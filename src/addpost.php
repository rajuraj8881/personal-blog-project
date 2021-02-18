<?php
    // session start 
    session_start();
    //set database Connection
    include_once'connection.php';
    
    if (!$_SESSION['id']) {
        header('location:login.php');
    }
    $uid = $_SESSION['id'];
?>
    <!-- include header file -->
    <?php include  'lib/header.php'; ?>
    <!-- include menubar file -->
    <?php include'lib/menu.php'?>

    <div class="container-flued">
        <div class="row mx-5">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <div class="row my-2 shadow-block mt-5">
                    <div class="col-md-12">
                        <h1>Add New Post</h1>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 ">
                                <form action="process.php" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="post-title" class="form-control"  placeholder="Enter title here">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="file" name="image" class="form-control-file" id="myFile" require>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="post-description" class="form-control" id="exampleFormControlSelect1" rows="8" placeholder="Write Here"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group">
                                                <button type="submit" value="Submit" name="postSubmit" class="btn btn-primary">Add Post</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- include footer file -->
    <?php include  'lib/footer.php'; ?>
