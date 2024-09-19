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

        <nav id="navlink" class="bg-[#81A94E] flex left-[-65rem] z-20 lg:hidden duration-500 top-0 h-[100vh] fixed shrink-0 w-full">
            
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
                        <div class="pt-3 flex justify-between mt-7 sm:mt-5 items-center">
                            <!-- ADD UNIT -->
                            <div onclick="openUnit()" class="p-2 rounded-full hover:bg-[#D9D9D9] active:bg-[#b6b6b6] cursor-pointer duration-300">
                                <img class="sm:w-10 w-9" src="../icons/add.png" alt="">
                            </div>

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
                                                    <a href='../PhpCodes/houseInfo.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                    </div>";
                                                }
                                                else if($row['status'] == "occupied"){
                                                    echo "<div class='bg-[#D9D9D9]  justify-center flex flex-col items-center py-3 pt-4'>
                                                    <p class='mb-2'>House $row[house_no]</p>
                                                    <img class='sm:w-20 w-16' src='../icons/occupied.svg'>
                                                    <a href='../PhpCodes/houseInfo.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
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
                                                    <a href='../PhpCodes/houseInfo.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                    </div>";
                                                }
                                                else if($row['status'] == "occupied"){
                                                    echo "<div class='bg-[#D9D9D9]  justify-center flex flex-col items-center py-3 pt-4'>
                                                    <p class='mb-2'>House $row[house_no]</p>
                                                    <img class='sm:w-20 w-16' src='../icons/occupied.svg'>
                                                    <a href='../PhpCodes/houseInfo.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
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
                                                    <a href='../PhpCodes/houseInfo.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                    </div>";
                                                }
                                                else if($row['status'] == "occupied"){
                                                    echo "<div class='bg-[#D9D9D9]  justify-center flex flex-col items-center py-3 pt-4'>
                                                    <p class='mb-2'>House $row[house_no]</p>
                                                    <img class='sm:w-20 w-16' src='../icons/occupied.svg'>
                                                    <a href='../PhpCodes/houseInfo.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
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
                                                <a href='../PhpCodes/houseInfo.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
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
                                                    <a href='../PhpCodes/houseInfo.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                    </div>";
                                                }
                                                else{
                                                    echo "<div class='bg-[#D9D9D9] relative justify-center flex flex-col items-center py-3 pt-4'>
                                                    <p class='mb-2'>House $row[house_no]</p>
                                                    <img class='sm:w-20 w-16' src='../icons/occupied.svg'>
                                                    <a href='../PhpCodes/houseInfo.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                    </div>";
                                                }
                                               
                                                  
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </form>
                

                    <!-- ADD UNIT UI -->
                    <div class="absolute top-0 px-7 hidden left-0 bg-white w-full h-full" id="addUnit">
                        <div class="select-none  text-[#527920]">
                            <img src="../icons/back.svg" onclick="closeUnit()" class="w-14 cursor-pointer -ml-2 lg:ml-0 active:bg-[#b6b6b6] rounded-full duration-150 hover:bg-[#D9D9D9] p-2" alt="">

                            <div class="flex flex-col justify-center sm:mt-10 items-center">
                                <div class="w-full flex flex-col items-center">
                                    <h1 class="text-3xl font-bold">Add New Unit</h1> 
                                    <img src="../icons/house-dashboard.png" class="sm:w-20 w-16 mt-5" alt="">
                                </div>

                                <!-- FORM -->
                                <form action="../PhpCodes/addUnit.php" method="POST" class="sm:px-16 flex flex-col justify-center w-full items-center sm:mt-10 mt-14">
                                    <div class="pb-14 ">
                                        <div class="flex justify-start">
                                            <div class="flex w-full flex-col">
                                                <label class="font-bold text-sm sm:text-base">House No:</label>
                                                <input autocomplete="off" required name="house_no" placeholder="Enter No" class="bg-[#D9D9D9] py-2 pl-3 outline-none text-sm sm:text-base sm:w-36 w-24" type="number">
                                            </div>
                                            <!-- <div class="flex flex-col whitespace-nowrap w-[12.5rem] sm:w-[14rem]">
                                                <label class="font-bold text-sm sm:text-base">Upload Images:</label>
                                                <div class="flex border-2 items-center relative border-[#527920]">
                                                    <label id="custom-button" class="font-bold absolute bottom-0 sm:px-2 left-0 sm:text-sm text-xs text-center py-[8px] px-[13px] duration-150 cursor-pointer text-white bg-[#527920]">Choose File</label>
                                                    <input id="fileImg[]" name="fileImg[]" accept=".jpg, .jpeg, .png" class="text-sm pl-0 sm:pl-[2px] py-[3px] sm:py-[5px] w-[12.5rem] sm:w-[14rem]" multiple type="file">
                                                </div>
                                                
                                            </div> -->
                                        </div>
                                        <div class="flex mt-5">
                                            <div class="flex w-full flex-col text-sm sm:text-base">
                                                <label class="font-bold">Full Address:</label>
                                                <input autocomplete="off" required name="fulladdress" placeholder="Enter Address" class="bg-[#D9D9D9] py-2 pl-3 outline-none w-full" type="text">
                                            </div>
                                        </div>

                                        <div class="flex gap-4 md:gap-7 mt-5">
                                            <div class="flex flex-col text-sm sm:text-base">
                                                <label class="font-bold">No. of Room/s:</label>
                                                <input autocomplete="off" min="0" required name="noRoom" placeholder="Enter Number" class="bg-[#D9D9D9] py-2 pl-3 outline-none w-full md:w-80" type="number">
                                            </div>
                                            <div class="flex flex-col text-sm sm:text-base">
                                                <label class="font-bold">No. of Bathroom/s:</label>
                                                <input autocomplete="off" min="0" required name="noBathroom" placeholder="Enter Number" class="bg-[#D9D9D9] py-2 pl-3 outline-none w-full md:w-64" type="number">
                                            </div>
                                        </div>

                                        <div class="flex gap-4 md:gap-7 mt-5 w-full">
                                            <div class="flex flex-col text-sm sm:text-base">
                                                <label class="font-bold">No. of Floor/s:</label>
                                                <input autocomplete="off" min="0" required name="noFloor" placeholder="Enter Number" class="bg-[#D9D9D9] py-2 pl-3 outline-none w-full md:w-72" type="number">
                                            </div>
                                            <div class="flex flex-col text-sm sm:text-base">
                                                <label class="font-bold">Rent Amount:</label>
                                                <input autocomplete="off" min="0" required name="rent" placeholder="Enter Amount" class="bg-[#D9D9D9] py-2 pl-3 outline-none w-full md:w-72" type="number">
                                            </div>
                                        </div>
                                        <div class="flex gap-7 mt-12 w-full justify-center">
                                            <button type="submit" name="submit" class="bg-[#527920] hover:bg-[#729445] active:bg-[#5a7535] duration-150 text-sm px-6 py-2 text-white font-bold">ADD UNIT</button>
                                        </div>
                                    </div>
                                </form>
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
        // TIME
        let today = new Date();
        let currTime = today.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
        document.getElementById("time").textContent = currTime;

    </script>
</body>
</html>