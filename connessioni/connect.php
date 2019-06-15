<?php
//Connette al database

$dbHost="localhost";
$dbUser="root";
$dbPass="password";
$dbVn="mporio_db";
$dbport = 3306;

$connect=mysqli_connect($dbHost, $dbUser, $dbPass,$dbVn) or die ('Could not connect to a MySQL server using the default settings');



?>