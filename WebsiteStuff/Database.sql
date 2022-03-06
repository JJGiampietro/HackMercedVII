-- Users table
CREATE TABLE users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(64) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (fullname, email, password, status) VALUES
('John Doe', 'john.doe@example.com', MD5('123456')),
('Sam Doe', 'sam.doe@example.com', MD5('123456'));