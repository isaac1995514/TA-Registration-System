/* Insert Department Testing Dataset*/

INSERT INTO Department VALUES ("Astronomy", "ASTR001");
INSERT INTO Department VALUES ("Biology", "BIOL002");
INSERT INTO Department VALUES ("Computer Science", "CMSC003");
INSERT INTO Department VALUES ("Dance", "DANC004");
INSERT INTO Department VALUES ("Education", "EDUC005");
INSERT INTO Department VALUES ("Film Studies", "FILM006");
INSERT INTO Department VALUES ("Government and Politics", "GVPT007");
INSERT INTO Department VALUES ("History", "HIST008");
INSERT INTO Department VALUES ("Italian", "ITAL009");
INSERT INTO Department VALUES ("Japanese", "JAPN010");

/* Insert Student Testing Dataset */
INSERT INTO Student VALUES ("00000001", "First", "M", "Last", "fakeEmail@gmail.com", "000-000-0000", "2.22",
                            "Computer Science", "2015", "Fall", "Undergrad", "Adviser", "Yes", NULL, NULL);

/* Insert StudentAccount Testing Dataset */

INSERT INTO StudentAccount VALUES("00000001", "user0000001", "psw0000001"); 

/* Insert Faculty Testing Dataset */

INSERT INTO Faculty VALUES("000001", "Nelson", NULL, "Padua-Perez", "nelson@cs.umd.edu", "000-000-0000", "Computer Science");
INSERT INTO Faculty VALUES("000002", "Fawzi", NULL, "Emad", "fpe@cs.umd.edu", "301-405-2709", "Computer Science");
INSERT INTO Faculty VALUES("000003", "Larry", NULL, "Herman", "no-way@I-get-too-much-email-already.umd.edu", "301-405-2762", "Computer Science");
INSERT INTO Faculty VALUES("000004", "Clyde", NULL, "Kruskal", "kruskal@cs.umd.edu", "000-000-0000", "Computer Science");

/* Insert FacultyAccount Testing Dataset*/

INSERT INTO FacultyAccount VALUES("000001", "faculty00001", "psw00001");
INSERT INTO FacultyAccount VALUES("000002", "faculty00002", "psw00002");
INSERT INTO FacultyAccount VALUES("000003", "faculty00003", "psw00003");
INSERT INTO FacultyAccount VALUES("000004", "faculty00004", "psw00004");

/* Insert Course Testing Dataset*/

INSERT INTO Course VALUES ("Object-Oriented Programming I", "CMSC131", "0101", "2018", "Spring", "000001");
INSERT INTO Course VALUES ("Object-Oriented Programming I", "CMSC131", "0102", "2018", "Spring", "000001");
INSERT INTO Course VALUES ("Object-Oriented Programming I", "CMSC131", "0103", "2018", "Spring", "000001");
INSERT INTO Course VALUES ("Object-Oriented Programming I", "CMSC131", "0104", "2018", "Spring", "000001");
INSERT INTO Course VALUES ("Object-Oriented Programming I", "CMSC131", "0105", "2018", "Spring", "000001");
INSERT INTO Course VALUES ("Object-Oriented Programming II", "CMSC132", "0101", "2018", "Spring", "000002");
INSERT INTO Course VALUES ("Object-Oriented Programming II", "CMSC132", "0102", "2018", "Spring", "000002");
INSERT INTO Course VALUES ("Object-Oriented Programming II", "CMSC132", "0103", "2018", "Spring", "000002");
INSERT INTO Course VALUES ("Object-Oriented Programming II", "CMSC132", "0104", "2018", "Spring", "000002");
INSERT INTO Course VALUES ("Object-Oriented Programming II", "CMSC132", "0105", "2018", "Spring", "000002");
INSERT INTO Course VALUES ("Introduction to Computer Systems", "CMSC216", "0101", "2018", "Spring", "000003");
INSERT INTO Course VALUES ("Introduction to Computer Systems", "CMSC216", "0102", "2018", "Spring", "000003");
INSERT INTO Course VALUES ("Introduction to Computer Systems", "CMSC216", "0103", "2018", "Spring", "000003");
INSERT INTO Course VALUES ("Introduction to Computer Systems", "CMSC216", "0104", "2018", "Spring", "000003");
INSERT INTO Course VALUES ("Introduction to Computer Systems", "CMSC216", "0105", "2018", "Spring", "000003");
INSERT INTO Course VALUES ("Algorithms", "CMSC351", "0101", "2018", "Spring", "000004");
INSERT INTO Course VALUES ("Algorithms", "CMSC351", "0102", "2018", "Spring", "000004");
INSERT INTO Course VALUES ("Algorithms", "CMSC351", "0103", "2018", "Spring", "000004");
INSERT INTO Course VALUES ("Algorithms", "CMSC351", "0104", "2018", "Spring", "000004");
INSERT INTO Course VALUES ("Algorithms", "CMSC351", "0105", "2018", "Spring", "000004");