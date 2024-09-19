<?php 

    include("connection.php");

    if(isset($_POST['submit'])){
        $id = $_GET['house_no'];
       
        if(isset($_FILES['fileImg'])){
            $targetDir = '../img/uploads/';

            
            if(!file_exists($targetDir)){
                mkdir($targetDir, 0777, true);
            }

            foreach($_FILES['fileImg']['tmp_name'] as $key => $tmpName){
                $fileName = basename($_FILES['fileImg']['name'][$key]);
                $newImageName = uniqid() . '-' . $fileName;
                $targetFilePath = $targetDir . $newImageName;

                if (move_uploaded_file($tmpName, $targetFilePath)) {
                    $query = "INSERT INTO images (house_no, img_dir) VALUES ($id, '$targetFilePath')";
                    
                    try{
                        mysqli_query($conn, $query);

                        echo "<script>
                        alert('Images Added Successfully!');
                        window.location.href = 'houseInfo.php?house_no=$id';
                        </script>";
                        
                    }
                    catch(mysqli_sql_exception){
                        echo"<script>
                            alert('Could Not Add Images!');
                            window.location.href = 'houseInfo.php?house_no=$id';
                        </script>";
                    }
                }       
            }  
        }   
        if(isset($_FILES['allImg'])){
            $targetDir = '../img/uploads/';

            
            if(!file_exists($targetDir)){
                mkdir($targetDir, 0777, true);
            }

            foreach($_FILES['allImg']['tmp_name'] as $key => $tmpName){
                $fileName = basename($_FILES['allImg']['name'][$key]);
                $newImageName = uniqid() . '-' . $fileName;
                $targetFilePath = $targetDir . $newImageName;

                if (move_uploaded_file($tmpName, $targetFilePath)) {
                    $query = "INSERT INTO images (house_no, img_dir) VALUES ($id, '$targetFilePath')";
                    
                    try{
                        mysqli_query($conn, $query);

                        echo "<script>
                        alert('Images Added Successfully!');
                        window.location.href = 'houseInfo.php?house_no=$id';
                        </script>";
                    }
                    catch(mysqli_sql_exception){
                        echo"<script>
                            alert('Could Not Add Images!');
                            window.location.href = 'houseInfo.php?house_no=$id';
                        </script>";
                    }
                }       
            }  
        }   
    }

?>