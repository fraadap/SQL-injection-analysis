
-- Permessi per admin_role
GRANT CONNECT ON DATABASE db_secure TO admin_role;
GRANT USAGE ON SCHEMA public TO admin_role;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO admin_role;

ALTER TABLE users OWNER TO admin_role ;
ALTER TABLE address OWNER TO admin_role ;
ALTER TABLE shop OWNER TO admin_role ;
ALTER TABLE article OWNER TO admin_role ;