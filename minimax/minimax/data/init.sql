CREATE DATABASE loi_merchandise_db;
USE loi_merchandise_db;

CREATE TABLE users (
                       id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                       firstname VARCHAR(30) NOT NULL,
                       lastname VARCHAR(30) NOT NULL,
                       email VARCHAR(50) NOT NULL,
                       username VARCHAR(30) NOT NULL,
                       age INT(3),
                       address VARCHAR(50),
                       location VARCHAR(50),
                       password VARCHAR(50),
                       date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       UNIQUE KEY (username)
);

CREATE TABLE Products(
                         idProducts INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                         productName VARCHAR(50) NOT NULL,
                         price double NOT NULL,
                         imgSRC VARCHAR(600),
                         UNIQUE Key (productName)
);

CREATE TABLE orders (
                        idOrder INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        idProducts INT(11)  UNSIGNED NOT NULL,
                        quantity INT(11) UNSIGNED NOT NULL,
                        username VARCHAR(30) NOT NULL,
                        totalAmount DOUBLE NOT NULL,
                        orderTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                        FOREIGN KEY (username) REFERENCES users(username),
                        FOREIGN KEY (idProducts) REFERENCES Products(idProducts)
);

CREATE TABLE admins (
                        idAdmin INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        username VARCHAR(30) NOT NULL,
                        password VARCHAR(50) NOT NULL
);

CREATE TABLE subscribers(
                            idSubscribers INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            username VARCHAR(30) NOT NULL ,
                            email VARCHAR(50),
                            date_of_sub TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            FOREIGN KEY (username) REFERENCES users(username)
);
