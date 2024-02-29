<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
   
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <input type="checkbox" id="flip">
 
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
          <form action="#">
            <div class="input-boxes">
              <div class="input-box">
              </div>
              <div class="input-box">
              </div>
              <div class="button input-box">
              </div>
              </div>
        </form>
      </div>
	   
        <form method="POST">
		 <div class="title">Register</div>
            <div class="input-boxes">
              <div class="input-box">
                <input type="text" id="firstname" name="firstname" placeholder="First Name" required>
              </div>
			   <div class="input-box">
                <input type="text" id="midname" name="midname" placeholder="Mid Name" required>
              </div>
			  <div class="input-box">
                <input type="text"id="lastname" name="lastname" placeholder="Last Name" required>
              </div>
			  <div class="input-box">
                <input type="text" id="age" name="age" placeholder="Age" required>
              </div>
			  <div class="input-box">
                <input type="text" id="gender" name="gender" placeholder="Gender" required>
              </div>
			  <div class="input-box">
                <input type="text" id="address" name="address" placeholder="Address" required>
              </div>
			  <div class="input-box">
                <input type="text" id="contact" name="contact" placeholder="Contact Number " required>
              </div>
              <div class="input-box">
                <input type="text" id="email" name="email" placeholder="Enter your email" required>
              </div>
			    <div class="input-box">
                <input type="text" id="idno" name="idno" placeholder="Id No." required>
              </div>
              <div class="input-box">
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Submit">
              </div>
			  
				
				<?php include('connector.php'); 
			 
		
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				
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
				

				$select = "SELECT * FROM student";
				$checkquery = "INSERT INTO student (email, password, firstname, middlename, age, gender, address, phone, idno) VALUES ('$email', '$password', '$firstname', '$midname', '$age', '$gender', '$address', '$contact', '$idno')";
				
				$result= mysqli_query ($con, $checkquery);
			}
		//		if ($stmt->execute() === TRUE) {
		//			echo "New record created successfully";
		//		} else {
			//		echo "Error: " . $stmt->error;
		//		}

				
			//	$stmt->close();
		//		$con->close();
			
		//	if (isset($_POST['register'])) {
				
  // receive all input values from the form
  //$name = mysqli_real_escape_string($db, $_POST['firstname']);
  //$middle = mysqli_real_escape_string($db, $_POST['midname']);
 // $last = mysqli_real_escape_string($db, $_POST['lastname']);
 // $age = mysqli_real_escape_string($db, $_POST['age']);
 // $email = mysqli_real_escape_string($db, $_POST['email']);
 // $gender = mysqli_real_escape_string($db, $_POST['gender']);
 // $address = mysqli_real_escape_string($db, $_POST['address']);
  //$password = mysqli_real_escape_string($db, $_POST['password']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
//  if (empty($name)) { array_push($errors, "Username is required"); }
 // if (empty($email)) { array_push($errors, "Email is required"); }
 // if (empty($password)) { array_push($errors, "Password is required"); }
 //if ($password != $password) {
    //    array_push($errors, "The two passwords do not match");
 // }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
 // $user_check_query = "SELECT * FROM students WHERE name='$name' OR email='$email' LIMIT 1";
 // $result = mysqli_query($db, $user_check_query);
 // $user = mysqli_fetch_assoc($result);
  
 // if ($user) { // if user exists
  //  if ($user['name'] === $name) {
  //    array_push($errors, "Username already exists");
   // }
//
  //  if ($user['email'] === $email) {
     // array_push($errors, "email already exists");
   // }
  //}

  // Finally, register user if there are no errors in the form
 // if (count($errors) == 0) {
 //       $password = md5($password);//encrypt the password before saving in the database

    //    $query = "INSERT INTO users (name,middle,last,age,email,address, password) 
       //                   VALUES('$name', '$email', '$password')";
     //   mysqli_query($db, $query);
     //   $_SESSION['username'] = $username;
     //   $_SESSION['success'] = "You are now logged in";
    //    header('location: index.php');
 ///\ }
//}

// ... 
			
//?>

           <div class="text sign-up-text">Already have an account? <a href="index.php">Login now</a></div>
			  
            </div>
      </form>
      </form>
    </div>
    </div>
    </div>
  </div>
</body>
</html>
