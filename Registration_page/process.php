<?php
    include_once'connection.php';
    if(isset($_POST['Submit'])){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $query = $conn->prepare( "SELECT * FROM users WHERE email = :email" );
        $query->execute(array(':email'=> $email));
        if ($query->rowCount() > 0) {
            // header("location:index.php");
            echo "Email allready Exist";
        }else{
            $query = $conn->prepare("INSERT INTO users(name, password, email) value(:name,:password,:email)");
            $query->bindParam(':name', $name);
            $query->bindParam(':password', $password);
            $query->bindParam(':email', $email);
            $query->execute();
            if ($query->rowCount() > 0) {
                echo"New records created successfully";
            }
        } 
    }
?>