-- Users table
CREATE TABLE users(
    id INT NOT NULL PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(64) NOT NULL UNIQUE,
    password VARCHAR(64) NOT NULL
);