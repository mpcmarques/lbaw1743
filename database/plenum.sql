DROP SCHEMA IF EXISTS plenum CASCADE;
CREATE SCHEMA plenum;
SET search_path TO plenum,public;
SET SCHEMA 'plenum';

/* every table should already be dropped, we are just making sure :) */
/* admin */
DROP TABLE IF EXISTS Admin;

/* UserTable */
DROP TABLE IF EXISTS UserTable;

/* premium signature*/
DROP TABLE IF EXISTS PremiumSignature;

/* country */
DROP TABLE IF EXISTS Country;

/* joined */
DROP TABLE IF EXISTS Joined;

/* project */
DROP TABLE IF EXISTS Project;

/* forum post*/
DROP TABLE IF EXISTS ForumPost;

/* reply */
DROP TABLE IF EXISTS Reply;

/* banned record */
DROP TABLE IF EXISTS BannedRecord;

/* task */
DROP TABLE IF EXISTS Task;

/* tag */
DROP TABLE IF EXISTS Tag;

/* tagged */
DROP TABLE IF Exists Tagged;

/* comment */
DROP TABLE IF EXISTS Comment;

/* completed task*/
DROP TABLE IF EXISTS Completed_Task;

/* close request */
DROP TABLE IF EXISTS CloseRequest;

/* edit task info */
DROP TABLE IF EXISTS EditTaskInfo;

/* assigned */
DROP TABLE IF EXISTS Assigned;

/* dropping old data types*/
DROP TYPE IF EXISTS gender;
DROP TYPE IF EXISTS role;

/* creating data types */
CREATE TYPE gender AS ENUM('Male', 'Female');
CREATE TYPE role AS ENUM('Owner' , 'Coordinator', 'Member');

/* country */
CREATE TABLE Country(
	idCountry serial PRIMARY KEY,
	name text UNIQUE NOT NULL
);

/* UserTable */
CREATE TABLE UserTable(
	idUser serial PRIMARY KEY,
	username text UNIQUE NOT NULL,
	password text NOT NULL,
	email text UNIQUE NOT NULL,
	premium boolean NOT NULL,
	banned boolean NOT NULL,
	name text NOT NULL,
	gender gender,
	address text,
	institution text,
	description text,
	birthDate date CONSTRAINT valid_date CHECK (birthdate < current_date),
	idCountry integer,
	FOREIGN KEY(idCountry) REFERENCES Country(idCountry)
);

/* premium signature */
CREATE TABLE PremiumSignature(
	idPremium serial PRIMARY KEY,
	startDate timestamp NOT NULL,
	duration  interval NOT NULL CHECK (duration > interval '0'),
	idUser integer NOT NULL,
	FOREIGN KEY(idUser) REFERENCES UserTable(idUser)
);

/* project */
CREATE TABLE Project(
	idProject serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	name text NOT NULL,
	description text NOT NULL,
	private boolean NOT NULL
);

/* joined */
CREATE TABLE Joined(
	idUser integer,
	idProject integer,
	joinedDate timestamp NOT NULL,
	role Role NOT NULL,
	PRIMARY KEY(idUser, idProject),
	FOREIGN KEY(idUser) REFERENCES UserTable(idUser),
	FOREIGN KEY(idProject) REFERENCES Project(idProject)
);

/* forum post */
CREATE TABLE ForumPost(
	idPost serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	lastEditDate timestamp,
	title text NOT NULL,
	content text NOT NULL,
	idProject integer NOT NULL,
	idUser integer NOT NULL,
	FOREIGN KEY(idProject) REFERENCES Project(idProject),
	FOREIGN KEY(idUser) REFERENCES UserTable(idUser)
);

/* reply */
CREATE TABLE Reply(
	idReply serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	lastEditDate timestamp,
	content text NOT NULL,
	idPost integer NOT NULL,
	idUser integer NOT NULL,
	FOREIGN KEY(idPost) REFERENCES ForumPost(idPost),
	FOREIGN KEY(idUser) REFERENCES UserTable(idUser)
);

/* task */
CREATE TABLE Task(
	idTask serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	lastEditDate timestamp,
	title text NOT NULL,
	description text,
	deadline timestamp,
	completed boolean NOT NULL,
	completetionDate timestamp,
	idUser integer NOT NULL,
	idProject integer NOT NULL,
	CONSTRAINT completionDate_valid CHECK (completetionDate > creationDate),
	FOREIGN KEY(idUser) REFERENCES UserTable(idUser),
	FOREIGN KEY(idProject) REFERENCES Project(idProject)
);

/* assigned */
CREATE TABLE Assigned(
	idUser integer,
	idTask integer,
	PRIMARY KEY(idUser, idTask),
	FOREIGN KEY(idUser) REFERENCES UserTable(idUser),
	FOREIGN KEY(idTask) REFERENCES Task(idTask)
);

