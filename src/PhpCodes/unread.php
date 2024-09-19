<?php
    include("connection.php");

    if($_SESSION['role'] == "tenant"){
        $sql = "SELECT * FROM messages WHERE incoming_msg_id = $_SESSION[user_id] AND tenant_unread = 1";
        $query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($query);
    }
    else if($_SESSION['role'] == "super admin"){
        $sql = "SELECT * FROM messages WHERE incoming_msg_id = 1 AND owner_unread = 1";
        $query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($query);
    }


    
?>