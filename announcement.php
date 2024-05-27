<?php 

session_start();
if(!isset($_SESSION['firstname']))
  header("location: ./login.php");
if(isset($_SESSION['role']))
  header("location: ./admin");
include('connector.php'); 
$announcements = [];
$id = $_SESSION['id'];
$select = "SELECT * FROM announcement ORDER BY date_created desc";
$result = $connection->query($select);


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $announcements[] = $row;
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
<?php include('side.php');?>
<div id="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span> 

<div class="w-full flex items-center flex-col container mx-auto">
  <h1 style="text-align:center; font-size:30px; font-weight:strong">Announcements</h1> 
  <div class="grid grid-cols-3 w-full px-20 gap-4 mt-10">

    <?php foreach($announcements as $ann): ?>
      <div class="h-56 overflow-y-auto bg-white border shadow-lg p-3 rounded-lg">
        <div class="pb-2 border-b flex justify-between items-center">

        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full hover:border hover:p-1 bg-gray-700 text-white flex items-center justify-center">A</div>
          <div class="flex flex-col">
            <span class="font-medium text-sm">From</span>
            <span class="text-sm capitalize"><?php echo $ann['name'];?></span>
          </div>
        </div>
        <div class="flex flex-col">
          <span class="font-medium">Posted On</span>
          <span class="text-sm"><?php echo $formatted_date = date('F j, Y g:i A', strtotime($ann['date_created']));?></span>
        </div>
        </div>
        <div class="mt-3">
          <h1 class="font-bold mb-2"><?php echo $ann['title'];?></h1>
          <p class="text-sm"><?php echo $ann['content'];?></p>
        </div>
      </div>
    <?php endforeach;?>
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
