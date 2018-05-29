/*DROP EXTENSION IF EXISTS pgcrypto;
CREATE EXTENSION pgcrypto;*/

/* every table should already be dropped, we are just making sure :) */
/* admin */
DROP TABLE IF EXISTS Admin CASCADE;

/* UserTable */
DROP TABLE IF EXISTS UserTable CASCADE ;

/* premium signature*/
DROP TABLE IF EXISTS PremiumSignature CASCADE;

/* country */
DROP TABLE IF EXISTS Country CASCADE;

/* joined */
DROP TABLE IF EXISTS Joined CASCADE;

/* project */
DROP TABLE IF EXISTS Project CASCADE;

/* forum post*/
DROP TABLE IF EXISTS ForumPost CASCADE;

/* reply */
DROP TABLE IF EXISTS Reply CASCADE;

/* banned record */
DROP TABLE IF EXISTS BannedRecord CASCADE;

/* task */
DROP TABLE IF EXISTS Task CASCADE;

/* tag */
DROP TABLE IF EXISTS Tag CASCADE;

/* tagged */
DROP TABLE IF Exists Tagged CASCADE;

/* comment */
DROP TABLE IF EXISTS Comment CASCADE;

/* completed task*/
DROP TABLE IF EXISTS Completed_Task CASCADE;

/* close request */
DROP TABLE IF EXISTS CloseRequest CASCADE;

/* edit task info */
DROP TABLE IF EXISTS EditTaskInfo CASCADE;

/* assigned */
DROP TABLE IF EXISTS Assigned CASCADE;

/* dropping old data types*/
DROP TYPE IF EXISTS gender;
DROP TYPE IF EXISTS role;
DROP TYPE IF EXISTS login;

/* creating data types */
CREATE TYPE gender AS ENUM('Male', 'Female');
CREATE TYPE role AS ENUM('Owner' , 'Manager', 'Member');
CREATE TYPE login AS ENUM('user' , 'admin');

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
	remember_token text,
	birthDate date CONSTRAINT valid_date CHECK (birthdate < current_date),
	idCountry integer,
	type login default 'user',
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
	lastEditDate timestamp,
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
	CONSTRAINT deadline_valid CHECK (deadline > creationDate),
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
	approvedUser integer,
	approvedDate timestamp,
	idUser integer NOT NULL,
	idTask integer NOT NULL,
	FOREIGN KEY(approvedUser) REFERENCES UserTable(idUser),
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
	FOREIGN KEY(idAdmin) REFERENCES UserTable(idUser),
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

-- -- Only a user who has Joined a Project can create Comments for a Project Task.
-- DROP TRIGGER IF EXISTS onCreateComment ON Comment;
--
-- CREATE OR REPLACE FUNCTION insertComent() RETURNS TRIGGER AS
-- $BODY$
--   BEGIN
--     IF NOT EXISTS (
--       SELECT * FROM Joined, Task
--       WHERE new.idTask = Task.idTask AND Task.idProject = Joined.idProject AND new.idUser = Joined.idUser)
--     THEN
--       RAISE EXCEPTION 'Only a user who joined a project can create comments for a Project Task.';
--     END IF;
--     RETURN NEW;
--   END;
-- $BODY$
-- LANGUAGE plpgsql;
--
-- CREATE TRIGGER onCreateComment BEFORE INSERT ON Comment
-- FOR EACH ROW
-- EXECUTE PROCEDURE insertComent();

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

    DROP INDEX IF EXISTS search_username;
    DROP INDEX IF EXISTS search_user_name;
    DROP INDEX IF EXISTS search_project_name;
    DROP INDEX IF EXISTS search_project_description;
    DROP INDEX IF EXISTS search_task_name;
    DROP INDEX IF EXISTS search_task_description;

    CREATE INDEX search_username ON UserTable USING GIN (to_tsvector('english', username));
    CREATE INDEX search_user_name ON UserTable USING GIN (to_tsvector('english', name));
    CREATE INDEX search_project_name ON Project USING GIN (to_tsvector('english', name));
    CREATE INDEX search_project_description ON Project USING GIST (to_tsvector('english', description));
    CREATE INDEX search_task_name ON Task USING GIN (to_tsvector('english', title));
    CREATE INDEX search_task_description ON Task USING GIST (to_tsvector('english', description));

/* INSERTS */

