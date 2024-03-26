<?php 

$page="View Records";
session_start();
if(!isset($_SESSION['role']))
header("Location: ./login.php");
require './db.php';

$students = [];
$query = "SELECT * FROM sessions INNER JOIN student ON student.id = sessions.student_id ORDER BY time_out asc";
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
</head>

<body class="bg-purple-100">
    <?php require './sidebar.php';?>
    <main class="flex-1 lg:ml-64  lg:mt-5">
       <div class="flex flex-col items-center  rounded-md">
            <form action="" method="get" class="flex justify-end w-full bg-gradient-to-l to-[#8F93FF] from-purple-400  p-5 rounded-md">
                <div class="flex justify-end gap-3 w-full">
                    <input name="search" class="shadow-lg border px-3 p-1 rounded-md" tpye="text" value="" placeholder="Search student..."/>
                    <input  class="shadow-lg px-3 p-1 rounded-md text-white cursor-pointer hover:bg-purple-600 bg-purple-500" type="submit" value="Search"/>
                </div>
            </form>
             <table class="mt-5 w-full text-sm text-left rtl:text-right text-white rounded-lg overflow-hidden">
                <thead class="text-xs bg-gradient-to-l t to-[#8F93FF] from-purple-400 uppercase rounded-md">
                    <tr>
                        <th class="border px-4 py-4 font-medium border-none text-center font-bold">ID NO
                        </th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">FIRST NAME</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">LAST NAME</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">SESSIONS</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">EMAIL</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">TIME IN</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">TIME OUT</th>
                        <th class="border px-4 py-4 font-medium border-none  text-center">Operation</th>
                    </tr>
                </thead>
                <tbody id="tbody" class="relative">
                    

                <?php 

            foreach ($students as $student) {
                   echo '<tr class="odd:bg-purple-500 bg-purple-700">
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['idno'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['firstname'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['lastname'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['sessions'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['email'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['time_in'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['time_out'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">' . ($student['time_out'] !== null ? '<span href="#" class="text-white bg-green-500 px-3 p-2 rounded-md">Finished</span>' : '<a href="./timeout.php?id='.$student['id'].'&s_id='.$student['session_id'].'" class="text-white bg-red-500 px-3 p-2 rounded-md">Logout</a>') . '</td></tr>';
                }
            ?>

                </tbody>

            </table>
        </div> 
    </main>
</body>

</html>