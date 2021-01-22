<?php
    include_once'connection.php';
    session_start();
    if (!$_SESSION['id']) {
        header('location:login.php');
    }
    $uid = $_SESSION['id'];
?>
    //include header file
    <?php include  'lib/header.php'; ?>

    <div class="container">
    <?php include'lib/menu.php'?>
        <div class="row">
            <h1>Add Post</h1>
            <h1><a href="dashboard.php">Home</a></h1>
            <form action="process.php" method="post">
                <input type="hidden" name="user_id" value="<?php echo $uid?>"><br>
                <label>Title:</label><br>
                <input type="text" name="post-title"><br>
                <label>Description:</label><br>
                <textarea rows="4" cols="50" name="post-description"></textarea>
                <br><br>
                <input type="submit" value="Submit" name="postSubmit">
            </form>
        </div>
    </div>
    
    //include footer file
    <?php include  'lib/footer.php'; ?>
