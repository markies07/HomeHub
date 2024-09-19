<?php 
    include("connection.php");
    session_start();
    $house_no = "";
    $fulladdress = "";
    $noRoom = "";
    $noBathroom = "";
    $noFloor = "";
    $rent = "";
    

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

    // ADDING TENANT
    if(isset($_POST['submit'])){
        $house_no = $_POST['house_no'];
        $fullname = $_POST['fullname'];
        $contact = $_POST['contact'];
        $deposit = $_POST['deposit'];
        $occupants = $_POST['occupants'];

        $sql = "SELECT * FROM houses WHERE house_no = $house_no";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $sql2 = "SELECT * FROM tenants WHERE fullname = '$fullname'";
        $result2 = $conn->query($sql2);
        if($result2->num_rows > 0){
            echo"<script>
                    window.location.href = 'houseInfo.php?house_no=$house_no';
                    alert('Could Not Add Tenant: This tenant already exist');
                </script>";
        }
        else{
            if($deposit == 0 || $deposit >= $row['rent']){
                $add = "INSERT INTO tenants (house_no, fullname, contact, occupants, deposit) 
                VALUES ('$house_no', '$fullname', '$contact', '$occupants', '$deposit')";
    
                $update = "UPDATE houses SET status = 'occupied' WHERE house_no = '$house_no'";
    
                $addDeposit = "INSERT INTO payment (house_no, fullname, MOP, amount) VALUES ('$house_no', '$fullname', '*deposit', '$deposit');";
    
                try{
                    mysqli_query($conn, $addDeposit);
                    mysqli_query($conn, $add);
                    $conn->query($update);
                    echo "<script>
                        window.location.href = 'houseInfo.php?house_no=$house_no';
                        alert('Tenant Added Successfully!');
                    </script>";
                }
                catch(mysqli_sql_exception){
                    echo"<script>
                        window.location.href = 'houseInfo.php?house_no=$house_no';
                        alert('Could Not Add Tenant!');
                    </script>";
                }
            } 
            else{
                echo"<script>
                        window.location.href = 'houseInfo.php?house_no=$house_no';
                        alert('Adding Tenant Failed: Deposit should not less than rent');
                    </script>";
            }

        }
    }
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
            <nav class="bg-[#81A94E] z-50 fixed hidden duration-150 h-full lg:block shrink-0 w-[18rem] lg:h-[100vh] ">
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
                        <div class="flex relative items-center w-64">
                            <img class="w-10 select-none pointer-events-none" src="../icons/chat.svg" alt="">
                            <p class="ml-5 select-none pointer-events-none">Message Inbox</p>
                            <?php
                                include("../PhpCodes/unread.php");
                                if($count > 0){
                                    echo "<p class='absolute right-5 py-[3px]  px-[9px] rounded-md bg-[#db5d5d]'>$count</p>";
                                }
                            ?>
                        </div> 
                    </a>
                </div>
            </nav>

            <div class="w-full flex flex-col items-center h-[100vh] relative">
                <!-- HEADER -->
                <div class="flex px-7 fixed z-20 bg-[#ABCF7E] left-0 top-0 shrink-0 w-full h-24 items-center justify-between">
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
                <main class="relative w-full h-full lg:pl-72 mt-24 pb-7 text-[#527920] tracking-wide">
                    <div class="mx-5 sm:mx-7 h-full mt-7 relative select-none">


                        <!-- UNOCCUPIED -->
                        <?php
                            if($status == "unoccupied"){
                                echo "<div class='select-none flex relative flex-col h-full text-[#527920]'>";
                            }
                            else if($status == "occupied"){
                                echo "<div class='select-none hidden text-[#527920]'>";
                            }
                        ?>

                            <a href="../SuperAdmin/units.php" class="w-14"><img src="../icons/back.svg" class="w-14 active:bg-[#b6b6b6] -ml-1 lg:ml-0 z-10 cursor-pointer rounded-full duration-150 hover:bg-[#D9D9D9] p-2" alt=""></a>
                            <div class=" flex flex-col pb-10 sm:h-full justify-center">

                                <div class="flex flex-col">
                                    <div class="flex flex-col mb-7 items-center">
                                        <h1 class="text-3xl font-bold">House <?php echo $house_no ?></h1> 
                                        <img src="../icons/unoccupied.svg" class="w-20 mt-5" alt="">
                                    </div>

                                    <div class="flex sm:hidden mb-5 flex-col py-2 px-3 self-center w-[95%] text-white rounded-lg bg-[#527920]">
                                        <label class="font-bold">Rent Amount:</label>
                                        <p class="text-lg">₱<?php echo $rent ?> per month</p>
                                    </div>

                                    <!-- HOUSE INFO -->
                                    <div class="md:px-16 w-full px-3 flex flex-col items-center ">
                                        <div class="md:w-[40rem] relative w-full pb-14 ">
                                            <div class="flex mb-5">
                                                <div class="flex w-full flex-col">
                                                    <label class="font-bold text-lg">Full Address:</label>
                                                    <p class="text-xl"><?php echo $fulladdress ?></p>
                                                </div>
                                            </div>

                                            <div class="flex justify-between relative">
                                                <div class="flex flex-col">
                                                    <label class="font-bold">No. of Room/s:</label>
                                                    <p class="text-base sm:text-xl"><?php echo $noRoom ?> Room</p>
                                                </div>
                                                <div class="hidden sm:block absolute top-0 right-0 flex-col py-2 px-3 text-white rounded-lg bg-[#527920]">
                                                    <label class="font-bold">Rent Amount:</label>
                                                    <p class="text-lg">₱<?php echo $rent ?> per month</p>
                                                </div>
                                            </div>

                                            <div class="flex mt-5">
                                                <div class="flex flex-col">
                                                    <label class="font-bold">No. of Floor/s:</label>
                                                    <p class="text-base sm:text-lg"><?php echo $noFloor?> Floor</p>
                                                </div>
                                            </div>
                                            <div class="flex mt-5">
                                                <div class="flex flex-col">
                                                    <label class="font-bold">No. of Bathroom/s:</label>
                                                    <p class="text-base sm:text-xl"><?php echo $noBathroom ?> Bathroom</p>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2 sm:grid-cols-4  gap-3 absolute bottom-16 right-0">
                                                
                                                <?php 
                                                    $sql = "SELECT * FROM images WHERE house_no = $house_no";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                            $imagePath = $row['img_dir'];
                                                            echo"
                                                            <div class='picture bg-black cursor-pointer hover:scale-110 active:scale-100 duration-300 rounded-lg overflow-hidden w-20 h-20 md:w-24 md:h-24'>
                                                            <img src='$imagePath' class='w-full h-full object-cover' alt=''>
                                                            </div>
                                                            ";
                                                        }
                                                    }       
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex gap-5 flex-col pb-16 sm:flex-row md:gap-20 w-full items-center justify-center">
                                        <?php
                                            echo "<button onclick='confirmDelete()' class='hover:bg-[#db6666] order-3 sm:order-1 active:bg-[#b63d3d] bg-[#CC4444] duration-150 text-sm w-44 py-2 text-white font-bold'>REMOVE PROPERTY</button>
                                            <script>
                                                function confirmDelete(){
                                                    let choice;
                                                    choice = confirm('Are you sure you want to remove this property? \\n \\nHouse: $house_no \\nAddress: $fulladdress');
                                                    if(choice){
                                                        window.location.href = 'deleteProperty.php?id=$house_no';
                                                    }
                                                }
                                            </script>";

                                            if ($result->num_rows == 0) {
                                                echo "<button id='showUpload' class='bg-[#81A94E] hover:bg-[#95c25a] order-1 sm:order-2 active:bg-[#709244] duration-150 text-sm w-44 py-2 text-white font-bold'>UPLOAD IMAGES</button>";
                                            }   

                                            
                                        ?>
                                        <a href="updateProperty.php?house_no=<?php echo $house_no; ?>" class="order-2"><button class=" bg-[#838383] hover:bg-[#969696] active:bg-[#727272] duration-150 text-sm w-44 py-2 text-white font-bold">EDIT PROPERTY</button></a>
                                        <button onclick="openAddTenant()" class="bg-[#527920] order-1 sm:order-3 hover:bg-[#729445] active:bg-[#5a7535] duration-150 text-sm w-44 py-2 text-white font-bold">ADD TENANT</button>
                                    </div>
                                </div>
                            </div>

                            <!-- FULL SCREEN IMAGE -->
                            <div id="modal" class="w-full h-full hidden absolute top-0 left-0 ">
                                <div class="w-full flex justify-center items-center h-[90%] relative bg-white">
                                    <img src="../icons/exit.svg" class="close absolute hover:bg-[#D9D9D9] rounded-lg duration-200 cursor-pointer top-0 right-0 w-12" alt="">
                                    <div class="sm:w-[80%] flex justify-center w-full h-[80%]">
                                        <img id="fullPicture" class="w-full h-full object-contain" src="" alt="">
                                    </div>
                                </div>
                            </div>

                            <!-- UPLOAD IMAGE -->
                            <div id="uploadImg" class="w-full h-full hidden absolute top-0 left-0 ">
                                <div class="w-full flex justify-center items-center h-[90%] relative bg-white">
                                    <img src="../icons/exit.svg" id="closeUp" class="absolute hover:bg-[#D9D9D9] rounded-lg duration-200 cursor-pointer top-0 right-0 w-12" alt="">
                                    <form enctype="multipart/form-data" method="POST" action="upload.php?house_no=<?php echo $house_no; ?>" class=" flex justify-center mb-10 items-center flex-col w-96 h-[80%]">
                                        <div class="w-full mb-28 flex flex-col items-center">
                                            <h1 class="text-3xl font-bold">Upload Images</h1> 
                                            <img src="../icons/pic.svg" class="sm:w-20 w-16 mt-5" alt="">
                                        </div>
                                        <div class="flex border-2 items-center relative border-[#527920]">
                                            <label for="fileImg[]" class="font-bold absolute bottom-0 sm:px-2 left-0 sm:text-sm text-xs text-center py-[8px] px-[13px] duration-150 cursor-pointer text-white bg-[#527920]">Choose File</label>
                                            <input id="fileImg[]" required name="fileImg[]" accept=".jpg, .jpeg, .png" class="text-sm pl-0 sm:pl-[2px] py-[3px] sm:py-[5px] w-60" multiple type="file">
                                        </div>
                                        <button type="submit" name="submit" class="bg-[#527920] hover:bg-[#729445] active:bg-[#5a7535] mt-20 duration-150 text-sm w-24 py-2 text-white font-bold">SAVE</button>
                                    </form>
                                </div>
                            </div>


                            


                            <script>
                                // MODAL UI
                                let picture = document.querySelectorAll(".picture img");
                                let fullPic = document.getElementById("fullPicture");
                                let modal = document.getElementById("modal");

                                picture.forEach(function (img) {
                                    img.onclick = function () {
                                        modal.style.display = "block";
                                        fullPic.src = this.src;
                                    };
                                });

                                var close = document.getElementsByClassName("close")[0];

                                close.onclick = function () {
                                    modal.style.display = "none";
                                }
                            </script>
                            <script>
                                // INSERTING IMAGE UI
                                const uploadImg = document.getElementById("uploadImg");
                                const showUpload = document.getElementById("showUpload");
                                const closeUp = document.getElementById("closeUp");

                                showUpload.onclick = function(){
                                    uploadImg.style.display = "block";
                                }

                                closeUp.onclick = function(){
                                    uploadImg.style.display = "none";
                                }

                                const fileInput = document.getElementById("fileImg[]");

                                fileInput.addEventListener("change", (event) => {
                                  const files = event.target.files;
                                  console.log(files);

                                  if (files.length > 4) {
                                    alert("A maximum of 4 files are allowed");
                                    fileInput.value = "";
                                    return;
                                  }
                                });


                            </script>
                            

                            <!-- FOOTER -->
                            <footer class="bg-[#ABCF7E] w-full justify-center fixed left-0 lg:left-36 z-10 bottom-0 h-10 flex shrink-0 items-center">
                                <p id="time" class="text-[#527920] "></p>
                            </footer>
                            <script>
                                // TIME
                                let todayy = new Date();
                                let currTimee = todayy.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                                document.getElementById("time").textContent = currTimee;
                            </script>
                        </div>
                            

                        <!-- ADDING TENANT -->
                        <div class="absolute top-0 left-0 h-full hidden bg-white w-full " id="addTenant">
                            <div class="select-none flex flex-col w-full h-full text-[#527920]">
                                <img src="../icons/exit.svg" onclick="closeAddTenant()" class="w-14 z-10 self-end cursor-pointer active:bg-[#b6b6b6] rounded-full duration-150 hover:bg-[#D9D9D9] p-2" alt="">

                                <div class="flex flex-col w-full sm:h-full">
                                    <div class="flex flex-col h-full justify-center w-full">
                                        <div class="flex flex-col items-center">
                                            <h1 class="text-3xl font-bold">House <?php echo $house_no ?></h1> 
                                            <img src="../icons/occupied.svg" class="w-20 mt-5" alt="">
                                        </div>

                                        <!-- FORM -->
                                        <form action="" method="POST" class="md:px-16 pb-10 px-4 flex bg-white w-full flex-col items-center mt-10 ">
                                            <div class="w-full mt-7 sm:mt-0 md:w-[40rem]">
                                                <div class="flex mt-5 w-full justify-between relative">
                                                    <div class="flex sm:w-[67%] mt-3 w-full flex-col">
                                                        <input type="number" class="hidden" name="house_no" value="<?php echo $house_no ?>">
                                                        <label class="font-bold text-lg">Full Name:</label>
                                                        <input required autocomplete="off" name="fullname" placeholder="Enter Full Name" class="bg-[#D9D9D9] py-2 pl-3 w-full  outline-none" type="text">
                                                    </div>
                                                    <div class="flex absolute self-end -top-14 sm:top-0 sm:bottom-0 right-0 flex-col py-1 pb-2 px-3 text-white bg-[#527920] rounded-lg">
                                                        <label class="font-bold text-base sm:text-lg">Rent:</label>
                                                        <p class="text-lg">₱<?php echo $rent ?> per month</p>
                                                    </div>
                                                </div> 
                                                <div class="flex flex-col sm:flex-row mt-5 gap-5 sm:gap-10">
                                                    <div class="flex w-full sm:w-[60%] flex-col">
                                                        <label class="font-bold text-lg">Contact number:</label>
                                                        <input required autocomplete="off"  name="contact" placeholder="Enter Contact Number" class="bg-[#D9D9D9] py-2 pl-3 w-full outline-none" type="text">
                                                    </div>
                                                    <div class="flex w-full sm:w-[40%] flex-col">
                                                        <label class="font-bold text-lg">Number of Occupant/s:</label>
                                                        <input required autocomplete="off" min="0" name="occupants" placeholder="Enter Number" class="bg-[#D9D9D9] py-2 pl-3 w-full  outline-none" type="number">
                                                    </div>
                                                </div>
                                                <div class="flex mt-5 w-full">
                                                    <div class="flex w-full sm:w-[50%] flex-col">
                                                        <label class="font-bold text-lg">Deposit & Advance Payment:</label>
                                                        <input required autocomplete="off" min="0" name="deposit" placeholder="Enter Deposit" class="bg-[#D9D9D9] w-full py-2 pl-3 outline-none" type="number">
                                                    </div>
                                                </div>
                                                <div class="flex mt-10 pb-10 sm:mt-16 w-full justify-center">
                                                    <button type="submit" name="submit" class="bg-[#527920] active:bg-[#5a7535] hover:bg-[#729445] duration-150 text-sm w-44 py-2 text-white font-bold">ADD TENANT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <script src="../function.js"></script> 

                        
                        <!-- OCCUPIED -->
                        <?php
                            if($status == "unoccupied"){
                                echo "<div class='select-none h-full hidden text-[#527920]'>";
                            }
                            else if($status == "occupied"){
                                echo "<div class='select-none flex flex-col h-full text-[#527920]'>";
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
                            
                            
                        ?>
                            <div class="flex justify-between">
                                <a href="../SuperAdmin/units.php" class="w-14 -ml-1 lg:ml-0"><img src="../icons/back.svg" class="w-14 active:bg-[#b6b6b6] cursor-pointer rounded-full duration-150 z-10 hover:bg-[#D9D9D9] p-2" alt=""></a>
                                <div class="flex gap-2">
                                    <a href="../PhpCodes/updateTenant.php?house_no=<?php echo $house_no ?>"><img src="../icons/tenantset.svg" class="w-16 -mr-1 lg:mr-0 active:bg-[#b6b6b6] cursor-pointer rounded-lg duration-150 hover:bg-[#D9D9D9] p-2" alt=""></a>
                                    <img onclick="openSet()" src="../icons/houseSet.svg" class="w-14 -mr-1 lg:mr-0 active:bg-[#b6b6b6] cursor-pointer rounded-lg duration-150 hover:bg-[#D9D9D9] p-2" alt="">
                                </div>
                            </div>
                            <div class=" flex flex-col items-center mt-2 sm:mt-0 w-full sm:h-full justify-center">

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
                                                    <p class="font-bold text-nowrap">Contact No: <span class="text-xl ml-1 font-normal"><?php echo $contact ?></span></p>
                                                </div>
                                                <div class="flex sm:w-[30%] flex-col">
                                                    <p class="font-bold text-nowrap">Credits: <span class="text-xl ml-1 font-normal">₱<?php echo $credits ?></span></p>
                                                </div>
                                            </div>
                                            <div class="flex flex-col sm:flex-row mt-5 items-center sm:items-start">
                                                <div class="flex sm:w-[70%] flex-col">
                                                    <p class="font-bold text-nowrap">Start Date: <span class="text-xl ml-1 font-normal"><?php echo date("F j, Y", strtotime($startDate)); ?></span></p>
                                                </div>
                                                
                                                <div class="flex sm:w-[30%] flex-col">
                                                    <p class="font-bold text-nowrap">House Rent: <span class="text-xl ml-1 font-normal">₱<?php echo $rent ?></span></p>  
                                                </div>
                                            </div>
                                            <div class="flex flex-col sm:flex-row mt-5 items-center sm:items-start">
                                                <div class="flex sm:w-[70%] flex-col">
                                                    <p class="font-bold text-nowrap">Occupants: <span class="text-xl ml-1 font-normal"><?php echo $occupants ?> people/s</span></p>  
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
                                        <?php
                                            echo "<button onclick='confirmDeletee()' class='hover:bg-[#db6666] order-3 sm:order-1 active:bg-[#b63d3d] bg-[#CC4444] duration-150 text-sm w-44 py-2 text-white font-bold'>TERMINATE</button>
                                            <script>
                                                function confirmDeletee(){
                                                    let choice;
                                                    choice = confirm('Are you sure you want to terminate this tenant? \\n \\nHouse $house_no \\nName: $fullname \\nStart Date: $startDate ');
                                                    if(choice){
                                                        window.location.href = 'terminateTenant.php?id=$house_no';
                                                    }
                                                }
                                            </script>";
                                            
                                        ?>
                                        <a href='contractPDF.php?house_no=<?php echo $house_no ?>' target="_blank" class="order-2 sm:order-2"><button class="bg-[#838383] hover:bg-[#969696] active:bg-[#727272] duration-150 text-sm w-44 py-2 text-white font-bold">VIEW CONTRACT</button></a>
                                        <button onclick="openHistory()" class="bg-[#527920] order-1 sm:order-3 hover:bg-[#729445] duration-150 text-sm w-44 py-2 active:bg-[#5a7535] text-white font-bold">PAYMENT HISTORY</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- HOUSE SETTINGS -->
                        <div id="houseSettings" class="top-0 left-0 absolute hidden h-full w-full bg-white">
                            <div class='select-none flex flex-col text-[#527920] h-full w-full'>
                                <img onclick="closeSet()" src="../icons/back.svg" class="w-14 active:bg-[#b6b6b6] -ml-1 lg:ml-0 z-10 cursor-pointer rounded-full duration-150 hover:bg-[#D9D9D9] p-2" alt="">
                                <div class="items-center relative justify-center sm:h-full flex flex-col">

                                    <div class="flex flex-col  w-full">
                                        <div class="flex flex-col mb-7 items-center">
                                            <h1 class="text-3xl font-bold">House <?php echo $house_no ?></h1> 
                                            <img src="../icons/occupied.svg" class="w-20 mt-5" alt="">
                                        </div>

                                        <div class="flex sm:hidden mb-5 flex-col py-2 px-3 self-center w-[95%] text-white rounded-lg bg-[#527920]">
                                            <label class="font-bold">Rent Amount:</label>
                                            <p class="text-lg">₱<?php echo $rent ?> per month</p>
                                        </div>

                                        <!-- HOUSE INFO -->
                                        <div class="md:px-16 w-full px-3 flex flex-col items-center ">
                                            <div class="md:w-[40rem] relative w-full mb-10">
                                                <div class="flex mb-5">
                                                    <div class="flex w-full flex-col">
                                                        <label class="font-bold text-lg">Full Address:</label>
                                                        <p class="text-xl"><?php echo $fulladdress ?></p>
                                                    </div>
                                                </div>

                                                <div class="flex justify-between relative">
                                                    <div class="flex flex-col">
                                                        <label class="font-bold">No. of Room/s:</label>
                                                        <p class="text-base sm:text-xl"><?php echo $noRoom ?> Room</p>
                                                    </div>
                                                    <div class="hidden sm:block absolute top-0 right-0 flex-col py-2 px-3 text-white rounded-lg bg-[#527920]">
                                                        <label class="font-bold">Rent Amount:</label>
                                                        <p class="text-lg">₱<?php echo $rent ?> per month</p>
                                                    </div>
                                                </div>

                                                <div class="flex mt-5">
                                                    <div class="flex flex-col">
                                                        <label class="font-bold">No. of Floor/s:</label>
                                                        <p class="text-base sm:text-lg"><?php echo $noFloor?> Floor</p>
                                                    </div>
                                                </div>
                                                <div class="flex mt-5">
                                                    <div class="flex flex-col">
                                                        <label class="font-bold">No. of Bathroom/s:</label>
                                                        <p class="text-base sm:text-xl"><?php echo $noBathroom ?> Bathroom</p>
                                                    </div>
                                                </div>
                                                <!-- IMAGES -->
                                                <div class="grid grid-cols-2 sm:grid-cols-4  gap-3 absolute bottom-0 right-0">
                                                
                                                    <?php 
                                                        $sql = "SELECT * FROM images WHERE house_no = $house_no";
                                                        $result = $conn->query($sql);

                                                        if ($result->num_rows > 0) {
                                                            while($row = $result->fetch_assoc()) {
                                                                $imagePath = $row['img_dir'];
                                                                echo"
                                                                <div class='picture bg-black  rounded-lg overflow-hidden w-20 h-20 md:w-24 md:h-24'>
                                                                <img src='$imagePath' class='w-full h-full object-cover' alt=''>
                                                                </div>
                                                                ";
                                                            }
                                                        }       
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex sm:gap-10 gap-5 flex-col sm:flex-row pb-16 w-full items-center justify-center">
                                            <?php
                                                echo "<button onclick='confirmDelete()' class='hover:bg-[#db6666] order-2 sm:order-1 active:bg-[#b63d3d] bg-[#CC4444] duration-150 text-sm w-44 py-2 text-white font-bold'>REMOVE PROPERTY</button>
                                                <script>
                                                    function confirmDelete(){
                                                        let choice;
                                                        choice = confirm('Are you sure you want to remove this property? \\n \\nHouse: $house_no \\nAddress: $fulladdress');
                                                        if(choice){
                                                            window.location.href = 'deleteProperty.php?id=$house_no';
                                                        }
                                                    }
                                                </script>";
                                                
                                                if ($result->num_rows == 0) {
                                                    echo "<button id='show' class='bg-[#81A94E] hover:bg-[#95c25a] order-1 sm:order-2 active:bg-[#709244] duration-150 text-sm w-44 py-2 text-white font-bold'>UPLOAD IMAGES</button>";
                                                } 
                                            ?>
                                            
                                        </div>
                                    </div>
                                    <!-- UPLOAD IMAGE -->
                                    <div id="uploadNow" class="w-full h-full hidden absolute -top-14 left-0 z-[10]">
                                        <div class="w-full flex justify-center bg-white items-center h-full relative ">
                                            <img src="../icons/exit.svg" id="closeUpload" class="absolute hover:bg-[#D9D9D9] rounded-lg duration-200 cursor-pointer top-0 right-0 w-12" alt="">
                                            <form enctype="multipart/form-data" method="POST" action="upload.php?house_no=<?php echo $house_no; ?>" class=" flex justify-center mb-10 items-center flex-col w-96 h-[80%]">
                                                <div class="w-full mb-28 flex flex-col items-center">
                                                    <h1 class="text-3xl font-bold">Upload Images</h1> 
                                                    <img src="../icons/pic.svg" class="sm:w-20 w-16 mt-5" alt="">
                                                </div>
                                                <div class="flex border-2 items-center relative border-[#527920]">
                                                    <label for="allImg[]" id="custom-button" class="font-bold absolute bottom-0 sm:px-2 left-0 sm:text-sm text-xs text-center py-[8px] px-[13px] duration-150 cursor-pointer text-white bg-[#527920]">Choose File</label>
                                                    <input id="allImg[]" required name="allImg[]" accept=".jpg, .jpeg, .png" class="text-sm pl-0 sm:pl-[2px] py-[3px] sm:py-[5px] w-60" multiple type="file">
                                                </div>
                                                <button type="submit" name="submit" class="bg-[#527920] hover:bg-[#729445] active:bg-[#5a7535] mt-20 duration-150 text-sm w-24 py-2 text-white font-bold">SAVE</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                const show = document.getElementById("show");
                                const uploadNow = document.getElementById("uploadNow");
                                const closeUpload = document.getElementById("closeUpload");

                                show.onclick = function(){
                                    uploadNow.style.display = "block";
                                }
                                closeUpload.onclick = function(){
                                    uploadNow.style.display = "none";
                                }

                                const allImg = document.getElementById('allImg[]');

                                allImg.addEventListener('change', event => {
                                const files = event.target.files;
                                console.log(files);

                                if (files.length > 4) {
                                    alert('A maximum of 4 files are allowed');
                                    fileInput.value = '';
                                    return;
                                }
                                });
                            </script>
                        </div>

                        <!-- PAYEMNT HISTORY -->
                        <div class="w-full h-full overflow-hidden absolute top-0 right-0 bg-white hidden" id="paymentHistory">
                            <button onclick="closeHistory()"><img src="../icons/back.svg" class="w-14 active:bg-[#b6b6b6] -ml-1 lg:ml-0 cursor-pointer rounded-full duration-150 hover:bg-[#D9D9D9] p-2" alt=""></button>
                            <div class="flex flex-col justify-center items-center w-full text-[#527920] tracking-widest">
                                <h1 class="text-2xl sm:text-3xl font-bold tracking-wider">Payment History</h1>
                                <img src="../icons/payment.svg" class="w-14 sm:w-20 mt-5" alt="">
                            </div>
                            <div action="" class="mt-7 sm:mt-5 text-sm sm:text-base max-w-[60rem] mx-auto" method="GET">
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
                                        $sql = "SELECT * FROM payment WHERE MOP != '*deposit' AND MOP != '*adjust' AND house_no ='$house_no' ORDER BY transaction_id DESC";
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
                            </div>
                        </div>
                        <script>
                            let houseSettings = document.getElementById("houseSettings");
                            let paymentHistory = document.getElementById("paymentHistory");

                            function openSet() {
                                houseSettings.style.display = "block";  
                            }
                            function closeSet() {
                                houseSettings.style.display = "none";
                            }
                            
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
                        </script>
                        
                        <!-- FOOTER -->
                        <footer class="bg-[#ABCF7E] w-full justify-center fixed left-0 lg:left-36 bottom-0 z-10 h-10 flex shrink-0 items-center">
                            <p id="timee" class="text-[#527920] "></p>
                        </footer>
                        <script>
                            // TIME
                            let today = new Date();
                            let currTime = today.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                            document.getElementById("timee").textContent = currTime;

                            
                        </script>
                    </div>
                </main>
            </div>
        </div>

    </body>
</html>