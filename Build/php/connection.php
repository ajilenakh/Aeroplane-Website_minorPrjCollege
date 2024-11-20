<?php

$dbhost = "aeroplane_website";
$dbuser = "root";
$dbpass = "password";
$dbname = "aeroplane_website";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
    die("failed to connect");
}

?>