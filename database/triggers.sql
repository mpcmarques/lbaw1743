-- Only a User who Joined a Project can create Posts in it's Forum.
DROP TRIGGER IF EXISTS onCreatePost ON plenum.ForumPost;

CREATE OR REPLACE FUNCTION plenum.insertPost() RETURNS TRIGGER AS
$BODY$
  BEGIN
    IF NOT EXISTS (
      SELECT * FROM plenum.Joined
      WHERE new.idUser = Joined.idUser AND new.idProject = Joined.idProject)
    THEN
      RAISE EXCEPTION 'Only a user who joined a project can post in its forum.';
    END IF;
    RETURN NEW;
  END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreatePost BEFORE INSERT ON plenum.ForumPost
FOR EACH ROW
EXECUTE PROCEDURE plenum.insertPost();

-- Only a User who Joined a Project can Reply in it's Forum.
DROP TRIGGER IF EXISTS onCreateReply ON plenum.Reply;

CREATE OR REPLACE FUNCTION plenum.insertReply() RETURNS TRIGGER AS
$BODY$
  BEGIN
    IF NOT EXISTS (
      SELECT * FROM plenum.Joined, plenum.ForumPost
      WHERE new.idPost = ForumPost.idPost AND ForumPost.idProject = Joined.idProject AND new.idUser = Joined.idUser)
    THEN
      RAISE EXCEPTION 'Only a user who joined a project can reply to posts in its forum.';
    END IF;
    RETURN NEW;
  END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateReply BEFORE INSERT ON plenum.Reply
FOR EACH ROW
EXECUTE PROCEDURE plenum.insertReply();

-- Only a user who has Joined a Project can create Comments for a Project Task.
DROP TRIGGER IF EXISTS onCreateComment ON plenum.Comment;

CREATE OR REPLACE FUNCTION plenum.insertComent() RETURNS TRIGGER AS
$BODY$
  BEGIN
    IF NOT EXISTS (
      SELECT * FROM plenum.Joined, plenum.Task
      WHERE new.idTask = Task.idTask AND Task.idProject = Joined.idProject AND new.idUser = Joined.idUser)
    THEN
      RAISE EXCEPTION 'Only a user who joined a project can create comments for a Project Task.';
    END IF;
    RETURN NEW;
  END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateComment BEFORE INSERT ON plenum.Comment
FOR EACH ROW
EXECUTE PROCEDURE plenum.insertComent();

-- Only a User who was Assigned to a Task can create a Close Request for it.
DROP TRIGGER IF EXISTS onCreateCloseRequest ON plenum.CloseRequest;

CREATE OR REPLACE FUNCTION plenum.insertCloseRequest() RETURNS TRIGGER AS
$BODY$
  BEGIN
    IF NOT EXISTS (
      SELECT * FROM plenum.Assigned
      WHERE new.idTask = Assigned.idTask AND new.idUser = Assigned.idUser)
    THEN
      RAISE EXCEPTION 'Only a user who joined a project can create comments for a Project Task.';
    END IF;
    RETURN NEW;
  END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateCloseRequest BEFORE INSERT ON plenum.CloseRequest
FOR EACH ROW
EXECUTE PROCEDURE plenum.insertCloseRequest();

-- Only a User who Joined a Project can create Tasks for It.
DROP TRIGGER IF EXISTS onCreateTask ON plenum.Task;

CREATE OR REPLACE FUNCTION plenum.insertTask() RETURNS TRIGGER AS
$BODY$
  BEGIN
    IF NOT EXISTS (
      SELECT * FROM plenum.Joined
      WHERE new.idUser = Joined.idUser AND new.idProject = Joined.idProject)
    THEN
      RAISE EXCEPTION 'Only a user who joined a project can create tasks for it.';
    END IF;
    RETURN NEW;
  END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateTask BEFORE INSERT ON plenum.Task
FOR EACH ROW
EXECUTE PROCEDURE plenum.insertTask();

-- Only a User who Joined a Project can be assigned to it's Tasks.
DROP TRIGGER IF EXISTS onCreateAssigned ON plenum.Assigned;

CREATE OR REPLACE FUNCTION plenum.insertAssigned() RETURNS TRIGGER AS
$BODY$
  BEGIN
    IF NOT EXISTS (
      SELECT * FROM plenum.Joined, plenum.Task
      WHERE new.idUser = Joined.idUser AND new.idTask = Task.idTask AND Task.idProject = Joined.idProject)
    THEN
      RAISE EXCEPTION 'Only a user who joined a project can be assigned to its tasks.';
    END IF;
    RETURN NEW;
  END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateAssigned BEFORE INSERT ON plenum.Assigned
FOR EACH ROW
EXECUTE PROCEDURE plenum.insertAssigned();

-- A Project can only be private while the Owner is a Premium User.
DROP TRIGGER IF EXISTS onCreateProject ON plenum.Project;

CREATE OR REPLACE FUNCTION plenum.canProjectBePrivate() RETURNS TRIGGER AS
$BODY$
  BEGIN
  IF NOT EXISTS (
    SELECT * FROM plenum.Joined, plenum.UserTable
    WHERE new.idProject = Joined.idProject AND Joined.role = 'Owner' AND Joined.idUser = UserTable.idUser AND UserTable.premium = true)
  THEN
    RAISE EXCEPTION 'A Project can only be private while the Owner is a Premium User.';
  END IF;
  RETURN NEW;
  END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateProject BEFORE UPDATE ON plenum.Project
FOR EACH ROW
WHEN (NEW.private IS TRUE)
EXECUTE PROCEDURE plenum.canProjectBePrivate();

DROP TRIGGER IF EXISTS onUpdateUser ON plenum.UserTable;

CREATE OR REPLACE FUNCTION plenum.updateUserTable() RETURNS TRIGGER AS
$BODY$
  BEGIN
  IF EXISTS (
    SELECT * FROM plenum.Joined, plenum.Project
    WHERE new.idUser = Joined.idUser AND Joined.role = 'Owner' AND Project.idProject = Joined.idProject AND Project.private = true)
  THEN
    RAISE EXCEPTION 'A Project can only be private while the Owner is a Premium User.';
  END IF;
  RETURN NEW;
  END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onUpdateUser BEFORE UPDATE ON plenum.UserTable
FOR EACH ROW
WHEN (new.premium = false)
EXECUTE PROCEDURE plenum.updateUserTable();

-- A Project can only have one owner.

DROP TRIGGER IF EXISTS onCreateJoined ON plenum.UserTable;

CREATE OR REPLACE FUNCTION plenum.onlyOneOwner() RETURNS TRIGGER AS
$BODY$
  BEGIN
  IF EXISTS (
    SELECT * FROM plenum.Joined
    WHERE new.idProject = Joined.idProject AND Joined.role = 'Owner')
  THEN
    RAISE EXCEPTION 'A Project can only have one owner.';
  END IF;
  RETURN NEW;
  END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateJoined BEFORE INSERT ON plenum.Joined
FOR EACH ROW
WHEN (new.role = 'Owner')
EXECUTE PROCEDURE plenum.onlyOneOwner();
