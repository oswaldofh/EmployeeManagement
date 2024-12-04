CREATE DATABASE IF NOT EXISTS employee;
USE employee;

CREATE TABLE Departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE Genders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE Employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    hire_date DATE NOT NULL,
    comments TEXT,
    gender_id INT NOT NULL,
    department_id INT NOT NULL,
    salary DECIMAL(15, 2) NOT NULL,
    FOREIGN KEY (gender_id) REFERENCES Genders(id),
    FOREIGN KEY (department_id) REFERENCES Departments(id)
);

CREATE TABLE Expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year YEAR NOT NULL,
    month TINYINT NOT NULL CHECK (month BETWEEN 1 AND 12),
    income DECIMAL(15, 2) NOT NULL,
    expense DECIMAL(15, 2) NOT NULL,
    department_id INT NOT NULL,
    FOREIGN KEY (department_id) REFERENCES Departments(id)
);