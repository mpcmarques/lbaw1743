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
