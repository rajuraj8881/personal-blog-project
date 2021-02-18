<?php
    include_once'connection.php';
    session_start();
    //register
    if(isset($_POST['regSubmit'])){
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $password = md5($_POST['password']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if ($name =="") {
            header('location: index.php?message=<div class="alert alert-danger ">Empty Name.</div>');
        }elseif ($email == '') {
            header('location: index.php?message=<div class="alert alert-danger ">Empty Email.</div>');
        }elseif ($password == '') {
            header('location: index.php?message=<div class="alert alert-danger ">Empty Passwoed.</div>');
        }else{
            $query = $conn->prepare( "SELECT * FROM users WHERE email = :email" );
            $query->execute(array(':email'=> $email));
            if ($query->rowCount() > 0) {
                header('location: index.php?message=<div class="alert alert-danger ">Email Allready Exist.</div>');
            }else{
                $query = $conn->prepare("INSERT INTO users(name, password, email) value(:name,:password,:email)");
                $query->bindParam(':name', $name);
                $query->bindParam(':password', $password);
                $query->bindParam(':email', $email);
                $query->execute();
                if ($query->rowCount() > 0) {
                    header('location: login.php?message=<div class="alert alert-success">Registration Successful. Please Login...</div>');
                }
            }
        } 
    }


    //login section 
    if (isset($_POST['logSubmit'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = md5($_POST['password']);
        
        if ($email == '') {
            header('location: login.php?message=<div class="alert alert-danger ">Empty Email.</div>');
        }elseif ($password == '') {
            header('location: login.php?message=<div class="alert alert-danger ">Empty Passwoed.</div>');
        }else{
            if ($email !='' && $password != '') {
                $query = "SELECT * FROM users WHERE email = :email AND password =:password";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':email',$email);
                $stmt->bindParam(':password',$password);
                $stmt->execute();
                $count = $stmt->rowCount();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($count == 1 && !empty( $row)) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['password'] = $row['password'];
                }else{
                    header('location: login.php?message=<div class="alert alert-danger ">Incorrect Email Or Passwoerd.</div>');
                } 
            }else{
                header("location:login.php");
            }
        }
    }

    if (isset($_SESSION["id"])) {
        header("location:dashboard.php");
    }

    //Add post
    if (isset($_POST['postSubmit'])) {
        $user_id = $_SESSION['id'];
        $title = $_POST['post-title'];
        $description = $_POST['post-description'];
     
        $addpost = $conn->prepare("INSERT INTO addpost(user_id, title, description) VALUES(:user_id, :titile,:description)");
        $addpost->bindParam(':user_id', $user_id);
        $addpost->bindParam(':titile', $title);
        $addpost->bindParam(':description', $description);
        $setpost = $addpost->execute();

        if ($setpost) {
            header("location:dashboard.php");
        }else{
            echo"Something want to wrong";
        }
        
    }

    //edit post
    if (isset($_POST['updatePost'])) {
        $id = $_POST['id'];
        $title = $_POST['post-title'];
        $description = $_POST['post-description'];

        $query = $conn->prepare("UPDATE addpost SET title=:title, description=:description WHERE id=:id");
        $query->bindParam(':title',$title);
        $query->bindParam(':description',$description);
        $query->bindParam(':id',$id);
        $query->execute();
        header("location: allpost.php");
    }

     //post comment add
     if (isset($_POST['comment'])) {
        $cmnt = $_POST['user-comment'];
        $user_id = $_SESSION["id"];
        $post_id = $_POST['post_id'];
        
        $cmmt = $conn->prepare("INSERT INTO comnt(user_id, post_id, comment) VALUES(:user_id, :post_id, :comment)");
        $cmmt->bindParam(':user_id', $user_id);
        $cmmt->bindParam(':post_id', $post_id);
        $cmmt->bindParam(':comment', $cmnt);
        $cmmt->execute();
    }
    
?>
