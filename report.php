<?php 

session_start();
if(!isset($_SESSION['firstname']))
  header("location: ./login.php");
if(isset($_SESSION['role']))
  header("location: ./admin");
include('connector.php'); 
$message = "";
$id = $_SESSION['id'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $feedback = $_POST['feedback'];

    if($feedback == ""){

      $message = '<span class="text-rose-500 text-lg font-medium">Message is required</span>';
    }else {
       $query = "INSERT INTO feedback (student_id,content) VALUES('$id','$feedback')";
       $result = $connection->query($query);
       if (!$result) {
          $errorMessage = "Error: " . $connection->error;
          return;
        }

        $message= '<span class="text-green-500 text-lg font-medium">Report submitted!</span>';
    }
}
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

<div class="w-full flex items-center flex-col gap-7">
  <h1 style="text-align:center; font-size:30px; font-weight:strong ">Report A Problem</h1>
  <?php echo $message?>
  <div class="border border-gray-200 rounded-md p-10">
     <form  action="" method="post"class="flex flex-col gap-3">
            <Label>Write a message</Label>
            <div class="bg-slate-200 text-black rounded-md px-3 p-2 text-sm">
                <textarea id="feedback" name="feedback" rows="4" cols="50" class="bg-transparent outline-none"></textarea>
            </div>
             
            <button class="bg-green-500 text-white rounded-md px-3 p-2">Submit Report</button>
        </div>
     </form>
  </div>
</div>
<br>
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
