<?php
    include_once 'connection.php';
    // include header file
    include  'lib/header.php';
    // include menubar file
    include 'lib/menu.php';
     // session start 
     session_start();
     if (!$_SESSION['id']) {
         header('location:login.php');
     }
     //get login user id and name
     $uid = $_SESSION['id'];
     $uName = $_SESSION['name'];

    if(isset($_POST['subImages'])){
        $user_id = $uid;
        $_FILES['image']['name'];

        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_error = $_FILES['image']['error'];
        $file_size = $_FILES['image']['size'];
        $file_type = $_FILES['image']['type'];
        
        $fileExt = explode('.', $file_name);
        $fileActulExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        if (in_array($fileActulExt, $allowed)) {
            if ($file_error === 0) {
                if ($file_size < 5000000) {
                    $file_name_new = uniqid('', true).".".$fileActulExt;
                    $fileDestination = "uploads/".$file_name_new;

                    if (move_uploaded_file($file_tmp, $fileDestination)) {
                        $imgIns = $conn->prepare("INSERT INTO img (imgs, name) VALUES(:images, :name)");
                        $imgIns->bindParam(':images', $file_name);
                        $imgIns->bindParam(':name', $user_id);
                        $imgIns->execute();
                        header('location: profile.php?done');
                    }else{
                        echo "Your directory Missing!";
                    }  
                }else{
                    echo "Your file is too large!";
                }
            }else{
                echo "There was an error uploading your file!";
            }
        }else{
            echo "You cannot upload files of this type!";
        }
    }
?>
    

    <!-- include footer file -->
<?php 
    include  'lib/footer.php';
?>