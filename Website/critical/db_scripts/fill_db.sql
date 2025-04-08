
delete from article; 
delete from shop; 
delete from users; 
delete from address;

-- Inserire dati nella tabella Shop
INSERT INTO Shop (id, name, phone, email) VALUES
(1,'Electronics World', '123-456-7890', 'contact@electronicsworld.com'),
(2,'Fashion Hub', '987-654-3210', 'info@fashionhub.com'),
(3,'Book Haven', '555-123-4567', 'support@bookhaven.com'),
(4,'Tech Store', '444-555-6666', 'sales@techstore.com'),
(5,'Sport Gear', '333-444-5555', 'info@sportgear.com'),
(6,'Toy Kingdom', '222-333-4444', 'contact@toykingdom.com'),
(7,'Home Essentials', '111-222-3333', 'support@homeessentials.com'),
(8,'Gadget Planet', '777-888-9999', 'info@gadgetplanet.com'),
(9,'Beauty Bliss', '999-888-7777', 'contact@beautybliss.com'),
(10,'Outdoor Adventures', '666-555-4444', 'info@outdooradventures.com');


-- Inserire dati nella tabella Article
INSERT INTO Article (name, brand, model, color, shop_id) VALUES
('Smartphone', 'Apple', 'iPhone 13', 'Black', 1),
('Laptop', 'Dell', 'XPS 13', 'Silver', 1),
('T-shirt', 'Nike', 'Athletic', 'Red', 2),
('Jeans', 'Levis', '501', 'Blue', 2),
('Book', 'J.K. Rowling', 'Harry Potter', 'Green', 3),
('E-Reader', 'Amazon', 'Kindle', 'White', 3),
('Headphones', 'Sony', 'WH-1000XM4', 'Black', 4),
('Smartwatch', 'Samsung', 'Galaxy Watch', 'Black', 4),
('Soccer Ball', 'Adidas', 'Predator', 'White', 5),
('Basketball', 'Spalding', 'NBA', 'Orange', 5),
('Lego Set', 'Lego', 'Star Wars', 'Multicolor', 6),
('Action Figure', 'Hasbro', 'Marvel', 'Red', 6),
('Blender', 'Philips', 'HR3652', 'Silver', 7),
('Vacuum Cleaner', 'Dyson', 'V11', 'Blue', 7),
('Smart Speaker', 'Google', 'Nest', 'White', 8),
('VR Headset', 'Oculus', 'Quest 2', 'White', 8),
('Lipstick', 'MAC', 'Ruby Woo', 'Red', 9),
('Perfume', 'Chanel', 'No. 5', 'Clear', 9),
('Tent', 'Coleman', 'Sundome', 'Green', 10),
('Backpack', 'Osprey', 'Daylite', 'Black', 10);

-- Inserire dati nella tabella Address
INSERT INTO Address (id, street, number, city) VALUES
(1,'Main Street', '123', 'New York'),
(2,'Broadway', '456', 'Los Angeles'),
(3,'Elm Street', '789', 'Chicago'),
(4,'Maple Avenue', '101', 'Houston'),
(5,'Oak Street', '202', 'Phoenix'),
(6,'Pine Avenue', '303', 'Philadelphia'),
(7,'Cedar Street', '404', 'San Antonio'),
(8,'Birch Avenue', '505', 'San Diego'),
(9,'Walnut Street', '606', 'Dallas'),
(10,'Aspen Avenue', '707', 'San Jose');

-- Inserire dati nella tabella Users
INSERT INTO Users (id, username, name, surname, password, email, role, address) VALUES
(1,'johndoe', 'John', 'Doe', 'password1', 'john.doe1@example.com', 'user', 1),
(2,'jane_smith03', 'Jane', 'Smith', 'password2', 'jane.smith2@example.com', 'user', 2),
(3, 'mikyjohnson', 'Mike', 'Johnson', '$password3', 'mike.johnson3@example.com', 'user', 3),
(4,'emy_dav', 'Emily', 'Davis', 'password4', 'emily.davis4@example.com', 'user', 4),
(5, 'chris_brownie', 'Chris', 'Brown', 'password5', 'chris.brown5@example.com', 'user', 5),
(6,'patty102', 'Pat', 'Taylor', 'password6', 'pat.taylor6@example.com', 'user', 6),
(7, 'alexxx_andy', 'Alex', 'Anderson', 'password7', 'alex.anderson7@example.com', 'user', 7),
(8,'sam_thomas_112', 'Sam', 'Thomas', 'password8', 'sam.thomas8@example.com', 'user', 8),
(9,'_casey_12', 'Casey', 'Lee', 'password9', 'casey.lee9@example.com', 'user', 9),
(10,'jordy_harris194', 'Jordan', 'Harris', 'password10', 'jordan.harris10@example.com', 'user', 10);

