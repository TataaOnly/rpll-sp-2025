<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "plastik";
    $port = "3306";

    $conn = mysqli_connect($servername,$username,$password,$dbname, $port);
    if(!$conn){
        echo "Connection failed: " . mysqli_connect_error();
    }
?>