CREATE DATABASE url;
USE url;

CREATE TABLE urls (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      long_url VARCHAR(255) NOT NULL,
                      short_code VARCHAR(50) NOT NULL
);