/* edit task info */
CREATE TABLE EditTaskInfo(
	idUser integer,
	idTask integer,
	editDate timestamp NOT NULL,
	PRIMARY KEY(idUser, idTask),
	FOREIGN KEY(idUser) REFERENCES UserTable(idUser),
	FOREIGN KEY(idTask) REFERENCES Task(idTask)
);

/* comment */
CREATE TABLE Comment(
	idComment serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	lastEditDate timestamp,
	content text NOT NULL,
	idTask integer NOT NULL,
	idUser integer NOT NULL,
	idParent integer,
	FOREIGN KEY(idTask) REFERENCES Task(idTask),
	FOREIGN KEY(idUser) REFERENCES UserTable(idUser),
	FOREIGN KEY(idParent) REFERENCES Comment(idComment)
);

/* tag */
CREATE TABLE Tag(
	idTag serial PRIMARY KEY,
	name text UNIQUE NOT NULL
);

/* tagged */
CREATE TABLE Tagged(
	idTask integer,
	idTag integer,
	PRIMARY KEY(idTask, idTag),
	FOREIGN KEY(idTask) REFERENCES Task(idTask),
	FOREIGN KEY(idTag) REFERENCES Tag(idTag)
);

/* close request */
CREATE TABLE CloseRequest(
	idRequest serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	title text NOT NULL,
	description text,
	approved boolean NOT NULL,
	idUser integer NOT NULL,
	idTask integer NOT NULL,
	FOREIGN KEY(idUser) REFERENCES UserTable(idUser),
	FOREIGN KEY(idTask) REFERENCES Task(idTask)
);

/* Admin */
CREATE TABLE Admin(
	idAdmin serial PRIMARY KEY,
	username text UNIQUE NOT NULL,
	email text UNIQUE NOT NULL,
	password text NOT NULL
);

/* Banned record */
CREATE TABLE BannedRecord(
	idBan serial PRIMARY KEY,
	startDate timestamp NOT NULL,
	duration interval NOT NULL,
	motive text,
	idUser integer NOT NULL,
	idAdmin integer NOT NULL,
	FOREIGN KEY(idUser) REFERENCES UserTable(idUser),
	FOREIGN KEY(idAdmin) REFERENCES Admin(idAdmin),
	CONSTRAINT min_time check (duration > interval '0 second')
);

/*Performance Indexes*/

    /*User*/
    DROP INDEX IF EXISTS emailUser;

    CREATE INDEX emailUser ON UserTable USING hash (email);

    /*Task*/
    DROP INDEX IF EXISTS taskUser;
    DROP INDEX IF EXISTS deadlineTask;

    CREATE INDEX taskUser ON Task USING hash(idUser);
    CREATE INDEX deadlineTask ON Task USING btree (DEADLINE);

    /*Project*/
    DROP INDEX IF EXISTS projectUser;

    CREATE INDEX projectUser ON Joined USING hash(idUser);

/*Full-text Search Indexes*/

    DROP INDEX IF EXISTS search_user;
    DROP INDEX IF EXISTS search_project;
    DROP INDEX IF EXISTS search_task;

    CREATE INDEX search_user ON UserTable USING GIN (to_tsvector('english', username || name));
    CREATE INDEX search_project ON Project USING GIN (to_tsvector('english', name || description));
    CREATE INDEX search_task ON Task USING GIN (to_tsvector('english', title || description));

-- Only a User who Joined a Project can create Posts in it's Forum.
DROP TRIGGER IF EXISTS onCreatePost ON ForumPost;

CREATE OR REPLACE FUNCTION insertPost() RETURNS TRIGGER AS
$BODY$
  BEGIN
    IF NOT EXISTS (
      SELECT * FROM Joined
      WHERE new.idUser = Joined.idUser AND new.idProject = Joined.idProject)
    THEN
      RAISE EXCEPTION 'Only a user who joined a project can post in its forum.';
    END IF;
    RETURN NEW;
  END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreatePost BEFORE INSERT ON ForumPost
FOR EACH ROW
EXECUTE PROCEDURE insertPost();

-- Only a User who Joined a Project can Reply in it's Forum.
DROP TRIGGER IF EXISTS onCreateReply ON Reply;

CREATE OR REPLACE FUNCTION insertReply() RETURNS TRIGGER AS
$BODY$
  BEGIN
    IF NOT EXISTS (
      SELECT * FROM Joined, ForumPost
      WHERE new.idPost = ForumPost.idPost AND ForumPost.idProject = Joined.idProject AND new.idUser = Joined.idUser)
    THEN
      RAISE EXCEPTION 'Only a user who joined a project can reply to posts in its forum.';
    END IF;
    RETURN NEW;
  END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateReply BEFORE INSERT ON Reply
FOR EACH ROW
EXECUTE PROCEDURE insertReply();

-- Only a user who has Joined a Project can create Comments for a Project Task.
DROP TRIGGER IF EXISTS onCreateComment ON Comment;

