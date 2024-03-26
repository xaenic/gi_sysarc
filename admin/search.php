<?php 

session_start();

if(!isset($_SESSION['role']))
    header("Location: ./login.php");
require './db.php';

$student = null;
if(isset($_GET['search'])){
    $searchId = $connection->real_escape_string($_GET['search']);
    $query = "SELECT * FROM student WHERE idno = '$searchId' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if($result && mysqli_num_rows($result) > 0)
    {
        $student = mysqli_fetch_assoc($result);
    }
}

if(isset($_POST['id'])){

    

    $id = $_POST['id'];
    $laboratory = $_POST['laboratory'];
    $purpose = $_POST['purpose'];

    $query = "SELECT * FROM sessions WHERE student_id = '$id'  AND time_out IS NULL";
    $result = mysqli_query($connection, $query);
    if($result && mysqli_num_rows($result) <= 0)
    {
    $query = "INSERT INTO sessions (student_id,laboratory,purpose) VALUES('$id','$laboratory','$purpose')";
    $result = $connection->query($query);
    if (!$result) {
            $errorMessage = "Error: " . $connection->error;
            return;
    }
        header('Location: ./records.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Search</title>
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
                    <a class="font-bold" href="./search.php">Search</a>
                </li>
                <li>
                    <a class="" href="record.php">View Records</a>
                </li>
                <li>
                    <a class="" href="generate.php">Generate Report</a>
                </li>
                <li>
                    <a class="" href=".././logout.php">Logout</a>
                </li>
            </ul>
        </nav>
        <div class="flex flex-col items-center p-5  rounded-md mt-5">
            <form action="" method="get" class="bg-white  p-5 rounded-md">
                <input name="search" class="shadow-lg border px-3 p-1 rounded-md" tpye="text" value="" placeholder="Search student..."/>
                <input  class="shadow-lg px-3 p-1 rounded-md text-white cursor-pointer hover:bg-purple-600 bg-purple-500" type="submit" value="Search"/>
            </form>

            <?php if(isset($_GET['search']) && $_GET['search'] != "") { ?>

            
            <form action="" method="post" class="flex flex-col items-center   mt-10 bg-white  p-5 rounded-md min-w-[320px] relative">
                
                <div class="flex items-center justify-center w-24 h-24 bg-white rounded-full shadow-lg absolute top-[-30px]">
                    <p class="text-2xl font-boldd uppercase"><?php echo $student['firstname'][0];echo $student['lastname'][0]; ?></p>
                </div>
                <div class="mt-14">
                    <p class="text-2xl text-center font-semibold"><?php echo $student['firstname']; echo $student['lastname'] ?></p>
                    <p class="text-center text-gray-600"><?php echo $student['idno']; ?></p>
                    <span class="text-xs font-semibold  p-1 bg-green-500 text-white rounded-md"><?php echo $student['sessions'];?> Sessions Available</span>
                </div>

                <div class="self-start flex flex-col gap-2 w-full mt-5">
                    <label class="">Purpose of SitIn</label>
                    <select name="purpose" class="border p-2 rounded-md w-full">
                        <option value="Java">Java</option>
                        <option value="Python">Python</option>
                        <option value="C">C</option>
                        <option value="C++">C++</option>
                        <option value="C#">C#</option>
                        <option value="Others">Others</option>
                    </select>
                    
                </div>
                <div class="flex flex-col gap-2 w-full mt-5">
                    <label class="">Laboratory</label>
                    <select name="laboratory" class="border p-2 rounded-md">
                        <option value="Lab 524">Lab 524</option>
                        <option value="Lab 526">Lab 526</option>
                        <option value="Lab 528">Lab 528</option>
                        <option value="Lab 542">Lab 542</option>
                        <option value="Lab 543">Lab 543</option>
                    </select>
                </div>
                
                <div class="flex justify-between mt-5 gap-5">

                  <input type="hidden" value="<?php echo $student['id'];?>" name="id"/>
                   <input type="submit" value="Sit In" class="font-semibold cursor-pointer px-3 p-2 border  rounded-lg "/>
                    <a href="" class="font-semibold cursor-pointer px-3 p-2  rounded-md border">Delete</a>
                </div>
            </form>

        <?php } ?>
        </div>
    </div>
</body>
</html>