<?php 

    include("connection.php");
    session_start();

    if(isset($_POST['submit'])){
        $house_no = $_POST['house_no'];
        $fullname = $_POST['fullname'];
        $MOP = $_POST['MOP'];
        $amount = $_POST['amount'];

        $check = "SELECT * FROM tenants WHERE house_no = '$house_no' AND fullname = '$fullname'";
        $result = $conn->query($check);
        
        if($result->num_rows == 0){
            if($_SESSION['role'] == 'super admin'){
                echo "<script>
                alert('House number and Tenants name is incorrect!');
                window.location.href = '../SuperAdmin/payment.php';
                </script>";
            }
            else if($_SESSION['role'] == 'admin'){
                echo "<script>
                alert('House number and Tenants name is incorrect!');
                window.location.href = '../Admin/payment.php';
                </script>";
            }
        }
        else{
            $sql = ("INSERT INTO payment (house_no, fullname, MOP, amount) VALUES ('$house_no', '$fullname', '$MOP', '$amount');");

            if($_SESSION['role'] == 'super admin'){
                try{
                    mysqli_query($conn, $sql);
                    echo '<script>
                        window.location.href = "../SuperAdmin/payment.php";
                        alert("Payment Successfully Added!");
                    </script>';
                }
                catch(mysqli_sql_exception){
                    echo'<script>
                        window.location.href = "../SuperAdmin/payment.php";
                        alert("Payment Failed!");
                    </script>';
                }
            }
            else if($_SESSION['role'] == 'admin'){
                try{
                    mysqli_query($conn, $sql);
                    echo '<script>
                        window.location.href = "../Admin/payment.php";
                        alert("Payment Successfully Added!");
                    </script>';
                }
                catch(mysqli_sql_exception){
                    echo'<script>
                        window.location.href = "../Admin/payment.php";
                        alert("Payment Failed!");
                    </script>';
                }
            }
        }
    }

?>