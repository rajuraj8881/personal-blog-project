<?php
    include_once'connection.php';
    session_start();
     if (!$_SESSION['id']) {
        header('location:login.php');
    }
    $uid = $_SESSION['id'];
    $Result = $conn->prepare("DELETE FROM addpost WHERE user_id = $uid AND id=". $_GET['id']);
    $Result->execute();

    if ($Result) {
        header('location:dashboard.php');
    }else{
        echo "Something Want to wrong";
    }

 ?>