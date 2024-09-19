<?php
    include("PhpCodes/connection.php");

    session_start();

    if(isset($_SESSION['role'])){
        if($_SESSION['role'] == 'super admin'){
            header("Location: SuperAdmin/dashboard.php");
        }
        else if($_SESSION['role'] == 'admin'){
            header("Location: Admin/tenants.php");
        }
        else if($_SESSION['role'] == 'tenant'){
            header("Location: Tenant/tenant.php");
        }
        
    }
  
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/homehub-icon.png">
    <link rel="stylesheet" href="./output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body>
    <main class="w-full h-[100vh] bg-[#81A94E] flex justify-center items-center">
        <!-- WHOLE CONTENT -->
        <div class="flex items-center flex-col">
            <div class="w-full mb-3 self-start -ml-1">
                <img src="./img/homehub.png" class="select-none w-40" alt="">
            </div>
            <!-- FORM -->
            <form action="PhpCodes/login.php" method="POST" class="flex flex-col gap-4 sm:w-96 w-80 bg-white sm:px-10 px-7 py-12 shadow-lg rounded-sm">
                <input name="username" autocomplete="off" class="bg-[#ECECEC] text-[#527920] outline-none sm:text-lg py-2 px-3" type="text" placeholder="username">
                <input name="password" autocomplete="off" class="bg-[#ECECEC] text-[#527920] outline-none sm:text-lg py-2 px-3" type="password" placeholder="password">
                <select name="role" id="" class="border-[#527920] mb-3 text-sm sm:text-base bg-[#ECECEC] self-end w-36 pt-[2.5px] pb-[4.5px] pl-1 outline-none font-medium text-[#527920] border-[1.7px]">
                    <option value="none" selected disabled hidden>Role</option>   
                    <option class="text-[#527920] py-5" value="Tenant">Tenant</option>
                    <option class="text-[#527920] py-5" value="Admin">Admin</option>
                    <option class="text-[#527920] py-5" value="Super Admin">Super Admin</option>
                </select>
                <button type="submit" name="submit" class="bg-[#83B840] hover:bg-[#75a43a] duration-200 py-2 justify-center items-center gap-3 flex">
                    <img class="w-[1.05rem]" src="./icons/lock.png" alt="">
                    <p class="tracking-wider text-sm sm:text-base text-white">LOGIN</p>
                </button>
            </form>
        </div>
    </main>
</body>
</html>