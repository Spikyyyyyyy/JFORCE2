-- MySQL database for JFORCE2 project
-- Import this file in phpMyAdmin or via the MySQL command line in XAMPP

DROP DATABASE IF EXISTS jforce_db;
CREATE DATABASE jforce_db;
USE jforce_db;

-- Users table for registration and login
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Feedback table for user feedback and admin dashboard
CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    feedback_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_feedback_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample data for testing
INSERT INTO users (username, email, password)
VALUES ('admin', 'admin@jforce.com', '$2y$10$8kLw7yqYv4m0ru2JcH9O0uZVxW6gCQK9Fq1QJkUZ6Zf2X4vX7D.m2');

INSERT INTO feedback (user_id, feedback_text)
VALUES
    ((SELECT id FROM users WHERE email = 'admin@jforce.com'), 'Good'),
    ((SELECT id FROM users WHERE email = 'admin@jforce.com'), 'Best');

-- Example queries:
-- SELECT * FROM users;
-- SELECT * FROM feedback;
-- SELECT f.id, u.username, f.feedback_text, f.created_at
-- FROM feedback f
-- LEFT JOIN users u ON f.user_id = u.id;
