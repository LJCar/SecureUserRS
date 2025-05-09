CREATE DATABASE IF NOT EXISTS secure_user;
USE secure_user;

CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       account_type ENUM('Individual', 'Company') NOT NULL,
                       username VARCHAR(50) NOT NULL UNIQUE,
                       password_hash VARCHAR(255) NOT NULL,
                       full_name VARCHAR(50),
                       contact_name VARCHAR(50),
                       job_title VARCHAR(50),
                       phone_number VARCHAR(20),
                       email VARCHAR(100) NOT NULL UNIQUE,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

