CREATE DATABASE USUARIOS;

USE USUARIOS;

CREATE TABLE Login(
id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL UNIQUE,
contraseña VARCHAR(255) NOT NULL,
tiempo_de_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- para ver cuando se creo la cuenta
);

SELECT * FROM Login;

DROP TABLE Login;

DESCRIBE Login;