--Countries
insert into country (name) values ('Andorra');
insert into country (name) values ('United Arab Emirates');
insert into country (name) values ('Afghanistan');
insert into country (name) values ('Antigua and Barbuda');
insert into country (name) values ('Anguilla');
insert into country (name) values ('Albania');
insert into country (name) values ('Armenia');
insert into country (name) values ('Angola');
insert into country (name) values ('Antarctica');
insert into country (name) values ('Argentina');
insert into country (name) values ('American Samoa');
insert into country (name) values ('Austria');
insert into country (name) values ('Australia');
insert into country (name) values ('Aruba');
insert into country (name) values ('Åland Islands');
insert into country (name) values ('Azerbaijan');
insert into country (name) values ('Bosnia and Herzegovina');
insert into country (name) values ('Barbados');
insert into country (name) values ('Bangladesh');
insert into country (name) values ('Belgium');
insert into country (name) values ('Burkina Faso');
insert into country (name) values ('Bulgaria');
insert into country (name) values ('Bahrain');
insert into country (name) values ('Burundi');
insert into country (name) values ('Benin');
insert into country (name) values ('Saint Barthélemy');
insert into country (name) values ('Bermuda');
insert into country (name) values ('Brunei Darussalam');
insert into country (name) values ('Bolivia');
insert into country (name) values ('Caribbean Netherlands ');
insert into country (name) values ('Brazil');
insert into country (name) values ('Bahamas');
insert into country (name) values ('Bhutan');
insert into country (name) values ('Bouvet Island');
insert into country (name) values ('Botswana');
insert into country (name) values ('Belarus');
insert into country (name) values ('Belize');
insert into country (name) values ('Canada');
insert into country (name) values ('Cocos (Keeling) Islands');
insert into country (name) values ('Democratic Republic of Congo');
insert into country (name) values ('Central African Republic');
insert into country (name) values ('Congo');
insert into country (name) values ('Switzerland');
insert into country (name) values ('Côte d''Ivoire');
insert into country (name) values ('Cook Islands');
insert into country (name) values ('Chile');
insert into country (name) values ('Cameroon');
insert into country (name) values ('China');
insert into country (name) values ('Colombia');
insert into country (name) values ('Costa Rica');
insert into country (name) values ('Cuba');
insert into country (name) values ('Cape Verde');
insert into country (name) values ('Curaçao');
insert into country (name) values ('Christmas Island');
insert into country (name) values ('Cyprus');
insert into country (name) values ('Czech Republic');
insert into country (name) values ('Germany');
insert into country (name) values ('Djibouti');
insert into country (name) values ('Denmark');
insert into country (name) values ('Dominica');
insert into country (name) values ('Dominican Republic');
insert into country (name) values ('Algeria');
insert into country (name) values ('Ecuador');
insert into country (name) values ('Estonia');
insert into country (name) values ('Egypt');
insert into country (name) values ('Western Sahara');
insert into country (name) values ('Eritrea');
insert into country (name) values ('Spain');
insert into country (name) values ('Ethiopia');
insert into country (name) values ('Finland');
insert into country (name) values ('Fiji');
insert into country (name) values ('Falkland Islands');
insert into country (name) values (' Federated States of Micronesia');
insert into country (name) values ('Faroe Islands');
insert into country (name) values ('France');
insert into country (name) values ('Gabon');
insert into country (name) values ('United Kingdom');
insert into country (name) values ('Grenada');
insert into country (name) values ('Georgia');
insert into country (name) values ('French Guiana');
insert into country (name) values ('Guernsey');
insert into country (name) values ('Ghana');
insert into country (name) values ('Gibraltar');
insert into country (name) values ('Greenland');
insert into country (name) values ('Gambia');
insert into country (name) values ('Guinea');
insert into country (name) values ('Guadeloupe');
insert into country (name) values ('Equatorial Guinea');
insert into country (name) values ('Greece');
insert into country (name) values ('South Georgia and the South Sandwich Islands');
insert into country (name) values ('Guatemala');
insert into country (name) values ('Guam');
insert into country (name) values ('Guinea-Bissau');
insert into country (name) values ('Guyana');
insert into country (name) values ('Hong Kong');
insert into country (name) values ('Heard and McDonald Islands');
insert into country (name) values ('Honduras');
insert into country (name) values ('Croatia');
insert into country (name) values ('Haiti');
insert into country (name) values ('Hungary');
insert into country (name) values ('Indonesia');
insert into country (name) values ('Ireland');
insert into country (name) values ('Israel');
insert into country (name) values ('Isle of Man');
insert into country (name) values ('India');
insert into country (name) values ('British Indian Ocean Territory');
insert into country (name) values ('Iraq');
insert into country (name) values ('Iran');
insert into country (name) values ('Iceland');
insert into country (name) values ('Italy');
insert into country (name) values ('Jersey');
insert into country (name) values ('Jamaica');
insert into country (name) values ('Jordan');
insert into country (name) values ('Japan');
insert into country (name) values ('Kenya');
insert into country (name) values ('Kyrgyzstan');
insert into country (name) values ('Cambodia');
insert into country (name) values ('Kiribati');
insert into country (name) values ('Comoros');
insert into country (name) values ('Saint Kitts and Nevis');
insert into country (name) values ('North Korea');
insert into country (name) values ('South Korea');
insert into country (name) values ('Kuwait');
insert into country (name) values ('Cayman Islands');
insert into country (name) values ('Kazakhstan');
insert into country (name) values ('Lao People''s Democratic Republic');
insert into country (name) values ('Lebanon');
insert into country (name) values ('Saint Lucia');
insert into country (name) values ('Liechtenstein');
insert into country (name) values ('Sri Lanka');
insert into country (name) values ('Liberia');
insert into country (name) values ('Lesotho');
insert into country (name) values ('Lithuania');
insert into country (name) values ('Luxembourg');
insert into country (name) values ('Latvia');
insert into country (name) values ('Libya');
insert into country (name) values ('Morocco');
insert into country (name) values ('Monaco');
insert into country (name) values ('Moldova');
insert into country (name) values ('Montenegro');
insert into country (name) values ('Saint-Martin (France)');
insert into country (name) values ('Madagascar');
insert into country (name) values ('Marshall Islands');
insert into country (name) values ('Macedonia');
insert into country (name) values ('Mali');
insert into country (name) values ('Myanmar');
insert into country (name) values ('Mongolia');
insert into country (name) values ('Macau');
insert into country (name) values ('Northern Mariana Islands');
insert into country (name) values ('Martinique');
insert into country (name) values ('Mauritania');
insert into country (name) values ('Montserrat');
insert into country (name) values ('Malta');
insert into country (name) values ('Mauritius');
insert into country (name) values ('Maldives');
insert into country (name) values ('Malawi');
insert into country (name) values ('Mexico');
insert into country (name) values ('Malaysia');
insert into country (name) values ('Mozambique');
insert into country (name) values ('Namibia');
insert into country (name) values ('New Caledonia');
insert into country (name) values ('Niger');
insert into country (name) values ('Norfolk Island');
insert into country (name) values ('Nigeria');
insert into country (name) values ('Nicaragua');
insert into country (name) values ('The Netherlands');
insert into country (name) values ('Norway');
insert into country (name) values ('Nepal');
insert into country (name) values ('Nauru');
insert into country (name) values ('Niue');
insert into country (name) values ('New Zealand');
insert into country (name) values ('Oman');
insert into country (name) values ('Panama');
insert into country (name) values ('Peru');
insert into country (name) values ('French Polynesia');
insert into country (name) values ('Papua New Guinea');
insert into country (name) values ('Philippines');
insert into country (name) values ('Pakistan');
insert into country (name) values ('Poland');
insert into country (name) values ('St. Pierre and Miquelon');
insert into country (name) values ('Pitcairn');
insert into country (name) values ('Puerto Rico');
insert into country (name) values ('State of Palestine');
insert into country (name) values ('Portugal');
insert into country (name) values ('Palau');
insert into country (name) values ('Paraguay');
insert into country (name) values ('Qatar');
insert into country (name) values ('Réunion');
insert into country (name) values ('Romania');
insert into country (name) values ('Serbia');
insert into country (name) values ('Russian Federation');
insert into country (name) values ('Rwanda');
insert into country (name) values ('Saudi Arabia');
insert into country (name) values ('Solomon Islands');
insert into country (name) values ('Seychelles');
insert into country (name) values ('Sudan');
insert into country (name) values ('Sweden');
insert into country (name) values ('Singapore');
insert into country (name) values ('Saint Helena');
insert into country (name) values ('Slovenia');
insert into country (name) values ('Svalbard and Jan Mayen Islands');
insert into country (name) values ('Slovakia');
insert into country (name) values ('Sierra Leone');
insert into country (name) values ('San Marino');
insert into country (name) values ('Senegal');
insert into country (name) values ('Somalia');
insert into country (name) values ('Suriname');
insert into country (name) values ('South Sudan');
insert into country (name) values ('Sao Tome and Principe');
insert into country (name) values ('El Salvador');
insert into country (name) values ('Sint Maarten');
insert into country (name) values ('Syria');
insert into country (name) values ('Swaziland');
insert into country (name) values ('Turks and Caicos Islands');
insert into country (name) values ('Chad');
insert into country (name) values ('French Southern Territories');
insert into country (name) values ('Togo');
insert into country (name) values ('Thailand');
insert into country (name) values ('Tajikistan');
insert into country (name) values ('Tokelau');
insert into country (name) values ('Timor-Leste');
insert into country (name) values ('Turkmenistan');
insert into country (name) values ('Tunisia');
insert into country (name) values ('Tonga');
insert into country (name) values ('Turkey');
insert into country (name) values ('Trinidad and Tobago');
insert into country (name) values ('Tuvalu');
insert into country (name) values ('Taiwan');
insert into country (name) values ('Tanzania');
insert into country (name) values ('Ukraine');
insert into country (name) values ('Uganda');
insert into country (name) values ('United States Minor Outlying Islands');
insert into country (name) values ('United States');
insert into country (name) values ('Uruguay');
insert into country (name) values ('Uzbekistan');
insert into country (name) values ('Vatican');
insert into country (name) values ('Saint Vincent and the Grenadines');
insert into country (name) values ('Venezuela');
insert into country (name) values ('Virgin Islands (British)');
insert into country (name) values ('Virgin Islands (U.S.)');
insert into country (name) values ('Vietnam');
insert into country (name) values ('Vanuatu');
insert into country (name) values ('Wallis and Futuna Islands');
insert into country (name) values ('Samoa');
insert into country (name) values ('Yemen');
insert into country (name) values ('Mayotte');
insert into country (name) values ('South Africa');
insert into country (name) values ('Zambia');
insert into country (name) values ('Zimbabwe');

