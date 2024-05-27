<?php 
date_default_timezone_set('Asia/Manila');
session_start();
include('connector.php'); 


$studentId = $_GET['id']; 
$query = "UPDATE bookings SET status = 'Cancelled' WHERE id = '$studentId'";
$result = $connection->query($query);
if (!$result) {
    $errorMessage = "Error: " . $connection->error;
}
if (!$result) {
    $errorMessage = "Error: " . $connection->error;
} 

echo '<span class="text-xl font-bold text-green-500">Booking has been cancelled.</span>';

?>


<a href="./reservation.php">Back to home</a>