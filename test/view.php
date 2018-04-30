<?php
$link = mysqli_connect('localhost', 'id4674819_dbuser', 'password', 'id4674819_tasql') or die('Error'.mysql_error($link));

if(isset($_POST['upload'])){

    $file_path = $_FILES['transcript']['tmp_name'];
    $file_type = $_FILES['transcript']['type'];
    $file_size = $_FILES['transcript']['size'];
    $file_name = $_FILES['transcript']['name'];

    // Check if the selected file is PDF
    if($file_type == 'application/pdf'){

        // extracts data of file in $data variable
        $data = mysqli_real_escape_string($link, file_get_contents($file_path));

        $query = "INSERT INTO Transcript (pdfName, mime, pdfData) VALUES('{$file_name}','{$file_type}','{$data}')";

        $result = mysqli_query($link, $query);

        if($result){
            echo "Success! Your file was successfully added!";
        }else{
            echo "Error";
        }
    }else{
        echo "Not a pdf file";
    }
}else if(isset($_POST['read'])){

    $sql = "SELECT * FROM Transcript WHERE id = '1'";

    $result = mysqli_query($link, $sql);

    $row = mysqli_fetch_object($result);

    $pdf_content = $row->pdfData;
    $fileName = time().".pdf";
    header("Content-type: application/pdf");
    header("Content-disposition: inline; filename = {$fileName}");
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: '.filesize($row->pdfName));
    header('Accept-Ranges: bytes');
    header('Expires: 0');
    header('Cache-Control: public, must-revalidate, max-age=0');
    ob_clean();
    flush();
    readfile($pdf_content);



}