--Users

-- PHreK9plUZ8
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('pputman0', '$2a$06$4snAaJ0gMEAsLt92yqdzS.bHCO8qwTU5knqCUm84nXrwGyRURq9K2', 'pputman0@usnews.com', true, false, 'Pincus Putman', 'Male', '8 Spaight Terrace', 'Demizz', 'Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.', '1994-12-11', 1);
-- vUf5vxe
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('belliker1', '$2a$06$GuA.t1pZHR2DdWNCnLit1uCa8PfNMvFLGzuPwIQu5y5hsN79K9fdi' , 'belliker1@gravatar.com', true, false, 'Betsey Elliker', 'Female', '2216 Nancy Way', 'Brainverse', 'Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.', '1998-03-24', 2);
-- jFY5qeZeAT0C
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('pfiggs2', '$2a$06$BRkiGZIuw.xtJain1iB4AOq9JqVw9cebAsCZNIfu799qzyd3or/zu' , 'pfiggs2@google.com.br', true, false, 'Pearla Figgs', 'Female', '854 Cambridge Pass', 'Vitz', 'Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.', '1991-02-19', 3);
-- yBU47k5sIVop
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('pmenendes3', '$2a$06$1bZFq1yOnbPoXPatsTYxm.bx1.b9okKzPoxP2mhHeOUi0dvmvIcWm' , 'pmenendes3@mlb.com', true, false, 'Patsy Menendes', 'Male', '28 Evergreen Hill', 'Oyope', 'Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.', '1998-08-27', 4);
	-- frrEEWm
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('rmathie4', '$2a$06$Ri5nCfU6OLKALXRq0cjPyehri9AgV98jTxbYSJzgHiXbcG1.YG8My', 'rmathie4@nih.gov', true, false, 'Rory Mathie', 'Female', '792 Garrison Park', 'Devcast', 'Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.', '1994-09-06', 5);
	-- ZZzD5chsNR
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('kmcritchie5','$2a$06$mHTZ.LdlHEjSUrZ.a8JfF.xOdFSEcrYc52Yb75D83JvHwcivm79mq'  , 'kmcritchie5@ed.gov', false, true, 'Kattie McRitchie', 'Female', '98951 Hudson Crossing', 'Skyndu', 'Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.', '1991-10-05', 6);
	-- 2zTXjXTFUo
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('pkeaves6','$2a$06$pOb8FYB9VsuqLoQ1M2zQ0eLiVOe85Y/U2N/r0tdkWHCVKHiOkEBza'  , 'pkeaves6@is.gd', false, false, 'Puff Keaves', 'Male', '4 Saint Paul Trail', 'Livepath', 'Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.', '1992-05-22', 7);
	-- DODIswuA
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('lsoles7','$2a$06$fs1YtLh/p6QsjdbxkzyCCe2fZjanMgGJ96rlcEdrxwN1NyI6A1ZDC'  , 'lsoles7@admin.ch', false, false, 'Leesa Soles', 'Female', '2 Oak Valley Way', 'Centizu', 'Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.', '1994-09-15', 8);
	-- rMw3Om
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('dstruttman8','$2a$06$XpsCM53aG6co5tuQRjLXw.v6ifUNdGEcgRC2hykRacXj6Wh98AkHa' , 'dstruttman8@spotify.com', false, false, 'Dareen Struttman', 'Female', '891 Meadow Valley Terrace', 'Topiclounge', 'Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.', '1996-06-22', 9);
	-- 3tkxbpaRq5Q
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('swaylen9','$2a$06$NawzyGiVYfdeZUaXFiJRHO.30xNvmzXjVTD65BC.pzMxO5fKyPnqO'  , 'swaylen9@biglobe.ne.jp', false, false, 'Sibelle Waylen', 'Female', '911 Paget Alley', 'Podcat', 'Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.', '1993-05-20', 10);
	-- S5xRwPhB
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('bjigglea','$2a$06$0W2Hq1LFfy6z28/Bc1mUXuuPbzYOEliMB02FqRS2gy6jX9HIOC6DW'  , 'bjigglea@yahoo.co.jp', false, false, 'Berkly Jiggle', 'Male', '00981 Packers Place', 'Gabcube', 'In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.', '1994-11-14', 11);
	-- WDAd613zAs
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('cjulianb','$2a$06$B4v7XlMls2iTylWgdPqB1.NfQ2S8dnst0l2kFiEGssFI./ChkHxty'  , 'cjulianb@abc.net.au', false, false, 'Coop Julian', 'Male', '9791 Mcguire Drive', 'Tagfeed', 'Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.', '1990-07-31', 12);
	-- ZtbKXID
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('ltwidlec','$2a$06$P8t1kHrq4iALLQm5hjl4AeUOY5DIubms7ARrHeQYjai/xBJ71YI5C'  , 'ltwidlec@freewebs.com', false, false, 'Linnea Twidle', 'Female', '2915 North Circle', 'Feedfire', 'Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.', '1993-04-16', 13);
	-- 3weUjK
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('ejurgesd','$2a$06$phvm3.OTqmZyQJBXK/ti5eHwx1bvt0H7BSxf.2.Q4HxV9WaeJjURG'  , 'ejurgesd@g.co', false, false, 'Elinore Jurges', 'Female', '539 Maple Wood Way', 'Oyonder', 'In congue. Etiam justo. Etiam pretium iaculis justo.', '1996-05-04', 14);
	-- c34fVIFUP8SQ
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('ilanone','$2a$06$9hO/8yrqJljk5IH7GiXZcOVjZoVlQZv2yqKQE9EENdLAfYCPH8E4y'  , 'ilanone@diigo.com', false, false, 'Isak Lanon', 'Male', '2 Oakridge Court', 'Blogtags', 'Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.', '1999-06-07', 15);
	-- ZasqJSdgH2
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('dscranneyf','$2a$06$RRKri4iZID/xjEnnd8trZeb5puebaB.KJLY8Y5hceuxhXDTIpL23e'  , 'dscranneyf@narod.ru', false, false, 'Dusty Scranney', 'Female', '8 Montana Pass', 'Kazio', 'Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.', '1994-05-25', 16);
	-- lRBgvAV
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('cstanlackg','$2a$06$br6RBcOXyTWxLkLs7lkyQu86eUUYIgX0v/y3TZv1GuRkslDDart5u'  , 'cstanlackg@simplemachines.org', false, false, 'Cathee Stanlack', 'Female', '97 Thierer Lane', 'Dabvine', 'Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.', '1993-06-03', 17);
	-- zy5pNl2rC
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('ccrinageh','$2a$06$./FnmB.PQwNlIvVRlcNK/.qWz4ZROQIXbTXSSesdje0A9Xt1ulN4y'  , 'ccrinageh@yellowbook.com', false, false, 'Chrystal Crinage', 'Female', '385 Northland Alley', 'Blogtags', 'Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.', '1991-02-12', 18);
	-- LFj7FG4cn
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('lcasini','$2a$06$MhDn3x.jm1Xg4QHeRmhTEOvZUf8hHPazE7K/c96nsg1rK0TzMxeRC'  , 'lcasini@admin.ch', false, false, 'Louella Casin', 'Female', '8543 Manufacturers Trail', 'Topicshots', 'Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.', '1992-05-06', 19);
	-- lANindUcz6
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry) values ('npallaschj', '$2a$06$i94DZYAuRShG/KFzrLBXeO83Zv3qATiJbZECOAhBQVYLNJvZM/6r2', 'npallaschj@addtoany.com', false, false, 'Neile Pallasch', 'Female', '17881 Gulseth Avenue', 'Realpoint', 'Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.', '1990-07-11', 20);


