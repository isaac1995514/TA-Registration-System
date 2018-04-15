<?php

    require_once("studentSupport.php");

    $content = <<<CONTENT

    <h1>This is Personal Info Page<h2>


CONTENT;

$content = generatePage($content, "Personal Info Pagee");
echo $content;

?>

