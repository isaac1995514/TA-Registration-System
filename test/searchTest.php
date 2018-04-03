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

    echo "getStudentApplication()", "<br><br>";

    $database = new DatabaseManager();

    [$code, $result] = $database->getStudentApplication("00000001");

    foreach($result as $application){
        print_r($application);
        echo "<br><br>";
    }

    echo "getCourseTA()", "<br><br>";

    [$code, $result] = $database->getCourseTA("CMSC131");

    foreach($result as $application){
        print_r($application);
        echo "<br><br>";
    }

    echo "getTACandidates()","<br><br>";

    [$code, $result] = $database->getTACandidates("CMSC132", "2018", "Spring", true);

    foreach($result as $application){
        print_r($application);
        echo "<br><br>";
    }

    echo "getTACandidates()","<br><br>";

    [$code, $result] = $database->getTACandidates("CMSC132", "2018", "Spring", false);

    foreach($result as $application){
        print_r($application);
        echo "<br><br>";
    }







