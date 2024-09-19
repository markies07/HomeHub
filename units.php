<?php 
    include("./src/PhpCodes/connection.php");
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
        
        $house_no = $row["house_no"];
        $fulladdress = $row["fulladdress"];
        $noRoom = $row["noRoom"];
        $noBathroom = $row["noBathroom"];
        $noFloor = $row["noFloor"];
        $rent = $row["rent"];
        $status = $row["status"];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../output.css">
        <link rel="icon" type="image/x-icon" href="src/img/homehub-icon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="../img/homehub-icon.png">
        <style>
            @media (min-height: 600px) {
                .main {
                    height: 100%;
                }
            }
        </style>
        <script src="https://cdn.tailwindcss.com"></script>
        <title>HomeHub</title>
    </head>
    <body>
        <div class="flex flex-col pt-2 h-[100vh]">   
            <div class="m-1 px-2 sm:px-6">
                <button onclick="window.history.back()"><img src="./src/icons/back.svg" class="w-14 lg:ml-1 mr-2 active:bg-[#b6b6b6] cursor-pointer rounded-full duration-150 hover:bg-[#D9D9D9] p-2" alt=""></button>
            </div>
            <div class="w-full h-full flex flex-col justify-center items-center relative">
                
                <!-- MAIN CONTENT -->
                <main class="h-full px-3">
                    <!-- UNOCCUPIED -->
                    <?php
                        if($status == "unoccupied"){
                            echo "<div class='select-none flex relative flex-col h-full text-[#527920]'>";
                        }
                        else if($status == "occupied"){
                            echo "<div class='select-none hidden text-[#527920]'>";
                        }
                    ?>
                        <div class="flex flex-col pb-10 sm:h-full justify-center">

                            <div class="flex flex-col">
                                <div class="flex flex-col mb-10 items-center">
                                    <h1 class="text-3xl font-bold">House <?php echo $house_no ?></h1> 
                                    <img src="./src/icons/unoccupied.svg" class="w-20 mt-5" alt="">
                                </div>

                                <div class="flex sm:hidden mb-5 flex-col py-2 px-3 self-center w-[95%] text-white rounded-lg bg-[#527920]">
                                    <label class="font-bold">Rent Amount:</label>
                                    <p class="text-lg">₱<?php echo $rent ?> per month</p>
                                </div>

                                <!-- HOUSE INFO -->
                                <div class=" w-full px-3 flex flex-col items-center ">
                                    <div class="md:w-[40rem] lg:w-[50rem] relative w-full sm:pb-20 ">
                                        <div class="flex mb-5">
                                            <div class="flex w-full flex-col">
                                                <label class="font-bold text-lg">Full Address:</label>
                                                <p class="text-xl"><?php echo $fulladdress ?></p>
                                            </div>
                                        </div>

                                        <div class="flex justify-between relative">
                                            
                                            <div class="hidden sm:block absolute top-0 right-0 flex-col py-2 px-3 text-white rounded-lg bg-[#527920]">
                                                <label class="font-bold">Rent Amount:</label>
                                                <p class="text-lg">₱<?php echo $rent ?> per month</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-10">
                                            <div class="flex gap-4 sm:flex-col sm:gap-3 md:flex-row md:gap-10">
                                                <div class="flex flex-col">
                                                    <label class="font-bold">No. of Bathroom/s:</label>
                                                    <p class="text-base sm:text-xl"><?php echo $noBathroom ?> Bathroom</p>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label class="font-bold">No. of Room/s:</label>
                                                    <p class="text-base sm:text-xl"><?php echo $noRoom ?> Room</p>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label class="font-bold">No. of Floor/s:</label>
                                                    <p class="text-base sm:text-lg"><?php echo $noFloor?> Floor</p>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2 place-items-center self-center gap-5 rounded-md sm:grid-cols-4">
                                                <?php 
                                                    $sql = "SELECT * FROM images WHERE house_no = $house_no";
                                                    $result = $conn->query($sql);
    
                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                            $imagePath = $row['img_dir'];
                                                            echo"
                                                            <div class='picture bg-black border-[#527920] hover:scale-110 active:scale-100 duration-150 cursor-pointer rounded-lg overflow-hidden w-40 h-40 sm:w-36 sm:h-36 lg:w-40 lg:h-40'>
                                                            <img src='./src/PhpCodes/$imagePath' class='w-full h-full object-cover' alt=''>
                                                            </div>
                                                            ";
                                                        }
                                                    }       
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <!-- OCCUPIED -->
                    <?php
                        if($status == "unoccupied"){
                            echo "<div class='select-none hidden text-[#527920]'>";
                        }
                        else if($status == "occupied"){
                            echo "<div class='select-none justify-center h-full flex flex-col  text-[#527920]'>";
                        }
                        
                    ?>
                        <div class="flex flex-col mb-10 items-center">
                            <h1 class="text-3xl font-bold">House <?php echo $house_no ?></h1> 
                            <img src="./src/icons/occupied.svg" class="w-20 mt-3" alt="">
                            <div class="mt-10">
                                <h1 class="text-3xl lg:text-4xl font-bold text-center px-5 pb-20">Sorry but this house is already occupied.</h1>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!-- FULL SCREEN IMAGE -->
            <div id="modal" class="w-full hidden absolute top-0 left-0 ">
                <div class="w-full flex justify-center items-center h-[100vh] bg-white relative ">
                    <img src="./src/icons/exit.svg" class="close absolute hover:bg-[#D9D9D9] rounded-full duration-200 cursor-pointer top-3 right-3 p-2 w-14" alt="">
                    <div class="w-[85%] h-[80%] flex justify-center">
                        <img id="fullPicture" class="w-full h-full object-contain" src="" alt="">
                    </div>
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

                    function back(){
                        window.location.href = "index.php";
                    }
            </script>
        </div>
    </body>
</html>