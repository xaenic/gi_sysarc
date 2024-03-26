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
$query = "UPDATE sessions SET time_out = '$newTimeOut' WHERE student_id = '$studentId' AND session_id = '$s_id'";
$result = $connection->query($query);
if (!$result) {
    $errorMessage = "Error: " . $connection->error;
}
$student = null;
$query = "SELECT * FROM student WHERE id = '$studentId' LIMIT 1";
$result = mysqli_query($connection, $query);
if($result && mysqli_num_rows($result) > 0)
{
    $student = mysqli_fetch_assoc($result);
}
$newSession = $student['sessions'] - 1;
$query = "UPDATE student SET sessions = '$newSession' WHERE id = '$studentId'";
$result = $connection->query($query);

if (!$result) {
    $errorMessage = "Error: " . $connection->error;
} 

header("Location: ./records.php");
?>