-- 1. Create the database
CREATE DATABASE IF NOT EXISTS contact_book_mvp;

-- 2. Tell MySQL to use this new database
USE contact_book_mvp;

-- 3. Create the contacts table
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Insert a dummy record so we have something to test!
INSERT INTO contacts (name, email, phone) 
VALUES ('Neo Kent', 'neo@gmail.com', '0948-0198');

ALTER TABLE contacts ADD COLUMN tags VARCHAR(255) DEFAULT '';

SELECT * FROM contacts;