--PremiumSignature
insert into premiumsignature (startDate, duration, idUser) values ('2015-10-19', interval '1 year', 1);

insert into premiumsignature (startDate, duration, idUser) values ('2016-10-20', interval '5 year', 1);
insert into premiumsignature (startDate, duration, idUser) values ('2016-11-05', interval '5 year', 2);
insert into premiumsignature (startDate, duration, idUser) values ('2016-06-17', interval '5 year', 3);
insert into premiumsignature (startDate, duration, idUser) values ('2016-03-01', interval '5 year', 4);
insert into premiumsignature (startDate, duration, idUser) values ('2016-07-10', interval '5 year', 5);

--Project
insert into project (creationDate, lastEditDate, name, description, private) values ('2017-03-05', '2017-03-05', 'Tin', 'Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.', true);
insert into project (creationDate, lastEditDate, name, description, private) values ('2017-03-03', '2017-03-03', 'Treeflex', 'Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.', true);
insert into project (creationDate, lastEditDate, name, description, private) values ('2017-03-18', '2017-03-18', 'Sub-Ex', 'In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.', false);
insert into project (creationDate, lastEditDate, name, description, private) values ('2017-03-14', '2017-03-14', 'Bamity', 'Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.', false);
insert into project (creationDate, lastEditDate, name, description, private) values ('2017-02-09', '2017-02-09', 'Voltsillam', 'Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.', true);

