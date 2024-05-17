<?php 

$page="Announcements";
session_start();
if(!isset($_SESSION['role']))
header("Location: ./login.php");
require './db.php';

$students = [];
$query = "SELECT * FROM announcement";
$result = $connection->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){

$content = $_POST['content'];
$title= $_POST['title'];
$name = 'admin';
 $query = "INSERT INTO announcement (name,title,content) VALUES('$name' , '$title','$content')";
$result = $connection->query($query);

header("Location: ./announcement.php");

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

<body class="bg-stone-200 ">
    <?php require './sidebar.php';?>
    <main class="flex-1 lg:ml-64  lg:mt-4 mr-4 relative min-h-screen">
        <div id="modal" class="hidden  items-center justify-center h-full w-full bg-black absolute z-20 bg-opacity-5">
            <form  action="" method="post" class="flex  flex-col gap-6 shadow-sm bg-white p-5 rounded-md">
                <div class="flex flex-col items-start">
                    <label>Title</label>
                    <div class="p-2 border rounded-md w-full">
                        <input type="text" name="title" placeholder="Enter title" class="w-full bg-transparent outline-none"/>
                    </div>
                </div>
                 <div class="flex flex-col items-start">
                    <label>Message</label>
                    <div class="p-2 border rounded-md">
                            <textarea id="feedback"  name="content" rows="4" cols="50" class="bg-transparent outline-none"></textarea>
                    </div>
                </div>
              <div class="flex justify-end gap-3">
                  <span id="cancel" class="bg-red-500 text-white p-3 rounded-md text-sm">Cancel</span>

                  <button class="bg-green-500 text-white p-3 rounded-md text-sm">Publish</button>
              </div>
            </form>

        </div>
       <div class="flex flex-col gap-8  rounded-xs">
        <div class="flex justify-end w-full bg-gradient-to-r from-stone-500 via-stone-600 to-stone-800 text-white p-3 rounded-xs">
            <div class="flex gap-1 items-center">
                <img src="https://innap.dexignzone.com/xhtml/images/profile/pic1.jpg" class="rounded-full w-10 h-10"/>
                <span class="text-sm">Admin</span>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <h1 class="font-medium text-lg text-stone-700">Announcements</h1>
           <button id="add" class="bg-green-500 text-white p-3 py-2 rounded-md text-sm">Add Announcement</button>
             
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
                        <th class="border px-4 py-4 font-medium border-none text-center font-bold">ID NO
                        </th>
                         <th class="border px-4 py-4 font-medium border-none  text-center">AUTHOR</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">Title</th>
                       
                        <th class="border px-4 py-4 font-medium border-none  text-center">CONTENT</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">DATE CREATED</th>
                    </tr>
                </thead>
                <tbody id="tbody" class="relative">
                    

                <?php 

            foreach ($students as $student) {
                   echo '<tr class="odd:bg-stone-500 bg-zinc-700">
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['id'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['name'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['title'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['content'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['date_created'].'</td>
                               </tr>';
                }
            ?>

                </tbody>

            </table>
        </div> 
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>

        $(document).ready(function() {

        

            $("#add").click(function() {

                $("#modal").removeClass("hidden");
                $("#modal").addClass("flex");
            })
            
            $("#cancel").click(function() {

                  $("#modal").removeClass("flex");
                $("#modal").addClass("hidden");
            })

        

        });
    </script>
</body>

</html>