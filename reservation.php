<?php 

session_start();
if(!isset($_SESSION['firstname']))
  header("location: ./login.php");
if(isset($_SESSION['role']))
  header("location: ./admin");
include('connector.php'); 
$announcements = [];

$history = [];
$id = $_SESSION['id'];
$select = "SELECT * FROM bookings WHERE student_id = $id ORDER BY date_created desc";
$result = $connection->query($select);
$exist = null;
$message="";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $history[] = $row;
    }
}
$select = "SELECT * FROM student WHERE id = '$id'";
$result = $connection->query($select);
$user = $result->fetch_assoc();
$sessions = $user['sessions'];
    $query = "SELECT * FROM bookings WHERE student_id = '$id'  AND status = 'Pending'";
    $s_result = $connection->query($query);
    if($s_result->num_rows > 0)
    {
    $exist = $s_result->fetch_assoc();
    }


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $purpose = $_POST['purpose'];
    $laboratory = $_POST['laboratory'];
    $date = $_POST['date'];
    echo $date;
    if($date == "" || $laboratory == "" || $date == ""){
        $message = '<span class="text-red-500 font-medium mt-5">Fill All Fields</span>';
    }else {
         $dateObject = DateTime::createFromFormat('F j, Y', $date);
        $date  = $dateObject->format('Y-m-d');
         if($exist == null) {
        $check = "SELECT * FROM student WHERE id = '$id' AND sessions > 0";
            $r_check = $connection->query($check);
            if($r_check->num_rows > 0){
                $query = "INSERT INTO bookings (student_id,laboratory,purpose,reservation_date) VALUES('$id','$laboratory','$purpose','$date')";
                $result = $connection->query($query);
                if (!$result) {
                        $message = "Error: " . $connection->error;
                }else {
                    $exist ="hah"; 
                    header('Location: ./reservation.php');
                    $message = '<span class="self-center px-3 p-2 mt-5 text-xs font-semibold   bg-green-500 text-white rounded-md">Booking has been submitted.</span>';
                }
                
            }else {
                $message = '<span class="self-center px-3 p-2 mt-5 text-xs font-semibold   bg-red-500 text-white rounded-md">No Sessions Available</span>';
            }   
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
<?php include('side.php');?>
<div id="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span> 

<div class="w-full flex items-center flex-col container mx-auto">
  <h1 style="text-align:center; font-size:30px; font-weight:strong">Make A Reservation</h1> 
     <div class="flex flex-col items-center">
        <?php if($exist == null) : ?>
        <form action="" method="post" class="flex flex-col items-center  border mt-10  text-black   p-5 rounded-md min-w-[320px]  relative">
                
               
                <div class="mt-14">
                    <p class="text-2xl text-center font-semibold text-stone-50"><?php ?></p>
                    <p class="text-center text-yellow-200"></p>
                    <span class="text-xs font-semibold px-2 p-1 bg-stone-900 text-white rounded-md"> <?php echo $sessions;?> Sessions Available</span>
                </div>
                  
               <?php echo $message;?>
                <div class="self-start flex flex-col gap-2 w-full mt-5">
                    <label class="text-gray-700">Purpose of SitIn</label>
                    <select name="purpose" class="text-gray-700 border p-2 rounded-md w-full">
                        <option value="Java">Java</option>
                        <option value="Python">Python</option>
                        <option value="C">C</option>
                        <option value="C++">C++</option>
                        <option value="C#">C#</option>
                        <option value="Others">Others</option>
                    </select>
                    
                </div>
                <div class="flex flex-col gap-2 w-full mt-5">
                    <label class="text-gray-700">Laboratory</label>
                    <select name="laboratory" class="text-gray-700 border p-2 rounded-md">
                        <option value="Lab 524">Lab 524</option>
                        <option value="Lab 526">Lab 526</option>
                        <option value="Lab 528">Lab 528</option>
                        <option value="Lab 542">Lab 542</option>
                        <option value="Lab 543">Lab 543</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2 w-full mt-5">
                    <label class="text-gray-700">Select Date</label>

                        <div class="border rounded-md">
                            <input type="text" name="date" id="datetimepicker" placeholder="From Date" class="outline-none px-3 p-3 rounded-md form-input w-full">
                        </div>
                </div>
                <div class="flex justify-between mt-5 gap-5 w-full">

                  <input type="hidden" value="<?php echo $student['id'];?>" name="id"/>
                 
                        <input type="submit" value="Book" class="w-full font-semibold cursor-pointer px-3 p-2 bg-stone-800 text-stone-50 rounded-lg "/>
            
                </div>
            </form>
        <?php else:?>
            <span class="text-red-500">You have a Pending Booking, you can't book right now.</span>
        <?php endif;?>
        <h1 class="mt-5 text-xl font-bold mb-5">Booking History</h1>
         <table id="oktable" class=" mb-10 w-full text-sm text-left rtl:text-right text-white rounded-lg overflow-hidden">
                <thead class="text-xs bg-gradient-to-l t to-[#8F93FF] from-purple-400 uppercase rounded-md">
                    <tr>
                       
                        <th class="border px-4 py-4 font-medium border-none  text-center">BOOKING ID</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">PURPOSE</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">LABORATORY</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">RESERVATION DATE</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">STATUS</th>
                    </tr>
                </thead>
                <tbody id="tbody" class="relative">
                    

                <?php 

            foreach ($history as $student) {
                $status = $student['status'];
                if($student['status'] == 'Pending') {
                    $status  = '<span>Pending</span> <a class="bg-red-600 p-1 rounded-md" href="./cancel.php?id='.$student['id'].'">Cancel</a>';
                }
                   echo '<tr class="odd:bg-purple-500 bg-purple-700">
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['id'].'</td>
                              
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['purpose'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['laboratory'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.date('F j, Y', strtotime($student['reservation_date'])).'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$status.'</td></tr>
                                ';
                }
            ?>

                </tbody>

            </table>
     </div>
</div>  
<br>
<center>

</center>
</div>
	</div>

 
</div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>


$(document).ready(function() {
  
    flatpickr('#datetimepicker', {
                dateFormat: "F j, Y",
                onChange: function(selectedDates, dateStr, instance) {
                    const selectedDate = formatDate(dateStr);
                    let data = "";
                    students.forEach(student => {
                        const studentDate = student.time_in.split(' ')[0];
                        const time_in = new Date(student.time_in).toLocaleString('en-US', { month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                         const time_out = new Date(student.time_in).toLocaleString('en-US', { month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                        if(selectedDate == studentDate) {
                            const statusElement = student.time_out !== null 
                            ? `<span href="#" class="text-white bg-green-500 px-3 p-2 rounded-md">Finished</span>` 
                            : `<a href="./timeout.php?id=${student['id']}&s_id=${student['session_id']}" class="text-white bg-red-500 px-3 p-2 rounded-md">Logout</a>`;
                            data += studentRow(student,statusElement,time_in,time_out);
                        }
                       
                    })
                   if(data != "")
                   $("#tbody").html(data)
                   else 
                    $("#tbody").html('<span class="text-xl font-semibold text-purple-700 text-center w-full">No records found</span>')
                }
            
            });

})
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
