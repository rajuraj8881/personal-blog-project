<?php
    include_once'connection.php';
    session_start();
    //register
    if(isset($_POST['regSubmit'])){
        $name = real_escape_string($_POST['name']);
        $password = $_POST['password'];
        $password = md5($password);
        $email = real_escape_string($_POST['email']);

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
      $email = real_escape_string($_POST['email']);
      $password = $_POST['password'];
      $password = md5($password);
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

    
?>