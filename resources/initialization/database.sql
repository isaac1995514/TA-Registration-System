DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Student;
DROP TABLE IF EXISTS StudentAccount;
DROP TABLE IF EXISTS Faculty;
DROP TABLE IF EXISTS FacultyAccount;
DROP TABLE IF EXISTS TA_Experience;
DROP TABLE IF EXISTS Applications;
DROP TABLE IF EXISTS Faculty;
DROP TABLE IF EXISTS Course;

CREATE TABLE Department(
    departmentName varchar(20) NOT NULL,
    registrationKey varchar(10) NOT NULL,
    PRIMARY KEY (departmentName)
);

CREATE TABLE StudentAccount(
    studentId varchar(8) NOT NULL,
    username varchar(50) NOT NULL UNIQUE,
    psw varchar(50) NOT NULL,
    PRIMARY KEY (studentId)
);

CREATE TABLE Student(
    studentId varchar(8) NOT NULL,
    firstName varchar(50) NOT NULL,
    middleName varchar(1),
    lastName varchar(50) NOT NULL,
    email varchar(50) NOT NULL,
    phone varchar(15) NOT NULL,
    departmentName varchar(50) NOT NULL,
    entryYear varchar(4) NOT NULL,
    entryTerm enum('Spring', 'Fall') NOT NULL,
    studentType enum('Undergrad', 'Grad', 'Master') NOT NULL,
    advisor varchar(50),
    msDegree enum('Yes', 'No') NOT NULL,
    emiTestPassed enum('Yes', 'No'),
    currentEMI enum('Yes', 'No'),
    PRIMARY KEY (studentId)
);

CREATE TABLE FacultyAccount(
    facultyId varchar(8) NOT NULL,
    username varchar(50) NOT NULL UNIQUE,
    psw varchar(50) NOT NULL,
    PRIMARY KEY (facultyId)
);

CREATE TABLE Faculty(
    facultyId varchar(8) NOT NULL,
    firstName varchar(50) NOT NULL,
    middleName varchar(1),
    lastName varchar(50) NOT NULL,
    email varchar(50) NOT NULL,
    phone varchar(15) NOT NULL,
    departmentName varchar(50) NOT NULL,
    PRIMARY KEY (facultyId)
);

CREATE TABLE TA_Experience(
    studentId varchar(8) NOT NULL,
    courseCode varchar(10) NOT NULL,
    academicYear varchar(4) NOT NULL,
    section varchar(4) NOT NULL,
    term enum('Fall', 'Spring', 'Winter', 'Summer') NOT NULL,
    PRIMARY KEY(studentId, courseCode, academicYear, section, term)
);

CREATE TABLE Applications(
    studentId varchar(8) NOT NULL,
    academicYear varchar(4) NOT NULL,
    course varchar(8) NOT NULL,
    term enum('Fall', 'Spring', 'Winter', 'Summer') NOT NULL,
    appStatus enum('New','Accepted', "Denied") NOT NULL,
    taType enum('Part Time', 'Full Time') NOT NULL,
    PRIMARY KEY (studentId, academicYear, course)
);

CREATE TABLE Course(
    courseName varchar(50) NOT NULL,
    courseCode varchar(8) NOT NULL,
    academicYear varchar(4) NOT NULL,
    section varchar(4) NOT NULL,
    term enum('Fall', 'Spring', 'Winter', 'Summer') NOT NULL,
    professorId varchar(8) NOT NULL,
    PRIMARY KEY (courseCode, academicYear, section, term)
);
