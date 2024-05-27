  <?php 
  
  
  session_start();
  
  if(isset($_SESSION['firstname']))
    header("Location: ./");
    $message ="";
  include('connector.php'); 
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $message ="";
				$firstname = $_POST['firstname'];
				$midname = $_POST['midname'];
				$lastname = $_POST['lastname'];
				$age = $_POST['age'];
				$gender = $_POST['gender'];
				$address = $_POST['address'];
				$contact = $_POST['contact'];
				$email = $_POST['email'];
				$idno = $_POST['idno'];
				$password = $_POST['password'];
				$select = "SELECT * FROM student WHERE email = '$email'";
                $emails =  $connection->query($select);
                $select = "SELECT * FROM student WHERE idno = $idno";
                $idnos =  $connection->query($select);
                if($emails->num_rows <=0 )
                {
                    if($idnos->num_rows <=0){
                        $query = "INSERT INTO student (email, password, firstname, middlename, age, gender, address, phone, idno) VALUES ('$email', '$password', '$firstname', '$midname', '$age', '$gender', '$address', '$contact', '$idno')";
                        $result = $connection->query($query);
                        if($result)
                            $message = '<h1 class="text-green-500 font-semibold text-center">Registered Successfully!</h1>';
                       
                    }else {
                         $message = '<h1 class="text-red-500 font-semibold text-center">IDNO already exist.</h1><br>';
                    }
                   
                }else {
                     $message = '<h1 class="text-red-500 font-semibold text-center">Email address already exist.</h1>';
                }
				
                
            }

?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
          <script src="./tailwind1.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body class="min-h-screen flex items-center justify-center bg-purple-100">
      <div class="container shadow-lg rounded-3xl p-4 bg-white  overflow-hidden ">
    
                

        <div class="grid grid-cols-3  rounded-3xl">
         
        <div class="bg-[#8F93FF] rounded-3xl relative h-[750px] flex items-center">
            <img src="./images/Saly-36.png" class="absolute"/>
        </div>
        
            <form method="POST" class="col-span-2 flex flex-col justify-center relative  ">
                    <div class="background  duration-1000 transition-all"></div>
                    
                
                <div class="title text-gray-800 text-center font-semibold text-3xl text-gray-760 mb-4">Register</div>
            
                    <div class="z-10 grid grid-cols-1 gap-4 w-full px-10">
                            <?php if($message != "") {?>
                                <?php echo $message;?>
                            <?php }?>
                        <div class="input-box shadow-sm w-full ">
                            <input type="text" id="firstname" name="firstname" placeholder="First Name" required class="px-3 p-2 rounded-lg w-full">
                        </div>

                        <div class="input-box shadow-sm">
                            <input type="text" id="midname" name="midname" placeholder="Mid Name" required class="px-3 p-2 rounded-lg w-full">
                        </div>

                        <div class="input-box">
                            <input type="text" id="lastname" name="lastname" placeholder="Last Name" required class="px-3 p-2 rounded-lg w-full">
                        </div>

                        <div class="input-box shadow-sm">
                            <input type="text" id="age" name="age" placeholder="Age" required class="px-3 p-2 rounded-lg w-full">
                        </div>

                        <div class="input-box shadow-sm">
                            <input type="text" id="gender" name="gender" placeholder="Gender" required class="px-3 p-2 rounded-lg w-full">
                        </div>

                        <div class="input-box shadow-sm">
                            <input type="text" id="address" name="address" placeholder="Address" required class="px-3 p-2 rounded-lg w-full">
                        </div>

                        <div class="input-box shadow-sm">
                            <input type="text" id="contact" name="contact" placeholder="Contact Number " required class="px-3 p-2 rounded-lg w-full">
                        </div>

                        <div class="input-box shadow-sm">
                            <input type="text" id="email" name="email" placeholder="Enter your email" required class="px-3 p-2 rounded-lg w-full">
                        </div>

                        <div class="input-box shadow-sm">
                            <input type="number" id="idno" name="idno" placeholder="Id No." required class="px-3 p-2 rounded-lg w-full">
                        </div>

                        <div class="input-box shadow-sm">
                            <input type="password" id="password" name="password" placeholder="Enter your password" required class="px-3 p-2 rounded-lg w-full">
                        </div>

                        <div class="button input-box shadow-sm">
                            <input type="submit" value="Join Now" class="w-full bg-red-400 p-2 rounded-lg text-white cursor-pointer hover:bg-red-600 duration-200 transition-colors">
                        </div>
                        
                        <div class="text sign-up-text text-center">
                            Already have an account? <a href="./login.php" class="text-blue-500">Login now</a>
                        </div>

                    </div>
            </form>

        </div>
       
      </div>
  </body>

  </html>