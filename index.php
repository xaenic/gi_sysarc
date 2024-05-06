<?php 

session_start();
if(!isset($_SESSION['firstname']))
  header("location: ./login.php");
if(isset($_SESSION['role']))
  header("location: ./admin");
include('connector.php'); 

$id = $_SESSION['id'];
$select = "SELECT * FROM student WHERE id = '$id'";
$result = $connection->query($select);
$user = $result->fetch_assoc();
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

<div class="w-full flex items-center flex-col">
  <h1 style="text-align:center; font-size:30px; font-weight:strong">Welcome <?php echo $_SESSION['firstname'];?>!</h1>
<span class="text-xs font-semibold px-2 p-1 bg-purple-500 text-white rounded-md text-center self-center"><?php echo $sessions?> Sessions Available</span> 

<div class=" mt-8 bg-white rounded-lg shadow-lg p-8 mx-28 w-full">
        <h2 class="text-2xl font-semibold mb-4 text-center">LABORATORY RULES AND REGULATIONS</h2>
        <ol class="list-decimal pl-6">
            <li class="mb-2">Maintain silence, proper decorum, and discipline inside the laboratory. Mobile phones, walkmans and other personal pieces of equipment must be switched off.</li>
            <li class="mb-2">Games are not allowed inside the lab. This includes computer-related games, card games and other games that may disturb the operation of the lab.</li>
            <li class="mb-2">Surfing the Internet is allowed only with the permission of the instructor. Downloading and installing of software are strictly prohibited.</li>
            <li class="mb-2">Getting access to other websites not related to the course (especially pornographic and illicit sites) is strictly prohibited.</li>
            <li class="mb-2">Deleting computer files and changing the set-up of the computer is a major offense.</li>
            <li class="mb-2">Observe computer time usage carefully. A fifteen-minute allowance is given for each use. Otherwise, the unit will be given to those who wish to “sit-in”.</li>
            <li class="mb-2">Observe proper decorum while inside the laboratory:
                <ol class="list-disc pl-6">
                    <li>Do not get inside the lab unless the instructor is present.</li>
                    <li>All bags, knapsacks, and the likes must be deposited at the counter.</li>
                    <li>Follow the seating arrangement of your instructor.</li>
                    <li>At the end of class, all software programs must be closed.</li>
                    <li>Return all chairs to their proper places after using.</li>
                </ol>
            </li>
            <li class="mb-2">Chewing gum, eating, drinking, smoking, and other forms of vandalism are prohibited inside the lab.</li>
            <li class="mb-2">Anyone causing a continual disturbance will be asked to leave the lab. Acts or gestures offensive to the members of the community, including public display of physical intimacy, are not tolerated.</li>
            <li class="mb-2">Persons exhibiting hostile or threatening behavior such as yelling, swearing, or Disregarding requests made by lab personnel will be asked to leave the lab.</li>
            <div class="bg-slate-200 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4">DISCIPLINARY ACTION</h2>
            <p class="mb-2"><strong>First Offense:</strong> The Head or the Dean or OIC recommends to the Guidance Center for a suspension from classes for each offender.</p>
            <p class="mb-2"><strong>Second and Subsequent Offenses:</strong> A recommendation for a heavier sanction will be endorsed to the Guidance Center.</p>
        </div>
        </ol>
    </div>
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
