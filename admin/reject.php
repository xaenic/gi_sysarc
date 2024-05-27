<?php 
date_default_timezone_set('Asia/Manila');
session_start();
if(!isset($_SESSION['role'])) {
    header("Location: ./login.php");
}
if(!isset($_GET['id']))
    header("Location: ./records.php");
require './db.php';

$studentId = $_GET['id']; 
$query = "UPDATE bookings SET status = 'Rejected' WHERE id = '$studentId'";
$result = $connection->query($query);
if (!$result) {
    $errorMessage = "Error: " . $connection->error;
}
if (!$result) {
    $errorMessage = "Error: " . $connection->error;
} 

echo '<span class="text-xl font-bold text-red-500">Booking has been rejected.</span>';

?>


<a href="./bookings.php">Back to home</a>