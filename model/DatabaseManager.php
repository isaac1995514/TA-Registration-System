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

        // Tables
        const DEPARTMENT = "Department";
        const STUDENT = "Student";
        const STUDENT_ACCOUNT = "StudentAccount";
        const FACULTY = "Faculty";
        const FACULTY_ACCOUNT = "FacultyAccount";
        const TA = "TA_Experience";
        const APPLICATION = "Applications";
        const COURSE = "Course";

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

        /**
         * Generate queries for database operations
         *
         * @param $type
         * @param $tables
         * @param $arguments
         * @return null|string
         */
        private function generateQuery($type, $tables, $arguments){

            $query = NULL;

            switch ($type){
                case "INSERT":
                    $values = join(", ", array_keys($arguments));
                    $field = join(", ", array_values($arguments));

                    $query = "INSERT INTO {$tables} ({$values}) VALUES ({$field});";
                    break;
                case "SELECT":
                    $select = $arguments["select"];
                    $where = $arguments["where"];

                    $query = "SELECT {$select} FROM {$tables} WHERE {$where};";
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
                "resumeFile" => (is_null($fields["resumeFile"])) ? "NULL" : "NULL", 
                "entryYear" => "'{$fields["entryYear"]}'",
                "entryTerm" => "'{$fields["entryTerm"]}'",
                "studentType" => "'{$fields["studentType"]}'",
                "adviser" => "'{$fields["adviser"]}'",
                "earnedMasterDegree" => "{$fields["earnedMasterDegree"]}",
                "foreignStudent" => "{$fields["foreignStudent"]}",
                "emiTestPassed" => (is_null($fields["emiTestPassed"]) ? "NULL" : "{$fields["emiTestPassed"]}"),
                "currentEMI" => (is_null($fields["currentEMI"]) ? "NULL" : "{$fields["currentEMI"]}")
            );

            // Generate Query to add Student
            $tables = self::STUDENT;
            $query = $this->generateQuery(self::INSERT, $tables, $arguments);

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
            $tables = self::STUDENT_ACCOUNT;
            $query = $this->generateQuery(self::INSERT, $tables, $arguments);

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
                "term" => "'{$fields["term"]}'",
                "professorId" => "'{$fields["professorId"]}'"
            );

            // Generate Query to add Faculty
            $tables = self::TA;
            $query = $this->generateQuery(self::INSERT, $tables, $arguments);

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
            $tables = self::FACULTY;
            $query = $this->generateQuery(self::INSERT, $tables, $arguments);

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
            $tables = self::FACULTY_ACCOUNT;
            $query = $this->generateQuery(self::INSERT, $tables, $arguments);

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
            $tables = self::APPLICATION;
            $query = $this->generateQuery(self::INSERT, $tables, $arguments);

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

        /**
         * Get all application for a specific student
         *      Note: if $year and $term are not provides, all application (current and previous) will be returned.
         *
         * @param $studentId
         * @param null $year
         * @param null $term
         * @return array [Error Code : int, Result : array($key => $value)]
         *      Error Code:
         *          0 - Succeeded
         *          1 - Empty Result
         *          101 - Connection Error
         *          102 - Failed to obtain student's application from database
         *          103 - Failed to obtain the column's name of a table from database
         */
        public function getStudentApplication($studentId, $year = NULL, $term = NULL){

            $data = array();

            $db_connection = $this->connect();

            if ($db_connection == NULL) return [101, $data];

            $arguments = array(
                "select" => "*",
                "where" => ($year === NULL) ?
                    ("studentId = '{$studentId}'") :
                    ("studentId = '{$studentId}', academicYear = '{$year}', term = '{$term}'")
            );

            $tables = self::APPLICATION;
            $query = $this->generateQuery(self::SELECT, $tables, $arguments);

            /* Executing query */
            $result = $db_connection->query($query);
            if (!$result) {
                return [102, $result];
            }else{
                /* Number of rows found */
                $num_rows = $result->num_rows;

                if($num_rows == 0){
                    return [1, $data];
                }else{

                    while($row = $result->fetch_assoc()) {
                        $data[]=$row;
                    }
                }
            }

            $db_connection->close();

            return [0, $data];
        }

        /***
         * Admin User Interface Functions
         */

        public function getTAForCourse($course, $section = NULL){

            $data = array();

            $db_connection = $this->connect();

            if($db_connection == NULL) return [101, $data];

            $arguments = array(
                "select" => "*",
                "where" => ($section === NULL) ?
                    ("courseCode = '{$course}'") :
                    ("courseCode = '{$course}', section = '{$section}'")
            );

            $tables = self::TA;
            $query = $this->generateQuery(self::SELECT, $tables, $arguments);


            /* Executing query */
            $result = $db_connection->query($query);
            if (!$result) {
                return [102, $result];
            }else{
                /* Number of rows found */
                $num_rows = $result->num_rows;

                if($num_rows == 0){
                    return [1, $data];
                }else{

                    while($row = $result->fetch_assoc()) {
                        $data[]=$row;
                    }
                }
            }

            $db_connection->close();

            return [0, $data];

        }



        private function getRow($columns, $row){

            $translatedRow = array();

            foreach($columns as $column){
                $translatedRow[(string) $column] = $row[(string) $column];
            }

            return $translatedRow;
        }

        private function getTableColumnNames($db_connection, $table){
            $columns = [];
            $columnQuery = "SHOW COLUMNS FROM {$table}";
            $res = $db_connection->query($columnQuery);
            if(!$res){
                return NULL;
            }else{
                while($row = $res->fetch_assoc()){
                    $columns[] = $row['Field'];
                }
            }

            return $columns;
        }
    }

