drop database if exists interlink;
create database interlink;
use interlink;
	
CREATE TABLE school(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(60) not null
);

CREATE TABLE program(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	school int NOT NULL,
    name varchar(255) not null,
    FOREIGN KEY (school) REFERENCES school(id)
);

create table country(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(60) not null
);

CREATE TABLE student(
    id INT(10) not null PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    f_name VARCHAR(30) not null,
    l_name VARCHAR(30),
	sex enum("Male", "Female") NOT NULL,
    program INT NOT NULL,
    country INT NOT NULL,
	has_edited ENUM ('0', '1') default '0',
    FOREIGN KEY (program) REFERENCES program(id),
    FOREIGN KEY (country) REFERENCES country(id)
);

CREATE table staff(
    id VARCHAR(10) not null PRIMARY KEY,
    password VARCHAR(30) NOT NULL,
    f_name VARCHAR(30) not null,
    l_name VARCHAR(30) not null,
	sex enum("Male", "Female")
);

create table message(
    id INT PRIMARY KEY AUTO_INCREMENT,
    sender_type ENUM('student', 'staff'),
    sender_id INT(10) NOT NULL,
    reciever_id INT(10) NOT NULL,
    content TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE complaint(
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    content TEXT NOT NULL 
);
