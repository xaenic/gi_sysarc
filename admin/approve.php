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
$query = "UPDATE bookings SET status = 'Approved' WHERE id = '$studentId'";
$result = $connection->query($query);
if (!$result) {
    $errorMessage = "Error: " . $connection->error;
}
if (!$result) {
    $errorMessage = "Error: " . $connection->error;
} 

echo '<span class="text-xl font-bold text-green-500">Booking has been approved.</span>';

?>


<a href="./bookings.php">Back to home</a>