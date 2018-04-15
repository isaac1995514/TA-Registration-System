<?php

    require_once("studentSupport.php");

    $content = <<<CONTENT

    <h1>This is New Application Page<h2>


CONTENT;

$content = generatePage($content, "New Application");
echo $content;

?>

