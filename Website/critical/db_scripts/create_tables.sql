CREATE TABLE Shop (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL
);

CREATE TABLE Article (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    brand VARCHAR(100) NOT NULL,
    model VARCHAR(100) NOT NULL,
    color VARCHAR(50) NOT NULL,
    shop_id INT NOT NULL,
    FOREIGN KEY (shop_id) REFERENCES Shop(id)
);

CREATE TABLE Address(
    ID SERIAL PRIMARY KEY,
    street VARCHAR(255),
    number VARCHAR(10),
    city VARCHAR(255)
);

CREATE TABLE Users(
  id SERIAL PRIMARY KEY,  
  username VARCHAR(255) UNIQUE NOT NULL,
  name VARCHAR(255) NOT NULL,
  surname VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  role VARCHAR(255) NOT NULL,
  address INT,
  FOREIGN KEY(address) REFERENCES Address(id)                                    
);