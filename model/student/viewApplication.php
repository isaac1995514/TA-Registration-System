<?php

    require_once("studentSupport.php");

    $content = <<<CONTENT

    <h1>This is View Application Page<h2>


CONTENT;

$content = generatePage($content, "View Application Page");
echo $content;

?>

