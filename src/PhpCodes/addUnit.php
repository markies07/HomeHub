<?php 

    include("connection.php");

    if(isset($_POST['submit'])){
        // INFORMATION
        $house_no = $_POST['house_no'];
        $fulladdress = $_POST['fulladdress'];
        $noRoom = $_POST['noRoom'];
        $noBathroom = $_POST['noBathroom'];
        $noFloor = $_POST['noFloor'];
        $rent = $_POST['rent'];

        // QUERIES
        // if(!empty($_FILES['fileImg']['name'])){
        //     $targetDir = '../img/uploads/';

        //     if(!file_exists($targetDir)){
        //         mkdir($targetDir, 0777, true);
        //     }

        //     foreach($_FILES['fileImg']['tmp_name'] as $key => $tmpName){
        //         $fileName = basename($_FILES['fileImg']['name'][$key]);
        //         $newImageName = uniqid() . '-' . $fileName;
        //         $targetFilePath = $targetDir . $newImageName;

        //         if (move_uploaded_file($tmpName, $targetFilePath)) {
        //             $query = "INSERT INTO images (house_no, img_dir) VALUES ($house_no, '$targetFilePath')";
        //             mysqli_query($conn, $query);
                    
        //         }
        //     }
        // }

        $sql = "INSERT INTO houses (house_no, fulladdress, noRoom, noBathroom, noFLoor, rent, status) 
        VALUES ('$house_no', '$fulladdress', '$noRoom', '$noBathroom', '$noFloor', '$rent', 'unoccupied')";

        try{
            mysqli_query($conn, $sql);
            echo '<script>
                alert("Unit Added Successfully!");
                window.location.href = "../SuperAdmin/units.php";
            </script>';
        }
        catch(mysqli_sql_exception){
            echo'<script>
                alert("Could Not Add Unit!");
                window.location.href = "../SuperAdmin/units.php";
            </script>';
        }
        
    }

?>