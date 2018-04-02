<?php
    /**
     * Created by PhpStorm.
     * User: Isaac
     * Date: 3/31/2018
     * Time: 6:46 PM
     */

    require_once('..\model\DatabaseManager.php');

    /**
     * Testing Insertion Function in DatabaseManager.php
     */

    $database = new DatabaseManager();

    $database->getStudentApplication("00000001");