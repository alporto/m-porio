<?php
//Connette al database

$dbHost="127.0.0.1";
$dbUser="avmcode";
$dbPass="password";
$connect=mysql_connect($dbHost, $dbUser, $dbPass) or die ('Could not connect to a MySQL server using the default settings');


$dbVn="mporio_db";

$temp=mysql_select_db($dbVn, $connect) or die ('Cannot select database');


?>