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
    $result = $conn->prepare("SELECT * FROM users where id=$uid");
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_OBJ);
?>
    <div class="container-flued">
        <div class="row mx-5">
            <div class="col-md-2 mt-5">
            </div>
            <div class="col-md-8 mt-5">
                <?php
                    foreach($users as $user):
                ?>
                <div class="row mx-5 my-3 shadow-block mt-5 justify-content-center">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="float-start me-auto my-4 mb-lg-0">
                                    <h3><span>Profile</span></h3>
                                </div>
                            </div>
                            <div class="col-md-6 float-end">
                                <div class="float-end">
                                    <ul class="navbar-nav me-auto my-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a href="editprofile.php" class="nav-link"><h3><strong>Edit Profile</strong></h3></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mx-5 shadow-block">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6 text-center mt-5">
                                        <img src="uploads/<?php echo $user->imgs;?>" alt="profile-image" style="width: 160px; height: 120px; border-radius: 5px;"/>
                                        <h6 class="margin-top:5px;">Recent Profile Picture</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row my-3 shadow-block">
                                    <div class="col-md-6 mt-3 mx-3">
                                        <div class="float-start">
                                            <h6>Name : <strong><?php echo $user->name; ?></strong></h6>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 mx-3">
                                        <div class="float-start">
                                            <h6>Bio :</h6>
                                            <p class="lead mb-0"><?php echo $user->bio; ?></span></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4 mx-3">
                                        <div class="float-start">
                                            <h6>Email : <strong><?php echo $user->email; ?></strong></h6>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-0 mx-3">
                                        <div class="float-start">
                                            <h6>Phone : <strong><?php echo $user->phone; ?></strong></h6>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 mx-3">
                                        <div class="float-start">
                                            <h6>Address : <strong><?php echo $user->address; ?></strong></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    endforeach;
                ?>
            </div>
            <div class="col-md-2 mt-5">
            </div>
        </div>
    </div>

    <!-- include footer file -->
<?php 
    include  'lib/footer.php';
?>