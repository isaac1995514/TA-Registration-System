DROP TABLE IF EXISTS Applications;
DROP TABLE IF EXISTS TA_Experience;
DROP TABLE IF EXISTS Course;
DROP TABLE IF EXISTS FacultyAccount;
DROP TABLE IF EXISTS Faculty;
DROP TABLE IF EXISTS StudentAccount;
DROP TABLE IF EXISTS Student;
DROP TABLE IF EXISTS Department;

CREATE TABLE Department(
    departmentName VARCHAR(20) NOT NULL,
    registrationKey VARCHAR(10) NOT NULL,
    PRIMARY KEY (departmentName)
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
    resumeFile BLOB,
    entryYear VARCHAR(4) NOT NULL,
    entryTerm enum('Spring', 'Fall') NOT NULL,
    studentType enum('Undergrad', 'Grad', 'Master', 'PhD') NOT NULL,
    adviser VARCHAR(100),
    earnedMasterDegree TINYINT(1) NOT NULL,
    foreignStudent TINYINT(1) NOT NULL,
    emiTestPassed TINYINT(1),
    currentEMI TINYINT(1),
    PRIMARY KEY (studentId),
    FOREIGN KEY (departmentName) REFERENCES Department(departmentName)
);

CREATE TABLE StudentAccount(
    studentId VARCHAR(8) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    psw VARCHAR(255) NOT NULL,
    PRIMARY KEY (studentId),
    FOREIGN KEY (studentId) REFERENCES Student(studentId)
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
    FOREIGN KEY (departmentName) REFERENCES Department(departmentName)
);

CREATE TABLE FacultyAccount(
    facultyId VARCHAR(8) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    psw VARCHAR(255) NOT NULL,
    PRIMARY KEY (facultyId),
    FOREIGN KEY (facultyId) REFERENCES Faculty(facultyId)
);

CREATE TABLE Course(
    courseName VARCHAR(50) NOT NULL,
    courseCode VARCHAR(8) NOT NULL,
    academicYear VARCHAR(4) NOT NULL,
    term enum('Fall', 'Spring', 'Winter', 'Summer') NOT NULL,
    section VARCHAR(4) NOT NULL,
    professorId varchar(8) NOT NULL,
    credit  INT(1) NOT NULL,
    PRIMARY KEY (courseCode, academicYear, term, section),
    FOREIGN KEY (professorId) REFERENCES Faculty(facultyId)
);

CREATE TABLE TA_Experience(
    studentId VARCHAR(8) NOT NULL,
    courseCode VARCHAR(10) NOT NULL,
    academicYear VARCHAR(4) NOT NULL,
    term enum('Fall', 'Spring', 'Winter', 'Summer') NOT NULL,
    section VARCHAR(4) NOT NULL,
    professorId VARCHAR(8) NOT NULL,
    PRIMARY KEY(studentId, courseCode, academicYear, section, term),
    FOREIGN KEY (studentId) REFERENCES Student(studentId),
    FOREIGN KEY (courseCode) REFERENCES Course(courseCode)
);

CREATE TABLE Applications(
    studentId VARCHAR(8) NOT NULL,
    academicYear VARCHAR(4) NOT NULL,
    courseCode VARCHAR(8) NOT NULL,
    term enum('Fall', 'Spring', 'Winter', 'Summer') NOT NULL,
    appStatus enum('New','Accepted', "Denied") NOT NULL,
    taType enum('Part Time', 'Full Time') NOT NULL,
    PRIMARY KEY (studentId, academicYear, courseCode),
    FOREIGN KEY (studentId) REFERENCES Student(studentId),
    FOREIGN KEY (courseCode) REFERENCES Course(courseCode)
);

GRANT ALL ON tasql.* to dbuser@localhost identified by "password";
