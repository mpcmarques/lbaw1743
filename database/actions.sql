    /*-------------QUERIES-------------*/

        /*-------------USERS-------------*/

/*Get Users*/
SELECT userName, email, gender, description
FROM UserTable;

/*Get User Data*/
SELECT userName, email, gender, description
FROM UserTable
WHERE UserTable.idUser= $idUser;

/*Select User's Tasks*/
SELECT title
FROM Task
WHERE Task.idUser=$idUser
ORDER BY deadline ASC;

/*Select User Projects*/
SELECT Project.name FROM Project, Joined, UserTable
WHERE Project.idProject=Joined.idProject
AND Joined.idUser=UserTable.idUser
AND UserTable.idUser = $idUser;

/*Select Premium User*/
SELECT name
FROM UserTable, PremiumSignature
WHERE PremiumSignature.idPremium = $idPremium
AND UserTable.idUser= PremiumSignature.idUser;

/*Select Premium Users*/
SELECT startDate, duration, name
FROM PremiumSignature, UserTable
WHERE UserTable.idUser= PremiumSignature.idUser;

/*Select Banned Users*/
SELECT UserTable.name, startDate, duration, motive
FROM UserTable, BannedRecord
WHERE UserTable.idUser = BannedRecord.idUser;

/*Select Banned User*/
SELECT UserTable.name, startDate, duration, motive
FROM UserTable, BannedRecord
WHERE BannedRecord.idUser = $idUser
AND UserTable.idUser = BannedRecord.idUser;

        /*-------------PROJECTS-------------*/

/*Select Project Name*/
SELECT name FROM Project
WHERE idProject = $idProject;

/*Select Project Description*/
SELECT description FROM Project
WHERE idProject = $idProject;

/*Select Project Team Coordinators*/
SELECT DISTINCT name, email
FROM UserTable, Joined, Project
WHERE Joined.idProject=$idProject
AND Joined.role!='Member'
AND Joined.idUser=UserTable.idUser;

/*Select Project Team Members*/
SELECT DISTINCT name, email
FROM UserTable, Joined, Project
WHERE Joined.idProject=$idProject
AND Joined.role!='Coordinator'
AND Joined.idUser=UserTable.idUser;

        /*-------------FORUMS-------------*/

/*Select Forum Post*/
SELECT title, lastEditDate, name
FROM ForumPost, UserTable
WHERE ForumPost.idUser = UserTable.idUser
AND UserTable.idUser = $idUser;

/*Select Forum Post ordered by last edit date*/
SELECT title, lastEditDate, name
FROM ForumPost, UserTable
WHERE ForumPost.idUser = UserTable.idUser
AND UserTable.idUser = $idUser;
ORDER BY ForumPost.lastEditDate;

/*Select Post Replies*/
SELECT UserTable.name, Reply.creationDate, Reply.content, Reply.idPost
FROM Reply, ForumPost, UserTable
WHERE Reply.idPost = $idPost
AND Reply.idUser = UserTable.idUser;

/*Select Tasks ordered by earliest deadline*/
SELECT title, deadline
WHERE deadline > CURRENT_DATE
ORDER BY deadline ASC;

/*SELECT Non Completed Tasks From a Project*/
SELECT Task.title
FROM Task, Project
WHERE Project.idProject = $idProject
AND Task.idProject = Project.idProject
AND Task.completed=FALSE;

/*Select Task Data*/
SELECT title, creationDate,lastEditDate, description, deadline
FROM Task
WHERE Task.idTask= $idTask;

/*Select Task Comments*/
SELECT Comment.creationDate, Comment.lastEditDate, Comment.content, name
FROM Comment, UserTable, Task
WHERE Task.idTask = $idTask
AND Comment.idUser = UserTable.idUser
AND Comment.idTask = Task.idTask;




    /*-------------UPDATES-------------*/

        /*-------------EDITS-------------*/

UPDATE UserTable
    SET email = $email, userName = $userName, descrition = $description
    WHERE idUser = $idUser;

UPDATE Project
    SET name = $name, description = $description, private = $private
    WHERE idTask = $idTask;

UPDATE Task
    SET lastEditDate = $lastEditDate, title = $title, description = $description, deadline = $deadline, completed = $completed
    WHERE idTask = $idTask;

         /*-------------REGISTER/CREATE-------------*/

INSERT INTO Country(name)
  VALUES($name);

INSERT INTO UserTable(userName, password, email, gender, name, address, institution, description, birthDate, idCountry)
  VALUES($userName, $password, $email, $gender, $name, $address, $institution, $description, $birthDate, $idCountry);

INSERT INTO PremiumSignature(startDate, duration, idUser)
  VALUES($startDate, $duration, $idUser);

INSERT INTO Project(creationDate, name, description, private)
  VALUES($creationDate, $name, $description, $private);

INSERT INTO Joined(idUser, idProject, joinedDate, leftDate, role)
  VALUES($idUser, $idProject, $joinedDate, $leftDate, $role);

INSERT INTO ForumPost(idUser, idProject, joinedDate, leftDate, role)
  VALUES($idUser, $idProject, $joinedDate, $leftDate, $role);

INSERT INTO Reply(idUser, idProject, joinedDate, leftDate, role)
  VALUES($idUser, $idProject, $joinedDate, $leftDate, $role);

INSERT INTO Task(creationDate, title, description, deadline)
  VALUES($creationDate, $title, $description, $deadline);

INSERT INTO Comment(idComment, creationDate, content)
    VALUES($idComment, $creationDate, $content);

        /*-------------DELETE/REMOVE-------------*/

DELETE FROM Project
  WHERE idProject = $idProject;

DELETE FROM Task
  WHERE idTask = $idTask;

DELETE FROM Comment
  WHERE idComment = $idComment;