--Joined
insert into joined (idUser, idProject, joinedDate, role) values (1, 1, '2017-10-22', 'Owner');
insert into joined (idUser, idProject, joinedDate, role) values (2, 2, '2017-11-07', 'Owner');
insert into joined (idUser, idProject, joinedDate, role) values (3, 3, '2017-06-21', 'Owner');
insert into joined (idUser, idProject, joinedDate, role) values (4, 4, '2017-03-06', 'Owner');
insert into joined (idUser, idProject, joinedDate, role) values (5, 5, '2017-07-19', 'Owner');
insert into joined (idUser, idProject, joinedDate, role) values (6, 1, '2017-09-22', 'Manager');
insert into joined (idUser, idProject, joinedDate, role) values (7, 2, '2017-04-27', 'Manager');
insert into joined (idUser, idProject, joinedDate, role) values (8, 3, '2017-04-27', 'Manager');
insert into joined (idUser, idProject, joinedDate, role) values (9, 4, '2017-07-03', 'Manager');
insert into joined (idUser, idProject, joinedDate, role) values (10, 5, '2017-06-29', 'Manager');
insert into joined (idUser, idProject, joinedDate, role) values (11, 1, '2017-09-22', 'Member');
insert into joined (idUser, idProject, joinedDate, role) values (12, 2, '2017-09-22', 'Member');
insert into joined (idUser, idProject, joinedDate, role) values (13, 3, '2017-09-25', 'Member');
insert into joined (idUser, idProject, joinedDate, role) values (14, 4, '2017-09-22', 'Member');
insert into joined (idUser, idProject, joinedDate, role) values (15, 5, '2017-09-23', 'Member');
insert into joined (idUser, idProject, joinedDate, role) values (16, 1, '2017-09-22', 'Member');
insert into joined (idUser, idProject, joinedDate, role) values (17, 2, '2017-09-21', 'Member');
insert into joined (idUser, idProject, joinedDate, role) values (18, 3, '2017-09-22', 'Member');
insert into joined (idUser, idProject, joinedDate, role) values (19, 4, '2017-09-20', 'Member');
insert into joined (idUser, idProject, joinedDate, role) values (20, 5, '2017-09-22', 'Member');

