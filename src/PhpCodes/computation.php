<?php

    include("connection.php");


    $dateNow = new DateTime();
    $datePass = new DateTime($startDate);
    $today = date("j");
    $dueDate = date("j", strtotime($startDate));
    $diff = $dateNow->diff($datePass);
    $monthCount = (($diff->y) * 12) + ($diff->m);
    $dayCount = ($monthCount * 30) + ($diff->d) ;
    $weekCount = floor($dayCount / 7) - 4;

    // echo $monthCount . ' months <br>';
    // echo "$today today <br>";
    // echo "$dueDate due date <br>";


    // COMPUTATION

    // $credits = $deposit;
    $credits = 0;
    $monthToPay = 0;
    // echo $monthPaid . ' paid <br>';

    if($monthCount > 0){
        for($monthPaid; $monthPaid < $monthCount; $monthPaid++){
            if($today == $dueDate){
                $monthToPay++;
            }
        }
    }
    // echo $monthToPay . ' month to pay <br>';
    // $balance = $monthToPay * $rent;
    $overallRent = $monthCount * $rent;
    $balance = $monthToPay * $rent;
    // echo $overallRent . ' overall rent <br>';
    // echo $deposit;


    // PAYMENT PROCESS
    
    $sql = "SELECT * FROM payment WHERE house_no = $house_no";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $amount = 0;
        while($row=$result->fetch_assoc()){
            $amount += $row['amount'];
        }

        $paid = $amount / $rent;
        $monthPaid = (int)$paid;
        
        $sql = "UPDATE tenants SET monthPaid = '$monthPaid' WHERE house_no = '$house_no'";
        $result = $conn->query($sql);

        

        if($amount < $rent){
            $balance -= $amount;
        }
        else if($amount >= $rent){
            if($amount < $overallRent){
                $balance = $overallRent - $amount;
            }
            else if($amount >= $overallRent){
                $credits = $amount - $overallRent;
                $balance = 0;
            }
            
        }
        // echo "$amount paid <br>"; 
    }
    if($balance > 0){
        $payment = "UNPAID";
        $sql = "UPDATE tenants SET payment = '$payment' WHERE house_no = '$house_no'";
        $result = $conn->query($sql);
    }
    else{
        $payment = "PAID";
        $sql = "UPDATE tenants SET payment = '$payment' WHERE house_no = '$house_no'";
        $result = $conn->query($sql);   
    }
?>