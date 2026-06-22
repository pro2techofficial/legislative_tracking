CREATE DATABASE IF NOT EXISTS mlts_db;
USE mlts_db;

DROP TABLE IF EXISTS audit_logs;
DROP TABLE IF EXISTS tracking_history;
DROP TABLE IF EXISTS sessions;
DROP TABLE IF EXISTS council_members;
DROP TABLE IF EXISTS committees;
DROP TABLE IF EXISTS resolutions;
DROP TABLE IF EXISTS ordinances;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(150) NOT NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('Admin','Staff','Councilor') DEFAULT 'Staff',
    status ENUM('Active','Inactive') DEFAULT 'Active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE ordinances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ordinance_no VARCHAR(50) NOT NULL,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(150),
    committee VARCHAR(150),
    date_filed DATE,
    status VARCHAR(100) DEFAULT 'Draft',
    file_path VARCHAR(255),
    remarks TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE resolutions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    resolution_no VARCHAR(50) NOT NULL,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(150),
    committee VARCHAR(150),
    date_filed DATE,
    status VARCHAR(100) DEFAULT 'Draft',
    file_path VARCHAR(255),
    remarks TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE committees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    chairperson VARCHAR(150),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE council_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(150) NOT NULL,
    position VARCHAR(100),
    committee VARCHAR(150),
    contact VARCHAR(50),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_no VARCHAR(50),
    session_date DATE,
    session_time TIME,
    venue VARCHAR(255),
    presiding_officer VARCHAR(150),
    agenda TEXT,
    minutes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tracking_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    legislation_type ENUM('Ordinance','Resolution') NOT NULL,
    legislation_id INT NOT NULL,
    status VARCHAR(100) NOT NULL,
    remarks TEXT,
    updated_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE audit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(255),
    module VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users(fullname, username, password, role)
VALUES ('System Administrator', 'admin', MD5('admin123'), 'Admin');

INSERT INTO committees(name, chairperson, description) VALUES
('Committee on Finance', 'Hon. Juan Dela Cruz', 'Handles budget, appropriation, taxation, and financial legislation.'),
('Committee on Health', 'Hon. Maria Santos', 'Handles health programs, sanitation, and public welfare.'),
('Committee on Education', 'Hon. Pedro Reyes', 'Handles education, scholarships, and youth development.'),
('Committee on Environment', 'Hon. Ana Garcia', 'Handles environmental protection, solid waste, and climate resilience.'),
('Committee on Agriculture', 'Hon. Ramon Torres', 'Handles agriculture, fisheries, and livelihood matters.');

INSERT INTO council_members(fullname, position, committee, contact, email) VALUES
('Hon. Juan Dela Cruz','Municipal Vice Mayor','Committee on Finance','09170000001','juan@example.com'),
('Hon. Maria Santos','SB Member','Committee on Health','09170000002','maria@example.com'),
('Hon. Pedro Reyes','SB Member','Committee on Education','09170000003','pedro@example.com');

INSERT INTO ordinances(ordinance_no,title,author,committee,date_filed,status,remarks) VALUES
('ORD-2026-001','An Ordinance Strengthening Solid Waste Management','Hon. Ana Garcia','Committee on Environment','2026-01-15','Committee Review','For committee deliberation.'),
('ORD-2026-002','An Ordinance Regulating Use of Public Parks','Hon. Pedro Reyes','Committee on Education','2026-02-10','First Reading','Included in next session agenda.');

INSERT INTO resolutions(resolution_no,title,author,committee,date_filed,status,remarks) VALUES
('RES-2026-001','Resolution Supporting Digital Transformation Programs','Hon. Juan Dela Cruz','Committee on Finance','2026-01-20','Approved','Approved during regular session.'),
('RES-2026-002','Resolution Requesting Additional Medical Supplies','Hon. Maria Santos','Committee on Health','2026-02-08','Filed','Awaiting committee action.');

INSERT INTO sessions(session_no,session_date,session_time,venue,presiding_officer,agenda,minutes) VALUES
('RS-2026-001','2026-02-15','09:00:00','SB Session Hall','Municipal Vice Mayor','Reading of proposed ordinances and committee reports.','Initial deliberations completed.');
