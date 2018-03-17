DROP SCHEMA IF EXISTS public CASCADE;
CREATE SCHEMA public;
SET SCHEMA 'public';

GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO public;

/* admin */
DROP TABLE IF EXISTS Admin;

/* user */
DROP TABLE IF EXISTS User;

/* premium signature*/
DROP TABLE IF EXISTS PremiumSignature;

/* country */
DROP TABLE IF EXISTS Country;

/* joined */
DROP TABLE IF EXISTS Joined;

/* project */
DROP TABLE IF EXISTS Project;

/* project forum */
DROP TABLE IF EXISTS ProjectForum;

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

/* edit comment info */
DROP TABLE IF EXISTS EditCommentInfo;

/* thread */
DROP TABLE IF EXISTS Thread;

DROP TABLE IF EXISTS Completed_Task;

/* close request */
DROP TABLE IF EXISTS CloseRequest;

/* edit task info */
DROP TABLE IF EXISTS EditTaskInfo;

/* assigned */
DROP TABLE IF EXISTS Assigned;

CREATE FUNCTION XOR(bool,bool) RETURNS bool AS '
SELECT ($1 AND NOT $2) OR (NOT $1 AND $2);
' LANGUAGE 'sql';

/* Admin */
CREATE TABLE public.Admin
(
	idAdmin PRIMARY KEY,
	username text UNIQUE NOT NULL,
	email text UNIQUE NOT NULL,
	password text NOT NULL,
);

/* User */
CREATE TABLE public.User
(
	idUser serial PRIMARY KEY,
	username text UNIQUE NOT NULL,
    password text NOT NULL,
	email text UNIQUE NOT NULL,
    gender ENUM('M', 'F'),
    name text NOT NULL,
	address text,
	institution text,
    description text,
    birthDate date,
	CONSTRAINT valid_date CHECK (birthdate < current_date),
    FOREIGN KEY(idCountry) REFERENCES Country(idCountry)
);

/* premium signature */
CREATE TABLE public.PremiumSignature
(
	idPremium serial PRIMARY KEY,
	startDate timestamp NOT NULL,
	duration  INTEGER NOT NULL,
	CONSTRAINT min_size CHECK (duration > 0),
    FOREIGN KEY(idUser) REFERENCES User(idUser)
);

/* country */
CREATE TABLE public.Country
(
	idCountry serial PRIMARY KEY,
	name text UNIQUE NOT NULL
);

/* joined */
CREATE TABLE public.Joined
(
    FOREIGN KEY(idJoined) REFERENCES User(IdJoined)
	FOREIGN KEY(idProject) REFERENCES Project(idProject),
	joinedDate timestamp NOT NULL,
	leftDate timestamp,
	role Role NOT NULL
);

/* project */
CREATE TABLE public.Project
(	
	idProject serial PRIMARY KEY,
    creationDate timestamp NOT NULL,
	name text NOT NULL,
	description text NOT NULL,
	private boolean NOT NULL,
	FOREIGN KEY(idForum) REFERENCES ProjectForum(idForum) UNIQUE,
);

/* project forum */
CREATE TABLE public.ProjectForum
(
    idForum serial PRIMARY KEY,
    FOREIGN KEY(idProject) REFERENCES Project(idProject)
);

/* forum post */
CREATE TABLE public.ForumPost
(
    idPost serial PRIMARY KEY,
    creationDate timestamp NOT NULL,
    title text NOT NULL,
    content text NOT NULL,
    FOREIGN KEY(idForum) REFERENCES ProjectForum(idForum),
	FOREIGN KEY(idUser) REFERENCES User(idUser)
);

/* TODO: Reply deve ter uma foreign key para o post do forum tambem */
CREATE TABLE public.Reply
(
	idReply serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	content text NOT NULL,
	FOREIGN KEY(idUser) REFERENCES User(idUser)
);

/* Banned record */
CREATE TABLE public.BannedRecord
(
	idBan serial PRIMARY KEY,
	startDate timestamp NOT NULL,
	duration integer NOT NULL,
	motive text,
	FOREIGN KEY(idUser) REFERENCES User(idUser),
	FOREIGN KEY(idAdmin) REFERENCES Admin(idAdmin)
	CONSTRAINT min_time check (duration > 0)
);

/* task */
CREATE TABLE public.Task
(
    idTask serial PRIMARY KEY,
    title text NOT NULL,
    description text,
    creationDate timestamp NOT NULL,
    deadline timestamp,
	completed boolean NOT NULL,
	completedDate timestamp,
	FOREIGN KEY(idUser) REFERENCES User(idUser),
	FOREIGN KEY(idProject) REFERENCES Project(idProject),

    CONSTRAINT completedDate CHECK (completedDate > creationDate)
);

/* assigned */
CREATE TABLE public.Assigned
(
	FOREIGN KEY(idUser) REFERENCES User(idUser),
	FOREIGN KEY(idTask) REFERENCES Task(idTask)
);

/* edit task info */
CREATE TABLE public.EditTaskInfo
(
	FOREIGN KEY(idUser) REFERENCES User(idUser),
	FOREIGN KEY(idTask) REFERENCES Task(idTask),
	editDate date NOT NULL,
	oldTitle text NOT NULL,
	oldDescription text,
	oldDeadline timestamp
);

/* comment */
CREATE TABLE public.Comment
(
	idComment serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	content TEXT NOT NULL,
	FOREIGN KEY(idTask) REFERENCES Task(idTask),
	FOREIGN KEY(idUser) REFERENCES User(idUser)
);

/* edit comment info */
CREATE TABLE public.EditCommentInfo
(
	FOREIGN KEY(idUser) REFERENCES User(idUser),
	FOREIGN KEY(idComment) REFERENCES Comment(idComment),
	editDate timestamp NOT NULL,
	oldContent text NOT NULL
);

/* tag */
CREATE TABLE public.Tag
(
	idTag serial PRIMARY KEY,
	name varchar(1000) NOT NULL,
);

/* tagged */
CREATE TABLE public.Tagged
(
	FOREIGN KEY(idTask) REFERENCES Task(idTask),
	FOREIGN KEY(idTag) REFERENCES Tag(idTag)
);

/* thread */
CREATE TABLE public.Thread
(
	FOREIGN KEY(parent) REFERENCES Comment(parent),
	FOREIGN KEY(son) REFERENCES Comment(son)
)

/* close request */
CREATE TABLE public.CloseRequest
(
	idRequest serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	title text NOT NULL,
	description text,
	aproved boolean NOT NULL,
	FOREIGN KEY(idUser) REFERENCES User(idUser),
	FOREIGN KEY(idTask) REFERENCES Task(idTask)
);

