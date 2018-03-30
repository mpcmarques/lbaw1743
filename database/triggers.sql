

-- Only a User who Joined a Project can create Posts in it's Forum
DROP TRIGGER IF EXISTS onCreatePost ON ForumPost;

CREATE OR REPLACE FUNCTION insertPost() RETURNS TRIGGER AS
$BODY$
  BEGIN
    IF NOT EXISTS (
      SELECT * FROM Joined
      WHERE (new.idUser = idUser AND new.idProject = idProject))
    THEN
      RAISE EXCEPTION 'Only a user who joined a project can post in its forum.';
    ELSE
      INSERT INTO ForumPost(creationDate, lastEditDate, title, content, idProject, idUser)
      VALUES (new.creationDate, new.lastEditDate, new.title, new.content, new.idProject, new.idUser);
    END IF;
    RETURN NEW;
  END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreatePost BEFORE INSERT ON ForumPost
FOR EACH ROW
EXECUTE PROCEDURE insertPost();

-- Only a User who Joined a Project can Reply in it's Forum
DROP TRIGGER IF EXISTS onCreateReply ON Reply;

CREATE OR REPLACE FUNCTION insertReply() RETURNS TRIGGER AS
$BODY$
  BEGIN
    IF NOT EXISTS (
      SELECT idJoined FROM Joined, ForumPost
      WHERE (new.idPost = ForumPost.idPost AND ForumPost.idProject = Joined.idProject AND new.idUser = Joined.idUser))
    THEN
      RAISE EXCEPTION 'Only a user who joined a project can reply to posts in its forum.';
    ELSE
      INSERT INTO Reply(creationDate, lastEditDate, content, idPost, idUser)
      VALUES (new.creationDate, new.lastEditDate, new.content, new.idPost, new.idUser);
    END IF;
    RETURN NEW;
  END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER onCreateReply BEFORE INSERT ON Reply
FOR EACH ROW
EXECUTE PROCEDURE insertReply();

-- -- Only a user who has Joined a Project can create Comments for a Project Task
-- CREATE FUNCTION CreateComment() RETURNS TRIGGER AS $$
--   BEGIN
--     SELECT idUser
--     FROM Joined
--     WHERE
--   END;
-- $$ LANGUAGE plpgsql;
--
-- CREATE TRIGGER canCreateComment BEFORE INSERT ON Comment
-- FOR EACH ROW
-- EXECUTE PROCEDURE CreateComment();

-- -- A Project can only be private while the Owner is a Premium User
-- CREATE FUNCTION ProjectPrivate() RETURNS TRIGGER AS $$
--   BEGIN
--     SELECT idUser
--     FROM Joined
--     WHERE
--   END;
-- $$ LANGUAGE plpgsql;
--
-- CREATE TRIGGER onCreateProject BEFORE INSERT OR UPDATE ON Project
-- FOR EACH ROW
-- WHEN (NEW.private IS TRUE)
-- EXECUTE PROCEDURE ProjectPrivate();
--
-- -- Only a User who was Assigned to a Task can create a Close Request for it.
-- CREATE FUNCTION createCLoseRequest() RETURNS TRIGGER AS $$
--   BEGIN
--     SELECT idUser
--     FROM Joined
--     WHERE
--   END;
-- $$ LANGUAGE plpgsql;
--
-- CREATE TRIGGER canCreateCLoseRequest BEFORE INSERT ON CloseRequest
-- FOR EACH ROW
-- EXECUTE PROCEDURE createCLoseRequest();
--
-- -- Only a Project Manager (or above) can approve for a Task to be closed.
-- CREATE FUNCTION approveCloseRequest() RETURNS TRIGGER AS $$
--   BEGIN
--     SELECT idUser
--     FROM Joined
--     WHERE
--   END;
-- $$ LANGUAGE plpgsql;
--
-- CREATE TRIGGER canApprove BEFORE UPDATE ON CloseRequest
-- FOR EACH ROW
-- EXECUTE PROCEDURE approveCloseRequest();
--
-- -- Only a User who Joined a Project can create Tasks for It
-- CREATE FUNCTION createTask() RETURNS TRIGGER AS $$
--   BEGIN
--     SELECT idUser
--     FROM Joined
--     WHERE
--   END;
-- $$ LANGUAGE plpgsql;
--
-- CREATE TRIGGER canCreateTask BEFORE INSERT ON Task
-- FOR EACH ROW
-- EXECUTE PROCEDURE createTask();
--
-- -- Only a User who Joined a Project can be assigned to it's Tasks
-- CREATE FUNCTION AssignedToTask() RETURNS TRIGGER AS $$
--   BEGIN
--     SELECT idUser
--     FROM Joined
--     WHERE
--   END;
-- $$ LANGUAGE plpgsql;
--
-- CREATE TRIGGER canBeAssigned BEFORE INSERT ON Assigned
-- FOR EACH ROW
-- EXECUTE PROCEDURE AssignedToTask();
--
-- -- Only the User who created the task and the Project Manager can edit a task
-- CREATE FUNCTION editTask() RETURNS TRIGGER AS $$
--   BEGIN
--     SELECT idUser
--     FROM Joined
--     WHERE
--   END;
-- $$ LANGUAGE plpgsql;
--
-- CREATE TRIGGER canEditTask BEFORE INSERT ON EditTaskInfo
-- FOR EACH ROW
-- EXECUTE PROCEDURE editTask();
