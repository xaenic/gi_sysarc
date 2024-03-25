  <?php 
  
  
  session_start();
  
  if(isset($_SESSION['firstname']))
    header("Location: ./");
    $message ="";
  include('connector.php'); 
			if ($_SERVER["REQUEST_METHOD"] == "POST") {

             
                $message ="";
				
				$idno = $_POST['idno'];
				$password = $_POST['password'];
				$select = "SELECT * FROM student WHERE idno = '$idno' AND password = '$password'";
                $check =  $connection->query($select);
                if($check->num_rows > 0 )
                {
                    $user = $check->fetch_assoc();
                    $_SESSION['firstname'] = $user['firstname'];
                    $_SESSION['id'] = $user['id'];
                    header("Location: ./");
                }else {
                     $message = '<h1 class="text-red-500 font-semibold text-center">Incorrect IDNO or password.</h1>';
                }
            }

?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src="https://cdn.tailwindcss.com"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body class="min-h-screen flex items-center justify-center bg-slate-100">
      <div class="container shadow-lg rounded-3xl p-4 bg-white  overflow-hidden ">
    
                

        <div class="grid grid-cols-3  rounded-3xl">
         
        <div class="bg-[#8F93FF] rounded-3xl relative h-[750px] flex items-center">
            <img src="./images/Saly-35.png" class="absolute"/>
        </div>
        
            <form action=""method="POST" class="col-span-2 flex flex-col justify-center relative  ">
                    <div class="background  duration-1000 transition-all"></div>
                    
                
                <div class="title text-gray-800 text-center font-semibold text-3xl text-gray-760 mb-4">Login</div>
            
                    <div class="z-10 grid grid-cols-1 gap-4 w-full px-10">
                            <?php if($message != "") {?>
                                <?php echo $message;?>
                            <?php }?>
                       

                       

                
                        <div class="input-box shadow-sm">
                            <input type="number" id="idno" name="idno" placeholder="IDNO" required class="px-3 p-2 rounded-lg w-full">
                        </div>

                        <div class="input-box shadow-sm">
                            <input type="password" id="password" name="password" placeholder="Enter your password" required class="px-3 p-2 rounded-lg w-full">
                        </div>

                        <div class="button input-box shadow-sm">
                            <input type="submit" value="Login" class="w-full bg-red-400 p-2 rounded-lg text-white cursor-pointer hover:bg-red-600 duration-200 transition-colors">
                        </div>
                        
                        <div class="text sign-up-text text-center">
                            Don't Have an Account? <a href="./register.php" class="text-blue-500">Register Now</a>
                        </div>

                    </div>
            </form>

        </div>
       
      </div>
  </body>

  </html>