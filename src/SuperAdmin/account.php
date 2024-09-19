<?php
    include("../PhpCodes/connection.php");
    session_start();
    if(!isset($_SESSION['role'])){
        header("Location: ../index.php");
    }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../img/homehub-icon.png">
    <link rel="stylesheet" href="../output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>HomeHub</title>
</head>
<body>
    <div class="flex relative">   
        <nav class="bg-[#81A94E] z-20 fixed hidden duration-150 h-full lg:block shrink-0 w-[18rem] lg:h-[100vh] ">
            <!-- TITLE LEFT -->
            <div class="w-full text-white flex flex-col leading-tight h-24 justify-center items-center bg-[#527920] z-10 ">
                <h1 class="text-xl font-semibold tracking-widest select-none">APARTMENT</h1>
                <p class="tracking-widest text-sm -mt-1 select-none">Management System</p>
            </div>

            <!-- MENU -->
            <div class="w-full text-white flex tracking-wider flex-col justify-center items-center">
                <h1 class="text-xl font-medium tracking-widest py-5 select-none">Menu</h1>
                <a href="dashboard.php" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-12 select-none pointer-events-none -m-1" src="../icons/owner.png" alt="">
                    <p class="ml-3 select-none pointer-events-none">Owner Dashboard</p>
                </a>
                <a href="units.php" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/units.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Units Information</p>
                </a>
                <a href="tenants.php" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/tenants.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Tenants Information</p>
                </a>
                <a href="payment.php" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/payment.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Payment Management</p>
                </a>
                <a href="account.php" class="py-4 bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-11 select-none pointer-events-none" src="../icons/account.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Account Management</p>
                </a>
                <a href="chat.php" class="py-4 relative hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/chat.svg" alt="">
                    <p class="ml-5 select-none pointer-events-none">Message Inbox</p>
                    <?php
                        include("../PhpCodes/unread.php");
                        if($count > 0){
                            echo "<p class='absolute right-5 py-[3px]  px-[9px] rounded-md bg-[#db5d5d]'>$count</p>";
                        }
                    ?>
                </a>
            </div>
        </nav>

        <nav id="navlink" class="bg-[#81A94E] flex left-[-65rem] z-20 lg:hidden duration-500 top-0 h-full fixed shrink-0 w-full">
            
            <!-- MENU -->
            <div class="w-full text-white flex tracking-wider mt-5 flex-col items-center">
                <div class="p-1 -ml-1 self-end mr-5 hover:bg-[#67922e] active:bg-[#5d8528] cursor-pointer duration-150 rounded-2xl">
                    <img onclick="closeMenu()" src="../icons/close.svg" class="w-10" alt="">
                </div>
                <h1 class="text-3xl font-medium tracking-widest py-7 select-none">Menu</h1>
                <a href="dashboard.php" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-12 select-none pointer-events-none -m-1" src="../icons/owner.png" alt="">
                        <p class="ml-3 select-none pointer-events-none">Owner Dashboard</p>
                    </div>    
                </a>
                <a href="units.php" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-10 select-none pointer-events-none" src="../icons/units.png" alt="">
                        <p class="ml-4 select-none pointer-events-none">Units Information</p>
                    </div>    
                </a>
                <a href="tenants.php" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-10 select-none pointer-events-none" src="../icons/tenants.png" alt="">
                        <p class="ml-4 select-none pointer-events-none">Tenants Information</p>
                    </div>    
                </a>
                <a href="payment.php" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-10 select-none pointer-events-none" src="../icons/payment.png" alt="">
                        <p class="ml-4 select-none pointer-events-none">Payment Management</p>
                    </div>    
                </a>
                <a href="account.php" class="py-4 my-2 justify-center bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-11 select-none pointer-events-none" src="../icons/account.png" alt="">
                        <p class="ml-4 select-none pointer-events-none">Account Management</p>
                    </div>    
                </a>
                <a href="chat.php" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex relative items-center w-64">
                        <img class="w-10 select-none pointer-events-none" src="../icons/chat.svg" alt="">
                        <p class="ml-5 select-none pointer-events-none">Message Inbox</p>
                        <?php
                            if($count > 0){
                                echo "<p class='absolute right-5 py-[3px]  px-[9px] rounded-md bg-[#db5d5d]'>$count</p>";
                            }
                        ?>
                    </div> 
                </a>
            </div>
        </nav>

        <div class="w-full flex flex-col h-[100vh] relative">
            <!-- HEADER -->
            <div class="flex px-7 fixed bg-[#ABCF7E] left-0 top-0 shrink-0 w-full h-24 items-center justify-between z-10">
                <div class="p-1 -ml-1 hover:bg-[#8cb853] active:bg-[#80a84c] cursor-pointer duration-150 rounded-2xl">
                    <img onclick="onToggleMenu()" src="../icons/burger.svg" class="w-10" alt="">
                </div>
                <p class="tracking-wider text-sm lg:text-base text-[#527920] select-none"><strong>OWNER |</strong>  <a href="../PhpCodes/logout.php" class="underline hover:text-red-600 duration-300">LOGOUT</a></p>
            </div>
            <script>
                // NAV BAR FOR MOBILE SIZE
                const navlink = document.getElementById("navlink");
                function onToggleMenu() {
                    navlink.style = "left: 0";
                }
                function closeMenu() {
                    navlink.style = "left: -65rem";
                }
            </script>

            <!-- MAIN CONTENT -->
            <main class="relative h-full w-full lg:pl-72 mt-24 pb-20 text-[#527920] tracking-wide">
                <div class="px-5 sm:px-7 h-full mt-7 relative select-none">
                    <h1 class="text-3xl pl-1 sm:pl-0 font-bold tracking-wider mb-10">Accounts</h1>

                    <div class="w-full">
                        <div action="" method="GET" class="max-w-[60rem] mx-auto">
                            <div class="flex items-center justify-between w-full">
                                <div class="flex w-full">
                                    <img  src="../icons/add.svg" onclick="openUI()" class="w-14 p-2 active:bg-[#b6b6b6] rounded-lg cursor-pointer duration-150 hover:bg-[#D9D9D9]" alt="">
                                </div>

                                <input type="text" autocomplete="off" id="name" class="border-2 outline-none border-[#527920] h-8 py-[3px] text-sm sm:text-base pl-[8px] w-80 sm:w-96" placeholder="Search Name..." type="text" onkeyup="myFunction()">
                            </div>

                            <!-- TABLE -->
                            <table id="myTable" class="w-full text-left mt-1 text-xs sm:text-sm md:text-base">
                                <tr class="bg-[#527920] h-9 text-white">
                                    <th class="px-2 py-1 font-normal">ID</th>
                                    <th class="px-2 py-1 border-l-2 border-white font-normal">Name</th>
                                    <th class="px-2 py-1 border-l-2 border-white font-normal">Username</th>
                                    <th class="px-2 py-1 border-l-2 border-white font-normal">Role</th>
                                    <th class="px-2 py-1 border-l-2 border-white font-normal">Option</th>
                                </tr>
            
                                <?php
                                    $sql = "SELECT * FROM users";
                                    $result = $conn->query($sql);
                                    if(!$result){
                                        die("Invalid Query!");
                                    }
                                    while($row=$result->fetch_assoc()){
                                        echo"
                                        <tr>
                                            <td name='id' class='px-2 border-r-2 border-white h-10 border-b-2 text-black bg-[#DADADA] py-1'>$row[user_id]</td>
                                            <td name='fullname' class='px-2 border-r-2 border-white h-10 border-b-2 text-black bg-[#DADADA] py-1'>$row[fullname]</td>
                                            <td name='username' class='px-2 border-r-2 border-white h-10 border-b-2 text-black bg-[#DADADA] py-1'>$row[username]</td>
                                            <td name='role' class='px-2 border-r-2 border-white h-10 border-b-2 text-black bg-[#DADADA] py-1'>$row[role]</td>
                                            <td class='px-2 border-l-2 border-white py-1 text-center sm bg-[#DADADA] h-9 border-b-2'>
                                                <a href='../PhpCodes/updateaccount.php?id=$row[user_id]'><button type='button' class='sm:text-sm font-medium  bg-[#81A94E] py-[2.5px] active:bg-[#709244] duration-150 hover:bg-[#95c25a] mb-1 min-w-[4rem] sm:min-w-20 text-xs  sm:mb-0 text-white'>EDIT</button></a>
                                                <a onclick=\" javascript:return confirm('Are you sure you want to delete this account? \\n \\nUsername: $row[username] \\nRole: $row[role]'); \"
                                                href='../PhpCodes/deleteaccount.php?id=$row[user_id]'><button type='button' class='sm:text-sm font-medium  bg-[#CC4444] py-[2.5px] duration-150 hover:bg-[#c95d5d] active:bg-[#b63d3d] min-w-[4rem] sm:min-w-20 text-xs  text-white'>DELETE</button></a>
                                                
                                            </td>
                                        </tr>";
                                    }
                                ?>

                            </table>
                        </div>
                    </div>

                    
                    
                    <!-- ADD ACCOUNT -->
                    <div class="absolute hidden top-0 left-0 px-5 bg-white w-full h-full" id="addAccount">
                        <div class="select-none flex flex-col h-full text-[#527920]">
                            <img src="../icons/back.svg" onclick="closeUI()" class="w-14 lg:ml-1 active:bg-[#b6b6b6] cursor-pointer rounded-full duration-150 hover:bg-[#D9D9D9] p-2" alt="">

                            <div class="flex sm:h-full w-full">
                                <div class="flex flex-col w-full justify-center items-center">
                                    <div class="w-72 flex flex-col items-center">
                                        <h1 class="text-3xl font-bold">New Account</h1> 
                                        <img src="../icons/newacc.svg" class="w-20 mt-5" alt="">
                                    </div>

                                    <!-- FORM -->
                                    <form action="../PhpCodes/addaccount.php" method="POST" class="px-5 flex w-full flex-col items-center sm:mt-10 ">
                                        <div class="w-full mt-7 sm:mt-0 md:w-[40rem]">
                                            <div class="flex gap-3 flex-col w-full sm:flex-row">
                                                <div class="flex flex-col sm:w-[70%] order-2 sm:order-1">
                                                    <label class="font-bold text-lg">Full Name:</label>
                                                    <input name="fullname" autocomplete="off" required id="fullname" placeholder="Enter Full Name" class="bg-[#D9D9D9] py-2 pl-3 sm:w-full outline-none" type="text">
                                                </div>
                                                <div class="flex flex-col sm:w-[30%] order-1 sm:order-2">
                                                    <label class="font-bold text-lg">Role:</label>
                                                    <select name="role" required id="role" class="border-[#527920] bg-[#D9D9D9] w-36 h-10 sm:h-full lg:w-48 pt-[2.5px] sm:w-full pb-[4.5px] px-1 outline-none font-medium text-[#527920] border-2">
                                                        <option value="" selected disabled hidden>Choose Role</option>
                                                        <option value="tenant">Tenant</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="super admin">Super Admin</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="flex gap-3 sm:gap-7 w-full mt-3 lg:mt-5 flex-col sm:flex-row">
                                                <div class="flex sm:w-[60%] flex-col">
                                                    <label class="font-bold text-lg">Username:</label>
                                                    <input placeholder="Enter Username" autocomplete="off" required id="username" name="username" class="bg-[#D9D9D9] w-[75%] sm:w-full py-2 pl-3 outline-none" type="text">
                                                </div>
                                                <div class="flex sm:w-[40%] flex-col">
                                                    <label class="font-bold text-lg">Password:</label>
                                                    <input placeholder="Enter Password" autocomplete="off" required id="password" name="password" class="bg-[#D9D9D9] w-[60%] sm:w-full py-2 pl-3 outline-none" type="password">
                                                </div>
                                            </div>

                                            <div class="flex gap-7 mt-3 sm:mt-5 w-full">
                                                <div class="flex flex-col w-full sm:w-[40%]">
                                                    <label class="font-bold text-lg">Confirm Password:</label>
                                                    <input name="con-password" id="con-password" autocomplete="off" required placeholder="Re-Enter Password" class="bg-[#D9D9D9] w-[60%] sm:w-full py-2 pl-3 outline-none" type="password">
                                                </div>
                                            </div>
                                            <div class="flex gap-7 pb-16 mt-12 w-full justify-center">
                                                <button type="submit" id="submit" name="submit" class="bg-[#527920] hover:bg-[#749745] active:bg-[#5a7535] duration-150 text-sm px-6 py-2 text-white font-bold">ADD ACCOUNT</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
                
                <!-- FOOTER -->
                <footer class="bg-[#ABCF7E] w-full justify-center fixed left-0 lg:left-36 bottom-0 h-10 flex shrink-0 items-center">
                    <p id="time" class="text-[#527920] "></p>
                </footer>

            </main>
        </div>
    </div>
    <script src="../function.js"></script>
    <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("name");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }
            }
        }

        // TIME
        let today = new Date();
        let currTime = today.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
        document.getElementById("time").textContent = currTime;
    </script>
</body>
</html>