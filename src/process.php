<?php
    include_once'connection.php';
    session_start();
    //register
    if(isset($_POST['regSubmit'])){
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $password = md5($_POST['password']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        $query = $conn->prepare( "SELECT * FROM users WHERE email = :email" );
        $query->execute(array(':email'=> $email));
        if ($query->rowCount() > 0) {
            echo "Email allready Exist";
        }else{
            $query = $conn->prepare("INSERT INTO users(name, password, email) value(:name,:password,:email)");
            $query->bindParam(':name', $name);
            $query->bindParam(':password', $password);
            $query->bindParam(':email', $email);
            $query->execute();
            if ($query->rowCount() > 0) {
                header("location:login.php");
            }
        }
    }


    //login section 
    if (isset($_POST['logSubmit'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = md5($_POST['password']);  
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
                echo"Email or password are wrong";
            } 
        }else{
            header("location:login.php");
        }
    }

    if (isset($_SESSION["id"])) {
        header("location:dashboard.php");
    }

    //Add post
    if (isset($_POST['postSubmit'])) {
        $user_id = $_POST['user_id'];
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
            echo"Success";
    }

     //post comment add
     if (isset($_POST['comment'])) {
        $cmnt = $_POST['user-comment'];
        $post_id = $_POST['post_id'];
        
        $cmmt = $conn->prepare("INSERT INTO comnt(post_id, comment) VALUES(:post_id, :comment)");
        $cmmt->bindParam(':comment', $cmnt);
        $cmmt->bindParam(':post_id', $post_id);
        $cmmt->execute();
    }
    
?>
