<?php
    include("./src/PhpCodes/connection.php");

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
        <div class="flex flex-col pt-2 h-[100vh] text-[#527920]">   
            <div class="flex m-1 px-2 sm:px-6">
                <a href="index.php"><img src="./src/icons/back.svg" class="w-14 lg:ml-1 mr-2 active:bg-[#b6b6b6] cursor-pointer rounded-full duration-150 hover:bg-[#D9D9D9] p-2" alt=""></a>
            </div>
            <div class="w-full h-full pt-3 lg:pt-5 flex flex-col relative">
                
                <!-- MAIN CONTENT -->
                <main class="w-full">
                    <!-- UNITS UI -->
                    <div id="units" class="self-center w-full">
                        <div class="flex flex-col">
                            <!-- CONTENT -->
                            <div class="px-5 sm:px-10 flex w-full flex-col">
                                <div class="flex justify-between flex-col items-start text-[#527920] font-medium tracking-widest">
                                    <div class="flex">
                                        <h1 class="text-3xl font-bold">All Units</h1> 
                                    </div>    
                                    <div class="flex sm:gap-10 self-end gap-5">
                                        <div class="flex">
                                            <p class="self-end text-xs sm:text-base mr-1">Occupied</p>
                                            <img class="w-10 sm:w-16 sm:h-[3rem]" src="./src/icons/occupied.svg" alt="">
                                        </div>
                                        <div class="flex">
                                            <p class="self-end text-xs sm:text-base mr-1">Available</p>
                                            <img class="w-10 sm:w-16 sm:h-[3rem] " src="./src/icons/unoccupied.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <form class="flex flex-col pb-5" action="" method="GET">
                                    <!-- SORT -->
                                    <div class="flex self-end mt-3">
                                        <select name="sort" class="border-[#527920] sm:text-sm text-xs self-end w-32 pt-[2.5px] pb-[4.5px] pl-1 outline-none font-medium text-[#527920] border-2">
                                            <option value="All Units" <?php if(isset($_GET['sort']) && $_GET['sort'] == "All Units"){echo "selected";} ?>>All Units</option>
                                            <option value="Occupied" <?php if(isset($_GET['sort']) && $_GET['sort'] == "Occupied"){echo "selected";} ?> >Occupied</option>
                                            <option value="Available" <?php if(isset($_GET['sort']) && $_GET['sort'] == "Available"){echo "selected";} ?>>Available</option>
                                        </select>
                                        <button type="submit" class="bg-[#527920] text-sm sm:text-base text-white px-3 p-1 active:bg-[#5a7535] duration-150 hover:bg-[#68883e]">Show</button>
                                    </div>
                                        

                                    <!-- HOUSES -->
                                    <div class="w-full flex justify-center mt-4 items-center">
                                        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 w-full sm:gap-7 gap-4">
                                            <?php 
                                            
                                                if(isset($_GET['sort'])){
                                                    if($_GET['sort'] == "All Units"){
                                                        $sql = "SELECT * FROM houses";
                                                        $result = $conn->query($sql);
                                                        
                                                        while($row=$result->fetch_assoc()){
                                                            if($row['status'] == "unoccupied"){
                                                                echo "<div class='bg-[#D9D9D9]  justify-center flex flex-col items-center py-3 pt-4'>
                                                                <p class='mb-2'>House $row[house_no]</p>
                                                                <img class='sm:w-20 w-16' src='./src/icons/unoccupied.svg'>
                                                                <a href='./units.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                                </div>";
                                                            }
                                                            else if($row['status'] == "occupied"){
                                                                echo "<div class='bg-[#D9D9D9]  justify-center flex flex-col items-center py-3 pt-4'>
                                                                <p class='mb-2'>House $row[house_no]</p>
                                                                <img class='sm:w-20 w-16' src='./src/icons/occupied.svg'>
                                                                <a href='./units.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
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
                                                                <img class='sm:w-20 w-16' src='./src/icons/unoccupied.svg'>
                                                                <a href='units.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                                </div>";
                                                            }
                                                            else if($row['status'] == "occupied"){
                                                                echo "<div class='bg-[#D9D9D9]  justify-center flex flex-col items-center py-3 pt-4'>
                                                                <p class='mb-2'>House $row[house_no]</p>
                                                                <img class='sm:w-20 w-16' src='./src/icons/occupied.svg'>
                                                                <a href='units.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
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
                                                                <img class='sm:w-20 w-16' src='./src/icons/unoccupied.svg'>
                                                                <a href='units.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                                </div>";
                                                            }
                                                            else if($row['status'] == "occupied"){
                                                                echo "<div class='bg-[#D9D9D9]  justify-center flex flex-col items-center py-3 pt-4'>
                                                                <p class='mb-2'>House $row[house_no]</p>
                                                                <img class='sm:w-20 w-16' src='./src/icons/occupied.svg'>
                                                                <a href='units.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
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
                                                            echo "<div class='bg-[#D9D9D9] justify-center flex flex-col items-center py-3 pt-4'>
                                                            <p class='mb-2'>House $row[house_no]</p>
                                                            <img class='sm:w-20 w-16' src='./src/icons/unoccupied.svg'>
                                                            <a href='units.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                            </div>";
                                                        }
                                                        else if($row['status'] == "occupied"){
                                                            $sql2 = "SELECT * FROM tenants WHERE house_no = $row[house_no]";
                                                            $result2 = $conn->query($sql2);
                                                            $row2 = $result2->fetch_assoc();

                                                            if($row2['status'] == 'UNPAID'){
                                                                echo "<div class='bg-[#D9D9D9] relative justify-center flex flex-col items-center py-3 pt-4'>
                                                                <p class='mb-2'>House $row[house_no]</p>
                                                                <img class='sm:w-20 w-16' src='./src/icons/occupied.svg'>
                                                                <a href='units.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
                                                                </div>";
                                                            }
                                                            else{
                                                                echo "<div class='bg-[#D9D9D9] relative justify-center flex flex-col items-center py-3 pt-4'>
                                                                <p class='mb-2'>House $row[house_no]</p>
                                                                <img class='sm:w-20 w-16' src='./src/icons/occupied.svg'>
                                                                <a href='units.php?house_no=$row[house_no]' class='self-end mr-3 mt-4'><button type='button' class='bg-[#527920] active:bg-[#5a7535] text-white hover:bg-[#749745] duration-150 text-[.7rem] sm:text-xs py-1 px-5'>INFO</button></a>
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














