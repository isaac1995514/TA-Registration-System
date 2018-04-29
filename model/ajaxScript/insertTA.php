<?php

    // ErrorCode:
    //      0 - Student added to the TA system
    //      1 - System Failed
    //      2 - TA is already A TA
    //      3 - Targeted Section or All section is full


    require_once("./../DatabaseManager.php");
    session_start();

    if(isset($_SESSION['database'])){
        $database = $_SESSION['database'];
    }else{
        $database = new DatabaseManager();
    }

    $appId = trim($_GET['appId']);
    $studentId = trim($_GET['studentId']);
    $courseCode = trim($_GET['courseCode']);
    $section = trim($_GET['section']);
    $academicYear = trim($_GET['academicYear']);
    $term = trim($_GET['term']);
    $taType = trim($_GET['taType']);
    $canTeach = trim($_GET['canTeach']);

    // Check if the student is already a TA for the next term
    $result = $database->isTA($studentId, $academicYear, $term);
    $isTA = $result[1];

    // If the student is a TA already
    if($isTA){
        echo "2|This Student has already been assigned as a TA for {$academicYear} {$term}. Please assign a different student";
    
    // If the student is not yet a TA
    }else{
        // Check if a specific section is provided
        if($section == "null"){
          
            //Get all classes that is not full
            $result = $database->getAvailableSection($courseCode);
            $errorCode = $result[0];

            // Check if there is available section
            if($errorCode == 0){
                $courseList = $result[1];
                $result = shuffle($courseList);

                // Check if the shuffle has been completed successfully
                if($result){
                    $course = $courseList[0];
                    $section = $course['section'];
                    $professorId = $course['professorId'];
    
                    // Add student as TA to the database
                    $result = $database->addTA($studentId, $courseCode, $section, $academicYear, $term, $professorId, $taType, $canTeach);
    
                    if($result){

                        $result = $database->removeAllApplication($studentId);

                        if($result){
                            echo "0|Student {$studentId} added to {$courseCode} - {$section}";
                        }else{
                            echo "1|System Failed. Please report to Admin! (1)"; 
                        }
                    }else{
                        echo "1|System Failed. Please report to Admin! (1-1)";
                    }
                }else{
                    echo "1|System Failed. Please report to Admin! (2-2)";
                }

            }else if($errorCode == 1){
                echo "3|All section for {$courseCode} is full. Please consider assigning this student to a different class!";
            }else{
                echo "1|System Failed. Please report to Admin! (2)";
            }
        }else{
            // Check if the student can be added as A TA to that specific section
            if($errorCode == 0 || $errorCode == 202){
            
                $professorId = $result[1];

                // Add student as TA to the database
                $result = $database->addTA($studentId, $courseCode, $section, $academicYear, $term, $professorId, $taType, $canTeach);

                if($result){

                    $result = $database->removeAllApplication($studentId);

                    if($result){
                        echo "0|Student {$studentId} added to {$courseCode} - {$section}";
                    }else{
                        echo "1|System Failed. Please report to Admin! (3)"; 
                    }
                }else{
                    echo "1|System Failed. Please report to Admin! (3-1)";
                }
            // The section is full
            }else if($errorCode = 103){
                echo "3|Section {$section} is full. Please assign this student to a different section!";
            }else{
                echo "1|System Failed. Please report to Admin! (4)";
            }
        }
    }
?>