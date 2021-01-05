<?php
    include_once'connection.php';
    
    if(isset($_POST['Submit'])){
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        $query = $conn->prepare( "SELECT * FROM users WHERE email = :email" );
        $query->execute(array(':email'=> $email));
        if ($query->rowCount() > 0) {
            // header("location:index.php");
            echo "Email allready Exist";
        }else{
            $query = $conn->prepare("INSERT INTO users(name, password, email) value(:name,:password,:email)");
            $query->bindParam(':name', $name);
            $query->bindParam(':password', $password_hash);
            $query->bindParam(':email', $email);
            $query->execute();
            if ($query->rowCount() > 0) {
                echo"New records created successfully";
            }
        } 
    }
?>