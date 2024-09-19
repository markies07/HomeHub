<?php 
    $sql = "SELECT * FROM tenants";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $house = [];
        while($row=$result->fetch_assoc()){
            $house[] = $row['house_no'];
        }
    }

    if($result->num_rows > 0){
        for ($i = 0; $i < count($house); $i++) {
            $sql = "SELECT * FROM tenants WHERE house_no = $i";
            
            $sqll = "SELECT * FROM tenants INNER JOIN houses on tenants.house_no = houses.house_no WHERE tenants.house_no = $house[$i]";
            $result = $conn->query($sqll);
            $row = $result->fetch_assoc();
            $startDate = $row["startDate"];
            $monthPaid = $row["monthPaid"];
            $rent = $row["rent"];
            $balance = 0;

            $dateNow = new DateTime();
            $datePass = new DateTime($startDate);

            $today = date("j");
            $dueDate = date("j", strtotime($startDate));

            $diff = $dateNow->diff($datePass);
            $monthCount = (($diff->y) * 12) + ($diff->m);

            $credits = 0;
            $monthToPay = 0;

            if($monthCount > 0){
                for($monthPaid; $monthPaid < $monthCount; $monthPaid++){
                    if($today == $dueDate){
                        $monthToPay++;
                    }
                }
            }

            $overallRent = $monthCount * $rent;
            $balance = $monthToPay * $rent;

            $sql = "SELECT * FROM payment WHERE house_no = $house[$i]";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $amount = 0;
                while($row=$result->fetch_assoc()){
                    $amount += $row['amount'];
                }

                $paid = $amount / $rent;
                $monthPaid = (int)$paid;
                
                $sql = "UPDATE tenants SET monthPaid = '$monthPaid' WHERE house_no = $house[$i]";
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
                
                if($balance > 0){
                    $payment = "UNPAID";
                    $sql = "UPDATE tenants SET status = '$payment' WHERE house_no = $house[$i]";
                    $result = $conn->query($sql);
                    // echo $payment . "<br>";
                }
                else{
                    $payment = "PAID";
                    $sql = "UPDATE tenants SET status = '$payment' WHERE house_no = $house[$i]";
                    $result = $conn->query($sql);
                    // echo $payment . "<br>";
                }
                
            }
            // echo $house[$i];
        }
        
    }
    $sql = "SELECT * FROM tenants WHERE status = 'UNPAID'";
        $result = $conn->query($sql);
        $paid = $result->num_rows;
    
    
?>