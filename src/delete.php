<?php
    include_once'connection.php';
    $Result = $conn->prepare("DELETE FROM addpost WHERE id=". $_GET['id']);
    $Result->execute();

    if ($Result) {
        header('location:dashboard.php');
    }else{
        echo "Something Want to wrong";
    }

 ?>