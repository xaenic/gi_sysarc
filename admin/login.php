<?php

session_start();


if(isset($_SESSION['role'])){
    header("Location: ./index.php");
}
$message= "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email =  $_POST['email'];
    $password =  $_POST['password'];
    if($password != "" && $email != ""){
        if($email == 'admin@gmail.com' && $password == 'admin123'){
            $_SESSION['role'] = 'admin';
            header('Location: ./index.php');
        }
    }
    $message='<span class="text-red-500 ">Incorrect email / password</span>';
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <script src="../tailwind1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-stone-200 text-white">
    <div class="container mx-auto flex mt-32 justify-center ">
        <div class="forms bg-zinc-800-r from-zinc-800 via-stone-800 to-zinc-800 p-10 rounded-md  min-w-[400px]">
            <div class="form-content">
                <div class="login-form">
                    <div class="title text-xl font-bold text-center">Admin Dashboard</div>
                    <form action="" method="post" class="mt-4">
                        <?php echo $message;?>
                        <div class="mt-4 flex flex-col gap-3">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" name="email" class="text-black w-full border px-3 p-2 rounded-md"
                                    placeholder="Enter your email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" class="text-black w-full border px-3 p-2 rounded-md"
                                    placeholder="Enter your password" required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Login"
                                    class=" w-full bg-gradient-to-r from-stone-300 to-neutral-500 p-2 rounded-md text-white cursor-pointer">
                            </div>
                           
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