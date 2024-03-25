<?php



session_start();
if(!isset($_SESSION['role']))
header("Location: ./login.php");
require './db.php';


if(isset($_GET['id'])){


    $id  = $_GET['id'];
    


    $query = "DELETE FROM sessions WHERE student_id = '$id'";
    $result = $connection->query($query);

    // Check if the deletion was successful
    if (!$result) {
        $errorMessage = "Error: " . $conn->error;
        // Handle the error here, e.g., display an error message
        return;
    }
    $query = "DELETE FROM student WHERE id = '$id'";
    $result = $connection->query($query);
    // Check if the deletion was successful
    if (!$result) {
        $errorMessage = "Error: " . $conn->error;
        // Handle the error here, e.g., display an error message
        return;
    }

    header("Location: ./records.php");
}

?>