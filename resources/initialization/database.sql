DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Student;
DROP TABLE IF EXISTS TA_Experience;
DROP TABLE IF EXISTS Applications;
DROP TABLE IF EXISTS Faculty;
DROP TABLE IF EXISTS Course;

CREATE TABLE Department(
    departmentName varchar(20) NOT NULL,
    registrationKey varchar(10) NOT NULL,
    PRIMARY KEY (departmentName)
);

CREATE TABLE Student(
    username varchar(50),
    psw varchar(50),
    studentId varchar(8),
    firstName varchar(50),
    middleName varchar(1),
    lastName varchar(50),
    email varchar(50),
    phone varchar(15),
    departmentName varchar(50),
    PRIMARY KEY (studentId)
);


CREATE TABLE TA_Experience(
    studentId varchar(8),
    courseCode varchar(10),
    academicYear varchar(4),
    section varchar(4),
    term enum('Fall', 'Spring', 'Winter', 'Summer'),
    PRIMARY KEY(studentId, courseCode, academicYear, section, term)
);

CREATE TABLE Applications(
    studentId varchar(8),
    academicYear varchar(4),
    course varchar(8),
    section varchar(4),
    term enum('Fall', 'Spring', 'Winter', 'Summer'),
    appStatus enum('New','Accepted', "Denied"),
    PRIMARY KEY (studentId, academicYear, course, section)
);

CREATE TABLE Faculty(
    username varchar(50) ,
    psw varchar(50),
    facultyId varchar(8),
    firstName varchar(50),
    middleName varchar(1),
    lastName varchar(50),
    email varchar(50),
    phone varchar(15),
    departmentName varchar(50),
    PRIMARY KEY (facultyId)
);

CREATE TABLE Course(
    courseName varchar(50),
    courseCode varchar(8),
    academicYear varchar(4),
    section varchar(4),
    term enum('Fall', 'Spring', 'Winter', 'Summer'),
    professorId varchar(8),
    PRIMARY KEY (courseCode, academicYear, section, term)
);
