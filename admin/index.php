<?php 
$page = "Search";
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
$message = "";
$exist = null;
$sessions = [];
if($student) {
   
    $ok  = $student['id'];
    $query = "SELECT * FROM sessions WHERE student_id = '$ok'  AND time_out IS NULL";
    $s_result = $connection->query($query);
    if($s_result->num_rows > 0)
    {
    $exist = $s_result->fetch_assoc();

    }

    $query = "SELECT * FROM sessions  WHERE student_id = '$ok' ORDER BY time_out";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $sessions[] = $row;
        }
    }
}

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $laboratory = $_POST['laboratory'];
    $purpose = $_POST['purpose'];
   
    
    if($exist == null) {
        $check = "SELECT * FROM student WHERE id = '$id' AND sessions > 0";
            $r_check = $connection->query($check);
            if($r_check->num_rows > 0){
                $query = "INSERT INTO sessions (student_id,laboratory,purpose) VALUES('$id','$laboratory','$purpose')";
                $result = $connection->query($query);
                if (!$result) {
                        $errorMessage = "Error: " . $connection->error;
                        return;
                }
                    header("Location: ./?search=" . $student['idno']);
            }else {
                $message = "No available sessions.";
            }   
    }
   
    
   
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
     <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-purple-100">
    <?php require './sidebar.php';?>
    <main class="flex-1 lg:ml-64  lg:mt-4 mr-4">
       <div class="flex flex-col items-center  rounded-md">
            <form action="" method="get" class="flex justify-end w-full bg-gradient-to-l to-[#8F93FF] from-purple-400  p-5 rounded-md">
                <div class="flex justify-end w-full">
                    <input name="search" class="shadow-lg border px-3 p-1 rounded-md" tpye="text" value="" placeholder="Search student..."/>
                <input  class="shadow-lg px-3 p-1 rounded-md text-white cursor-pointer hover:bg-purple-600 bg-purple-500" type="submit" value="Search"/>
                </div>
            </form>

            <?php if(isset($_GET['search']) && $_GET['search'] != "") { ?>
            
            <?php if($student != null ) { ?>
              
            <form action="" method="post" class="flex flex-col items-center   mt-10 bg-gradient-to-t text-white to-[#8F93FF] from-purple-400  p-5 rounded-md min-w-[320px] relative">
                
                <div class="flex items-center justify-center w-24 h-24 bg-white rounded-full shadow-lg absolute top-[-30px]">
                    <p class="text-2xl font-boldd uppercase text-gray-700"><?php echo isset($student['firstname']) ? $student['firstname'][0] : "";  ?></p>
                </div>
                <div class="mt-14">
                    <p class="text-2xl text-center font-semibold"><?php echo $student['firstname']; echo $student['lastname'] ?></p>
                    <p class="text-center text-gray-600"><?php echo $student['idno']; ?></p>
                    <span class="text-xs font-semibold px-2 p-1 bg-purple-500 text-white rounded-md"><?php echo $student['sessions'];?> Sessions Available</span>
                </div>
                  <span class="self-start mt-5 text-xs font-semibold   bg-red-500 text-white rounded-md"><?php echo $message;?></span>
               
                <div class="self-start flex flex-col gap-2 w-full mt-5">
                    <label class="">Purpose of SitIn</label>
                    <select name="purpose" class="text-gray-700 border p-2 rounded-md w-full">
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
                    <select name="laboratory" class="text-gray-700 border p-2 rounded-md">
                        <option value="Lab 524">Lab 524</option>
                        <option value="Lab 526">Lab 526</option>
                        <option value="Lab 528">Lab 528</option>
                        <option value="Lab 542">Lab 542</option>
                        <option value="Lab 543">Lab 543</option>
                    </select>
                </div>
                    
                <div class="flex justify-between mt-5 gap-5">

                  <input type="hidden" value="<?php echo $student['id'];?>" name="id"/>
                   <?php if($exist == null) {?>
                        <input type="submit" value="Sit In" class="font-semibold cursor-pointer px-3 p-2 bg-purple-600  rounded-lg "/>
                    <?php } else {?>
                        <a href="./timeout.php?id=<?php echo $student['id'];?>&s_id=<?php echo $exist['session_id'];?>" class="text-white bg-red-500 px-3 p-2 rounded-md">Logout</a>
                    <?php }?>
                    <a href="./delete.php?id=<?php echo $student['id'];?>" class="font-semibold cursor-pointer px-3 p-2  rounded-md bg-red-500">Delete</a>
                </div>
            </form>
             <h1 class="text-xl font-semibold text-purple-600 mt-5"><?php echo $student['firstname'];?>'s Sit In Records</h1>               
            <table class="my-5 mb-10 mx-5 w-full text-sm text-left rtl:text-right text-white rounded-lg overflow-hidden">
                <thead class="text-xs bg-gradient-to-l t to-[#8F93FF] from-purple-400 uppercase rounded-md">
                    <tr>
                       
                        <th class="border px-4 py-4 font-medium border-none  text-center">SESSION ID</th>
             
                        <th class="border px-4 py-4 font-medium border-none  text-center">PURPOSE</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">LABORATORY</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">TIME IN</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">TIME OUT</th>
                    </tr>
                </thead>
                <tbody id="tbody" class="relative">
                    

                <?php 

            foreach ($sessions as $session) {
                   echo '<tr class="odd:bg-purple-500 bg-purple-700">
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$session['session_id'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$session['purpose'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$session['laboratory'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$session['time_in'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">' . ($session['time_out'] !== null ? $session['time_out'] : '<span class="text-green-3   00 font-semibold      ">OnGoing</span>') . '</td>
                                </tr>';
                }
            ?>

                </tbody>

            </table>
                <?php } else {?>
                    <p class="text-xl font-semibold">NO STUDENT FOUND</p>    
                <?php }?>
        <?php } ?>
        </div> 
    </main>
</body>

</html>