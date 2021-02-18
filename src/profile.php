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
            <div class="col-md-12">
                <?php
                    foreach($users as $user):
                ?>
                <div class="row mx-5 mt-3 shadow-block">
                    <div class="col-md-6">
                        <div class="row justify-content-center ">
                            <div class="col-md-12 text-center my-5">
                                <img src="uploads/<?php echo $user->imgs;?>" alt="profile-image" style="width: 160px; height: 120px; border-radius: 5px;"/>
                                <h6>Recent Profile Picture</h6>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-3 bg-success">container</div> -->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="float-start me-auto my-3 mb-lg-0">
                                    <h3><span>Profile</span></h3>
                                </div>
                            </div>
                            <div class="col-md-6 float-end">
                                <div class="float-end">
                                    <ul class="navbar-nav me-auto my-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a href="editprofile.php" class="nav-link"><h3><strong>Edit</strong></h3></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row my-3">
                                    <div class="col-md-6 mt-3">
                                        <div class="float-start">
                                            <h6><strong><?php echo $user->name; ?></strong></h6>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-0">
                                        <div class="float-start">
                                            <p class="lead mb-0"><span><?php echo $user->bio; ?></span></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="float-start">
                                            <h6>Email : <strong><?php echo $user->email; ?></strong></h6>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-0">
                                        <div class="float-start">
                                            <h6>Phone : <strong><?php echo $user->phone; ?></strong></h6>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-0">
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
        </div>
    </div>

    <!-- include footer file -->
<?php 
    include  'lib/footer.php';
?>