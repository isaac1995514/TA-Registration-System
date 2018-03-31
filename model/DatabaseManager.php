<?php
    /**
     * Created by PhpStorm.
     * User: Isaac
     * Date: 3/29/2018
     * Time: 9:12 PM
     */

    class DatabaseManager
    {
        /**
         * Constants
         */
        const INSERT = "INSERT";
        const DELETE = "DELETE";
        const UPDATE = "UPDATE";
        const SELECT = "SELECT";

        private $host;
        private $user;
        private $password;
        private $database;
        private $tables;

        /**
         * DatabaseManager constructor.
         */
        public function __construct()
        {
            $this->host = 'localhost';
            $this->user = 'dbuser';
            $this->password = "password";
            $this->database = 'tasql';
            $this->tables = array(
                "department" => "Department",
                "student" => "Student",
                "studentAcc" => "StudentAccount",
                "faculty" => "Faculty",
                "facultyAcc" => "FacultyAccount",
                "ta" => "TA_Experience",
                "app" => "Applications",
                "course" => "Course"
            );
        }

        /***************************************************************************
         *                             SQL functions                               *
         ***************************************************************************/

        /**
         * Connect to tasql database
         *      * NULL is return when there is a connection error
         * @return mysqli|null
         */
        private function connect(){

            /* Connecting to the database */
            $db_connection = new mysqli($this->host, $this->user, $this->password, $this->database);
            if ($db_connection->connect_error) {
                return NULL;
            }

            return $db_connection;
        }

        private function generateQuery($type, $tables, $arguments){

            $query = NULL;

            switch ($type){
                case "INSERT":
                    $values = join(", ", array_keys($arguments));
                    $field = join(", ", array_values($arguments));

                    $query = "INSERT INTO {$tables[0]} ({$values}) VALUES ({$field});";

                    break;
            }

            return $query;
        }

        /***************************************************************************
         *                          Insertion Functions                            *
         ***************************************************************************/

        /**
         * Add student into Student Table and StudentAccount Table
         *
         * @param $fields
         * @return int : Error Code
         *      0 - Succeed
         *      101 - Connection Error
         *      102 - Failed to insert to Student
         *      103 - Failed io insert to StudentAccount
         */
        public function addStudent($fields){

            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return 101;

            // Set up values to be added
            $arguments = array(
                "studentId" => "'{$fields["studentId"]}'",
                "firstName" => "'{$fields["firstName"]}'",
                "middleName" => (is_null($fields["middleName"]) ? "NULL" : "'{$fields["middleName"]}'"),
                "lastName" => "'{$fields["lastName"]}'",
                "email" => "'{$fields["email"]}'",
                "phone" => "'{$fields["phone"]}'",
                "gpa" => $fields["gpa"],
                "departmentName" => "'{$fields["departmentName"]}'",
                "entryYear" => "'{$fields["entryYear"]}'",
                "entryTerm" => "'{$fields["entryTerm"]}'",
                "studentType" => "'{$fields["studentType"]}'",
                "adviser" => "'{$fields["adviser"]}'",
                "msDegree" => "'{$fields["msDegree"]}'",
                "emiTestPassed" => (is_null($fields["emiTestPassed"]) ? "NULL" : "'{$fields["emiTestPassed"]}'"),
                "currentEMI" => (is_null($fields["currentEMI"]) ? "NULL" : "'{$fields["currentEMI"]}'")
            );

            // Generate Query to add Student
            $query = $this->generateQuery(self::INSERT, array($this->tables['student']), $arguments);

            // echo "Query (Add to Student): ", $query;
            // echo "<br><br>";

            /* Executing query */
            $result = $db_connection->query($query);
            if (!$result) {
                return 102;
            }

            // Set up values to be added
            $encrypted_username = password_hash($fields["username"], PASSWORD_DEFAULT);
            $encrypted_psw = password_hash($fields["psw"], PASSWORD_DEFAULT);


            $arguments = array(
                "studentId" => "'{$fields["studentId"]}'",
                "username" => "'{$encrypted_username}'",
                "psw" => "'{$encrypted_psw}'"
            );

            // Generate Query to add StudentAccount
            $query = $this->generateQuery(self::INSERT, array($this->tables['studentAcc']), $arguments);

            // echo "Query (Add to StudentAccount): ", $query;
            // echo "<br><br>";

            /* Executing query */
            $result = $db_connection->query($query);
            if (!$result) {
                // Make sure to delete previous insertion to student
                return 103;
            }

            // Disconnect from Database;
            $db_connection->close();

            return 0;

        }

        /**
         * Add ta position for a student in a specif year
         *
         * @param $fields
         * @return int : Error Code
         *      0 - Succeed
         *      101 - Connection Error
         *      102 - Failed to insert to TA_Experience
         */
        public function addTA($fields){
            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return 101;

            // Set up values to be added
            $arguments = array(
                "studentId" => "'{$fields["studentId"]}'",
                "courseCode" => "'{$fields["courseCode"]}'",
                "academicYear" => "'{$fields["academicYear"]}'",
                "term" => "'{$fields["term"]}'"
            );

            // Generate Query to add Faculty
            $query = $this->generateQuery(self::INSERT, array($this->tables['ta']), $arguments);

            /* Executing query */
            $result = $db_connection->query($query);
            if (!$result) {
                return 102;
            }

            $db_connection->close();

            return 0;

        }

        /**
         * Add faculty into Faculty Table and FacultyAccount Table
         *
         * @param $fields
         * @return int : Error Code
         *      0 - Succeed
         *      101 - Connection Error
         *      102 - Failed to insert to Faculty
         *      103 - Failed io insert to FacultyAccount
         */
        public function addFaculty($fields){

            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return 101;

            // Set up values to be added
            $arguments = array(
                "facultyId" => "'{$fields["facultyId"]}'",
                "firstName" => "'{$fields["firstName"]}'",
                "middleName" => (is_null($fields["middleName"]) ? "NULL" : "'{$fields["middleName"]}'"),
                "lastName" => "'{$fields["lastName"]}'",
                "email" => "'{$fields["email"]}'",
                "phone" => "'{$fields["phone"]}'",
                "departmentName" => "'{$fields["departmentName"]}'",
            );

            // Generate Query to add Faculty
            $query = $this->generateQuery(self::INSERT, array($this->tables['faculty']), $arguments);

            /* Executing query */
            $result = $db_connection->query($query);
            if (!$result) {
                return 102;
            }

            // Set up values to be added
            $encrypted_username = password_hash($fields["username"], PASSWORD_DEFAULT);
            $encrypted_psw = password_hash($fields["psw"], PASSWORD_DEFAULT);

            $arguments = array(
                "facultyId" => "'{$fields["facultyId"]}'",
                "username" => "'{$encrypted_username}'",
                "psw" => "'{$encrypted_psw}'"
            );

            // Generate Query to add FacultyAccount
            $query = $this->generateQuery(self::INSERT, array($this->tables['facultyAcc']), $arguments);

            /* Executing query */
            $result = $db_connection->query($query);
            if (!$result) {
                // Make Sure to remove faculty from Faculty
                return 103;
            }

            $db_connection->close();

            return 0;

        }

        /**
         * Add new application into Application Table
         *
         * @param $fields
         * @return int : Error Code
         *      0 - Succeed
         *      101 - Connection Error
         *      102 - Failed to insert to Application
         */
        public function addApplication($fields){
            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return 101;

            // Set up values to be added
            $arguments = array(
                "studentId" => "'{$fields["studentId"]}'",
                "academicYear" => "'{$fields["academicYear"]}'",
                "courseCode" => "'{$fields["courseCode"]}'",
                "term" => "'{$fields["term"]}'",
                "appStatus" => "'{$fields["appStatus"]}'",
                "taType" => "'{$fields["taType"]}'"
            );

            // Generate Query to add Faculty
            $query = $this->generateQuery(self::INSERT, array($this->tables['app']), $arguments);

            /* Executing query */
            $result = $db_connection->query($query);
            if (!$result) {
                return 102;
            }

            $db_connection->close();

            return 0;

        }


        /***
         * Student User Interface Functions
         */

    }

