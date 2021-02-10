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

   
?>
    <div class="container-flued">
        <div class="row mx-5">
            <div class="col-md-12">
                <div class="row mx-5 mt-3 shadow-block">
                    <div class="col-md-6">
                        <div class="row justify-content-center ">
                            <div class="col-md-12 text-center my-5">
                                <img src="uploads/60201f0369b147.79971398.jpg" alt="profile-image" style="width: 160px; height: 120px; border-radius: 5px;"/>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- include footer file -->
<?php 
    include  'lib/footer.php';
?>