<?php
    include("../PhpCodes/connection.php");
    session_start();
    if(!isset($_SESSION['role'])){
        header("Location: ../index.php");
    }
    if(isset($_SESSION['user_id'])){
        $sql = mysqli_query($conn, "UPDATE messages SET tenant_unread = 0 WHERE incoming_msg_id = $_SESSION[user_id]") or die();
    }
    $house_no = $_GET['house_no'];
    $get = "SELECT fullname FROM tenants WHERE house_no = '$house_no'";
    $resulta = $conn->query($get);
    $rows = $resulta->fetch_assoc();
    $fullname = $rows['fullname'];

    $sql = "SELECT * FROM tenants t INNER JOIN houses h ON t.house_no = h.house_no WHERE fullname = '$fullname'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $sql2 = "SELECT * FROM users WHERE role = 'super admin'";
    $resultt = $conn->query($sql2);
    $roww = $resultt->fetch_assoc();
    while(!$roww){
        header('location:../SuperAdmin/chat.php');
        exit;
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
    <style>
        .triangle1{
            position: absolute;
            top: .75rem;
            left: 4.2rem;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 6px solid transparent;
            border-top: 15px solid #ffff;
        }
        .triangle2{
            position: absolute;
            top: .75rem;
            right: 4.2rem;
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 10px solid transparent;
            border-top: 15px solid #ffff;
        }
    </style>
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
                <a href="tenant.php?house_no=<?php echo $house_no ?>" class="hover:bg-[#6a8349] py-4 duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/dash.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Tenant Dashboard</p>
                </a>
                <a href="info.php?house_no=<?php echo $house_no ?>" class="py-4 hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/tenant.png" alt="">
                    <p class="ml-4 select-none pointer-events-none">Tenant Information</p>
                </a>
                <a href="chat.php?house_no=<?php echo $house_no ?>" class="py-4 relative bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full pl-4">
                    <img class="w-10 select-none pointer-events-none" src="../icons/chat.svg" alt="">
                    <p class="ml-5 select-none pointer-events-none">Message Inbox</p>
                    <p class="absolute right-5 py-[3px]  px-[9px] rounded-md bg-[#db5d5d] hidden"></p>
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
                <a href="tenant.php?house_no=<?php echo $house_no ?>" class="py-4 my-2 justify-center hover:bg-[#6a8349] duration-150 cursor-pointer flex items-center self-start w-full">
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
                <a href="chat.php?house_no=<?php echo $house_no ?>" class="py-4 my-2 justify-center bg-[#54683A] duration-150 cursor-pointer flex items-center self-start w-full">
                    <div class="flex items-center w-64">
                        <img class="w-10 select-none pointer-events-none" src="../icons/chat.svg" alt="">
                        <p class="ml-4 select-none pointer-events-none">Message Inbox</p>
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

            <!-- MAIN CONTENT -->
            <main class="relative w-full h-full lg:pl-72 overflow-hidden mt-24 pb-40 sm:pb-48 text-[#527920] tracking-wide">
                <div class="mx-7 mt-7 flex flex-col h-full select-none">
                <h1 class="text-3xl text-[#527920] font-bold tracking-wider mb-5 md:mb-10 ">Inbox</h1>
                    <!-- NEW -->
                    <div class="bg-[#daf0c0] max-w-[40rem] mx-auto justify-between flex h-full w-full flex-col">
                        <div class="flex bg-[#a1d65f] shadow-sm z-10 w-full justify-center items-center h-12 sm:h-16 text-[#527920] font-medium tracking-widest">
                            <h1 class="sm:text-3xl text-gray-50 text-2xl font-bold tracking-wider">Owner</h1>
                        </div>
                        <div class="chatBox overflow-auto flex flex-col pb-5 h-full w-full">
                            
                        <!-- MESSENGES WILL APPEAR HERE -->
                        
                        </div>
                        <form autocomplete="off" class="typing_area shrink-0 flex items-center px-5 justify-center w-full bg-[#a1d65f] bottom-0 h-16">
                            
                            <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $roww['user_id']; ?>" hidden>
                            
                            <!-- MESSAGE BOX -->
                            <input type="text" name="message" class="messageBox h-10 pl-4 pr-2 pb-[2px] w-[60%] sm:w-[70%] rounded-full outline-none" placeholder="Enter Message...">
                            
                            <button type="button" class="sendBtn pointer-events-none ml-5 active:bg-[#537c1e] duration-150 flex h-10 justify-center items-center rounded-full w-10 bg-[#77ad30]">
                                <img src="../icons/send.svg" class="w-6 ml-[3px]" alt="">
                            </button>
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
    <script>
        
        // TIME
        let today = new Date();
        let currTime = today.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
        document.getElementById("time").textContent = currTime;
    </script>
    <script src="../chatOwner.js"></script>
</body>
</html>