<?php
$dashboard = isset($_SESSION['role']) ? '/dashboard' : '/admin/dashboard';

?>
<aside id="sidebar"
    class="left-[-1000px] lg:left-0 h-[805px] pb-36 duration-300 transition-all  w-56 bg-gradient-to-t to-[#8F93FF] from-purple-400 p-5 rounded-xl  lg:m-4 text-gray-100 fixed top-0 left-0 bottom-0   flex-col justify-between">
    <div class="h-full text-white  ">
        <section id="widget_1" class="border-b border-gray-200 pb-4 flex items-center gap-2 justify-center ">
            <img src="../images/ccs_logo.png" class="w-10 h-10" />
            <h1 class="text-center font-bold">Sit In</h1>
        </section>
        <section id="widget_2" class="mt-5 flex flex-col gap-5">
            <div class="flex gap-2 items-center <?php echo($page == 'Search' ? 'bg-purple-700' : '' ) ?>  cursor-pointer text-white rounded-lg px-3 p-2">
                <i class="fa-solid fa-magnifying-glass"></i>
                <a href="./" class="w-full">Search</a>
            </div>
        </section>
         <section id="widget_2" class="mt-5 flex flex-col gap-5">
            <div class="flex gap-2 items-center <?php echo($page == 'View Records' ? 'bg-purple-700' : '' ) ?> text-sm   cursor-pointer text-white rounded-lg px-3 p-2">
            <i class="fa-solid fa-eye"></i>    
            <a href="./records.php" class="w-full">View Records</a>
            </div>
        </section>
        <section id="widget_2" class="mt-5 flex flex-col gap-5">
            <div class="flex gap-2 items-center <?php echo($page == 'Generate Reports' ? 'bg-purple-700' : '' ) ?> text-sm cursor-pointer text-white rounded-lg px-3 p-2">
           <i class="fa-solid fa-file"></i>
            <a href="./records.php" class="w-full">Generate Reports</a>
            </div>
        </section>
    </div>
    <div class=" hover:bg-slate-900 p-2 rounded-lg duration-200 transition-colors ">
        <div class="flex gap-1 justify-center items-center w-full">

            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="m17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5M4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4z" />
            </svg>
            <a href="../logout.php" class=" text-center">Logout</a>
        </div>

    </div>
</aside>