insert into joined (idUser, idProject, joinedDate, role) values (1, 5, '2017-10-20', 'Manager');


--ForumPost
insert into forumpost (creationDate, lastEditDate, title, content, idProject, idUser) values ('2017-04-17', '2018-01-17', 'Enhanced global customer loyalty', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.', 1, 1);
insert into forumpost (creationDate, lastEditDate, title, content, idProject, idUser) values ('2017-04-06', NULL, 'Triple-buffered secondary product', 'Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.', 2, 2);
insert into forumpost (creationDate, lastEditDate, title, content, idProject, idUser) values ('2017-06-19', '2018-02-25', 'Devolved dynamic structure', 'Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.', 3, 3);
insert into forumpost (creationDate, lastEditDate, title, content, idProject, idUser) values ('2018-02-23', NULL, 'Automated bottom-line challenge', 'Sed ante. Vivamus tortor. Duis mattis egestas metus.', 4, 4);
insert into forumpost (creationDate, lastEditDate, title, content, idProject, idUser) values ('2017-06-18', '2017-10-27', 'Re-contextualized multi-tasking process improvement', 'Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.', 5, 5);

--Reply
insert into reply (creationDate, lastEditDate, content, idPost, idUser) values ('2017-04-30', NULL, 'Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.', 1, 6);
insert into reply (creationDate, lastEditDate, content, idPost, idUser) values ('2018-03-21', NULL, 'Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.', 2, 7);
insert into reply (creationDate, lastEditDate, content, idPost, idUser) values ('2017-04-12', NULL, 'Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.', 3, 8);
insert into reply (creationDate, lastEditDate, content, idPost, idUser) values ('2017-09-23', '2017-09-25', 'Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.', 4, 9);
insert into reply (creationDate, lastEditDate, content, idPost, idUser) values ('2017-08-09', NULL, 'Fusce consequat. Nulla nisl. Nunc nisl.', 5, 10);

--Task
insert into task (creationDate, lastEditDate, title, description, deadline, completed, completetionDate, idUser, idProject) values ('2017-07-03', '2017-07-05', 'Customizable neutral circuit', 'Sed ante. Vivamus tortor. Duis mattis egestas metus.', '2018-05-04', true, '2018-05-13', 1, 1);
insert into task (creationDate, lastEditDate, title, description, deadline, completed, completetionDate, idUser, idProject) values ('2017-06-18', '2017-08-19', 'De-engineered multi-state structure', 'Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.', '2018-05-01', false, NULL, 2, 2);
insert into task (creationDate, lastEditDate, title, description, deadline, completed, completetionDate, idUser, idProject) values ('2017-06-29', '2017-06-25', 'Face to face foreground migration', 'Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', '2018-05-20', false, NULL, 3, 3);
insert into task (creationDate, lastEditDate, title, description, deadline, completed, completetionDate, idUser, idProject) values ('2018-01-19', '2017-04-25', 'Polarised secondary challenge', 'Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.', '2018-05-25', true, '2018-05-29', 4, 4);
insert into task (creationDate, lastEditDate, title, description, deadline, completed, completetionDate, idUser, idProject) values ('2017-03-25', '2017-05-29', 'Multi-tiered upward-trending hardware', 'Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', '2018-05-08', false, NULL, 5, 5);

insert into task (creationDate, lastEditDate, title, description, deadline, completed, completetionDate, idUser, idProject) values ('2017-09-03', '2017-09-03', 'Customizable neutral circuit II', 'Sed ante. Vivamus tortor. Duis mattis egestas metus.', '2018-06-04', false, NULL, 1, 1);

--Assigned
insert into assigned (idUser, idTask) values (1, 1);
insert into assigned (idUser, idTask) values (2, 2);
insert into assigned (idUser, idTask) values (3, 3);
insert into assigned (idUser, idTask) values (4, 4);
insert into assigned (idUser, idTask) values (5, 5);

insert into assigned (idUser, idTask) values (1, 6);
insert into assigned (idUser, idTask) values (6, 6);

--Comment
insert into comment (creationDate, lastEditDate, content, idTask, idUser) values ('2017-12-12', '2017-12-12', 'Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.', 1, 1);
insert into comment (creationDate, lastEditDate, content, idTask, idUser) values ('2018-03-02', '2018-03-02', 'Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.', 1, 6);
insert into comment (creationDate, lastEditDate, content, idTask, idUser, idParent) values ('2018-03-03', '2018-03-03', 'Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.', 1, 1, 2);

insert into comment (creationDate, lastEditDate, content, idTask, idUser) values ('2017-04-03', '2017-04-03', 'Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.', 2, 2);
insert into comment (creationDate, lastEditDate, content, idTask, idUser) values ('2017-10-01', '2017-10-01', 'Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.', 3, 3);
insert into comment (creationDate, lastEditDate, content, idTask, idUser) values ('2017-09-25', '2017-09-25', 'Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.', 4, 4);
insert into comment (creationDate, lastEditDate, content, idTask, idUser) values ('2017-07-12', '2017-07-12', 'Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.', 5, 5);
insert into comment (creationDate, lastEditDate, content, idTask, idUser) values ('2017-10-01', '2017-10-01', 'Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.', 2, 7);
--Tag
insert into tag (name) values ('full-range');
insert into tag (name) values ('moderator');
insert into tag (name) values ('capability');
insert into tag (name) values ('success');
insert into tag (name) values ('support');
insert into tag (name) values ('multi-tasking');
insert into tag (name) values ('interactive');
insert into tag (name) values ('moratorium');
insert into tag (name) values ('contextually-based');
insert into tag (name) values ('system engine');

--Tagged
insert into tagged (idTask, idTag) values (1, 1);
insert into tagged (idTask, idTag) values (2, 2);
insert into tagged (idTask, idTag) values (3, 3);
insert into tagged (idTask, idTag) values (4, 4);
insert into tagged (idTask, idTag) values (5, 5);

--CloseRequest
insert into closerequest (creationDate, title, description, approved, approvedUser, approvedDate, idUser, idTask) values ('2018-03-04', 'Distributed demand-driven forecast', 'Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.', true, 1,'2018-05-13', 1, 1);
insert into closerequest (creationDate, title, description, approved, approvedUser, approvedDate, idUser, idTask) values ('2018-03-02', 'Progressive upward-trending hierarchy', 'Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.', false, NULL, NULL, 2, 2);
insert into closerequest (creationDate, title, description, approved, approvedUser, approvedDate, idUser, idTask) values ('2018-01-06', 'Switchable leading edge pricing structure', 'Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.', false, NULL, NULL, 3, 3);
insert into closerequest (creationDate, title, description, approved, approvedUser, approvedDate, idUser, idTask) values ('2018-03-11', 'Digitized high-level analyzer', 'Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.', true, 4, '2018-05-29', 4, 4);
insert into closerequest (creationDate, title, description, approved, approvedUser, approvedDate, idUser, idTask) values ('2018-03-14', 'Profit-focused demand-driven workforce', 'Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', false, NULL, NULL, 5, 5);

--Admin
-- lbaw2018
insert into admin (username, email, password) values ('barbosa','up201503477@fe.up.pt' ,'$2a$06$uPtfqW7HmL2rTqWS3fTMN.jJCkPaGv.NSerysJofIxyii05VZPXSe');
insert into admin (username, email, password) values ('mario','up201503406@fe.up.pt' ,'$2a$06$uPtfqW7HmL2rTqWS3fTMN.jJCkPaGv.NSerysJofIxyii05VZPXSe');
insert into admin (username, email, password) values ('mateus','up201601876@fe.up.pt' ,'$2a$06$uPtfqW7HmL2rTqWS3fTMN.jJCkPaGv.NSerysJofIxyii05VZPXSe');
insert into admin (username, email, password) values ('jotapsa','up201506252@fe.up.pt' ,'$2a$06$uPtfqW7HmL2rTqWS3fTMN.jJCkPaGv.NSerysJofIxyii05VZPXSe');

-- lbaw2018
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry, type) values ('barbosa', '$2a$06$uPtfqW7HmL2rTqWS3fTMN.jJCkPaGv.NSerysJofIxyii05VZPXSe', 'up201503477@fe.up.pt', false, false, 'Bernardo Barbosa', 'Male', NULL, NULL, NULL, '1997-04-02', 1, 'admin');
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry, type) values ('mario', '$2a$06$uPtfqW7HmL2rTqWS3fTMN.jJCkPaGv.NSerysJofIxyii05VZPXSe', 'up201503406@fe.up.pt', false, false, 'Mário Santos', 'Male', NULL, NULL, NULL, '1996-01-01', 1, 'admin');
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry, type) values ('mateus', '$2a$06$uPtfqW7HmL2rTqWS3fTMN.jJCkPaGv.NSerysJofIxyii05VZPXSe', 'up201601876@fe.up.pt', false, false, 'Mateus Pedroza', 'Male', NULL, NULL, NULL, '1996-01-01', 1, 'admin');
insert into usertable (username, password, email, premium, banned, name, gender, address, institution, description, birthDate, idCountry, type) values ('jotapsa', '$2a$06$uPtfqW7HmL2rTqWS3fTMN.jJCkPaGv.NSerysJofIxyii05VZPXSe', 'up201506252@fe.up.pt', false, false, 'João Sá', 'Male', NULL, NULL, NULL, '1996-01-01', 1, 'admin');

--BannedRecord
insert into bannedrecord (startDate, duration, motive, idUser, idAdmin) values ('2018-01-20', interval '6 months', 'Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.', 19, 21);
