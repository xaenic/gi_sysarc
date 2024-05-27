<?php 
date_default_timezone_set('Asia/Manila');
session_start();
if(!isset($_SESSION['role'])) {
    header("Location: ./login.php");
}
if(!isset($_GET['id']))
    header("Location: ./records.php");
require './db.php';
$newTimeOut = date("Y-m-d H:i:s");
$studentId = $_GET['id']; 
$s_id = $_GET['s_id']; 
$query = "UPDATE sessions SET time_in = '$newTimeOut' WHERE student_id = '$studentId' AND session_id = '$s_id'";
$result = $connection->query($query);
if (!$result) {
    $errorMessage = "Error: " . $connection->error;
}

if (!$result) {
    $errorMessage = "Error: " . $connection->error;
} 

header("Location: ./records.php");
?>