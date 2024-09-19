<?php
    include("connection.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];


        // DELETING IMAGES
        $sql2 = "SELECT * FROM images WHERE house_no = $id";
        $result2 = $conn->query($sql2);

        if($result2->num_rows > 0){
            $row2=$result2->fetch_assoc();

            if($row2['house_no'] == $id){
                $sql2 = "DELETE FROM images WHERE house_no = $id";
                $conn->query($sql2);
            }

            // while($row2=$result2->fetch_assoc()){
            //     $imgPath = $row2['img_dir'];
            //     if(file_exists($imgPath)){
            //         unlink($imgPath);
            //     }
            // }
        }
        
        
        // DELETING TENANTS
        $tenant = "SELECT * FROM tenants WHERE house_no = $id";
        $resultt = $conn->query($tenant);

        if($resultt->num_rows > 0){
            $totalPaid = 0;

            $roww = $resultt->fetch_assoc();
            $payment = "SELECT * FROM payment WHERE house_no = $id";
            $result = $conn->query($payment);
            while ($row = $result->fetch_assoc()) {
                $totalPaid += $row['amount'];
            }

            $former = "INSERT INTO former_tenants (house_no, fullname, startDate, totalPaid)
            VALUES ('$id', '$roww[fullname]', '$roww[startDate]', $totalPaid)";
            $conn->query($former);

            $terminate = "DELETE FROM tenants WHERE house_no = $id";
            $deleteSql = "DELETE FROM payment WHERE house_no = $id";
            $conn->query($terminate);
            $conn->query($deleteSql);
        }
        
        
        // DELETING HOUSE
        $sql = "DELETE FROM houses WHERE house_no = $id";
        $conn->query($sql);
    }
    header('location: ../SuperAdmin/units.php');
    exit;
?>