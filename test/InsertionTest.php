<?php
    /**
     * Created by PhpStorm.
     * User: Isaac
     * Date: 3/31/2018
     * Time: 2:06 PM
     */

    require_once('..\model\DatabaseManager.php');

    /**
     * Testing Insertion Function in DatabaseManager.php
     */

    $database = new DatabaseManager();

    $fields = array(
        "studentId" => "111111111",
        "username" => "user01",
        "psw" => "psw1234567",
        "firstName" => "First01",
        "middleName" => "M",
        "lastName" => "Last01",
        "email" => "fakeEmail01@gmail.com",
        "phone" => "111-111-1111",
        "gpa" => "3.33",
        "departmentName" => "Computer Science",
        "entryYear" => "2015",
        "entryTerm" => "Fall",
        "studentType" => "Undergrad",
        "adviser" => "Adviser",
        "msDegree" => "No",
        "emiTestPassed" => NULL,
        "currentEMI" => NULL
    );

    $code = $database->addStudent($fields);

    echo "Error Code (Add Student): ", $code, "<br><br>";

    $fields = array(
        "studentId" => "222222222",
        "username" => "user02",
        "psw" => "psw1234567",
        "firstName" => "First01",
        "middleName" => "M",
        "lastName" => "Last01",
        "email" => "fakeEmail02@gmail.com",
        "phone" => "111-111-1112",
        "gpa" => "3.34",
        "departmentName" => "History",
        "entryYear" => "2016",
        "entryTerm" => "Spring",
        "studentType" => "Undergrad",
        "adviser" => "Adviser",
        "msDegree" => "Yes",
        "emiTestPassed" => "Yes",
        "currentEMI" => "No"
    );

    $code = $database->addStudent($fields);

    echo "Error Code (Add Student): ", $code, "<br><br>";

    $fields = array(
        "studentId" => "333333333",
        "username" => "user03",
        "psw" => "psw1234567",
        "firstName" => "First03",
        "middleName" => "M",
        "lastName" => "Last03",
        "email" => "fakeEmail03@gmail.com",
        "phone" => "111-111-1113",
        "gpa" => "3.341",
        "departmentName" => "Biology",
        "entryYear" => "2016",
        "entryTerm" => "Spring",
        "studentType" => "Grad",
        "adviser" => "Adviser",
        "msDegree" => "Yes",
        "emiTestPassed" => "Yes",
        "currentEMI" => "No"
    );

    $code = $database->addStudent($fields);

    echo "Error Code (Add Student): ", $code, "<br><br>";

    $fields = array(
        "facultyId" => "000005",
        "username" => "faculty00005",
        "psw" => "psw00005",
        "firstName" => "Michael",
        "middleName" => NULL,
        "lastName" => "Hicks",
        "email" => "mwh@cs.umd.edu",
        "phone" => "301-405-2710",
        "departmentName" => "Computer Science"
    );

    $code = $database->addFaculty($fields);

    echo "Error Code (Add Faculty): ", $code, "<br><br>";

    $fields = array(
        "studentId" => "00000001",
        "courseCode" => "CMSC131",
        "academicYear" => "2018",
        "term" => "Spring",
    );

    $code = $database->addTA($fields);

    echo "Error Code (Add TA): ", $code, "<br><br>";

    $fields = array(
        "studentId" => "00000001",
        "academicYear" => "2018",
        "courseCode" => "CMSC131",
        "term" => "Spring",
        "appStatus" => "New",
        "taType" => "Full Time"
    );

    $code = $database->addApplication($fields);

    echo "Error Code (Add Application): ", $code, "<br><br>";
