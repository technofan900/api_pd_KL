CREATE DATABASE persons_api;

USE persons_api;

CREATE TABLE person (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(128) NOT NULL,
    surname VARCHAR(128) NOT NULL,
    e_mail VARCHAR(128) NOT NULL,
    country VARCHAR(128) NOT NULL,
    picture VARCHAR(256) NOT NULL
)