<?php
    include("../PhpCodes/connection.php");
    
    session_start();
    if(!isset($_SESSION['role'])){
        header("Location: ../index.php");
    }

    // QUERIES 

    $units = "SELECT * FROM houses";
    $noUnits = $conn->query($units);

    $rented = "SELECT * FROM houses WHERE status = 'occupied'";
    $noOccupied = $conn->query($rented);

    $available = "SELECT * FROM houses WHERE status = 'unoccupied'";
    $noAvailable = $conn->query($available);

    $tenants = "SELECT * FROM tenants";
    $noTenants = $conn->query($tenants);

    
    $totalUnits = $noUnits->num_rows;
    $rentedUnits = $noOccupied->num_rows;
    $availableUnits = $noAvailable->num_rows;
    $allTenants = 0;
    $earnings = 0;
    
    
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
                <a href="dashboard.php" class="py-4 bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
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
                <a href="account.php" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
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
                <a href="dashboard.php" class="py-4 my-2 justify-center bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full">
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
                <a href="account.php" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
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

            <?php
                include("../PhpCodes/unpaid.php");
            ?>

            <!-- MAIN CONTENT -->
            <main class="relative w-full lg:pl-72 mt-24 pb-20 text-[#527920] tracking-wide">
                <div class="mx-7 mt-7 select-none">
                    
                    <h1 class="text-3xl text-[#527920] font-bold tracking-wider mb-14 lg:mb-20">Dashboard</h1>
                    
                    <?php
                        
                        $currYear = date("Y");
                        $currMonth = date("m");

                        $sql = ("SELECT datePaid, amount FROM payment WHERE YEAR(datePaid) = ? AND MONTH(datePaid) = ? AND MOP != '*deposit' AND MOP != '*adjust'");
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ii", $currYear, $currMonth);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result === false) {
                            echo "Error: " . $conn->error;
                        } else {
                            // Process the result
                            while ($row = $result->fetch_assoc()) {
                                $earnings += $row['amount'];
                            }
                        }

                        
                    ?>

                    <div class="grid xl:grid-cols-3 md:grid-cols-2 w-full gap-7 text-[#527920]">
                        <div class="bg-[#D9D9D9] relative w-full">
                            <div class="p-4 pt-7">
                                <h1 class="text-5xl font-bold mt-5"><?php echo $totalUnits; ?></h1>
                                <p class="font-semibold mt-1">Total Units</p>
                                <img class="absolute top-5 w-16 right-5" src="../icons/house-dashboard.png" alt="">
                            </div>
                            <div class="py-2 flex justify-center items-center bg-[#527920]"></div>
                        </div>
                        <div class="bg-[#D9D9D9] relative w-full">
                            <div class="p-4 pt-7">
                                <h1 class="text-5xl font-bold mt-5"><?php echo $rentedUnits; ?></h1>
                                <p class="font-semibold mt-1">Rented Units</p>
                                <img class="absolute top-5 w-16 right-5" src="../icons/key.png" alt="">
                            </div>
                            <div class="py-2 flex justify-center items-center bg-[#527920]"></div>
                        </div>
                        <div class="bg-[#D9D9D9] relative w-full">
                            <div class="p-4 pt-7">
                                <h1 class="text-5xl font-bold mt-5"><?php echo $availableUnits; ?></h1>
                                <p class="font-semibold mt-1">Available Units</p>
                                <img class="absolute top-5 w-16 right-5" src="../icons/available.png" alt="">
                            </div>
                            <div class="py-2 flex justify-center items-center bg-[#527920]"></div>
                        </div>
                        <div class="bg-[#D9D9D9] relative w-full">
                            <div class="p-4 pt-7">
                                <h1 class="text-5xl font-bold mt-5"><?php 
                                    while($row=$noTenants->fetch_assoc()){
                                        $allTenants += $row['occupants'];
                                    }
                                    echo $allTenants;
                                ?></h1>
                                <p class="font-semibold mt-1">All Tenants</p>
                                <img class="absolute top-5 w-16 right-5" src="../icons/all-tenants.png" alt="">
                            </div>
                            <div class="py-2 flex justify-center items-center bg-[#527920]"></div>
                        </div>
                        <div class="bg-[#D9D9D9] relative w-full">
                            <div class="p-4 pt-7">
                                <h1 class="text-4xl font-bold mt-5 tracking-tight pt-2">₱<?php echo $earnings ?></h1>
                                <p class="font-semibold mt-1">Monthly Earnings</p>
                                <img class="absolute top-5 w-16 right-5" src="../icons/earning.png" alt="">
                            </div>
                            <div class="py-2 flex justify-center items-center bg-[#527920]"></div>
                        </div>
                        <div class="bg-[#D9D9D9] relative w-full">
                            <div class="p-4 pt-7">
                                <h1 class="text-5xl font-bold mt-5"><?php echo $paid ?></h1>
                                <p class="font-semibold mt-1">Duedates</p>
                                <img class="absolute top-5 w-16 right-5" src="../icons/duedate.png" alt="">
                            </div>
                            <div class="py-2 flex justify-center items-center bg-[#527920]"></div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- FOOTER -->
            <footer class="bg-[#ABCF7E] w-full justify-center fixed left-0 lg:left-36 bottom-0 h-10 flex shrink-0 items-center">
                <p id="time" class="text-[#527920]"></p>
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


