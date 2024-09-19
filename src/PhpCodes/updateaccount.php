<?php 
    include("connection.php");
    session_start();
    $id = "";
    $fullname = "";
    $role = "";
    $username = "";
    

    if($_SERVER["REQUEST_METHOD"] == 'GET'){
        if(!isset($_GET['id'])){
            header('location:/Homehub/SuperAdmin/account.php');
            exit;
        }
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE user_id = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        while(!$row){
            header('location:/Homehub/SuperAdmin/account.php');
            exit;
        }
        $user = $row["username"];
        $fullname = $row["fullname"];
        $role = $row["role"];
    }
    else{
        $id = $_POST["id"];
        $fullname = $_POST["fullname"];
        $role = $_POST["role"];
        $username = $_POST["username"];

        $sql = "UPDATE users SET fullname = '$fullname', role = '$role', username = '$username' WHERE user_id = '$id'";

        try{
            $result = $conn->query($sql);
            echo '<script>
                window.location.href = "../SuperAdmin/account.php";
                alert("Update Successfully!");
            </script>';
        }
        catch(mysqli_sql_exception){
            echo'<script>
                window.location.href = "../SuperAdmin/account.php";
                alert("Update Failed!");
            </script>';
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
                <a href="../SuperAdmin/units.php" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
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
                <a href="../SuperAdmin/account.php" class="py-4 bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
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
                <a href="../SuperAdmin/units.php" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
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
                <a href="../SuperAdmin/account.php" class="py-4 my-2 justify-center bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full">
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
                    
                    <!-- UPDATE ACCOUNT -->
                    <div class="w-full h-full relative">
                        <div class="select-none relative flex flex-col h-full text-[#527920]">
                            <img onclick="history.back()" src="../icons/back.svg" class="w-14 lg:ml-1 cursor-pointer active:bg-[#b6b6b6] rounded-full duration-150 hover:bg-[#D9D9D9] p-2">

                            <div class="flex flex-col h-full sm:justify-center">


                                <div class="flex flex-col w-full">
                                    <div class="flex flex-col items-center">
                                        <h1 class="text-3xl font-bold">Edit Account</h1> 
                                        <img src="../icons/edit.svg" class="w-20 mt-5" alt="">
                                    </div>

                                    <!-- FORM -->
                                    <form action="" method="POST" class=" flex flex-col px-7 sm:px-10 items-center w-full mt-5 sm:mt-10 ">
                                        <div class="w-full flex flex-col gap-5 mt-7 sm:mt-0 md:w-[35rem]">
                                            
                                            <div class="flex gap-5 sm:gap-7 w-full flex-col  sm:flex-row">
                                                <div class="flex flex-col sm:w-[70%] w-full order-2 sm:order-1">
                                                    <label class="font-bold">Username:</label>
                                                    <input id="username" name="username" value="<?php echo $user; ?>" class="bg-[#D9D9D9] py-2 pl-3 outline-none w-full" type="text">
                                                </div> 
                                                <div class="flex flex-col sm:w-[30%] w-full order-1 sm:order-2">
                                                    <label class="font-bold">Role:</label>
                                                    <select name="role" class="border-[#527920] bg-[#D9D9D9] h-10 sm:h-full w-36 sm:w-full pt-[2.5px] pb-[4.5px] px-1 outline-none font-medium text-[#527920] border-2" alt="">
                                                        <option id="tenant" value="tenant">Tenant</option>
                                                        <option id="admin" value="admin">Admin</option>
                                                        <option id="superadmin" value="super admin">Super Admin</option>
                                                    </select>
                                                    <?php
                                                        if($role == "tenant"){
                                                            echo "<script>
                                                            let tenant = document.getElementById('tenant');
                                                            tenant.setAttribute('selected', '');
                                                            </script>";
                                                        }
                                                        else if($role == "admin"){
                                                            echo "<script>
                                                            let admin = document.getElementById('admin');
                                                            admin.setAttribute('selected', '');
                                                            </script>";
                                                        }
                                                        else if($role == "super admin"){
                                                            echo "<script>
                                                            let superadmin = document.getElementById('superadmin');
                                                            superadmin.setAttribute('selected', '');
                                                            </script>";
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="flex gap-5 w-full flex-col">
                                                <div class="flex w-full flex-col">
                                                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                                                    <label class="font-bold">Name:</label>
                                                    <input name="fullname" value="<?php echo $fullname; ?>" id="fullname" class="bg-[#D9D9D9] py-2 pl-3 outline-none w-full" type="text">
                                                    
                                                </div>
                                                <div class="mt-3 text-center">
                                                    <a href='../PhpCodes/changePass.php?id=<?php echo $id ?>' class="underline hover:text-[#7eb13c] active:text-[#4c6926] font-medium duration-150 cursor-pointer ">Change Password</a>
                                                </div>
                                            </div>
                                            <div class="flex mt-10 pb-16 w-full justify-center">
                                                <button onclick=" javascript:return confirm('Are you sure you want to update this account?'); " type="submit" id="submit" name="submit" class="bg-[#527920] hover:bg-[#71a232] active:bg-[#547b21] duration-150 text-sm px-6 py-2 text-white font-bold">SAVE</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
    <script src="../app.js"></script>
    <script>
        // TIME
        let today = new Date();
        let currTime = today.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
        document.getElementById("time").textContent = currTime;
    </script>
</body>
</html>