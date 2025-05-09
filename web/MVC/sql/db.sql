DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uuid CHAR(36) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    role VARCHAR(25) NOT NULL DEFAULT 'user',
    pwd VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO users (uuid, username, email, role, pwd)
VALUES 
(UUID(), 'user1', 'user1@example.com', 'user', 'password123'),
(UUID(), 'user2', 'user2@example.com', 'user', 'password456'),
(UUID(), 'user3', 'user3@example.com', 'admin', 'password789'),
(UUID(), 'user4', 'user4@example.com', 'user', 'password101'),
(UUID(), 'user5', 'user5@example.com', 'admin', 'password202');


