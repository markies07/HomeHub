<?php 
    include("connection.php");

    $role = '';

    if(isset($_POST['submit'])){

        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = isset($_POST['role']) ? htmlspecialchars($_POST['role']) : '';


        if(empty($username) || empty($role) || empty($password)){
            echo'<script>
                window.location.href = "../index.php";
                alert("Please fill up all the fields!");
            </script>';
        }

        $sql = "SELECT * FROM users WHERE username='$username' AND role='$role'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $destination = $row['role'];
            if(password_verify($password, $row['password'])){
                session_start();
                $_SESSION['role'] = "";
                $_SESSION['user_id'] = "";
                $_SESSION['house_no'] = "";
                if($destination == "super admin"){
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['role'] = 'super admin';
                    header("Location: ../SuperAdmin/dashboard.php");
                }
                else if($destination == "admin"){
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['role'] = 'admin';
                    header("Location: ../Admin/units.php");
                }
                else if($destination == "tenant"){
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['role'] = 'tenant';

                
                    $sql = "SELECT fullname FROM users WHERE username = '$username'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $fullname = $row['fullname'];

                    $num = "SELECT * FROM tenants WHERE fullname = '$fullname'";
                    $result2 = $conn->query($num);
                    $row2 = $result2->fetch_assoc();
                    $_SESSION['house_no'] = $row2['house_no'];

                    $check = "SELECT house_no FROM tenants WHERE fullname = '$fullname'";
                    $resulta = $conn->query($check);
                    $rows = $resulta->fetch_assoc();
                    header("Location: ../Tenant/tenant.php?house_no=$rows[house_no]");
                }
            }
            else{
                echo '<script>
                alert("Incorrect Password");
                window.location.href = "../index.php";
                </script>';
            }
        }
        else{
            echo '<script>
            alert("Wrong Credentials: Incorrect username and role");
            window.location.href = "../index.php";
            </script>';
        }
    }

?>