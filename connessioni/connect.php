<?php
//Connette al database

$dbHost="IP ADDRESS";
$dbUser="User";
$dbPass="Password";
$connect=mysql_connect($dbHost, $dbUser, $dbPass) or die ('Could not connect to a MySQL server using the default settings');


$dbVn="DB Name";

$temp=mysql_select_db($dbVn, $connect) or die ('Cannot select database');


?>