<?php
    include("connection.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $reset = "ALTER TABLE users AUTO_INCREMENT = 1";
        $sql = "DELETE FROM users WHERE user_id = $id";
        $conn->query($sql);
        $conn->query($reset);
    }
    header('location:../SuperAdmin/account.php');
    exit;
?>