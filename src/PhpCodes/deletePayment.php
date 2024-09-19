<?php
    include("connection.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "SELECT * FROM payment WHERE transaction_id = $id";
        $result = $conn->query($sql);
        $row=$result->fetch_assoc();

        $house_no = $row['house_no'];
        $amount = $row['amount'];

        $get = "SELECT * FROM houses WHERE house_no = $house_no";
        $resultt = $conn->query($get);
        $roww=$resultt->fetch_assoc();

        $getTenant = "SELECT * FROM tenants WHERE house_no = $house_no";
        $resulttt = $conn->query($getTenant);
        $rowww=$resulttt->fetch_assoc();

        $monthDel = $amount / $roww['rent'];
        $monthDelete = (int)$monthDel;
        $monthPaid = $rowww['monthPaid'] - $monthDelete;

        $reduct = "UPDATE tenants SET monthPaid = '$monthPaid' WHERE house_no = '$house_no'";
        $conn->query($reduct);
        
        $deleteSql = "DELETE FROM payment WHERE transaction_id = $id";
        $conn->query($deleteSql);
    }
    header('location:../PhpCodes/records.php');
    exit;
?>

