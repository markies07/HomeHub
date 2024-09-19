<?php
    include("../PhpCodes/connection.php");
    session_start();
    if(!isset($_SESSION['role'])){
        header("Location: ../index.php");
    }
    $house_no = $_GET['house_no'];
    if($house_no != $_SESSION['house_no']){
        header("Location: tenant.php?house_no=$house_no");
    }

    $get = "SELECT fullname FROM tenants WHERE house_no = '$house_no'";
    $resulta = $conn->query($get);
    $rows = $resulta->fetch_assoc();
    $fullname = $rows['fullname'];

    $sql = "SELECT * FROM tenants t INNER JOIN houses h ON t.house_no = h.house_no WHERE fullname = '$fullname'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
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
    <div class="flex text-[#527920]">   
    <nav class="bg-[#81A94E] z-20 fixed hidden duration-150 h-full lg:block shrink-0 w-[18rem] lg:h-[100vh] ">
            <!-- TITLE LEFT -->
            <div class="w-full text-white flex flex-col leading-tight h-24 justify-center items-center bg-[#527920] z-10 ">
                <h1 class="text-xl font-semibold tracking-widest select-none">APARTMENT</h1>
                <p class="tracking-widest text-sm -mt-1 select-none">Management System</p>
            </div>

            <!-- MENU -->
            <div class="w-full text-white flex tracking-wider flex-col justify-center items-center">
                <h1 class="text-xl font-medium tracking-widest py-5 select-none">Menu</h1>
                <a href="tenant.php?house_no=<?php echo $house_no ?>" class=" py-4 duration-150 hover:bg-[#6a8349] cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/dash.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Tenant Dashboard</p>
                </a>
                <a href="info.php?house_no=<?php echo $house_no ?>" class="py-4 bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/tenant.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Tenant Information</p>
                </a>
                <a href="chat.php?house_no=<?php echo $house_no ?>" class="py-4 relative hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
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
                <a href="tenant.php?house_no=<?php echo $house_no ?>" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-10 select-none pointer-events-none" src="../icons/dash.png" alt="">
                        <p class="ml-4 select-none pointer-events-none">Tenant Dashboard</p>
                    </div>    
                </a>
                <a href="info.php?house_no=<?php echo $house_no ?>" class="py-4 my-2 justify-center bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-10 select-none pointer-events-none" src="../icons/tenant.png" alt="">
                        <p class="ml-4 select-none pointer-events-none">Tenant Information</p>
                    </div>    
                </a>
                <a href="chat.php?house_no=<?php echo $house_no ?>" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-10 select-none pointer-events-none" src="../icons/chat.svg" alt="">
                        <p class="ml-4 select-none pointer-events-none">Message Inbox</p>
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
                <p class="tracking-wider text-sm lg:text-base text-[#527920] select-none"><strong>TENANT |</strong>  <a href="../PhpCodes/logout.php" class="underline hover:text-red-600 duration-300">LOGOUT</a></p>
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
            <main class="relative w-full h-full lg:pl-72 mt-24 pb-7 text-[#527920] tracking-wide">
                <div class="mx-5 sm:mx-7 h-full mt-7 relative select-none">
                    <div class='select-none flex flex-col h-full text-[#527920]'>
                        <div class="relative flex flex-col items-center w-full h-full justify-center">
                            
                            <div class="flex flex-col w-full justify-center">
                                <div class="flex w-full flex-col items-center">
                                    <h1 class="text-3xl font-bold">House <?php echo $house_no ?></h1> 
                                    <img src="../icons/occupied.svg" class="w-20 mt-5" alt="">
                                </div>

                                <!-- CONTENT -->
                                <div class="sm:px-16 px-5 justify-center h-full flex w-full mt-10 ">
                                    <div class="pb-14 flex flex-col h-full text-sm sm:text-base w-full md:w-[35rem] sm:w-[30rem]">
                                        <div class="flex flex-col sm:flex-row items-center sm:items-start">
                                            <div class="flex sm:w-[70%] flex-col">
                                                <p class="font-bold text-nowrap">Name: <span class="text-xl ml-1 font-normal"><?php echo $fullname ?></span></p>
                                            </div>

                                            <?php
                                                if($_SERVER["REQUEST_METHOD"] == 'GET'){
                                                    if(!isset($_GET['house_no'])){
                                                        header('location:/Homehub/SuperAdmin/units.php');
                                                        exit;
                                                    }
                                                    $house_no = $_GET['house_no'];
                                                    $sql = "SELECT * FROM houses WHERE house_no = $house_no";
                                                    $result = $conn->query($sql);
                                                    $row = $result->fetch_assoc();
                                                    while(!$row){
                                                        header('location:/Homehub/SuperAdmin/account.php');
                                                        exit;
                                                    }
                                                    $house_no = $row["house_no"];
                                                    $fulladdress = $row["fulladdress"];
                                                    $noRoom = $row["noRoom"];
                                                    $noBathroom = $row["noBathroom"];
                                                    $noFloor = $row["noFloor"];
                                                    $rent = $row["rent"];
                                                    $status = $row["status"];
                                                }
                                                $house_no = $_GET['house_no'];
                                                $sql = "SELECT * FROM tenants WHERE house_no = $house_no";
                                                $result = $conn->query($sql);
                                                $row = $result->fetch_assoc();
                                                while(!$row){
                                                    header('location:/Homehub/SuperAdmin/account.php');
                                                    exit;
                                                }
                                                $house_no = $row["house_no"];
                                                $fullname = $row["fullname"];
                                                $contact = $row["contact"];
                                                $occupants = $row["occupants"];
                                                $startDate = $row["startDate"];
                                                $monthPaid = $row["monthPaid"];
                                                $balance = 0;
                                                
                                                
                                                $dateNow = new DateTime();
                                                $datePass = new DateTime($startDate);

                                                $today = date("j");
                                                $dueDate = date("j", strtotime($startDate));

                                                $diff = $dateNow->diff($datePass);
                                                $monthCount = (($diff->y) * 12) + ($diff->m);
                                                $dayCount = ($monthCount * 30) + ($diff->d) ;
                                                $weekCount = floor($dayCount / 7) - 4;
                                                
                                                // echo $monthCount . ' months <br>';
                                                // echo "$today today <br>";
                                                // echo "$dueDate due date <br>";


                                                // COMPUTATION

                                                $credits = 0;
                                                $monthToPay = 0;
                                                // echo $monthPaid . ' paid <br>';

                                                if($monthCount > 0){
                                                    for($monthPaid; $monthPaid < $monthCount; $monthPaid++){
                                                        if($today == $dueDate){
                                                            $monthToPay++;
                                                        }
                                                    }
                                                }

                                                
                                                $overallRent = $monthCount * $rent;
                                                $balance = $monthToPay * $rent;
                                                // echo $monthToPay . ' month to pay <br>';
                                                // $balance = $monthToPay * $rent;
                                                // echo $overallRent . ' overall rent <br>';
                                                // echo $deposit;

                                            
                                                // PAYMENT PROCESS

                                                $sql = "SELECT * FROM payment WHERE house_no = $house_no";
                                                $result = $conn->query($sql);
                                                if($result->num_rows > 0){
                                                    $amount = 0;
                                                    while($row=$result->fetch_assoc()){
                                                        $amount += $row['amount'];
                                                    }

                                                    $paid = $amount / $rent;
                                                    $monthPaid = (int)$paid;
                                                    
                                                    $sql = "UPDATE tenants SET monthPaid = '$monthPaid' WHERE house_no = '$house_no'";
                                                    $result = $conn->query($sql);

                                                    if($amount < $rent){
                                                        $balance -= $amount;
                                                    }
                                                    else if($amount >= $rent){
                                                        if($amount < $overallRent){
                                                            $balance = $overallRent - $amount;
                                                        }
                                                        else if($amount >= $overallRent){
                                                            $credits = $amount - $overallRent;
                                                            $balance = 0;
                                                        }
                                                        
                                                    }
                                                    // echo "$amount paid <br>"; 
                                                }
                                                if($balance > 0){
                                                    $payment = "UNPAID";
                                                    
                                                }
                                                else{
                                                    $payment = "PAID";
                                                }
                                            ?>
                                            

                                            <div class="flex sm:w-[30%] flex-col">
                                                <p class="font-bold text-nowrap">Balance: <span class="text-xl ml-1 font-normal">₱<?php echo $balance ?></span></p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-col sm:flex-row mt-5 items-center sm:items-start">
                                            <div class="flex sm:w-[70%] flex-col">
                                                <p class="font-bold text-nowrap">Start Date: <span class="text-xl ml-1 font-normal"><?php echo date("F j, Y", strtotime($startDate)); ?></span></p>
                                            </div>
                                            <div class="flex sm:w-[30%] flex-col">
                                                <p class="font-bold text-nowrap">Credits: <span class="text-xl ml-1 font-normal">₱<?php echo $credits ?></span></p>
                                            </div>
                                            
                                        </div>
                                        <div class="flex flex-col sm:flex-row mt-5 items-center sm:items-start">
                                            <div class="flex sm:w-[70%] flex-col">
                                                <p class="font-bold text-nowrap">House Rent: <span class="text-xl ml-1 font-normal">₱<?php echo $rent ?></span></p>
                                            </div>
                                            <div class="flex sm:w-[30%] flex-col">
                                                <p class="font-bold text-nowrap">Status: 
                                                    <?php
                                                        if($payment == "PAID"){
                                                            echo "<span class='text-xl ml-1 text-green-500 font-bold'>$payment</span>";
                                                        }
                                                        else if($payment == "UNPAID"){
                                                            echo "<span class='text-xl ml-1 text-red-600 font-bold'>$payment</span>";
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-5 flex-col pb-16 sm:flex-row items-center md:gap-14 sm:mt-12 mt-0 w-full justify-center">
                                    
                                    <a target="_blank" href="../PhpCodes/contractPDF.php?house_no=<?php echo $house_no; ?>"><button class="bg-[#838383] order-2 sm:order-2 hover:bg-[#969696] active:bg-[#727272] duration-150 text-sm w-44 py-2 text-white font-bold">VIEW CONTRACT</button></a>
                                    <button type="button" onclick="openHistory()" class="bg-[#527920] order-1 sm:order-3 hover:bg-[#729445] duration-150 text-sm w-44 py-2 active:bg-[#5a7535] text-white font-bold">PAYMENT HISTORY</button>
                                </div>
                            </div>

                            <!-- PAYEMNT HISTORY -->
                            <div class="w-full h-full overflow-hidden absolute top-0 right-0 bg-white hidden" id="paymentHistory">
                                <button onclick="closeHistory()"><img src="../icons/back.svg" class="w-14 active:bg-[#b6b6b6] -ml-1 lg:ml-0 cursor-pointer rounded-full duration-150 hover:bg-[#D9D9D9] p-2" alt=""></button>
                                <div class="flex flex-col justify-center items-center w-full text-[#527920] tracking-widest">
                                    <h1 class="text-2xl sm:text-3xl font-bold tracking-wider">Payment History</h1>
                                    <img src="../icons/payment.svg" class="w-14 sm:w-20 mt-5" alt="">
                                </div>
                                <form action="" class="mt-7 sm:mt-5 text-sm sm:text-base max-w-[60rem] mx-auto" method="GET">
                                    <div class="flex justify-end items-center gap-2 sm:gap-3 mt-2">
                                        <input type="text" id="name" autocomplete="off" onkeyup="myFunction()" class="border-2 mr-1 outline-none border-[#527920] py-[3px] pl-[8px] w-52 sm:w-72" placeholder="Enter Month..." type="text">
                                    
                                    </div>

                                    <!-- TABLE -->
                                    <table class="w-full text-left h-full mt-3" id="myTable">
                                        <tr class="bg-[#527920] h-8 text-white">
                                            <th class="hidden">ID</th>
                                            <th class="px-2 py-1 text-xs sm:text-base border-white font-medium">ID</th>
                                            <th class="px-2 py-1 text-xs sm:text-base border-l-2 border-white font-medium">Date Paid</th>
                                            <th class="px-2 py-1 text-xs sm:text-base border-l-2 border-white font-medium"><span class="sm:hidden">MOP</span><span class="hidden sm:block">Mode of Payment</span></th>
                                            <th class="px-2 py-1 text-xs sm:text-base border-l-2 border-white font-medium">Amount</th>
                                        </tr>
                                        <?php
                                            $sql = "SELECT * FROM payment WHERE MOP != '*deposit' AND house_no ='$house_no' ORDER BY transaction_id DESC";
                                            $result = $conn->query($sql);

                                            while($row=$result->fetch_assoc()){
                                                $default = strtotime($row["datePaid"]);
                                                $date = date('F d, Y', $default);
                                                $time = date('h:i A', $default);
                                                
                                                
                                                echo"
                                                    <tr>
                                                        <td name='trans_id' class='px-2 border-r-2 border-white h-10  text-xs sm:text-base border-b-2 text-black bg-[#DADADA] py-1'>$row[transaction_id]</td>
                                                        <td name='datePaid' class='px-2 border-r-2 border-white text-xs sm:text-base duration-150 h-10 border-b-2 text-black bg-[#DADADA] py-1'>$date / $time</td>
                                                        <td name='MOP' class='px-2 border-r-2 border-white h-10 text-xs sm:text-base border-b-2 text-black bg-[#DADADA] py-1'>$row[MOP]</td>
                                                        <td name='amount' class='px-2 border-white text-xs sm:text-base h-10 border-b-2 text-black bg-[#DADADA] py-1'>$row[amount]</td>
                                                        
                                                    </tr>";
                                            }
                                        ?>
                                    </table>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <footer class="bg-[#ABCF7E] w-full justify-center fixed left-0 lg:left-36 bottom-0 h-10 flex shrink-0 items-center">
                    <p id="time" class="text-[#527920]"></p>
                </footer>
            </main>
        </div>
    </div>
    <script>
        let paymentHistory = document.getElementById("paymentHistory");
        function openHistory() {
            paymentHistory.style.display = "block";
        }
        function closeHistory() {
            paymentHistory.style.display = "none";
        }

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