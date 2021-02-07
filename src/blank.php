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
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1><strong>Profile</strong></h1>
                <form action="profile.php" method="post" enctype="multipart/form-data">
                    <div class="profile-thumb-block">
                        <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="profile-image" class="profile"/>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="file" name="image" class="form-control-file" id="myFile" require>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" name="subImages" class="btn btn-success">Upload</button>
                        </div>
                    </div>
                </form>

                <form>
                    <div class="form-group">
                        <label class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-4">
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-form-label">Addresss</label>
                        <div class="col-md-4">
                            <input type="text" name="addresss" class="form-control" placeholder="address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-4">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" value="Submit" name="profileDet" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- include footer file -->
<?php 
    include  'lib/footer.php';
?>