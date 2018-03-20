    /*-------------QUERIES-------------*/

 /*Get All Users*/
  SELECT userName, email, gender, description
  FROM UserTable;

 /*Get User Data*/
 SELECT userName, email, gender, description
  FROM UserTable
  WHERE UserTable.idUser= $idUser;

/*Get Non Completed Tasks From a Project*/
SELECT title, creationDate,lastEditDate, description, deadline
    FROM Task
    INNER JOIN Project ON Task.idProject = Project.idProject;

/*Get Task Data*/
SELECT title, creationDate,lastEditDate, description, deadline
    FROM Task
    WHERE Task.idTask= $idTask;

/*Get All Comments From Task*/
SELECT creationDate, lastEditDate, content, userName
    FROM Comment
    INNER JOIN UserTable ON UserTable.idUser= Comment.idUser
    INNER JOIN Task ON Task.idTask = Comment.idTask;

/*Get Post Data*/
SELECT creationDate, lastEditDate, title, content, userName
    FROM ForumPost
    INNER JOIN UserTable ON UserTable.idUser= ForumPost.idUser;

/*Get All Post Replies*/
SELECT creationDate, lastEditDate, content, userName
    FROM Reply
    INNER JOIN UserTable ON UserTable.idUser = Reply.idUser
    INNER JOIN ForumPost ON ForumPost.idPost = ForumPost.idPost;

/*Get All Premium Users*/
SELECT startDate, duration, userName
    FROM PremiumSignature
    INNER JOIN UserTable ON UserTable.idUser= PremiumSignature.idUser;

/*Get All Banned Users*/
SELECT userName, startDate, duration, motive
    FROM BannedRecord
    INNER JOIN UserTable ON UserTable.idUser = BannedRecord.idUser
    INNER JOIN Admin

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

INSERT INTO UserTable(userName, password, email, gender, name, address, institution, description, birthDate, idCountry)
    VALUES($userName, $password, $email, $gender, $name, $address, $institution, $description, $birthDate, $idCountry);

INSERT INTO Project(creationDate, name, description, private)
    VALUES($creationDate, $name, $description, $private);

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


        /*-------------POPULATION-------------*/
INSERT INTO UserTable()
