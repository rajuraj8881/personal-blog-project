<?php
    try {
        // echo "Connection is created";
        $conn = new PDO('mysql:host=localhost;dbname=test','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    //    echo "Connected successfully";  
    } catch (PDOEXCEPTION $e) {
       // echo "The error is : ".$e->getMessage();
    }
?>