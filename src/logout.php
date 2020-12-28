<?php
    //logout section 
    session_start();
    unset($_SESSION["id"]);
    unset($_SESSION["email"]);
    header("Location:login.php");
?>