<?php
    include("connection.php");
    $house_no = $_POST["house_no"];

    $house_no = intval($house_no);

    $house_no = mysqli_real_escape_string($conn, $house_no);
    $sql = "SELECT * FROM tenants WHERE house_no = $house_no";
    $result = $conn->query($sql);

    $fullname = "";

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fullname = $row["fullname"];
    } 
    else{
        $fullname = ""; // No information found
    }
    echo $fullname;
?>
