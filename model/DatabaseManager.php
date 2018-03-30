<?php
    /**
     * Created by PhpStorm.
     * User: Isaac
     * Date: 3/29/2018
     * Time: 9:12 PM
     */

    class DatabaseManager
    {
        private $host;
        private $user;
        private $database;
        private $tables;

        public function __construct()
        {
            $this->host = 'localhost';
            $this->user = 'admin';
            $this->database = 'tasql';
            $this->tables = array(
                "department" => "Department",
                "student" => "Student",
                "ta" => "TA_Experience",
                "app" => "Applications",
                "faculty" => "Faculty",
                "course" => "Course"
            );
        }

        /***
         * Student User Interface Functions
         */

        



    }