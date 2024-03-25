<?php 
session_start();
if(!isset($_SESSION['role']))
header("Location: ./login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-purple-500">
    <div class="container mx-auto ">
        <nav class="bg-white px-3 p-4 mt-10 border rounded-md justify-between flex">
            <div>
                <a class="font-semibold" href="">SITIN</a>
            </div>
            <ul class="flex gap-3 items-center">
                <li>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <a href="./search.php">Search</a>
                </li>
                  <li>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <a href="record.php">View Records</a>
                </li>
                  <li>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <a href="generate.php">Generate Report</a>
                </li>
                   <li>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <a href=".././logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </div>
</body>
</html>