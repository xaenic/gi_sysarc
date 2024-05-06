<?php 

session_start();
if(!isset($_SESSION['firstname']))
  header("location: ./login.php");
if(isset($_SESSION['role']))
  header("location: ./admin");
include('connector.php'); 
$message = "";
$id = $_SESSION['id'];
$select = "SELECT * FROM student WHERE id = '$id'";
$result = $connection->query($select);
$user = $result->fetch_assoc();
$sessions = $user['sessions'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $middlename = $_POST['middlename'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];




    if($user['password'] == $password){
       $query = "UPDATE student 
          SET firstname = '$firstname', 
              lastname = '$lastname', 
              middlename = '$middlename',
              age = '$age',
              gender = '$gender',
              address = '$address',
              phone = '$phone' 
          WHERE id = '$id'";


        
        $result = $connection->query($query);
            $user['firstname'] = $firstname;
            $user['lastname'] = $lastname;
            $user['middlename'] = $middlename;
            $user['age'] = $age;
            $user['gender'] = $gender;
            $user['address'] = $address;
            $user['phone'] = $phone;
        $message = '<span class="text-green-500 text-center">Updated Successfully!</span>';
    }else {
        $message =  '<span class="text-red-500 text-center">Incorrect Password</span>';
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
  <h1 style="text-align:center; font-size:30px; font-weight:strong ">Profile Settings</h1>
  <?php echo $message?>
  <div class="border border-gray-200 rounded-md p-10">
     <form  action="" method="post"class="flex flex-col gap-3">
        <div class="justify-between flex items-center gap-3">
            <label>IDNO</label>
            <div class="bg-white border border-gray-200 px-3 p-2 rounded-md">
                <input disabled class="outline-none text-slate-600" type="text" value="<?php echo $user['idno'] ?>"/>
            </div>
        </div>
        <div class="justify-between flex items-center gap-3">
            <label>First Name</label>
            <div class="bg-white border border-gray-200 px-3 p-2 rounded-md">
                <input name="firstname" class="outline-none" type="text" value="<?php echo $user['firstname'] ?>"/>
            </div>
        </div>
        
        <div class="justify-between flex items-center gap-3">
            <label>Last Name</label>
            <div class="bg-white border border-gray-200 px-3 p-2 rounded-md">
                <input name="lastname" class="outline-none" type="text" value="<?php echo $user['lastname'] ?>"/>
            </div>
        </div>
        <div class="justify-between flex items-center gap-3">
            <label>Middle Name</label>
            <div class="bg-white border border-gray-200 px-3 p-2 rounded-md">
                <input name="middlename" class="outline-none" type="text" value="<?php echo $user['middlename'] ?>"/>
            </div>
        </div>
        <div class="justify-between flex items-center gap-3">
            <label>Age</label>
            <div class="bg-white border border-gray-200 px-3 p-2 rounded-md">
                <input name="age" class="outline-none" type="number" value="<?php echo $user['age'] ?>"/>
            </div>
        </div>
        <div class="justify-between flex items-center gap-3">
            <label>Gender</label>
            <div class="bg-white border border-gray-200 px-3 p-2 rounded-md">
                <input name="gender" class="outline-none" type="text" value="<?php echo $user['gender'] ?>"/>
            </div>
        </div>
        <div class="justify-between flex items-center gap-3">
            <label>Address</label>
            <div class="bg-white border border-gray-200 px-3 p-2 rounded-md">
                <input name="address" class="outline-none" type="text" value="<?php echo $user['address'] ?>"/>
            </div>
        </div>
        <div class="justify-between flex items-center gap-3">
            <label>Phone</label>
            <div class="bg-white border border-gray-200 px-3 p-2 rounded-md">
                <input name="phone" class="outline-none" type="number" value="<?php echo $user['phone'] ?>"/>
            </div>
        </div>
        <div class="justify-between flex items-center gap-3">
            <label>Password</label>
            <div class="bg-white border border-gray-200 px-3 p-2 rounded-md">
                <input name="password" class="outline-none" type="password" />
            </div>
        </div>
        
        <div class="flex justify-end">
            <button class="bg-blue-500 text-white rounded-md px-3 p-2">Save Changes</button>
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
