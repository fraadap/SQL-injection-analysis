#!/bin/sh

# This defines roles and users
# roles.sql 

# This creates 
# create-db-user.sql

# This assigns priveligies to roles
# assign.sql

# Inserts rows in the tables for example 
# fill_db.sql


# This does all
sudo -u postgres psql postgres -f create_db.sql -f roles.sql -f create_tables.sql  -f assign.sql -f fill_db.sql
