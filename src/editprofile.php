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
    <div class="container-flued">
        <div class="row mx-5">
            <div class="col-md-12">
                <form action="editprofile.php" method="post" enctype="multipart/form-data">
                    <div class="row mx-5 mt-3 shadow-block">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 text-center my-5">
                                    <div class="btn btn-mdb-color btn-rounded float-left">
                                        <span>Add photo</span>
                                        <input type="file" class="form-control-file" id="myFile" name="filename">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-3 bg-success">container</div> -->
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="float-start me-auto my-3 mb-lg-0">
                                        <h3><span>Edit Profile</span></h3>
                                    </div>
                                </div>
                                <div class="col-md-6 float-end">
                                    <div class="float-end">
                                        <ul class="navbar-nav me-auto my-2 mb-lg-0">
                                            <li class="nav-item">
                                                <a href="profile.php" class="nav-link"><h3><strong>Profile</strong></h3></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row my-3">
                                        <div class="col-md-6 mt-3">
                                            <div class="float-start">
                                                <h6><strong>Raju Mondal</strong></h6>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-0">
                                            <div class="float-start">
                                                <p class="lead mb-0"><span>doloribus unde consequuntur nobis possimus quaerat veritatis repudiandae ut deleniti ex iure.</span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="float-start">
                                                <h6>Email : <strong>raju.mondal@winexsoft.com</strong></h6>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-0">
                                            <div class="float-start">
                                                <h6>Phone : <strong>+8801670 685287</strong></h6>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-0">
                                            <div class="float-start">
                                                <h6>Address : <strong>Dhaka, 1207</strong></h6>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" value="Submit" name="profileSubmit" class="btn btn-success">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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