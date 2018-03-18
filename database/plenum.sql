DROP SCHEMA IF EXISTS public CASCADE;
CREATE SCHEMA public;

/* admin */
DROP TABLE IF EXISTS public.Admin;

/* user */
DROP TABLE IF EXISTS public.User;

/* premium signature*/
DROP TABLE IF EXISTS public.PremiumSignature;

/* country */
DROP TABLE IF EXISTS public.Country;

/* joined */
DROP TABLE IF EXISTS public.Joined;

/* project */
DROP TABLE IF EXISTS public.Project;

/* project forum */
DROP TABLE IF EXISTS public.ProjectForum;

/* forum post*/
DROP TABLE IF EXISTS public.ForumPost;

/* reply */
DROP TABLE IF EXISTS public.Reply;

/* banned record */
DROP TABLE IF EXISTS public.BannedRecord;

/* task */
DROP TABLE IF EXISTS public.Task;

/* tag */
DROP TABLE IF EXISTS public.Tag;

/* tagged */
DROP TABLE IF Exists public.Tagged;

/* comment */
DROP TABLE IF EXISTS public.Comment;

/* edit comment info */
DROP TABLE IF EXISTS public.EditCommentInfo;

/* thread */
DROP TABLE IF EXISTS public.Thread;

/* completed task*/
DROP TABLE IF EXISTS public.Completed_Task;

/* close request */
DROP TABLE IF EXISTS public.CloseRequest;

/* edit task info */
DROP TABLE IF EXISTS public.EditTaskInfo;

/* assigned */
DROP TABLE IF EXISTS public.Assigned;

/* dropping old data types*/
DROP TYPE IF EXISTS public.gender;

/* creating data types */
CREATE TYPE public.gender AS ENUM('male', 'female', 'other');

/* country */
CREATE TABLE public.Country(
	idCountry serial PRIMARY KEY,
	name text UNIQUE NOT NULL
);

/* User */
CREATE TABLE public.User(
	idUser serial PRIMARY KEY,
	username text UNIQUE NOT NULL,
	password text NOT NULL,
	email text UNIQUE NOT NULL,
	gender public.gender,
	name text NOT NULL,
	address text,
	institution text,
	description text,
	birthDate date CONSTRAINT valid_date CHECK (birthdate < current_date),
	idCountry integer,
	FOREIGN KEY(idCountry) REFERENCES Country(idCountry)
);

/* premium signature */
CREATE TABLE public.PremiumSignature(
	idPremium serial PRIMARY KEY,
	startDate timestamp NOT NULL,
	duration  interval NOT NULL CHECK (duration > 0),
	idUser integer,
	FOREIGN KEY(idUser) REFERENCES User(idUser)
);

/* project forum */
CREATE TABLE public.ProjectForum(
	idForum serial PRIMARY KEY
);


/* project */
CREATE TABLE public.Project(
	idProject serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	name text NOT NULL,
	description text NOT NULL,
	private boolean NOT NULL,
	idForum integer UNIQUE NOT NULL,
	FOREIGN KEY(idForum) REFERENCES ProjectForum(idForum)
);

/* joined
CREATE TABLE public.Joined(

joinedDate timestamp NOT NULL,
leftDate timestamp,
role Role NOT NULL,
FOREIGN KEY(idJoined) REFERENCES User(IdJoined)
FOREIGN KEY(idProject) REFERENCES Project(idProject)
);
*/

/* forum post */
CREATE TABLE public.ForumPost(
	idPost serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	title text NOT NULL,
	content text NOT NULL,
	idForum integer NOT NULL,
	idUser integer NOT NULL,
	FOREIGN KEY(idForum) REFERENCES ProjectForum(idForum),
	FOREIGN KEY(idUser) REFERENCES User(idUser)
);

/* reply */
CREATE TABLE public.Reply(
	idReply serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	content text NOT NULL,
	idPost integer NOT NULL,
	idUser integer NOT NULL,
	FOREIGN KEY(idPost) REFERENCES ForumPost(idPost),
	FOREIGN KEY(idUser) REFERENCES User(idUser)
);

/* task */
CREATE TABLE public.Task(
	idTask serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	title text NOT NULL,
	description text,
	deadline timestamp,
	completed boolean NOT NULL,
	completedDate timestamp,
	CONSTRAINT completedDate_valid CHECK (completedDate > creationDate),
	FOREIGN KEY(idUser) REFERENCES User(idUser),
	FOREIGN KEY(idProject) REFERENCES Project(idProject),
);

/* assigned */
CREATE TABLE public.Assigned(
	idUser integer,
	idTask integer,
	PRIMARY KEY(idUser, idTask),
	FOREIGN KEY(idUser) REFERENCES User(idUser),
	FOREIGN KEY(idTask) REFERENCES Task(idTask)
);

/* edit task info */
CREATE TABLE public.EditTaskInfo(
	idUser integer,
	idTask integer,
	editDate timestamp NOT NULL,
	oldTitle text NOT NULL,
	oldDescription text,
	oldDeadline timestamp,
	PRIMARY KEY(idUser, idTask),
	FOREIGN KEY(idUser) REFERENCES User(idUser),
	FOREIGN KEY(idTask) REFERENCES Task(idTask)
);

/* comment */
CREATE TABLE public.Comment(
	idComment serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	content TEXT NOT NULL,
	idTask integer NOT NULL,
	idUser integer NOT NULL,
	FOREIGN KEY(idTask) REFERENCES Task(idTask),
	FOREIGN KEY(idUser) REFERENCES User(idUser)
);

/* edit comment info */
CREATE TABLE public.EditCommentInfo(
	idUser integer,
	idComment integer,
	editDate timestamp NOT NULL,
	oldContent text NOT NULL,
	PRIMARY KEY(idUser, idComment),
	FOREIGN KEY(idUser) REFERENCES User(idUser),
	FOREIGN KEY(idComment) REFERENCES Comment(idComment)
);

/* tag */
CREATE TABLE public.Tag(
	idTag serial PRIMARY KEY,
	name text UNIQUE NOT NULL
);

/* tagged */
CREATE TABLE public.Tagged(
	idTask integer,
	idTag integer,
	PRIMARY KEY(idTask, idTag),
	FOREIGN KEY(idTask) REFERENCES Task(idTask),
	FOREIGN KEY(idTag) REFERENCES Tag(idTag)
);

/* thread */
CREATE TABLE public.Thread(
	idSon integer PRIMARY KEY,
	idParent integer,
	FOREIGN KEY(idParent) REFERENCES Comment(idComment),
	FOREIGN KEY(idSon) REFERENCES Comment(idComment)
)

/* close request */
CREATE TABLE public.CloseRequest(
	idRequest serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	title text NOT NULL,
	description text,
	aproved boolean NOT NULL,
	idUser integer,
	idTask integer,
	FOREIGN KEY(idUser) REFERENCES User(idUser),
	FOREIGN KEY(idTask) REFERENCES Task(idTask)
);

/* Admin */
CREATE TABLE public.Admin(
	idAdmin serial PRIMARY KEY,
	username text UNIQUE NOT NULL,
	email text UNIQUE NOT NULL,
	password text NOT NULL
);

/* Banned record */
CREATE TABLE public.BannedRecord(
	idBan serial PRIMARY KEY,
	startDate timestamp NOT NULL,
	duration integer NOT NULL,
	motive text,
	FOREIGN KEY(idUser) REFERENCES User(idUser),
	FOREIGN KEY(idAdmin) REFERENCES Admin(idAdmin)
	CONSTRAINT min_time check (duration > 0)
);
