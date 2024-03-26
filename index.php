<?php 

session_start();
if(!isset($_SESSION['firstname']))
  header("location: ./login.php");
if(isset($_SESSION['role']))
  header("location: ./admin");
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
  <a href="#">Home</a>
  <a href="#">Manage</a>
  <a href="#">History</a>
  <a href="./logout.php">Log Out</a>
</div>

<div id="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span> 

<h1 style="text-align:center; font-size:30px; font-weight:strong">Welcome <?php echo $_SESSION['firstname'];?>!</h1>
<span class="text-xs font-semibold px-2 p-1 bg-purple-500 text-white rounded-md"><?php echo $_SESSION['session'];?> Sessions Available</span> 
<br>
<center>
    <div style="padding:50px; background-color:#E0DFE2; width:500px; height: 250; border-radius: 25px; text-align:left" class="relative">
    
   <h7 style= "text-align:center"> Find a Schedule </h7> <br>
    <br>
               
                Date
    <input    
                style="padding: 5px; border-radius: 8px"
                class="form-control"
                name="dep_date" 
                type="date"  
                onFocus="this.value = '';" 
                onBlur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">
               
                Time
     <input 
                style="padding: 5px; border-radius: 8px"
                class="form-control"
                type="time" 
                id="appt" 
                onFocus="this.value = '';" 
                name="appt">

      
                <form action="/action_page.php">
                  <br>
  <label for="fname" style="padding-right: 30px;">Name</label>
  <input type="text" id="fname" name="fname" style="padding: 5px; border-radius: 8px"> <br> 
  <label for="lname" style="padding-right: 22px;">Course</label>
  <input type="text" id="fname" name="fname" style="padding: 5px; border-radius: 8px"> <br> 
  <label for="lname" style="padding-right: 19px;">Subject</label>
  <input type="text" id="fname" name="fname" style="padding: 5px; border-radius: 8px"> <br>
  <input type="submit" value="Submit">
</form>
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
