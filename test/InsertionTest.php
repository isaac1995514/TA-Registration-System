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
        "resumeFile" => NULL,
        "entryYear" => "2015",
        "entryTerm" => "Fall",
        "studentType" => "Undergrad",
        "adviser" => "Adviser",
        "earnedMasterDegree" => 0,
        "foreignStudent" => 0,
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
        "resumeFile" => NULL,
        "entryYear" => "2016",
        "entryTerm" => "Spring",
        "studentType" => "PhD",
        "adviser" => "Adviser",
        "earnedMasterDegree" => 1,
        "foreignStudent" => 1,
        "emiTestPassed" => 1,
        "currentEMI" => 1
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
        "section" => "0101",
        "professorId" => "000001"
    );

    $code = $database->addTA($fields);

    echo "Error Code (Add TA): ", $code, "<br><br>";

    $fields = array(
        "studentId" => "00000002",
        "academicYear" => "2018",
        "courseCode" => "CMSC132",
        "term" => "Spring",
        "appStatus" => "New",
        "taType" => "Full Time"
    );

    $code = $database->addApplication($fields);

    echo "Error Code (Add Application): ", $code, "<br><br>";

    $fields = array(
        "studentId" => "00000003",
        "academicYear" => "2018",
        "courseCode" => "CMSC132",
        "term" => "Spring",
        "appStatus" => "New",
        "taType" => "Full Time"
    );

    $code = $database->addApplication($fields);

    echo "Error Code (Add Application): ", $code, "<br><br>";

    $fields = array(
        "studentId" => "00000002",
        "academicYear" => "2018",
        "courseCode" => "CMSC216",
        "term" => "Spring",
        "appStatus" => "New",
        "taType" => "Full Time"
    );

    $code = $database->addApplication($fields);

    echo "Error Code (Add Application): ", $code, "<br><br>";

    $fields = array(
        "studentId" => "00000001",
        "academicYear" => "2018",
        "courseCode" => "CMSC132",
        "term" => "Spring",
        "appStatus" => "New",
        "taType" => "Full Time"
    );

    $code = $database->addApplication($fields);

    echo "Error Code (Add Application): ", $code, "<br><br>";

    $fields = array(
        "studentId" => "00000001",
        "academicYear" => "2018",
        "courseCode" => "CMSC216",
        "term" => "Spring",
        "appStatus" => "New",
        "taType" => "Full Time"
    );

    $code = $database->addApplication($fields);

    echo "Error Code (Add Application): ", $code, "<br><br>";

    $fields = array(
        "studentId" => "00000001",
        "academicYear" => "2018",
        "courseCode" => "CMSC351",
        "term" => "Spring",
        "appStatus" => "New",
        "taType" => "Full Time"
    );

    $code = $database->addApplication($fields);

    echo "Error Code (Add Application): ", $code, "<br><br>";
