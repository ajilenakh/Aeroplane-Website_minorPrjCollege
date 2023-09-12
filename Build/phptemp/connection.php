<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "aeroplane_website";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
    die("failed to connect");
}
?>