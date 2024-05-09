<?php 

session_start();
if(!isset($_SESSION['firstname']))
  header("location: ./login.php");
if(isset($_SESSION['role']))
  header("location: ./admin");
include('connector.php'); 
$history = [];
$id = $_SESSION['id'];
$select = "SELECT * FROM student WHERE id = '$id'";
$result = $connection->query($select);
$user = $result->fetch_assoc();
$query = "SELECT * FROM sessions INNER JOIN student ON student.id = sessions.student_id WHERE time_out IS NOT NULL AND student.id = '$id' ORDER BY time_out asc";
$result = $connection->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $history[] = $row;
    }
}
$sessions = $user['sessions'];
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdn.tailwindcss.com"></script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

body {
    
    font-family: "Poppins" , sans-serif;
    transition: background-color .5s;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #7D2AE8;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #f0f0f0;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #000000;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="./">Home</a>
  <a href="./profile.php">Profile</a>
  <a href="./report.php">Report</a>
  <a href="./history.php">History</a>
  <a href="./logout.php">Log Out</a>
</div>

<div id="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span> 

<div class="w-full flex items-center flex-col container mx-auto">
  <h1 style="text-align:center; font-size:30px; font-weight:strong">Your Session History</h1> 
     <table id="oktable" class=" mb-10 w-full text-sm text-left rtl:text-right text-white rounded-lg overflow-hidden">
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

            foreach ($history as $student) {
                   echo '<tr class="odd:bg-purple-500 bg-purple-700">
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['session_id'].'</td>
                              
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['purpose'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['laboratory'].'</td>
                              
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.date('F j, Y H:i:s', strtotime($student['time_in'])).'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.date('F j, Y H:i:s', strtotime($student['time_out'])).'</td></tr>
                                ';
                }
            ?>

                </tbody>

            </table>
</div>  
<br>
<center>

</center>
</div>
	</div>

 
</div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>
   
</body>
</html> 
