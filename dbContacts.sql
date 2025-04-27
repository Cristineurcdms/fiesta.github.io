CREATE DATABASE dbContacts;

USE dbContacts;

CREATE TABLE tblSMS (
    sms_ID INT AUTO_INCREMENT PRIMARY KEY,
    studno VARCHAR(50),
    name VARCHAR(100),
    cpno VARCHAR(20)
);
