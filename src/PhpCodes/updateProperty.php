<?php 
    include("connection.php");
    session_start();

    
    
        
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <link rel="icon" type="image/x-icon" href="../img/homehub-icon.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>HomeHub</title>
</head>
<body>
    <div class="flex relative">   
        <nav class="bg-[#81A94E] z-30 fixed hidden duration-150 h-full lg:block shrink-0 w-[18rem] lg:h-[100vh] ">
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
                <a href="../SuperAdmin/units.php" class="py-4 bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/units.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Units Information</p>
                </a>
                <a href="../SuperAdmin/tenants.php" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/tenants.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Tenants Information</p>
                </a>
                <a href="../SuperAdmin/payment.php" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
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

        <nav id="navlink" class="bg-[#81A94E] flex left-[-65rem] z-30 lg:hidden duration-500 top-0 h-full fixed shrink-0 w-full">
            
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
                <a href="../SuperAdmin/units.php" class="py-4 my-2 justify-center bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full">
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
                <a href="../SuperAdmin/payment.php" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
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
                    <div class="flex items-center w-64">
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
           <div class="flex px-7 fixed bg-[#ABCF7E] left-0 top-0 shrink-0 w-full h-24 items-center justify-between z-20">
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
                <div class="mx-5 h-full mt-7 relative select-none">

                <?php
                    $house_no = $_GET["house_no"];

                    
                    $sql = "SELECT * FROM houses WHERE house_no = $house_no";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                
                
                    $fulladdress = $row["fulladdress"];
                    $noRoom = $row["noRoom"];
                    $noFloor = $row["noFloor"];
                    $noBathroom = $row["noBathroom"];
                    $rent = $row["rent"];
                
                    if(isset($_POST['submit'])){
                        $fulladdress = $_POST["fulladdress"];
                        $noRoom = $_POST["noRoom"];
                        $noFloor = $_POST["noFloor"];
                        $noBathroom = $_POST["noBathroom"];
                        $rent = $_POST["rent"];


                        $sql = "UPDATE houses SET fulladdress = '$fulladdress', noRoom = '$noRoom', noFloor = '$noFloor', noBathroom = '$noBathroom', rent = '$rent' WHERE house_no = '$house_no'";
                
                        try{
                            $conn->query($sql);
                            echo "<script>
                            window.location.href = 'houseInfo.php?house_no=$house_no';
                            alert('Update Successfully!');
                            </script>";
                        }
                        catch(mysqli_sql_exception){
                            echo "<script>
                            window.location.href = 'houseInfo.php?house_no=$house_no';
                            alert('Update Failed!');
                            </script>";
                        }
                    }
                    
                ?>
                    <!-- EDIT PROPERTY -->
                    <div id="editHouse" class="w-full h-full flex flex-col">
                        <a href="houseInfo.php?house_no=<?php echo $house_no; ?>"><img src="../icons/back.svg" class="hover:bg-[#D9D9D9] p-2 rounded-full duration-200 cursor-pointer self-start w-14" alt=""></a>
                        <div class="w-full flex flex-col justify-center items-center h-full relative">
                            <div class="w-full flex flex-col items-center">
                                <h1 class="text-3xl font-bold">Edit Property</h1> 
                                <p class="mt-5 font-medium">House <?php echo $house_no; ?></p>
                                <img src="../icons/houseSet.svg" class="sm:w-20 w-16" alt="">
                            </div>
                            <!-- FORM -->
                            <form action="" method="POST" class=" flex flex-col px-7 sm:px-10 items-center w-full mt-5 sm:mt-10 ">
                                <div class="w-full flex flex-col gap-5 mt-7 sm:mt-0 md:max-w-[45rem]">
                                    
                                    <div class="flex w-full flex-col gap-5">
                                        <div class="flex flex-col w-full">
                                            <input type="hidden" name="house_no" value="<?php echo $house_no; ?>">
                                            <label class="font-bold">Full Address:</label>
                                            <input name="fulladdress" value="<?php echo $fulladdress; ?>" class="bg-[#D9D9D9] py-2 pl-3 outline-none w-full" type="text">
                                        </div> 
                                        <div class="flex flex-col w-full sm:hidden">
                                            <label class="font-bold">House Rent:</label>
                                            <input name="rent" value="<?php echo $rent; ?>" class="bg-[#D9D9D9] py-2 pl-3 outline-none w-[60%]" type="text">
                                        </div> 
                                    </div>
                                    <div class="flex flex-col sm:flex-row gap-5 w-full">
                                        <div class="flex w-full flex-col">
                                            <label class="font-bold">No. of Room/s:</label>
                                            <input name="noRoom" value="<?php echo $noRoom; ?>"class="bg-[#D9D9D9] w-[40%] py-2 pl-3 outline-none sm:w-full" type="text">
                                        </div>
                                        <div class="flex w-full flex-col">
                                            <label class="font-bold">No. of Floor/s:</label>
                                            <input name="noFloor" value="<?php echo $noFloor; ?>" class="bg-[#D9D9D9] w-[40%] py-2 pl-3 outline-none sm:w-full" type="text">
                                        </div>
                                        <div class="flex w-full flex-col">
                                            <label class="font-bold">No. of Bathroom/s:</label>
                                            <input name="noBathroom" value="<?php echo $noBathroom; ?>" class="bg-[#D9D9D9] w-[40%] py-2 pl-3 outline-none sm:w-full" type="text">
                                        </div>
                                    </div>
                                    <div class="w-full flex-col hidden sm:block gap-5">
                                        <div class="flex flex-col w-full">
                                            <label class="font-bold">House Rent:</label>
                                            <input name="rent" value="<?php echo $rent; ?>" class="bg-[#D9D9D9] py-2 pl-3 outline-none w-[60%]" type="text">
                                        </div> 
                                    </div>
                                    <div class="flex mt-10 pb-16 w-full justify-center">
                                        <a href="updateProperty.php"><button onclick=" javascript:return confirm('Are you sure you want to update this property?');" type="submit" name="submit" class="bg-[#527920] hover:bg-[#71a232] active:bg-[#547b21] duration-150 text-sm px-6 py-2 text-white font-bold">SAVE</button></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                            

                <!-- FOOTER -->
                <footer class="bg-[#ABCF7E] w-full justify-center fixed left-0 lg:left-36 bottom-0 h-10 flex shrink-0 items-center">
                    <p id="time" class="text-[#527920] "></p>
                </footer>

            </main>
        </div>
    </div>
    <script src="../app.js"></script>
    <script>
        // TIME
        let today = new Date();
        let currTime = today.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
        document.getElementById("time").textContent = currTime;
    </script>
</body>
</html>