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
                
                <a href="units.php" class="py-4 bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
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
                
            </div>
        </nav>

        <nav id="navlink" class="bg-[#81A94E] flex left-[-65rem] z-20 lg:hidden duration-500 top-0 h-[100vh] fixed shrink-0 w-full">
            
            <!-- MENU -->
            <div class="w-full text-white flex tracking-wider mt-5 flex-col items-center">
                <div class="p-1 -ml-1 self-end mr-5 hover:bg-[#67922e] active:bg-[#5d8528] cursor-pointer duration-150 rounded-2xl">
                    <img onclick="closeMenu()" src="../icons/close.svg" class="w-10" alt="">
                </div>
                <h1 class="text-3xl font-medium tracking-widest py-7 select-none">Menu</h1>
                
                <a href="units.php" class="py-4 my-2 justify-center bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full">
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
            <main class="relative w-full lg:pl-72 mt-24 pb-14 text-[#527920] tracking-wide">
                <div class="px-7 mt-7 relative select-none">
                    <div class="flex justify-between h-14 items-start text-[#527920] font-medium tracking-widest">
                        <h1 class="text-3xl font-bold tracking-wider mb-20">Units</h1>
                        
                        <div class="flex sm:gap-10 gap-5 mt-10 sm:m-5">
                            <div class="flex">
                                <p class="self-end text-sm sm:text-base mr-1">Occupied</p>
                                <img class="w-10 sm:w-16 sm:h-[3rem]" src="../icons/occupied.svg" alt="">
                            </div>
                            <div class="flex">
                                <p class="self-end text-sm sm:text-base mr-1">Available</p>
                                <img class="w-10 sm:w-16 sm:h-[3rem] " src="../icons/unoccupied.svg" alt="">
                            </div>
                        </div>
                    </div>
                    
                    <form action="" method="GET">
                        <div class="pt-5 flex justify-end mt-7 mb-3 sm:mt-5 items-center">
                            <!-- SORT -->
                            <div class="flex">
                                <select name="sort" class="border-[#527920] sm:text-sm text-xs self-end w-32 pt-[2.5px] pb-[4.5px] pl-1 outline-none font-medium text-[#527920] border-2">
                                    <option value="All Units" <?php if(isset($_GET['sort']) && $_GET['sort'] == "All Units"){echo "selected";} ?>>All Units</option>
                                    <option value="Occupied" <?php if(isset($_GET['sort']) && $_GET['sort'] == "Occupied"){echo "selected";} ?> >Occupied</option>
                                    <option value="Available" <?php if(isset($_GET['sort']) && $_GET['sort'] == "Available"){echo "selected";} ?>>Available</option>
                                </select>
                                <button type="submit" class="bg-[#527920] text-sm sm:text-base text-white px-3 p-1 active:bg-[#5a7535] duration-150 hover:bg-[#68883e]">Show</button>
                            </div>
                            
                        </div>

                        <!-- HOUSES -->
                        <div class="w-full flex justify-center items-center">
                            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 w-full sm:gap-7 gap-4">
                                <?php 
                                    
                                    include("../PhpCodes/unpaid.php");
                                
                                    if(isset($_GET['sort'])){
                                        if($_GET['sort'] == "All Units"){
                                            $sql = "SELECT * FROM houses";
                                            $result = $conn->query($sql);
                                            
                                            while($row=$result->fetch_assoc()){
                                                if($row['status'] == "unoccupied"){
                                                    echo "<div class='bg-[#D9D9D9]  justify-center flex flex-col items-center py-3 pt-4'>
                                                    <p class='mb-2'>House $row[house_no]</p>
                                                    <img class='sm:w-20 w-16' src='../icons/unoccupied.svg'>
                                                    <a href='../PhpCodes/houseInfoAdmin.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                    </div>";
                                                }
                                                else if($row['status'] == "occupied"){
                                                    echo "<div class='bg-[#D9D9D9]  justify-center flex flex-col items-center py-3 pt-4'>
                                                    <p class='mb-2'>House $row[house_no]</p>
                                                    <img class='sm:w-20 w-16' src='../icons/occupied.svg'>
                                                    <a href='../PhpCodes/houseInfoAdmin.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                    </div>";
                                                }
                                            }
                                        }
                                        else if($_GET['sort'] == "Occupied"){
                                            $sql = "SELECT * FROM houses WHERE status = 'occupied'";
                                            $result = $conn->query($sql);
                                            
                                            while($row=$result->fetch_assoc()){
                                                if($row['status'] == "unoccupied"){
                                                    echo "<div class='bg-[#D9D9D9]  justify-center flex flex-col items-center py-3 pt-4'>
                                                    <p class='mb-2'>House $row[house_no]</p>
                                                    <img class='sm:w-20 w-16' src='../icons/unoccupied.svg'>
                                                    <a href='../PhpCodes/houseInfoAdmin.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                    </div>";
                                                }
                                                else if($row['status'] == "occupied"){
                                                    echo "<div class='bg-[#D9D9D9]  justify-center flex flex-col items-center py-3 pt-4'>
                                                    <p class='mb-2'>House $row[house_no]</p>
                                                    <img class='sm:w-20 w-16' src='../icons/occupied.svg'>
                                                    <a href='../PhpCodes/houseInfoAdmin.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                    </div>";
                                                }
                                            }
                                        }
                                        else if($_GET['sort'] == "Available"){
                                            $sql = "SELECT * FROM houses WHERE status = 'unoccupied'";
                                            $result = $conn->query($sql);
                                            
                                            while($row=$result->fetch_assoc()){
                                                if($row['status'] == "unoccupied"){
                                                    echo "<div class='bg-[#D9D9D9]  justify-center flex flex-col items-center py-3 pt-4'>
                                                    <p class='mb-2'>House $row[house_no]</p>
                                                    <img class='sm:w-20 w-16' src='../icons/unoccupied.svg'>
                                                    <a href='../PhpCodes/houseInfoAdmin.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                    </div>";
                                                }
                                                else if($row['status'] == "occupied"){
                                                    echo "<div class='bg-[#D9D9D9]  justify-center flex flex-col items-center py-3 pt-4'>
                                                    <p class='mb-2'>House $row[house_no]</p>
                                                    <img class='sm:w-20 w-16' src='../icons/occupied.svg'>
                                                    <a href='../PhpCodes/houseInfoAdmin.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                    </div>";
                                                }
                                            }
                                        }
                                    }
                                    else{
                                        $sql = "SELECT * FROM houses";
                                        $result = $conn->query($sql);
                                        
                                        
                                        while($row=$result->fetch_assoc()){
                                            if($row['status'] == "unoccupied"){
                                                echo "<div class='bg-[#D9D9D9]  justify-center flex flex-col items-center py-3 pt-4'>
                                                <p class='mb-2'>House $row[house_no]</p>
                                                <img class='sm:w-20 w-16' src='../icons/unoccupied.svg'>
                                                <a href='../PhpCodes/houseInfoAdmin.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                </div>";
                                            }
                                            else if($row['status'] == "occupied"){
                                                $sql2 = "SELECT * FROM tenants WHERE house_no = $row[house_no]";
                                                $result2 = $conn->query($sql2);
                                                $row2 = $result2->fetch_assoc();

                                                if($row2['status'] == 'UNPAID'){
                                                    echo "<div class='bg-[#D9D9D9] relative justify-center flex flex-col items-center py-3 pt-4'>
                                                    <div class='absolute w-5 h-5 bg-[#CC4444] top-2 right-2 rounded-full'></div>
                                                    <p class='mb-2'>House $row[house_no]</p>
                                                    <img class='sm:w-20 w-16' src='../icons/occupied.svg'>
                                                    <a href='../PhpCodes/houseInfoAdmin.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                    </div>";
                                                }
                                                else{
                                                    echo "<div class='bg-[#D9D9D9] relative justify-center flex flex-col items-center py-3 pt-4'>
                                                    <p class='mb-2'>House $row[house_no]</p>
                                                    <img class='sm:w-20 w-16' src='../icons/occupied.svg'>
                                                    <a href='../PhpCodes/houseInfoAdmin.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                    </div>";
                                                }
                                               
                                                  
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </form>
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
        // TIME
        let today = new Date();
        let currTime = today.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
        document.getElementById("time").textContent = currTime;

    </script>
</body>
</html>