CREATE OR REPLACE FUNCTION insertComent() RETURNS TRIGGER AS
$BODY$
  BEGIN
    IF NOT EXISTS (
      SELECT * FROM Joined, Task
      WHERE new.idTask = Task.idTask AND Task.idProject = Joined.idProject AND new.idUser = Joined.idUser)
    THEN
      RAISE EXCEPTION 'Only a user who joined a project can create comments for a Project Task.';
    END IF;
    RETURN NEW;
  END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateComment BEFORE INSERT ON Comment
FOR EACH ROW
EXECUTE PROCEDURE insertComent();

-- Only a User who was Assigned to a Task can create a Close Request for it.
DROP TRIGGER IF EXISTS onCreateCloseRequest ON CloseRequest;

CREATE OR REPLACE FUNCTION insertCloseRequest() RETURNS TRIGGER AS
$BODY$
  BEGIN
    IF NOT EXISTS (
      SELECT * FROM Assigned
      WHERE new.idTask = Assigned.idTask AND new.idUser = Assigned.idUser)
    THEN
      RAISE EXCEPTION 'Only a user who joined a project can create comments for a Project Task.';
    END IF;
    RETURN NEW;
  END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateCloseRequest BEFORE INSERT ON CloseRequest
FOR EACH ROW
EXECUTE PROCEDURE insertCloseRequest();

-- Only a User who Joined a Project can create Tasks for It.
DROP TRIGGER IF EXISTS onCreateTask ON Task;

CREATE OR REPLACE FUNCTION insertTask() RETURNS TRIGGER AS
$BODY$
  BEGIN
    IF NOT EXISTS (
      SELECT * FROM Joined
      WHERE new.idUser = Joined.idUser AND new.idProject = Joined.idProject)
    THEN
      RAISE EXCEPTION 'Only a user who joined a project can create tasks for it.';
    END IF;
    RETURN NEW;
  END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateTask BEFORE INSERT ON Task
FOR EACH ROW
EXECUTE PROCEDURE insertTask();

-- Only a User who Joined a Project can be assigned to it's Tasks.
DROP TRIGGER IF EXISTS onCreateAssigned ON Assigned;

CREATE OR REPLACE FUNCTION insertAssigned() RETURNS TRIGGER AS
$BODY$
  BEGIN
    IF NOT EXISTS (
      SELECT * FROM Joined, Task
      WHERE new.idUser = Joined.idUser AND new.idTask = Task.idTask AND Task.idProject = Joined.idProject)
    THEN
      RAISE EXCEPTION 'Only a user who joined a project can be assigned to its tasks.';
    END IF;
    RETURN NEW;
  END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateAssigned BEFORE INSERT ON Assigned
FOR EACH ROW
EXECUTE PROCEDURE insertAssigned();

-- A Project can only be private while the Owner is a Premium User.
DROP TRIGGER IF EXISTS onCreateProject ON Project;

CREATE OR REPLACE FUNCTION canProjectBePrivate() RETURNS TRIGGER AS
$BODY$
  BEGIN
  IF NOT EXISTS (
    SELECT * FROM Joined, UserTable
    WHERE new.idProject = Joined.idProject AND Joined.role = 'Owner' AND Joined.idUser = UserTable.idUser AND UserTable.premium = true)
  THEN
    RAISE EXCEPTION 'A Project can only be private while the Owner is a Premium User.';
  END IF;
  RETURN NEW;
  END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateProject BEFORE UPDATE ON Project
FOR EACH ROW
WHEN (NEW.private IS TRUE)
EXECUTE PROCEDURE canProjectBePrivate();

DROP TRIGGER IF EXISTS onUpdateUser ON UserTable;

CREATE OR REPLACE FUNCTION updateUserTable() RETURNS TRIGGER AS
$BODY$
  BEGIN
  IF EXISTS (
    SELECT * FROM Joined, Project
    WHERE new.idUser = Joined.idUser AND Joined.role = 'Owner' AND Project.idProject = Joined.idProject AND Project.private = true)
  THEN
    RAISE EXCEPTION 'A Project can only be private while the Owner is a Premium User.';
  END IF;
  RETURN NEW;
  END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onUpdateUser BEFORE UPDATE ON UserTable
FOR EACH ROW
WHEN (new.premium = false)
EXECUTE PROCEDURE updateUserTable();

-- A Project can only have one owner.

DROP TRIGGER IF EXISTS onCreateJoined ON UserTable;

CREATE OR REPLACE FUNCTION onlyOneOwner() RETURNS TRIGGER AS
$BODY$
  BEGIN
  IF EXISTS (
    SELECT * FROM Joined
    WHERE new.idProject = Joined.idProject AND Joined.role = 'Owner')
  THEN
    RAISE EXCEPTION 'A Project can only have one owner.';
  END IF;
  RETURN NEW;
  END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateJoined BEFORE INSERT ON Joined
FOR EACH ROW
WHEN (new.role = 'Owner')
EXECUTE PROCEDURE onlyOneOwner();
