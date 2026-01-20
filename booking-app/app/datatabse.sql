CREATE DATABASE IF NOT EXISTS doctor_app;
USE doctor_app;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    specialization VARCHAR(100),
    experience INT,
    consultation_fee DECIMAL(10,2)
);

-- CREATE TABLE doctor_availability (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     doctor_id INT NOT NULL,
--     FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE,
--     INDEX (doctor_id, available_date)
-- );

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    status ENUM('BOOKED','CANCELLED','COMPLETED') DEFAULT 'BOOKED',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES users(id),
    FOREIGN KEY (doctor_id) REFERENCES doctors(id),
    UNIQUE (doctor_id, appointment_date, appointment_time)
);

ALTER TABLE users
ADD COLUMN mobileno VARCHAR(15) AFTER email,
ADD COLUMN dob DATE AFTER mobileno,
ADD COLUMN age INT AFTER dob,
ADD COLUMN gender ENUM('MALE','FEMALE','OTHER') AFTER age,
ADD COLUMN address TEXT AFTER gender;

ALTER TABLE doctors
ADD COLUMN available_from TIME,
ADD COLUMN available_to TIME;
/*  Sample Data 
    password_hash()
*/

INSERT INTO users (name, email, password, role)
VALUES (
  'John Doe',
  'john@gmail.com',
  '$2y$10$j14k/U3Y86bFXcmz5z4Kq.2bEcjt0.k8ocUaF3Ju.GpEDGSMSMVum',
  'patient'
);