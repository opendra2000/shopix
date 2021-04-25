-- create database ShopixDB;

create table Users(
    id int auto_increment not null,
    username varchar(30),
    password varchar(30),
    primary key(id)
);

create table Shops(
    id int auto_increment not null,
    num_workers integer,
    name varchar(100),
    store_type varchar(30),
    location varchar(100),
    primary key(id)
);

create table Workers(
    id int auto_increment not null,
    name varchar(30),
    position varchar(20),
    primary key(id)
);

create table Products(
    id int auto_increment not null,
    name varchar(40),
    price double precision(7, 2),
    description varchar(280),
    availability boolean,
    num_in_stock integer,
    primary key(id)
);

create table ProductsElectronics(
    product_id int auto_increment not null,
    brand_name varchar(20),

    foreign key(product_id) references Products(id),
    primary key(product_id)
);

create table ProductsBooks(
    product_id int auto_increment not null,
    author varchar(40),
    publisher varchar(40),

    foreign key(product_id) references Products(id),
    primary key(product_id)
);

create table ProductsMusicalInstruments(
    product_id int auto_increment not null,
    brand_name varchar(40),
    category varchar(20),
    
    foreign key(product_id) references Products(id),
    primary key(product_id)
);
create table ProductsGrocery(
    product_id int auto_increment not null,
    expiry_date date,
    foreign key(product_id) references Products(id),
    primary key(product_id)
);

create table ProductsOther(
    product_id int auto_increment not null,
    foreign key(product_id) references Products(id),
    primary key(product_id)
);

create table Manufacturers(
    id int auto_increment not null,
    name varchar(40),
    primary key(id)
);

create table Clients(
    id int auto_increment not null,
    name varchar(40),
    date_of_birth date,
    username varchar(20),
    password varchar(30),
    primary key(id)
);

create table PremiumClients(
    client_id int auto_increment not null,
    loyalty_points integer, 
    subscription_begin date,
    subscription_end date,

    foreign key(client_id) references Clients(id),
    primary key(client_id)
);

create table RegularClients(
    client_id int auto_increment not null,
    foreign key(client_id) references Clients(id),
    primary key(client_id)
);

create table Payments(
    id int auto_increment not null,
    amount double precision,
    p_date date,
    primary key(id)
);
create table OnlinePayment(
    payment_id int auto_increment not null,
    method varchar(30),
    foreign key(payment_id) references Payments(id),
    primary key(payment_id)
);

create table CashPayment(
    payment_id int auto_increment not null,
    foreign key(payment_id) references Payments(id),
    primary key(payment_id)
);

create table WorksIn(
    worker_id int not null,
    shop_id int not null,
    foreign key(worker_id) references Workers(id),
    foreign key(shop_id) references Shops(id),
    primary key(worker_id, shop_id)
    
);

create table ManufacturedIn(
    product_id int not null,
    manufacturer_id int not null,
    foreign key(product_id) references Products(id),
    foreign key(manufacturer_id) references Manufacturers(id),
    primary key(product_id, manufacturer_id)
);


create table PaidBy(
    payment_id int not null,
    client_id int not null,
    foreign key(payment_id) references Payments(id),
    foreign key(client_id) references Clients(id)
);

INSERT INTO Users VALUES 
    (1, 'admin', 'admin');

INSERT INTO Shops VALUES
    (1, 15, 'Netto Grocery', 'grocery', 'Hamburg'),
    (2, 50, 'Kaufland', 'grocery', 'Bremen'),
    (3, 50, 'Bauhaus', 'hardware', 'Munich'),
    (4, 60, 'MediaMarkt', 'electronics', 'Berlin'),
    (5, 5, 'Friendly Neighborhood Bookstore', 'books', 'Bremen'),
    (6, 40, 'GuitarCenter', 'musical instruments', 'Bremen');
    
INSERT INTO Workers VALUES
    (1, 'Jennifer', 'Stocker'),
    (2, 'Mark', 'Manager'),
    (3, 'Debra', 'Stocker');
    
INSERT INTO Products VALUES
    (1, "Ben & Jerry's Cookies and Cream", 5.00, "Vanilla ice cream with cookie dough mixed in.", TRUE, 50),
    (2, "Bio Eggs - 6 Pack", 3.25, "6 Pack of eggs.", TRUE, 70),
    (3, "Bio Mango", 5.00, "Mango - raw fruit.", FALSE, 0),
    (4, "iPhone Xr", 800.00, "The iPhone Xr - from Apple.", TRUE, 100),
    (5, "nVidia GeForce RTX 3080", 700.00, "The next generational standard in graphics processing - the GeForce RTX 3080.", FALSE, 0),
    (6, "BenQ EL2870U", 250.00, "BenQ's best monitor for high-quality video editing, gaming, and more.", TRUE, 30),
    (7, "1984", 10.00, "George Orwell's masterpiece.", TRUE, 25),
    (8, "Dune", 11.00, "Now the base for a major motion-picture!", FALSE, 0),
    (9, "Crescent City", 20.00, "Lorem Ipsum 1", TRUE, 30),
    (10, "Robinson Crusoe", 5.00, "Lorem Ipsum 2", TRUE, 15), 
    (11, "Guitar", 200.00, "Lorem Ipsum 3", TRUE, 30),
    (12, "Violin", 150.00, "Lorem Ipsum 4", FALSE, 0),
    (13, "Piano", 500.00, "Lorem Ipsum 5", TRUE, 5),
    (14, "Pixel 5", 700.00, "Pixel 5 by Google", TRUE, 100),
    (15, "Pixel 4a", 340.00, "Pixel 4a by Google", TRUE, 200);

INSERT INTO ProductsElectronics VALUES
    (14, 'Google'),
    (15, 'Google');

-- -- find available electronis with specific name
-- SELECT * 
-- FROM ProductsElectronics AS PE, Products AS P
-- WHERE P.name = 'Pixel 5'
--     and P.availability = TRUE
--     and PE.brand_name = 'Google';

-- -- find workers with specific position
-- SELECT *
-- FROM Workers
-- WHERE position = 'Manager';

-- -- show a list of shops in specific location
-- SELECT *
-- FROM Shops
-- WHERE location = 'Bremen';

-- -- THE CODE UNTIL THIS LIKE WORKS PERFECTLY, JUST ADAPT YOUR CASES LIKE IN MY EXAMPLES.

-- -- sort the products on basis of price
-- SELECT *
-- FROM Products
-- where category='Guitar'
-- and brandname='Fender'
-- and price < 600
-- ​
-- -- the number of purchases made during a year
-- SELECT Count(*) as Total_Purchases
-- FROM Payments
-- where p_date BETWEEN #01/01/2019# AND #01/01/2020#;
-- ​
-- -- know your top five loyal clients
-- SELECT *
-- FROM Clients
-- ORDER BY Score DESC
-- LIMIT 5  -- only top five costumers

-- -- Find large stores nearby
-- SELECT name, id
-- FROM Shops
-- WHERE num_workers > 25
--     and distance <= 10000    -- measured in meters

-- -- Find books published by a specific publisher and author, beneath a certain price point 
-- SELECT product_name, product_id
-- FROM ProductsBooks
-- WHERE publisher = 'Penguin Random House'
--     and author = 'George Orwell'
--     and product_price < 6.50
--     and availability = TRUE
--     and num_in_stock > 0

-- -- Find stores that have a specific item in stock
-- SELECT name, id
-- FROM Products
-- WHERE "Ben & Jerry's" IN product_name
--     and availability = TRUE