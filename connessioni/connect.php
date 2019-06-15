<?php
//Connette al database

$dbHost=getenv('IP');
$dbUser=getenv('C9_USER');
$dbPass="password";
$dbport = 3306;
$connect=mysql_connect($dbHost, $dbUser, $dbPass) or die ('Could not connect to a MySQL server using the default settings');


$dbVn="mporio_db";

$temp=mysql_select_db($dbVn, $connect) or die ('Cannot select database');


?>