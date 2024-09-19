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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>HomeHub</title>
</head>
<body>
    <div class="flex">   
        <nav class="bg-[#81A94E] z-20 fixed hidden duration-150 h-full lg:block shrink-0 w-[18rem] lg:h-[100vh] ">
            <!-- TITLE LEFT -->
            <div class="w-full text-white flex flex-col leading-tight h-24 justify-center items-center bg-[#527920] z-10 ">
                <h1 class="text-xl font-semibold tracking-widest select-none">APARTMENT</h1>
                <p class="tracking-widest text-sm -mt-1 select-none">Management System</p>
            </div>

            <!-- MENU -->
            <div class="w-full text-white flex tracking-wider flex-col justify-center items-center">
                <h1 class="text-xl font-medium tracking-widest py-5 select-none">Menu</h1>
                <a href="units.php" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/units.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Units Information</p>
                </a>
                <a href="tenants.php" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/tenants.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Tenants Information</p>
                </a>
                <a href="payment.php" class="py-4 bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/payment.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Payment Management</p>
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
                <a href="payment.php" class="py-4 my-2 justify-center bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-10 select-none pointer-events-none" src="../icons/payment.png" alt="">
                        <p class="ml-4 select-none pointer-events-none">Payment Management</p>
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
                <p class="tracking-wider text-sm lg:text-base text-[#527920] select-none"><strong>ADMIN |</strong>  <a href="../PhpCodes/logout.php" class="underline hover:text-red-600 duration-300">LOGOUT</a></p>
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
            <main class="relative w-full lg:pl-72 mt-24 pb-20 text-[#527920] tracking-wide">
                <div class="mx-7 mt-7 select-none">
                    <h1 class="text-3xl text-[#527920] font-bold tracking-wider lg:mb-16 mb-12">Payment</h1>
                
                    <!-- NEW -->
                    <div class="flex flex-col items-center justify-center">
                        <div class="flex flex-col sm:max-w-[40rem] w-full lg:max-w-[65rem] lg:flex-row justify-between gap-10 2xl:gap-10 text-sm sm:text-base lg:text-nowrap lg:gap-5 tracking-wide text-[#527920]">
                            <script>
                                $(document).ready(function(){
                                    $("#house_no").keyup(function(){
                                        var house_no = $(this).val();
                                        filterData(house_no);
                                    });
                                });

                                function filterData(house_no) {
                                    $.ajax({
                                        url: "../PhpCodes/filter.php",
                                        method: "POST",
                                        data: {house_no: house_no},
                                        success: function(data) {
                                            $("#fullname").val(data);
                                        }
                                    });
                                }
                            </script>
                            <form action="../PhpCodes/payments.php" class="w-full lg:max-w-[28rem]" method="POST">
                                <div class="bg-[#D9D9D9] flex flex-col w-full pb-5">
                                    <h1 class="text-center text-lg py-2 tracking-widest bg-[#527920] text-white">Tenant's Information</h1>
                                    <div class="flex w-full sm:justify-center">
                                        <div class="p-4 pt-6 pb-16 w-full sm:max-w-[27rem] lg:max-w-full items-center flex gap-5">
                                            <div>
                                                <p>House No.</p>
                                                <input min="0" id="house_no" required name="house_no" autocomplete="off" placeholder="Enter No." class="border-[#527920] w-32 pt-[2.5px] pb-[4.5px] pl-[8px] outline-none text-[#527920] border-2" type="number">
                                            </div>
                                            <div class="w-full">
                                                <p>Tenant's Name</p>
                                                <input required id="fullname" name="fullname" autocomplete="off" class="border-[#527920] w-full self-end pt-[2.5px] pb-[4.5px] pl-[8px] outline-none text-[#527920] border-2" placeholder="Automatic Input" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h1 class="text-center text-lg py-2 tracking-widest bg-[#527920] text-white">Payment Summary</h1>
                                    <div class="flex w-full sm:justify-center">
                                        <div class="p-4 pt-6 pb-[3.8rem] w-full sm:max-w-[27rem] lg:max-w-full items-center flex gap-5">
                                            <div>
                                                <p>Mode of Payment</p>
                                                <select required name="MOP" autocomplete="off" id="" class="border-[#527920] self-end w-36 pt-[2.5px] pb-[4.5px] pl-1 outline-none font-medium text-[#527920] border-2">
                                                    <option value="Cash">Cash</option>
                                                    <option value="E-Wallet">E-Wallet</option>
                                                    <option value="Bank Transfer">Bank Transfer</option>
                                                </select>
                                            </div>
                                            <div class="w-full">
                                                <p>Amount of Payment</p>
                                                <input required min="0" name="amount" autocomplete="off" placeholder="Enter Amount" class="border-[#527920] w-full self-end pt-[2.5px] pb-[4.5px] pl-[8px] outline-none text-[#527920] border-2" type="number">
                                            </div>
                                        </div>
                                    </div>
                                    <button name="submit" type="submit" class="bg-[#527920] hover:bg-[#709243] duration-150 font-medium text-base self-center active:bg-[#5a7535] py-1 px-5 text-white text-center">Submit</button>
                                </div>
                            </form>
                            
                            <div class="w-full text-wrap text-sm mt-3 h-[27rem] overflow-hidden sm:mt-0 xl:text-base bg-[#c8e0a9]">
                                <!-- TABLE -->
                                <table class="w-full text-left">
                                    <tr class="bg-[#527920] h-8 text-white">
                                        <th class="px-2 py-1 font-medium">House No.</th>
                                        <th class="px-2 py-1 border-l-2 border-white font-medium">Tenant's Name</th>
                                        <th class="px-2 py-1 border-l-2 border-white font-medium">Date and Time</th>
                                    </tr>
                                    <?php

                                        $sql = "SELECT * FROM payment WHERE MOP != '*deposit' and MOP != '*adjust' ORDER BY transaction_id DESC";
                                        $result = $conn->query($sql);

                                        while($row=$result->fetch_assoc()){
                                            $default = strtotime($row["datePaid"]);
                                            $date = date('F d, Y', $default);
                                            $time = date('h:i A', $default);
                                            echo"
                                            <tr>
                                                <td name='id' class='px-2 border-r-2 border-white h-10 border-b-2 text-black bg-[#DADADA] py-1'>$row[house_no]</td>
                                                <td name='username' class='px-2 border-r-2 border-white h-10 border-b-2 text-black bg-[#DADADA] py-1'>$row[fullname]</td>
                                                <td name='fullname' class='px-2 border-white text-xs h-10 border-b-2 text-black bg-[#DADADA] py-1'>$date <br> $time</td>
                                            </tr>";
                                        }
                                        
                                    ?>
                                </table>
                            </div>
                            
                        </div>
                        <div class="w-full sm:max-w-[40rem] lg:max-w-[65rem] flex justify-end mt-3">
                            <a href="../PhpCodes/adminRecords.php"><button class="bg-[#527920] flex hover:bg-[#709243] duration-150 items-center text-white text-sm font-semibold active:bg-[#5a7535] py-1 px-3">View All Records
                                <img src="../icons/arrow.svg" class="w-4 ml-2" alt="">
                            </button></a>
                        </div>
                    </div>
                </div>
            </main>

           <!-- FOOTER -->
           <footer class="bg-[#ABCF7E] w-full justify-center fixed left-0 lg:left-36 bottom-0 h-10 flex shrink-0 items-center">
                <p id="time" class="text-[#527920] "></p>
            </footer>
        </div>
    </div>
    <script>
        // TIME
        let today = new Date();
        let currTime = today.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
        document.getElementById("time").textContent = currTime;

        
    </script>
</body>
</html>