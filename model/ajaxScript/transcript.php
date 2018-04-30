<?php
    require_once("./../DatabaseManager.php");
    if(isset($_SESSION['database'])){
        $database = $_SESSION['database'];
    }else{
        $database = new DatabaseManager();
    }

    $studentId = $_GET['studentId'];

    $db_connection = $database->connect();
    $query = "SELECT * FROM Transcript WHERE studentid = '{$studentId}'";
    $result = $db_connection->query($query);
    $row = $result->fetch_assoc();

    header("Content-Type: ".$row['mime']);
    header("Content-Disposition: inline; filename=x.pdf");
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    header('Cache-Control: public, must-revalidate, max-age=0');
    ob_clean();
    flush();
    echo $row['data'];
?>

