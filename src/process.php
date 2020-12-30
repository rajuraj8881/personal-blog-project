<?php
    include_once'connection.php';
    session_start();
    //register
    if(isset($_POST['regSubmit'])){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];

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
      $email = $_POST['email'];
      $password = $_POST['password'];
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
        $title = $_POST['post-title'];
        $description = $_POST['post-description'];
     
        $addpost = $conn->prepare("INSERT INTO addpost(title, description) VALUES(:titile,:description)");
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
    
?>