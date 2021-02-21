<?php
    // session start 
    session_start();
    //set database Connection
    include_once'connection.php';
    // include header file
    include'lib/header.php';
    // include menubar file
    include'lib/menu.php';
    
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

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActulExt, $allowed)) {
            if ($file_error === 0) {
                if ($file_size < 5000000) {
                    $file_name_new = $file_name;
                    $fileDestination = "uploads/".$file_name_new;

                    if (move_uploaded_file($file_tmp, $fileDestination)) {
                        $imgIns = $conn->prepare("UPDATE users SET imgs=:images WHERE id=:id");
                        $imgIns->bindParam(':images', $file_name);
                        $imgIns->bindParam(':id', $user_id);
                        $imgIns->execute();
                        header('location: editprofile.php');
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
    // Update profile 
    if (isset($_POST['profileSubmit'])) {
        $id = $uid;
        $name = $_POST['users-name'];
        $bio = $_POST['users-subtitle'];
        $email = $_POST['users-email'];
        $phone = $_POST['users-phone'];
        $address = $_POST['users-address'];

        $query = $conn->prepare("UPDATE users SET name=:name, bio=:bio, email=:email, phone=:phone, address=:address WHERE id=:id");
        $query->bindParam(':name',$name);
        $query->bindParam(':bio',$bio);
        $query->bindParam(':email',$email);
        $query->bindParam(':phone',$phone);
        $query->bindParam(':address',$address);
        $query->bindParam(':id',$id);
        $query->execute();
        header('location: editprofile.php');
    }
?>
    <div class="container-flued">
        <div class="row mx-5">
            <div class="col-md-2 mt-5">
            </div>
            <div class="col-md-8 mt-5">
                <div class="row mx-5 my-3 shadow-block mt-5 justify-content-center">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="float-start me-auto my-4 mb-lg-0">
                                    <h3><span>Edit Profile</span></h3>
                                </div>
                            </div>
                            <div class="col-md-6 float-end">
                                <div class="float-end">
                                    <ul class="navbar-nav me-auto my-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a href="profile.php" class="nav-link"><h3><strong>View Profile</strong></h3></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="editprofile.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="col-sm-12 text-center">
                                                    <input type="file" name="image" class="form-control-file" id="myFile">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12 text-center">
                                                    <button type="submit" name="subImages" class="btn btn-success">Upload</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <form action="editprofile.php" method="post">
                                    <?php
                                        $id = $uid;
                                        $query = $conn->prepare("SELECT * FROM users WHERE id=:id");
                                        $query->bindParam(':id', $id);
                                        $query->execute();
                                        $result = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0):
                                            foreach($result as $row):
                                    ?>
                                    <div class="row my-3">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <lable>Name : </lable>
                                                <input type="text" name="users-name" class="form-control" value="<?php echo $row->name;?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <lable>Bio : </lable>
                                                <textarea name="users-subtitle" class="form-control" id="exampleFormControlSelect1" rows="4"><?php echo $row->bio;?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <lable>Email : </lable>
                                                <input type="text" name="users-email" class="form-control" value="<?php echo $row->email;?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <lable>Phone : </lable>
                                                <input type="text" name="users-phone" class="form-control" value="<?php echo $row->phone;?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <lable>Address : </lable>
                                                <input type="text" name="users-address" class="form-control" value="<?php echo $row->address;?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" value="Submit" name="profileSubmit" class="btn btn-success">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                            endforeach;
                                        endif;
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mt-5">
            </div>
        </div>
    </div>

    <!-- include footer file -->
<?php 
    include  'lib/footer.php';
?>