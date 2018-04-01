/*Performance Indexes*/

    /*User*/
    CREATE INDEX emailUser ON UserTable USING hash (email);

    /*Task*/
    CREATE INDEX taskUser ON Task USING hash(idUser);
    CREATE INDEX deadlineTask ON Task USING btree (DEADLINE);

    /*Project*/
    CREATE INDEX projectUser ON Project USING hash(idUser);

/*Full-text Search Indexes*/

    CREATE INDEX search_username ON User USING GIN (to_tsvector('english', username));
    CREATE INDEX search_user_name ON User USING GIN (to_tsvector('english', name));
    CREATE INDEX search_project_name ON Project USING GIN (to_tsvector('english', name));
    CREATE INDEX search_project_description ON Project USING GIST (to_tsvector('english', description));
    CREATE INDEX search_task_name ON Task USING GIN (to_tsvector('english', name));
    CREATE INDEX search_task_description ON Task USING GIST (to_tsvector('english', name));