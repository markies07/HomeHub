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

    if($house_no != $_SESSION['house_no']){
        header("Location: tenant.php?house_no=$house_no");
    }

    $get = "SELECT * FROM tenants WHERE house_no = '$house_no'";
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
                <a href="tenant.php?house_no=<?php echo $house_no ?>" class="bg-[#54683A] py-4 duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/dash.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Tenant Dashboard</p>
                </a>
                <a href="info.php?house_no=<?php echo $house_no ?>" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
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
                <a href="tenant.php?house_no=<?php echo $house_no ?>" class="py-4 my-2 justify-center bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-10 select-none pointer-events-none" src="../icons/dash.png" alt="">
                        <p class="ml-4 select-none pointer-events-none">Tenant Dashboard</p>
                    </div>    
                </a>
                <a href="info.php?house_no=<?php echo $house_no ?>" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
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
                                echo "<p class='absolute right-[9rem] py-[3px] px-[9px] rounded-md bg-[#db5d5d]'>$count</p>";
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

            <?php
                $dateNow = new DateTime();
                $startDate = $row['startDate'];
                $datePass = new DateTime($startDate);


                $diff = $dateNow->diff($datePass);
                $monthCount = (($diff->y) * 12) + ($diff->m);

            ?>
            <!-- MAIN CONTENT -->
            <main class="relative w-full lg:pl-72 mt-24 pb-20 text-[#527920] tracking-wide">
                <div class="mx-7 mt-7 select-none">
                    <h1 class="text-3xl text-[#527920] font-bold tracking-wider mb-14 lg:mb-20">House <?php echo $row['house_no'] ?></h1>
                    <div class="grid xl:grid-cols-3 md:grid-cols-2 w-full gap-7 text-[#527920]">
                        <div class="bg-[#D9D9D9] relative w-full">
                            <div class="p-5">
                                <h1 class="text-5xl font-bold mt-5"><?php echo $monthCount ?></h1>
                                <p class="font-semibold mt-1">Months of Staying</p>
                                <img class="absolute top-5 w-[4.3rem] right-5" src="../icons/stay.svg" alt="">
                            </div>
                            <div class="py-3 flex justify-center h-5 bg-[#527920]"></div>
                        </div>
                        
                        <div class="bg-[#D9D9D9] relative w-full">
                            <div class="p-5">
                                <h1 class="text-4xl font-bold mt-5 tracking-tight pt-2">₱<?php echo $row['rent'] ?></h1>
                                <p class="font-semibold mt-1">Monthly Rent</p>
                                <img class="absolute top-5 w-[4.5rem] right-5" src="../icons/rent.svg" alt="">
                            </div>
                            <div class="py-3 flex justify-center h-5 bg-[#527920]"></div>
                        </div>
                        <div class="bg-[#D9D9D9] relative w-full">
                            <div class="p-5">
                                <?php
                                    if($rows['status'] == "PAID"){
                                        echo "<h1 class='text-5xl text-green-500 font-bold mt-5'>$rows[status]</h1>";
                                    }
                                    else if($rows['status'] == "UNPAID"){
                                        echo "<h1 class='text-5xl text-red-700 font-bold mt-5'>$rows[status]</h1>";
                                    }

                                ?>
                                
                                <p class="font-semibold mt-1">Status</p>
                                <img class="absolute top-5 w-[4.3rem] right-5" src="../icons/status.svg" alt="">
                            </div>
                            <div class="py-3 flex justify-center h-5 bg-[#527920]"></div>
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