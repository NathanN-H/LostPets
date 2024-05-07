<?php

    $servername = "localhost";
    $username = "root";
    $password = "";

    $con = mysqli_connect($servername, $username, $password, "lost_pets");

    if($con->connect_error) {
        die("connection failed: " . $con->connect_error);
    }
    //echo "Connected Successfully";

            /*$con = new PDO("mysql:host=localhost;w21025072=w21025072",
                                    "w21025072", "9eN8H@phPC@1") or die("Could not connect");
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        
            throw new Exception("Connection error ". $e->getMessage(), 0, $e);*/
        
    
?>