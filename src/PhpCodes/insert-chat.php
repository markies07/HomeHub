<?php 
    session_start();
    echo $_POST['incoming_id'];
    if(isset($_SESSION['role'])){
        include_once "connection.php";
        $outgoing_id = $_SESSION['user_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){
            if($_SESSION['role'] == "tenant"){
                $sql = "SELECT * FROM users INNER JOIN tenants ON users.fullname = tenants.fullname WHERE user_id = $outgoing_id";
                $result = $conn->query($sql);
                $row=$result->fetch_assoc();

                $send = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, house_no, owner_unread)
                                        VALUES (1, {$outgoing_id}, '{$message}', '{$row['house_no']}', 1)") or die();
            }
            else if($_SESSION['role'] == "super admin"){
                $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, tenant_unread)
                                        VALUES ({$incoming_id}, 1, '{$message}', 1)") or die();
            }
            
        }
    }


    
?>