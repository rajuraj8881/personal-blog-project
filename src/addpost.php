<?php
    include_once'connection.php';
    session_start();
    $id = NULL;
    if(isset($_POST['id'])){
        $id = $_POST['id'];
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $urAdpst = $conn->prepare("SELECT * FROM users WHERE id=$id");
    $urAdpst->execute();
    $userid = $urAdpst->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1>Add Post</h1>
            <h1><a href="dashboard.php">Home</a></h1>
            <form action="process.php" method="post">
                <?php
                    foreach($userid as $user):
                ?>
                <input type="hidden" name="user_id" value="<?php echo $user->id;?>"><br>
                <?php
                    endforeach;
                ?>
                <label>Title:</label><br>
                <input type="text" name="post-title"><br>
                <label>Description:</label><br>
                <textarea rows="4" cols="50" name="post-description"></textarea>
                <br><br>
                <input type="submit" value="Submit" name="postSubmit">
            </form>
        </div>
    </div>
</body>
</html>
