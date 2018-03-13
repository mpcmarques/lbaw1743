DROP SCHEMA IF EXISTS public CASCADE;
CREATE SCHEMA public;
SET SCHEMA 'public';

GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO public;

DROP TABLE IF EXISTS Admin;

DROP TABLE IF EXISTS User;

DROP TABLE IF EXISTS Premium;

DROP TABLE IF EXISTS Country;

DROP TABLE IF EXISTS City;

DROP TABLE IF EXISTS Joined;

DROP TABLE IF EXISTS Project;

DROP TABLE IF EXISTS Project_Forum;

DROP TABLE IF EXISTS Forum_Post;

DROP TABLE IF EXISTS Post_Reply;

DROP TABLE IF EXISTS Banned;

DROP TABLE IF EXISTS Role;

DROP TABLE IF EXISTS Task;

DROP TABLE IF EXISTS Comments;

DROP TABLE IF EXISTS Tag;

DROP TABLE IF EXISTS Completed_Task;

DROP TABLE IF EXISTS Close_Request;



CREATE FUNCTION XOR(bool,bool) RETURNS bool AS '
SELECT ($1 AND NOT $2) OR (NOT $1 AND $2);
' LANGUAGE 'sql';

CREATE TABLE public.Admin
(
	idAdmin PRIMARY KEY,
	username varchar(1000) UNIQUE NOT NULL,
	email varchar(1000) UNIQUE NOT NULL,
	password varchar(1000) NOT NULL,

CREATE TABLE public.Users
(
	idUser serial PRIMARY KEY,
	username varchar(1000) UNIQUE NOT NULL,
    password varchar(1000) NOT NULL,
	email varchar(1000) UNIQUE NOT NULL,
    gender ENUM('M', 'F'),
    name varchar(1000) NOT NULL,
	institution varchar(1000),
    description varchar(1000),
    birthdate date,
	CONSTRAINT valid_date CHECK (birthdate < current_date)
);


CREATE TABLE public.Premium
(
	idPremium serial PRIMARY KEY,
	startDate timestamp NOT NULL,
	duration  INTEGER,
	CONSTRAINT min_size CHECK (duration > 0),
    FOREIGN KEY(idPremium) REFERENCES User(idUser)
);

CREATE TABLE public.Country
(
	idCountry serial PRIMARY KEY,
	name varchar(1000) UNIQUE NOT NULL
);

CREATE TABLE public.City
(
	idCity serial PRIMARY KEY,
	name varchar(1000) NOT NULL,
	idCountry INTEGER,
	FOREIGN KEY(idCity) REFERENCES Country(idCountry)
);

CREATE TABLE public.Joined
(
	idJoined serial PRIMARY KEY,
	joinedDate timestamp NOT NULL
    FOREIGN KEY(idJoined) REFERENCES User(idUser)
);


CREATE TABLE public.Project
(	
	idProject serial PRIMARY KEY,
    creationDate timestamp NN,
	name VARCHAR(1000) NOT NULL,
	private BOOL NN,
);

CREATE TABLE public.Project_Forum
(
    idForum serial PRIMARY KEY,
    FOREIGN KEY(idForum) REFERENCES Project(idProject)
);

CREATE TABLE public.Forum_Post
(
    idPost serial PRIMARY KEY,
    startDate timestamp NN,
    title varchar(1000),
    text varchar(1000),
    FOREIGN KEY (idPost) REFERENCES Project_Forum(idForum)
);

CREATE TABLE public.Post_Reply
(
	idReply serial PRIMARY KEY,
	creationDate timestamp NOT NULL,
	text TEXT NOT NULL,
	FOREIGN KEY(idReply) REFERENCES Forum_Post(idPost)
);

CREATE TABLE public.Banned
(
	startDate timestamp NN,
    duration INTEGER,
    motive TEXT,
    CONSTRAINT duration CHECK (duration > 0)
    FOREIGN KEY(idUser) REFERENCES User(idUser)
);


CREATE TABLE public.Role
(
	idRole serial PRIMARY KEY,
	title varchar(1000) NN,
    FOREIGN KEY(idRole) REFERENCES Joined(idJoined)
);

CREATE TABLE public.Task
(
    idTask serial PRIMARY KEY,
    title varchar(1000) NN,
    description TEXT,
    creationDate timestamp NN,
    deadline timestamp,
    lastEditDate timestamp,
    CONSTRAINT lastEditDate CHECK (lastEditDate > creationDate)
);

CREATE TABLE public.Comments
(
	idComment integer PRIMARY KEY,
	creationDate timestamp NN,
	text TEXT NN,
);


CREATE TABLE public.Tag
(
	idTag serial PRIMARY KEY,
	name varchar(1000) NN,
	FOREIGN KEY(idTag) REFERENCES Task(idTask)
);

CREATE TABLE public.Completed_Task
(
	completionDate timestamp NN,
);

CREATE TABLE public.Close_Request
(
	idRequest serial PRIMARY KEY,
	title varchar(1000) NOT NULL,
	description TEXT,
);

