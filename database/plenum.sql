DROP SCHEMA IF EXISTS plenum CASCADE;
CREATE SCHEMA plenum;
SET search_path TO plenum,public;

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
	gender gender,
	name text NOT NULL,
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
	idUser integer,
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
	leftDate timestamp,
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
	completedDate timestamp,
	idUser integer,
	idProject integer,
	CONSTRAINT completedDate_valid CHECK (completedDate > creationDate),
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
	oldTitle text NOT NULL,
	oldDescription text,
	oldDeadline timestamp,
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
	FOREIGN KEY(idTask) REFERENCES Task(idTask),
	FOREIGN KEY(idUser) REFERENCES UserTable(idUser)
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
	aproved boolean NOT NULL,
	idUser integer,
	idTask integer,
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
	duration integer NOT NULL,
	motive text,
	idUser integer NOT NULL,
	idAdmin integer NOT NULL,
	FOREIGN KEY(idUser) REFERENCES UserTable(idUser),
	FOREIGN KEY(idAdmin) REFERENCES Admin(idAdmin),
	CONSTRAINT min_time check (duration > 0)
);
