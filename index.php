<?php
    include("./src/PhpCodes/connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="src/img/homehub-icon.png">
    <link rel="stylesheet" href="./src/output.css">
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
<body class="relative text-[#527920]">
    <!-- WHOLE -->
    <div class="lg:mx-32 relative sm:mx-20 mx-10 flex flex-col select-none h-[100vh]">
        <!-- HEADER -->
        <header class="justify-between flex shrink-0 lg:h-24">
            <div class=" flex items-end h-20 self-end">
                <img draggable="false" class="lg:w-32 w-28 object-contain" src="./src/img/logo4.png" alt="">
            </div>
            <div class="flex items-center self-end sm:gap-8 gap-5">
                <button onclick="openContact()" class="xl:text-xl hover:text-[#91C53C] active:text-[#527920] duration-150 lg:text-lg hidden sm:block -mb-[2px]">Contact Us</button>
                <a href="./src/"><button class="bg-[#91C53C] hover:bg-[#a7da56] duration-150 active:bg-[#91C53C] lg:text-base text-white py-[5px] xl:text-xl px-6 rounded-md tracking-wide">LOGIN</button></a>
            </div>
        </header>

        <!-- MAIN -->
        <main class="main justify-center sm:justify-between xl:self-center items-center flex">
            <div class="flex justify-between flex-col xl:flex-row pt-1 xl:pt-16 w-full">
                <div class="flex gap-10 flex-col items-center md:items-start order-2 md:order-1">
                    <h1 class="2xl:text-7xl text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-6xl text-center md:text-start whitespace-nowrap font-bold">Your New Home, <br>Your Happy Place.</h1>
                    <a href="allUnits.php">
                        <button class="bg-[#527920] active:bg-[#527920] group hover:bg-[#639226] duration-200 relative font-medium tracking-wide text-white flex items-center py-2 lg:w-40 hover:w-44 pl-3 w-40 rounded-md">View All Units
                            <img src="./src/icons/arrow.svg" class="w-5 group-hover:w-6 duration-150 absolute right-3" alt="">
                        </button>
                    </a>
                    <button onclick="openContact()" class="xl:text-xl lg:text-lg sm:hidden hover:text-[#91C53C] active:text-[#527920] -mt-5">Contact Us</button>
                </div>
                <div class="flex xl:-mt-16 lg:-mt-10 md:items-end shrink-0 items-center flex-col order-1 md:order-2">
                    <img draggable="false" src="./src/img/model.png" class="w-96 lg:w-[30rem] md:w-[26rem]" alt="">
                </div>
            </div>
        </main>
    </div>

    <!-- CONTACT UI -->
    <div id="contact" class="absolute hidden top-0 bg-white self-center left-0 h-[100vh] w-full">
        <div class="flex  flex-col px-2 pt-2 h-full">
            <div class="flex justify-end">
                <button onclick="closeContact()"><img src="./src/icons/exit.svg" class="w-14 lg:ml-1 active:bg-[#b6b6b6] cursor-pointer rounded-full duration-150 hover:bg-[#D9D9D9] p-2" alt=""></button>
            </div>
            <!-- CONTENT -->
            <div class=" px-10 flex h-full justify-center pb-16 flex-col">
                <div>
                    <h1 class="text-3xl text-center mb-8">Contact Us</h1> 
                </div>
                <div class="flex justify-center">
                    <form id="form" onsubmit="sendEmail(); reset(); return false;"  class="shadow-[1px_1px_15px_2px_rgb(0,0,0,.17)] relative sm:w-auto w-full p-10 bg-white rounded-md">
                        <div class="flex gap-3 flex-col sm:flex-row">
                            <input autocomplete="off" id="name" required class="input-field border-2 md:w-80 sm:w-64 rounded-sm py-2 pl-2 outline-none" type="text" id="name" placeholder="Name">
                            <input autocomplete="off" id="email" email required class="input-field border-2 md:w-80 sm:w-64 rounded-sm py-2 pl-2 outline-none" type="email" id="email" placeholder="Email">
                        </div>
                        <div class="w-full">
                            <input autocomplete="off" id="subject" required class="input-field border-2 w-full py-2 pl-2 mt-4 outline-none" type="text" id="subject" placeholder="Subject">
                            <textarea autocomplete="off" id="message" required class="input-field border-2 w-full px-2 pt-2 h-40 mt-4 rounded-sm outline-none" id="message" type="text" placeholder="Message"></textarea>
                        </div>
                            <div class="mt-3 text-center">
                            <button type="submit" class="py-1 px-7 rounded-md text-white bg-[#527920] active:bg-[#527920] group hover:bg-[#639226] duration-200">SEND</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        let contact = document.getElementById("contact");

        function openContact(){
            contact.style.display = "block";
        }
        function closeContact(){
            contact.style.display = "none";
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the input element
            var inputElements = document.querySelectorAll('.input-field');

            function handleInputEvent(event) {
                var inputElement = event.target;
                var inputValue = inputElement.value.trim();

                if (inputValue.length > 0) {
                    inputElement.classList.add('border-[#91C53C]');
                } else {
                    inputElement.classList.remove('border-[#91C53C]');
                }
            }
            
            inputElements.forEach(function(inputElement) {
                inputElement.addEventListener('input', handleInputEvent);
            });
        });
    </script>

    <!-- EMAIL FUNCTION -->
    <script src="https://smtpjs.com/v3/smtp.js"></script>
     <script>
        const form = document.querySelector("form");
        const namee = document.getElementById("name");
        const email = document.getElementById("email");
        const subject = document.getElementById("subject");
        const message = document.getElementById("message");

        function sendEmail(){

            const bodyMessage = `Name: ${namee.value}<br> Email: ${email.value}<br>
                        Message: ${message.value}`;

            Email.send({
                Host : "smtp.elasticemail.com",
                Username : "markchristiannaval07@gmail.com",
                Password : "1CC4457E802629C5541074D268AB388CFC79",
                To : 'markchristiannaval07@gmail.com',
                From : 'markchristiannaval07@gmail.com',
                Subject : subject.value,
                Body : bodyMessage
            }).then(
                message => alert("Message Sent Successfully!")
            );
        }

     </script>
</body>
</html>