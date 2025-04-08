
-- Assegnare privilegi ai ruoli

-- Permessi per user_role
GRANT CONNECT ON DATABASE db_secure TO user_role;
GRANT USAGE ON SCHEMA public TO user_role;
GRANT SELECT ON TABLE Article, Shop TO user_role;
GRANT INSERT ON TABLE Users, Address TO user_role;
GRANT SELECT ON TABLE Users, Address TO user_role;
GRANT USAGE, SELECT ON SEQUENCE address_id_seq TO user_role;
GRANT USAGE, SELECT ON SEQUENCE users_id_seq TO user_role;

-- Permessi per shop_role
GRANT CONNECT ON DATABASE db_secure TO shop_role;
GRANT USAGE ON SCHEMA public TO shop_role;
GRANT INSERT ON TABLE Article, Shop TO shop_role;
GRANT SELECT ON TABLE Shop, Article TO shop_role;
GRANT DELETE ON TABLE Article TO shop_role;

-- Permessi per admin_role
GRANT CONNECT ON DATABASE db_secure TO admin_role;
GRANT USAGE ON SCHEMA public TO admin_role;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO admin_role;