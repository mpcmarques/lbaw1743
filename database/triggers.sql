SET SCHEMA 'plenum';

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
