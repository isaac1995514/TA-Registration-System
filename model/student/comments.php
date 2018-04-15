<?php

    require_once("studentSupport.php");

    $content = <<<CONTENT

    <h1>This is Comments Page<h2>


CONTENT;

$content = generatePage($content, "Comments");
echo $content;

?>

