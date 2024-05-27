<?php 

$page="Bookings";
session_start();
if(!isset($_SESSION['role']))
header("Location: ./login.php");
require './db.php';

$students = [];
$query = "SELECT bookings.id AS bookid, bookings.*, student.* 
          FROM bookings 
          INNER JOIN student ON student.id = bookings.student_id 
          ORDER BY bookings.date_created DESC";
$result = $connection->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}
$connection->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
     <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  
</head>

<body class="bg-stone-200">
    <?php require './sidebar.php';?>
    <main class="flex-1 lg:ml-64  lg:mt-4 mr-4">
       <div class="flex flex-col gap-8  rounded-xs">
        <div class="flex justify-end w-full bg-gradient-to-r from-stone-500 via-stone-600 to-stone-800 text-white p-3 rounded-xs">
            <div class="flex gap-1 items-center">
                <img src="https://innap.dexignzone.com/xhtml/images/profile/pic1.jpg" class="rounded-full w-10 h-10"/>
                <span class="text-sm">Admin</span>
            </div>
        </div>

        <div class="">
            <h1 class="font-medium text-lg text-stone-700">Booking Reservations</h1>
            <div class="grid grid-cols-4 mt-3 gap-4">
                <div action="" method="get" class="flex  rounded-md">
                <!-- <div class="items-center flex justify-start w-full shadow-lg border  rounded-md bg-white">
                    <input id="search" name="search" class="px-3 p-2 outline-none  bg-transparent " tpye="text" value="" placeholder="Search booking id..."/>
                    <i class="self-center text-center w-full text-gray-500 border-l px-3 p-1 fa-solid fa-magnifying-glass"></i>
                  
                </div> -->
                 
            </div>
              <!-- <input type="text" id="datetimepicker" placeholder="From Date" class="outline-none px-3 p-3 rounded-md form-input w-full"> -->
            </div>
        </div>
            <!-- <form action="" method="get" class="flex justify-end w-full bg-gradient-to-l to-[#8F93FF] from-purple-400  p-5 rounded-md">
                <div class="flex justify-end gap-3 w-full">
                    <input name="search" class="shadow-lg border px-3 p-1 rounded-md" tpye="text" value="" placeholder="Search student..."/>
                    <input  class="shadow-lg px-3 p-1 rounded-md text-white cursor-pointer hover:bg-purple-600 bg-purple-500" type="submit" value="Search"/>
                </div>
            </form> -->
             <table class=" w-full text-sm text-left rtl:text-right text-white rounded-lg overflow-hidden">
                <thead class="text-xs bg-gradient-to-r from-zinc-800 via-stone-500 to-zinc-800 uppercase rounded-md">
                    <tr>
                        <th class="border px-4 py-4 font-medium border-none text-center font-bold"> STUDENT ID NO
                        </th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">BOOKING ID</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">NAME</th>
                        
                        <th class="border px-4 py-4 font-medium border-none  text-center">Purpose</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">Laboratory</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">Reservation Date</th>
                       
                        <th class="border px-4 py-4 font-medium border-none  text-center">Operation</th>
                    </tr>
                </thead>
                <tbody id="tbody" class="relative">
                    

                <?php 

            foreach ($students as $student) {
                    $status = $student['status'];
                    if($student['status'] == 'Pending') {
                        $status = '<div class="flex justify-end gap-3"><a href="./approve.php?id='.$student['bookid'].'" class="text-white bg-green-500 px-3 p-2 rounded-md">Approve</a><a href="./reject.php?id='.$student['bookid'].'" class="text-white bg-red-500 px-3 p-2 rounded-md">Reject</a></div>';
                    }
                   echo '<tr class="odd:bg-stone-500 bg-zinc-700">
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['idno'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['bookid'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['firstname'].' '.$student['lastname'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['purpose'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['laboratory'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.date('F j, Y', strtotime($student['reservation_date'])).'</td>
                       
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$status.'</td></tr>';
                }
            ?>

                </tbody>

            </table>
        </div> 
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>

        $(document).ready(function() {

            
            const students = <?php echo json_encode($students); ?>;
            console.log(students)

            

            function studentRow(student,statusElement,time_in,time_out) {
                return `<tr class="odd:bg-purple-500 bg-purple-700"><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${student.idno}</td><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${student.firstname}</td><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${student.lastname}</td><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${student.sessions}</td><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${student.email}</td><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${time_in}</td><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${time_out}</td><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${statusElement}</td></tr>`
            }
            $("#search").on('input', function() {

                 if(this.value == "")
                   return restore(students);
                 let data = "";
                    students.forEach(student => {
                        const studentDate = student.time_in.split(' ')[0];
                  
                        if(student.idno == this.value) {
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
            })
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


            function formatDate(dateString) {
    
                const date = new Date(dateString);

                
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0'); 
                const day = String(date.getDate()).padStart(2, '0');
                const formattedDate = `${year}-${month}-${day}`;

                return formattedDate;
            }

           function restore(students) {
                let data= "";
               
                students.forEach(student => {

                    const studentDate = student.time_in.split(' ')[0];
                        const time_in = new Date(student.time_in).toLocaleString('en-US', { month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                    const time_out = new Date(student.time_in).toLocaleString('en-US', { month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                     const statusElement = student.time_out !== null 
                            ? `<span href="#" class="text-white bg-green-500 px-3 p-2 rounded-md">Finished</span>` 
                            : `<a href="./timeout.php?id=${student['id']}&s_id=${student['session_id']}" class="text-white bg-red-500 px-3 p-2 rounded-md">Logout</a>`;
                            data += studentRow(student,statusElement,time_in,time_out);
                })

                  if(data != "")
                   $("#tbody").html(data)
                   else 
                    $("#tbody").html('<span class="text-xl font-semibold text-purple-700 text-center w-full">No records found</span>')
                        
            }

        });
        // Initialize Flatpickr
        
    </script>
</body>

</html>