<?php
    include("connection.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $totalPaid = 0;

        $tenant = "SELECT * FROM tenants WHERE house_no = $id";
        $resultt = $conn->query($tenant);
        $roww = $resultt->fetch_assoc();

        $user = "SELECT * FROM users WHERE fullname = '$roww[fullname]'";
        $result2 = $conn->query($user);
        $row2 = $result2->fetch_assoc();

        $payment = "SELECT * FROM payment WHERE house_no = $id";
        $result = $conn->query($payment);
        while ($row = $result->fetch_assoc()) {
            $totalPaid += $row['amount'];
        }

        $msg = "SELECT * FROM messages WHERE house_no = $id";
        $result3 = $conn->query($msg);

        $former = "INSERT INTO former_tenants (house_no, fullname, startDate, totalPaid)
        VALUES ('$id', '$roww[fullname]', '$roww[startDate]', $totalPaid)";
        $conn->query($former);

        $sql = "DELETE FROM tenants WHERE house_no = $id";
        $update = "UPDATE houses SET status = 'unoccupied' WHERE house_no = '$id'";
        $deleteSql = "DELETE FROM payment WHERE house_no = $id";

        
        if($result3->num_rows > 0){
            $messages = "DELETE FROM messages WHERE incoming_msg_id = '$row2[user_id]' OR outgoing_msg_id = '$row2[user_id]'";
            $conn->query($messages);
        }

        if($result2->num_rows > 0){
            $tenantAccount = "DELETE FROM users WHERE user_id = $row2[user_id]";
            $conn->query($tenantAccount);
        }
        
        $conn->query($sql);
        $conn->query($update);
        $conn->query($deleteSql);
    }
    header("location: houseInfo.php?house_no=$id");
    exit;
?>