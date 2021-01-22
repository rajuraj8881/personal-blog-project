<?php
    include_once'connection.php';
    session_start();
    if (!$_SESSION['id']) {
        header('location:login.php');
    }
    $uid = $_SESSION['id'];
?>
    <!-- include header file -->
    <?php include  'lib/header.php'; ?>
    <!-- include menubar file -->
    <?php include'lib/menu.php'?>

    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1><strong>Add Post</strong></h1>
                <form action="process.php" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $uid?>"><br>
                    <div class="form-group row">
                        <label class="col-md-1 col-form-label"><strong>Title</strong></label>
                        <div class="col-md-11">
                            <input type="text" name="post-title" class="form-control"  placeholder="Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><strong>Description</strong></label>
                        <textarea name="post-description" class="form-control" id="exampleFormControlSelect1" rows="4" placeholder="Write Here"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" value="Submit" name="postSubmit" class="btn btn-success">Add Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- include footer file -->
    <?php include  'lib/footer.php'; ?>
