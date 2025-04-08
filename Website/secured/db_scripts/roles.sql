-- Creare i ruoli specifici
CREATE ROLE user_role;
CREATE ROLE shop_role;
CREATE ROLE admin_role;

-- Creare utenti specifici
CREATE USER user_user WITH ENCRYPTED PASSWORD '12345';
CREATE USER shop_user WITH ENCRYPTED PASSWORD '98765';
CREATE USER admin_user WITH ENCRYPTED PASSWORD '10293';

-- Assegnare i ruoli agli utenti
GRANT user_role TO user_user;
GRANT shop_role TO shop_user;
GRANT admin_role TO admin_user;
