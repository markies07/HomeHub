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
    <div class="flex text-[#527920] relative">   
        <nav class="bg-[#81A94E] z-20 fixed hidden duration-150 h-full lg:block shrink-0 w-[18rem] lg:h-[100vh] ">
            <!-- TITLE LEFT -->
            <div class="w-full text-white flex flex-col leading-tight h-24 justify-center items-center bg-[#527920] z-10 ">
                <h1 class="text-xl font-semibold tracking-widest select-none">APARTMENT</h1>
                <p class="tracking-widest text-sm -mt-1 select-none">Management System</p>
            </div>

            <!-- MENU -->
            <div class="w-full text-white flex tracking-wider flex-col justify-center items-center">
                <h1 class="text-xl font-medium tracking-widest py-5 select-none">Menu</h1>
                <a href="../SuperAdmin/dashboard.php" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-12 select-none pointer-events-none -m-1" src="../icons/owner.png" alt="">
                    <p class="ml-3 select-none pointer-events-none">Owner Dashboard</p>
                </a>
                <a href="../SuperAdmin/units.php" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/units.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Units Information</p>
                </a>
                <a href="../SuperAdmin/tenants.php" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/tenants.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Tenants Information</p>
                </a>
                <a href="../SuperAdmin/payment.php" class="py-4 bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/payment.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Payment Management</p>
                </a>
                <a href="../SuperAdmin/account.php" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-11 select-none pointer-events-none" src="../icons/account.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Account Management</p>
                </a>
                <a href="../SuperAdmin/chat.php" class="py-4 relative hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/chat.svg" alt="">
                    <p class="ml-5 select-none pointer-events-none">Message Inbox</p>
                    <?php
                        include("unread.php");
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
                <a href="../SuperAdmin/dashboard.php" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-12 select-none pointer-events-none -m-1" src="../icons/owner.png" alt="">
                        <p class="ml-3 select-none pointer-events-none">Owner Dashboard</p>
                    </div>    
                </a>
                <a href="../SuperAdmin/units.php" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-10 select-none pointer-events-none" src="../icons/units.png" alt="">
                        <p class="ml-4 select-none pointer-events-none">Units Information</p>
                    </div>    
                </a>
                <a href="../SuperAdmin/tenants.php" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-10 select-none pointer-events-none" src="../icons/tenants.png" alt="">
                        <p class="ml-4 select-none pointer-events-none">Tenants Information</p>
                    </div>    
                </a>
                <a href="../SuperAdmin/payment.php" class="py-4 my-2 justify-center bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-10 select-none pointer-events-none" src="../icons/payment.png" alt="">
                        <p class="ml-4 select-none pointer-events-none">Payment Management</p>
                    </div>    
                </a>
                <a href="../SuperAdmin/account.php" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-11 select-none pointer-events-none" src="../icons/account.png" alt="">
                        <p class="ml-4 select-none pointer-events-none">Account Management</p>
                    </div>    
                </a>
                <a href="../SuperAdmin/chat.php" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex relative items-center w-64">
                        <img class="w-10 select-none pointer-events-none" src="../icons/chat.svg" alt="">
                        <p class="ml-5 select-none pointer-events-none">Message Inbox</p>
                        <?php
                            include("unread.php");
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
            <main class="relative w-full h-full lg:pl-72 overflow-hidden mt-24 pb-28 text-[#527920] tracking-wide">
                <div class="sm:mx-7 mx-3 mt-7 h-full select-none">
                    <div class='select-none flex flex-col h-full text-[#527920]'>
                        <a href="../SuperAdmin/payment.php" class="w-14"><img src="../icons/back.svg" class="w-14 active:bg-[#b6b6b6] sm:-ml-1 ml-1 lg:ml-0 cursor-pointer rounded-full duration-150 z-10 hover:bg-[#D9D9D9] p-2" alt=""></a>
                        <div class="flex flex-col justify-center items-center w-full text-[#527920] tracking-widest">
                            <h1 class="text-2xl sm:text-3xl font-bold tracking-wider">Payment Records</h1>
                            <img src="../icons/payment.svg" class="w-14 sm:w-20 mt-5" alt="">
                        </div>

                        <!-- NEW -->
                        <div class="w-full h-full overflow-hidden ">
                            <div class="mt-7 sm:mt-5 text-sm sm:text-base max-w-[60rem] mx-auto" method="GET">
                                <div class="flex justify-between items-center gap-2 sm:gap-3 mt-2">
                                    <a target="_blank" href="paymentPDF.php"><button type="button" class="bg-[#527920] active:bg-[#5a7535] text-sm sm:text-base text-white hover:bg-[#749745] duration-150 text-[.7rem] py-1 px-2">Earnings this month</button></a>
                                    <input type="text" id="name" autocomplete="off" onkeyup="myFunction()" class="border-2 mr-1 outline-none border-[#527920] py-[3px] pl-[8px] w-52 sm:w-72" placeholder="Search Tenant's Name..." type="text">
                                
                                </div>

                                <!-- TABLE -->
                                <table class="w-full text-left h-full mt-3" id="myTable">
                                    <tr class="bg-[#527920] h-8 text-white">
                                        <th class="hidden">ID</th>
                                        <th class="px-2 py-1 text-xs sm:text-base border-white font-medium">House</th>
                                        <th class="px-2 py-1 text-xs sm:text-base border-l-2 border-white font-medium">Tenant's Name</th>
                                        <th class="px-2 py-1 text-xs sm:text-base border-l-2 border-white font-medium"><span class="sm:hidden">MOP</span><span class="hidden sm:block">Mode of Payment</span></th>
                                        <th class="px-2 py-1 text-xs sm:text-base border-l-2 border-white font-medium">Amount</th>
                                        <th class="px-2 py-1 text-xs sm:text-base border-l-2 border-white font-medium">Date Paid</th>
                                    </tr>
                                    <?php
                                        $sql = "SELECT * FROM payment WHERE MOP != '*deposit' AND MOP != '*adjust' ORDER BY transaction_id DESC";
                                        $result = $conn->query($sql);

                                        while($row=$result->fetch_assoc()){
                                            $default = strtotime($row["datePaid"]);
                                            $date = date('F d, Y', $default);
                                            $time = date('h:i A', $default);
                                            $shortDate = date('m/d/Y', $default);
                                            
                                            echo"
                                                <tr>
                                                    <td name='trans_id' class='hidden'>$row[transaction_id]</td>
                                                    <td name='house_no' class='px-2 border-r-2 border-white h-10  text-xs sm:text-base border-b-2 text-black bg-[#DADADA] py-1'>$row[house_no]</td>
                                                    <td name='fullname' class='px-2 border-r-2 border-white h-10 text-xs sm:text-base border-b-2 text-black bg-[#DADADA] py-1'>$row[fullname]</td>
                                                    <td name='MOP' class='px-2 border-r-2 border-white h-10 text-xs sm:text-base border-b-2 text-black bg-[#DADADA] py-1'>$row[MOP]</td>
                                                    <td name='amount' class='px-2 border-r-2 border-white text-xs sm:text-base h-10 border-b-2 text-black bg-[#DADADA] py-1'>$row[amount]</td>
                                                    <td name='datePaid' class='px-2 border-white cursor-pointer duration-150 hidden md:block hover:bg-[#f8a2a2] active:bg-[#ff6e6e] text-xs h-10 border-b-2 text-black bg-[#DADADA] py-1'>
                                                        <a onclick=\" javascript:return confirm('Are you sure you want to delete this payment? \\n \\nName: $row[fullname] \\nAmount: $row[amount] \\nDate: $date \\nTime: $time'); \" href='../PhpCodes/deletePayment.php?id=$row[transaction_id]'>
                                                            $date <br> $time 
                                                        </a>
                                                    </td>
                                                    
                                                    <td name='datePaid' class='px-2 md:hidden border-white cursor-pointer duration-150 hover:bg-[#f8a2a2] active:bg-[#ff6e6e] text-xs h-10 border-b-2 text-black bg-[#DADADA] py-1'>
                                                        <a  onclick=\" javascript:return confirm('Are you sure you want to delete this payment? \\n \\nName: $row[fullname] \\nAmount: $row[amount] \\nDate: $date \\nTime: $time'); \" href='../PhpCodes/deletePayment.php?id=$row[transaction_id]'>
                                                            $shortDate <br> $time
                                                        </a>
                                                    </td>
                                                </tr>";
                                        }
                                    ?>
                                </table>
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
                td = tr[i].getElementsByTagName("td")[2];
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