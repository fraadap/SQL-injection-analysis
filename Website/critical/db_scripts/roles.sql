-- Creazione del ruolo admin
CREATE ROLE admin_role;

-- Creazione dello user admin
CREATE USER admin_user WITH ENCRYPTED PASSWORD '10293';

-- Assegnazione del ruolo all'utente
GRANT admin_role TO admin_user;
