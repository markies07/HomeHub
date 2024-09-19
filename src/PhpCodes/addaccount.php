<?php 

    include("connection.php");

    if(isset($_POST['submit'])){
        $fullname = $_POST['fullname'];
        $role = $_POST['role'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repass = $_POST['con-password'];

        $hashed_pass = password_hash($repass, PASSWORD_DEFAULT);

        $check = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($check);

        if($password != $repass){
            echo'<script>
                window.location.href = "../SuperAdmin/account.php";
                alert("Password and Confirm Password do not match!");
            </script>';
        }
        else if($result->num_rows > 0){
            echo'<script>
                window.location.href = "../SuperAdmin/account.php";
                alert("Username is already taken! Try another one.");
            </script>';
        }
        else{
            if($role == 'tenant'){
                $check = "SELECT * FROM tenants WHERE fullname = '$fullname'";
                $result = $conn->query($check);
                if($result->num_rows > 0){
                    $sql = ("INSERT INTO users (fullname, role, username, password) 
                    VALUES ('$fullname', '$role', '$username', '$hashed_pass');");

                    try{
                        mysqli_query($conn, $sql);
                        echo '<script>
                            window.location.href = "../SuperAdmin/account.php";
                            alert("Registered Successfully!");
                        </script>';
                    }
                    catch(mysqli_sql_exception){
                        echo'<script>
                            window.location.href = "../SuperAdmin/account.php";
                            alert("Could Not Register Account!");
                        </script>';
                    }
                }
                else{
                    echo'<script>
                            window.location.href = "../SuperAdmin/account.php";
                            alert("User must be your tenant first!");
                        </script>';
                }

            }
            else{
                $sql = ("INSERT INTO users (fullname, role, username, password) 
                VALUES ('$fullname', '$role', '$username', '$hashed_pass');");

                try{
                    mysqli_query($conn, $sql);
                    echo '<script>
                        window.location.href = "../SuperAdmin/account.php";
                        alert("Registered Successfully!");
                    </script>';
                }
                catch(mysqli_sql_exception){
                    echo'<script>
                        window.location.href = "../SuperAdmin/account.php";
                        alert("Could Not Register Account!");
                    </script>';
                }
            }
        }
    }

?>