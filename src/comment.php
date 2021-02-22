<?php
    // session start 
    session_start();
    //set database Connection
    include_once'connection.php';

    //post comment add
     if (isset($_POST['Dcomment'])) {
        $cmnt = $_POST['user-comment'];
        $user_id = $_SESSION["id"];
        $post_id = $_POST['post_id'];
        
        $cmmt = $conn->prepare("INSERT INTO comnt(user_id, post_id, comment) VALUES(:user_id, :post_id, :comment)");
        $cmmt->bindParam(':user_id', $user_id);
        $cmmt->bindParam(':post_id', $post_id);
        $cmmt->bindParam(':comment', $cmnt);
        $showPage = $cmmt->execute();
        if ($showPage) {
            header("location: dashboard.php");
        }
    }