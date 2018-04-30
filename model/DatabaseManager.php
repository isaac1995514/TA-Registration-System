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
        public const DEPARTMENT = "Department";
        public const STUDENT = "Student";
        public const STUDENT_ACCOUNT = "StudentAccount";
        public const FACULTY = "Faculty";
        public const FACULTY_ACCOUNT = "FacultyAccount";
        public const TA = "TA_Experience";
        public const APPLICATION = "Applications";
        public const COURSE = "Course";
        public const TRANSCRIPT = "Transcript";
        public const COMMENT = "Comment";
        public const CONFIG = "Config";

        private $host;
        private $user;
        private $password;
        private $database;
        private $tables;

        public static $currentSemesterYear = "2018";
        public static $currentSemesterTerm = "Spring";
        public static $nextSemesterYear = "2018";
        public static $nextSemesterTerm = "Summer";

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
        public function connect(){

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

                    foreach($arguments as $key => $value){
                        $arguments[$key] = "'{$value}'";
                    } 

                    $values = join(", ", array_keys($arguments));
                    $field = join(", ", array_values($arguments));

                    $query = "INSERT INTO {$tables} ({$values}) VALUES ({$field});";
                    break;
                case "SELECT":
                    $select = $arguments["select"];
                    $where = $arguments["where"];

                    $query = "SELECT {$select} FROM {$tables} WHERE {$where};";
                    break;
                case "UPDATE":
                    $set = $arguments['set'];
                    $where = $arguments['where'];

                    $query = "UPDATE {$tables} SET {$set} WHERE {$where};";
                    break;
                case "DELETE":
                    $where = $arguments['where'];

                    $query = "DELETE FROM {$tables} WHERE {$where};";
            }

            return $query;
        }

        /***************************************************************************
         *                          Insertion Functions                            *
         ***************************************************************************/

        /**
         * Add student into Student Table
         *
         * @param $fields
         * @return int : Error Code
         *      0 - Succeed
         *      101 - Connection Error
         *      102 - Failed to insert to Student
         */
        public function addStudent($fields){

            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return 101;

            // Generate Query to add Student
            $tables = self::STUDENT;
            $query = $this->generateQuery(self::INSERT, $tables, $fields);

            // echo "Query (Add to Student): ", $query;
            // echo "<br><br>";

            /* Executing query */
            $result = $db_connection->query($query);
            if (!$result) {
                return 102;
            }

            // Disconnect from Database;
            $db_connection->close();

            return 0;

        }

        /**
         * update student into Student Table
         *
         * @param $fields
         * @return int : Error Code
         *      0 - Succeed
         *      101 - Connection Error
         *      1 - Failed to update  Student
         */
        public function updateStudent($fields){

            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return 101;

            $setArr = [];

            foreach($fields as $key => $value){
                $setArr[] = "{$key} = '{$value}'";
            }

            $setStr = join(", ", $setArr);

            $fields['where'] = "studentid = '{$fields['studentId']}'";
            $fields['set'] = $setStr;

            // Generate Query to add Student
            $tables = self::STUDENT;
            $query = $this->generateQuery(self::UPDATE, $tables, $fields);
            //echo $query;

            // echo "Query (Add to Student): ", $query;
            // echo "<br><br>";

            /* Executing query */
            $result = $db_connection->query($query);

            // Disconnect from Database;
            $db_connection->close();

            return ($result == true) ? 0 : 1;

        }

        /**
         * Get student in Student Table
         *
         * @param $fields
         * @return int : Error Code
         *          0 - Succeeded
         *          1 - Empty Result
         *          101 - Connection Error
         *          102 - Failed to obtain student's application from database
         */
        public function getStudent($studentId){

            $data = array();

            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return [101, $data];

            $arguments = array(
                "select" => "*",
                "where" => "studentId = '{$studentId}'"
            );

            $tables = self::STUDENT;
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
            return [0, $data];

        }

        /**
         * Get comments for a student 
         *
         * @param $fields
         * @return int : Error Code
         *          0 - Succeeded
         *          1 - Empty Result
         *          101 - Connection Error
         *          102 - Failed to obtain student's comment from database
         */
        public function getComment($studentId){

            $data = array();

            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return [101, $data];

            $arguments = array(
                "select" => "Comment.*, Faculty.firstName, Faculty.lastName",
                "where" => "studentId = '{$studentId}' ORDER BY sendTime"
            );

            $tables = 'Comment LEFT JOIN Faculty ON Comment.facultyId = Faculty.facultyId';
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
            return [0, $data];

        }

        /**
         * 
         */
        public function getCourse($studentId){

            $data = array();

            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return [101, $data];

            $arguments = array(
                "select" => "DISTINCT courseCode",
                "where" => "s.studentId = '{$studentId}' and d.departmentName = s.departmentName and d.departmentName = c.departmentName"
            );

            $tables = "Student s, Department d, Course c";
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
            return [0, $data];

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
        public function addTA($studentId, $courseCode, $section, $academicYear, $term, $professorId, $taType, $canTeach){
            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return 101;

            // Set up values to be added
            $arguments = array(
                "studentId" => "{$studentId}",
                "courseCode" => "{$courseCode}",
                "section" => "{$section}",
                "academicYear" => "{$academicYear}",
                "term" => "{$term}",
                "professorId" => "{$professorId}",
                "taType" => "{$taType}",
                "canTeach" => "{$canTeach}",
            );

            // Generate Query to add Faculty
            $tables = self::TA;
            $query = $this->generateQuery(self::INSERT, $tables, $arguments);

            /* Executing query */
            $result = $db_connection->query($query);
    
            $db_connection->close();

            return $result;
        }

        /**
         * 
         * 
         * 
         */
        public function getTA($studentId){

            $data = array();

            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return [101, $data];

            $where = [
                "t.professorId = f.facultyId",
                "t.courseCode = c.courseCode",
                "t.section = c.section",
                "studentId = '{$studentId}'"
            ];

            $arguments = array(
                "select" => "t.*, CONCAT(f.firstName, ' ',f.lastName) as professorName, c.courseName",
                "where" => join(' and ', $where)." ORDER BY t.academicYear, t.term"
            );

            $tables = "TA_Experience t, Faculty f, Course c";
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
            return [0, $data];
            
        }

        public function isTA($studentId, $academicYear, $term){

        
            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return [101, $data];

            $where = [
                "studentId = '{$studentId}'",
                "academicYear = '{$academicYear}'",
                "term = '{$term}'"
            ];

            $arguments = array(
                "select" => "*",
                "where" => join(' and ', $where)
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

                if($num_rows > 0){
                    return [1, true];
                }else{
                    return [1, false];
                }

                $db_connection->close();
            }
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

            // Generate Query to add Faculty
            $tables = self::APPLICATION;
            $query = $this->generateQuery(self::INSERT, $tables, $fields);

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
         */
        public function getStudentApplication($studentId){

            $data = array();

            $db_connection = $this->connect();

            if ($db_connection == NULL) return [101, $data];

            $arguments = array(
                "select" => "*",
                "where" => "studentId = '{$studentId}'"
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

        public function getAllApplication($studentId, $courseCode, $department, $studentType, $taType, $orderBy){

            $data = [];
            
            $db_connection = $this->connect();

            if ($db_connection == NULL) return [101, $data];

            $tables = "Applications a, Student s";
            $nextSemesterYear = DatabaseManager::$nextSemesterYear;
            $nextSemesterTerm = DatabaseManager::$nextSemesterTerm;

            $where = [
                "a.studentId = s.studentId",
                "a.academicYear = '{$nextSemesterYear}'",
                "a.term = '{$nextSemesterTerm}'",
                "a.courseCode LIKE '{$department}%'"
            ];

            // Check if studentId field is emtpy
            if($studentId != ""){
                $where[] = "a.studentId = '{$studentId}'";
            }

            // Check if courseCode field is emtpy
            if($courseCode != ""){
                $where[] = "a.courseCode = '{$courseCode}'";
            }

            // Check if studentType not equals to all Student;
            if($studentType != 'allStudent'){
                $where[] = "s.studentType = '{$studentType}'";
            }

            // Check if taType not equals to all Student;
            if($taType != 'allStudent'){
                $where[] = "a.taType = '{$taType}'";
            }
            $order = "";

            if($orderBy != "none"){
                $order = " ORDER BY '{$orderBy}'";
            }

            $arguments = [
                "select" => "a.*, s.gpa, s.studentType, CONCAT(s.firstName, ' ', s.lastName) as studentName",
                "where" => join(' and ', $where).$order
            ];
          
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

        /**
         * Remove application with the specified application id
         *
         * @param $id
         * @return array [Error Code : int, Result : array($key => $value)]
         *      Error Code:
         *          0 - Succeeded
         *          101 - Connection Error
         *          102 - Failed to delete student from the Applications table
         */
        public function removeStudentApplication($id){

            $data = array();

            $db_connection = $this->connect();

            if ($db_connection == NULL) return 101;

            $arguments = array(
                "where" => "id = '{$id}'"
            );

            $tables = self::APPLICATION;
            $query = $this->generateQuery(self::DELETE, $tables, $arguments);

            /* Executing query */
            $result = $db_connection->query($query);

            if($result){
                return 0;
            }else{
                return 102;
            }
        }



        /***
         * Admin User Interface Functions
         */


        /**
         * Get TA for a specific course (and section)
         *      Note: if $section is not provided, TAs of all section for a specific course are returned
         *
         * @param $course
         * @param null $section
         * @return array [Error Code : int, Result : array($key => $value)]
         *      Error Code:
         *          0 - Succeeded
         *          1 - Empty Result
         *          101 - Connection Error
         *          102 - Failed to obtain TA information for a course
         */
        public function getCourseTA($course, $section = NULL){

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

        /**
         * Get the application of student who applied for TA of a specific class
         *      Note: if $includeCurrentTAs is true, a TA selected for other classes will also be shown
         *
         * @param $course
         * @param null $section
         * @return array [Error Code : int, Result : array($key => $value)]
         *      Error Code:
         *          0 - Succeeded
         *          1 - Empty Result
         *          101 - Connection Error
         *          102 - Failed to obtain application of a specific course
         */
        public function getTACandidates($course, $year, $term, $includeCurrentTAs){

            $data = array();
            $arguments = null;

            $db_connection = $this->connect();

            if($db_connection == NULL) return [101, $data];

            if($includeCurrentTAs){
                $arguments = array(
                    "select" => "*",
                    "where" => "courseCode = '{$course}' AND
                                academicYear = '{$year}' AND
                                term = '$term'"

                );
               
            }else{
                $table = self::TA;
                $innerQuery = "SELECT studentId
                               FROM {$table}
                               WHERE academicYear = '{$year}'
                                 AND term = '{$term}'";

                $arguments = array(
                    "select" => "*",
                    "where" => "courseCode = '{$course}' AND
                                academicYear = '{$year}' AND
                                term = '$term' AND
                                studentId NOT IN ({$innerQuery});"
                );
            }

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

        public function getConfig(){

            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return [101, $data];

            $arguments = array(
                "select" => "numOfStudent",
                "where" => "true"
            );

            $tables = self::CONFIG;
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
                    $row = $result->fetch_assoc();
                    $data = $row['numOfStudent'];
                }
            }
            return [0, $data];
        }

        public function setConfig($numOfStudent){

            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return 101;

            $table = self::CONFIG;
            $set = "numOfStudent = '{$numOfStudent}'";
            
            $query = "UPDATE {$table} SET {$set};";
           
            /* Executing query */
            $result = $db_connection->query($query);

            // Disconnect from Database;
            $db_connection->close();

            return ($result == true) ? 0 : 1;

        }

        public function getCourseCode(){

            $data = [];

            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return [101, $data];

            $arguments = array(
                "select" => "abbreviation",
                "where" => "true"
            );

            $tables = self::DEPARTMENT;
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
                    while($row = $result->fetch_assoc()){
                        $data[] = $row['abbreviation'];
                    }
                }
            }
            return [0, $data];
        }

        /**
         * Error Code:
         *        0 - Found
         *        1 - Empty
         *      101 - Connection Failed
         *      102 - getConfig Failed
         *      103 - query failed
         */
        public function getAvailableSection($courseCode){

            $data = array();

            /* Connect to database */
            $db_connection = $this->connect();

            if ($db_connection == NULL) return [101, $data];

            // Get the number of student avaiable for each section
            $result = $this->getConfig();
            $errorCode = $result[0];
            $numOfStudent = $result[1];
            $nextSemesterYear = DatabaseManager::$nextSemesterYear;
            $nextSemesterTerm = DatabaseManager::$nextSemesterTerm;

            // Check if the getConfig is successful
            if($errorCode != 0){
                return [102, $data];
            }

            $where = [
                "c.courseCode = '{$courseCode}'",
                "{$numOfStudent} > (SELECT count(*) 
                                        FROM TA_Experience t 
                                        WHERE c.courseCode = t.courseCode AND
                                                 c.section = t.section AND
                                                 t.academicYear = '{$nextSemesterYear}' AND
                                                 t.term = '{$nextSemesterTerm}')",
            ];

            $arguments = array(
                "select" => "c.section, c.professorId",
                "where" => join(' and ', $where)
            );

            $tables = "Course c";
            $query = $this->generateQuery(self::SELECT, $tables, $arguments);

            //return $query;

            /* Executing query */
            $result = $db_connection->query($query);
            if (!$result) {
                return [103, $result];
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
            return [0, $data];
        }

        public function removeAllApplication($studentId){

            $data = array();

            $db_connection = $this->connect();

            if ($db_connection == NULL) return 101;

            $arguments = array(
                "where" => "studentId = '{$studentId}'"
            );

            $tables = self::APPLICATION;
            $query = $this->generateQuery(self::DELETE, $tables, $arguments);

            /* Executing query */
            $result = $db_connection->query($query);

            return $result;
        }

        function uploadTranscript($id, $type, $data) {
            $db_connection = $this->connect();
            $stmt = $db_connection->prepare("INSERT INTO Transcript (studentId, mime, data) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $id, $type, $data);
            $stmt->execute();
            if (!$stmt) {
                echo mysqli_error($db_connection);
                return false;
            } else {
                header("Location: transcript.php");
            } 
        }
    }

