<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "labuser";

$connection = new mysqli($servername, $username, $password, $database);
if ($connection === false) {
    die("connection error");
}


?>