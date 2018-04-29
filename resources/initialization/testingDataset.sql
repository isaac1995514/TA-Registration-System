/* Insert Department Testing Dataset*/

INSERT INTO Department VALUES ("Astronomy", "ASTR","ASTR001");
INSERT INTO Department VALUES ("Biology", "BIOL", "BIOL002");
INSERT INTO Department VALUES ("Computer Science","CMSC", "CMSC003");
INSERT INTO Department VALUES ("Dance", "DANC", "DANC004");
INSERT INTO Department VALUES ("Education", "EDUC", "EDUC005");
INSERT INTO Department VALUES ("Film Studies", "FILM", "FILM006");
INSERT INTO Department VALUES ("Government and Politics", "GVPT", "GVPT007");
INSERT INTO Department VALUES ("History", "HIST", "HIST008");
INSERT INTO Department VALUES ("Italian", "ITAL", "ITAL009");
INSERT INTO Department VALUES ("Japanese", "JAPN", "JAPN010");

/* Insert StudentAccount Testing Dataset */

INSERT INTO StudentAccount VALUES("00000001", "user0000001", "psw0000001"); 
INSERT INTO StudentAccount VALUES("00000002", "user0000002", "psw0000002"); 
INSERT INTO StudentAccount VALUES("00000003", "user0000003", "psw0000003"); 

/* Insert Student Testing Dataset */
INSERT INTO Student VALUES ("00000001", "First01", "M", "Last01", "fakeEmail@gmail.com", "000-000-0000", "2.22",
                            "Computer Science", "2015", "Fall", "Undergrad", "Adviser",
                            0, 0, -1, -1);

INSERT INTO Student VALUES ("00000002", "First02", "M", "Last02", "fakeEmail@gmail.com", "000-000-0000", "2.22",
                            "Computer Science", "2015", "Fall", "Undergrad", "Adviser",
                            0, 0, -1, -1);

INSERT INTO Student VALUES ("00000003", "First03", "M", "Last03", "fakeEmail@gmail.com", "000-000-0000", "2.22",
                            "Computer Science", "2015", "Spring", "Undergrad", "Adviser",
                            0, 0, -1, -1);   


/* Insert FacultyAccount Testing Dataset*/

INSERT INTO FacultyAccount VALUES("000001", "faculty00001", "psw00001");
INSERT INTO FacultyAccount VALUES("000002", "faculty00002", "psw00002");
INSERT INTO FacultyAccount VALUES("000003", "faculty00003", "psw00003");
INSERT INTO FacultyAccount VALUES("000004", "faculty00004", "psw00004");

/* Insert Faculty Testing Dataset */

INSERT INTO Faculty VALUES("000001", "Nelson", NULL, "Padua-Perez", "nelson@cs.umd.edu", "000-000-0000", "Computer Science");
INSERT INTO Faculty VALUES("000002", "Fawzi", NULL, "Emad", "fpe@cs.umd.edu", "301-405-2709", "Computer Science");
INSERT INTO Faculty VALUES("000003", "Larry", NULL, "Herman", "no-way@I-get-too-much-email-already.umd.edu", "301-405-2762", "Computer Science");
INSERT INTO Faculty VALUES("000004", "Clyde", NULL, "Kruskal", "kruskal@cs.umd.edu", "000-000-0000", "Computer Science");

/* Insert Course Testing Dataset*/

INSERT INTO Course VALUES ("Object-Oriented Programming I", "CMSC131", "Computer Science", "2018", "Spring", "0101", "000001", 3);
INSERT INTO Course VALUES ("Object-Oriented Programming I", "CMSC131", "Computer Science", "2018", "Spring", "0201", "000001", 3);
INSERT INTO Course VALUES ("Object-Oriented Programming I", "CMSC131", "Computer Science", "2018", "Spring", "0301", "000001", 3);
INSERT INTO Course VALUES ("Object-Oriented Programming I", "CMSC131", "Computer Science", "2018", "Spring", "0401", "000001", 3);
INSERT INTO Course VALUES ("Object-Oriented Programming I", "CMSC131", "Computer Science", "2018", "Spring", "0501", "000001", 3);
INSERT INTO Course VALUES ("Object-Oriented Programming II", "CMSC132", "Computer Science", "2018", "Spring", "0101", "000002", 3);
INSERT INTO Course VALUES ("Object-Oriented Programming II", "CMSC132", "Computer Science", "2018", "Spring", "0201", "000002", 3);
INSERT INTO Course VALUES ("Object-Oriented Programming II", "CMSC132", "Computer Science", "2018", "Spring", "0301", "000002", 3);
INSERT INTO Course VALUES ("Object-Oriented Programming II", "CMSC132", "Computer Science", "2018", "Spring", "0401", "000002", 3);
INSERT INTO Course VALUES ("Object-Oriented Programming II", "CMSC132", "Computer Science", "2018", "Spring", "0501", "000002", 3);
INSERT INTO Course VALUES ("Introduction to Computer Systems", "CMSC216", "Computer Science", "2018", "Spring", "0101", "000003", 4);
INSERT INTO Course VALUES ("Introduction to Computer Systems", "CMSC216", "Computer Science", "2018", "Spring", "0201", "000003", 4);
INSERT INTO Course VALUES ("Introduction to Computer Systems", "CMSC216", "Computer Science", "2018", "Spring", "0301", "000003", 4);
INSERT INTO Course VALUES ("Introduction to Computer Systems", "CMSC216", "Computer Science", "2018", "Spring", "0401", "000003", 4);
INSERT INTO Course VALUES ("Introduction to Computer Systems", "CMSC216", "Computer Science", "2018", "Spring", "0501", "000003", 4);
INSERT INTO Course VALUES ("Algorithms", "CMSC351", "Computer Science", "2018", "Spring", "0101", "000004", 3);
INSERT INTO Course VALUES ("Algorithms", "CMSC351", "Computer Science", "2018", "Spring", "0201", "000004", 3);
INSERT INTO Course VALUES ("Algorithms", "CMSC351", "Computer Science", "2018", "Spring", "0301", "000004", 3);
INSERT INTO Course VALUES ("Algorithms", "CMSC351", "Computer Science", "2018", "Spring", "0401", "000004", 3);
INSERT INTO Course VALUES ("Algorithms", "CMSC351", "Computer Science", "2018", "Spring", "0501", "000004", 3);

INSERT INTO Comment (studentId, facultyId, comment) VALUES ('00000003', '000001', 'You are terrible');
INSERT INTO Comment (studentId, facultyId, comment) VALUES ('00000003', '000002', 'You are okay');
INSERT INTO Comment (studentId, facultyId, comment) VALUES ('00000003', '000003', 'You are alright');
INSERT INTO Comment (studentId, facultyId, comment) VALUES ('00000003', '000004', 'You suck');
INSERT INTO Comment (studentId, facultyId, comment) VALUES ('00000002', '000001', 'You are so terrible');
INSERT INTO Comment (studentId, facultyId, comment) VALUES ('00000001', '000001', 'You are super terrible');

