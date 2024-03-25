<?php

session_start();


if(isset($_SESSION['role'])){
    header("Location: ./index.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email =  $_POST['email'];
    $password =  $_POST['password'];
    if($password != "" && $email != ""){
        if($email == 'admin@gmail.com' && $password == 'admin123'){
            $_SESSION['role'] = 'admin';
            header('Location: ./index.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
   <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body class="bg-purple-700 text-black">
  <div class="container mx-auto flex mt-32 justify-center ">  
    <div class="forms bg-white p-10 rounded-md  ">
        <div class="form-content">
          <div class="login-form">
            <div class="title text-xl font-bold text-center">Admin Dashboard</div>
          <form action="" method="post" class="mt-4">
            <div class="flex flex-col gap-3">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" name="email" class="w-full border px-3 p-2 rounded-md" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="w-full border px-3 p-2 rounded-md" placeholder="Enter your password" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Login" class="w-full bg-purple-600 p-2 rounded-md text-white cursor-pointer">
              </div>
              <div class="text sign-up-text">Don't have an account? <a class="font-semibold text-sky-600" href="Registration.php">Signup now</a></div>
            </div>
        </form>
      </div>
       
      </form>
    </div>
    </div>
    </div>
  </div>
</body>
</html>
