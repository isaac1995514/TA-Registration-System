DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Transcript;
DROP TABLE IF EXISTS files;
DROP TABLE IF EXISTS Applications;
DROP TABLE IF EXISTS TA_Experience;
DROP TABLE IF EXISTS Course;
DROP TABLE IF EXISTS Faculty;
DROP TABLE IF EXISTS FacultyAccount;
DROP TABLE IF EXISTS Student;
DROP TABLE IF EXISTS StudentAccount;
DROP TABLE IF EXISTS Department;

CREATE TABLE Department(
    departmentName VARCHAR(20) NOT NULL,
    abbreviation VARCHAR(4) NOT NULL,
    registrationKey VARCHAR(10) NOT NULL,
    PRIMARY KEY (departmentName)
);

CREATE TABLE StudentAccount(
    studentId VARCHAR(8) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    psw VARCHAR(255) NOT NULL,
    PRIMARY KEY (studentId)
);

CREATE TABLE Student(
    studentId VARCHAR(8) NOT NULL,
    firstName VARCHAR(50) NOT NULL,
    middleName VARCHAR(1),
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    gpa FLOAT NOT NULL,
    departmentName VARCHAR(50) NOT NULL,
    entryYear VARCHAR(4) NOT NULL,
    entryTerm enum('Spring', 'Fall') NOT NULL,
    studentType enum('Undergrad', 'Grad', 'Master', 'PhD') NOT NULL,
    adviser VARCHAR(100),
    earnedMasterDegree TINYINT(1) NOT NULL,
    foreignStudent TINYINT(1) NOT NULL,
    emiTestPassed TINYINT(1) NOT NULL,
    currentEMI TINYINT(1) NOT NULL,
    PRIMARY KEY (studentId),
    FOREIGN KEY (studentId) REFERENCES StudentAccount(studentId)
);

CREATE TABLE FacultyAccount(
    facultyId VARCHAR(8) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    psw VARCHAR(255) NOT NULL,
    PRIMARY KEY (facultyId)
);

CREATE TABLE Faculty(
    facultyId VARCHAR(8) NOT NULL,
    firstName VARCHAR(50) NOT NULL,
    middleName VARCHAR(1),
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    departmentName varchar(50) NOT NULL,
    PRIMARY KEY (facultyId),
    FOREIGN KEY (departmentName) REFERENCES Department(departmentName),
    FOREIGN KEY (facultyId) REFERENCES FacultyAccount(facultyId)
);

CREATE TABLE Course(
    courseName VARCHAR(50) NOT NULL,
    courseCode VARCHAR(8) NOT NULL,
    departmentName VARCHAR(50) NOT NULL,
    academicYear VARCHAR(4) NOT NULL,
    term enum('Fall', 'Spring', 'Winter', 'Summer') NOT NULL,
    section VARCHAR(4) NOT NULL,
    professorId varchar(8) NOT NULL,
    credit  TINYINT(1) NOT NULL,
    PRIMARY KEY (courseCode, academicYear, term, section),
    FOREIGN KEY (professorId) REFERENCES Faculty(facultyId)
);

CREATE TABLE TA_Experience(
    studentId VARCHAR(8) NOT NULL,
    courseCode VARCHAR(10) NOT NULL,
    section VARCHAR(4) NOT NULL,
    academicYear VARCHAR(4) NOT NULL,
    term enum('Fall', 'Spring', 'Summer') NOT NULL,
    professorId VARCHAR(8) NOT NULL,
    taType enum('Part Time', 'Full Time') NOT NULL,
    canTeach TINYINT(1) NOT NULL,
    PRIMARY KEY(studentId, courseCode, academicYear, term),
    FOREIGN KEY (studentId) REFERENCES StudentAccount(studentId),
    FOREIGN KEY (courseCode) REFERENCES Course(courseCode)
);

CREATE TABLE Applications(
    id INT NOT NULL AUTO_INCREMENT,
    studentId VARCHAR(8) NOT NULL,
    academicYear VARCHAR(4) NOT NULL,
    courseCode VARCHAR(8) NOT NULL,
    term enum('Fall', 'Spring', 'Summer') NOT NULL,
    appStatus enum('New','Accepted', "Denied") NOT NULL,
    canTeach TINYINT(1) NOT NULL,
    taType enum('Part Time', 'Full Time') NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (studentId) REFERENCES StudentAccount(studentId),
    FOREIGN KEY (courseCode) REFERENCES Course(courseCode),
    CONSTRAINT unique_application UNIQUE(studentId, courseCode, academicYear, term)
);

CREATE TABLE Transcript(
    studentId VARCHAR(8) NOT NULL,
    title text,
    imgdata longblob,
    FOREIGN KEY (studentId) REFERENCES StudentAccount(studentId)
);

CREATE TABLE files (
    id   INT           AUTO_INCREMENT PRIMARY KEY,
    mime VARCHAR (255) NOT NULL,
    data LONGBLOB          NOT NULL
);

CREATE TABLE Comment(
    id INT NOT NULL AUTO_INCREMENT,
    studentId VARCHAR(8) NOT NULL,
    facultyId VARCHAR(8) NOT NULL,
    comment TEXT NOT NULL,
    sendTime TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (studentId) REFERENCES StudentAccount(studentId),
    FOREIGN KEY (facultyId) REFERENCES Faculty(facultyId)
);

GRANT ALL ON tasql.* to dbuser@localhost identified by "password";
