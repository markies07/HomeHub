<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        include_once "connection.php";
        if($_SESSION['role'] == 'super admin'){
            $outgoing_id = 1;
            $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
            $output = "";
            $sql = "SELECT * FROM messages LEFT JOIN users ON users.user_id = messages.outgoing_msg_id
                    WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                    OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                    if($row['outgoing_msg_id'] == $outgoing_id){
                        $output .= "<div class='w-full flex flex-col items-end'>
                                        <div class='flex mt-5 relative justify-end pr-5 w-[65%]'>
                                            <div class='triangle2'></div>
                                            <p class='bg-white mr-4  mt-3 p-2 px-3 rounded-lg'>$row[msg]</p>
                                            <img class='w-10 h-10 p-2 bg-[#619422] rounded-full' src='../icons/owner.png' alt=''>
                                        </div>
                                    </div>";

                    }
                    else if($row['outgoing_msg_id'] != $outgoing_id){
                        $output .= "<div class='w-full flex flex-col items-start'>
                                        <div class='flex mt-5 relative pl-5 w-[65%]'>
                                            <div class='triangle1'></div>
                                            <img class='w-10 h-10 p-2 bg-[#619422] rounded-full' src='../icons/tenant.png' alt=''>
                                            <p class='bg-white ml-4 mt-3 p-2 px-3 rounded-lg'>$row[msg]</p>
                                        </div>
                                    </div>" ;
                    }
                }
            }
        }
        if($_SESSION['role'] == 'tenant'){
            $outgoing_id = $_SESSION['user_id'];
            $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
            $output = "";
            $sql = "SELECT * FROM messages LEFT JOIN users ON users.user_id = messages.outgoing_msg_id
                    WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                    OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                    if($row['outgoing_msg_id'] === $outgoing_id){
                        $output .= "<div class='w-full flex flex-col items-end'>
                                        <div class='flex mt-5 relative justify-end pr-5 w-[65%]'>
                                            <div class='triangle2'></div>
                                            <p class='bg-white mr-4  mt-3 p-2 px-3 rounded-lg'>$row[msg]</p>
                                            <img class='w-10 h-10 p-2 bg-[#619422] rounded-full' src='../icons/tenant.png' alt=''>
                                        </div>
                                    </div>";

                    }
                    else{
                        $output .= "<div class='w-full flex flex-col items-start'>
                                        <div class='flex mt-5 relative pl-5 w-[65%]'>
                                            <div class='triangle1'></div>
                                            <img class='w-10 h-10 p-2 bg-[#619422] rounded-full' src='../icons/owner.png' alt=''>
                                            <p class='bg-white ml-4 mt-3 p-2 px-3 rounded-lg'>$row[msg]</p>
                                        </div>
                                    </div>" ;
                    }
                }
            }
        }
        
        echo $output;
    }else{
        header("location: ../SuperAdmin/chat.php");
    }

?>