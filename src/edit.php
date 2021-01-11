<?php 
    include_once'connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1>Add Post</h1>
            <h1><a href="dashboard.php">Home</a></h1>
            <form action="process.php" method="post">
           
            <?php
                  $id = NULL;
                if(isset($_POST['id'])){
                    $id = $_POST['id'];
                }

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
               
                $query = $conn->prepare("SELECT * FROM addpost WHERE id=:id");
                $query->bindParam(':id', $id);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0):
                    foreach($result as $row):
            ?>  <input type="hidden" name="id" value="<?php echo $row->id;?>">
                <label>Title:</label><br>
                <input type="text" name="post-title" value="<?php echo $row->title;?>"><br>
                <label>Description:</label><br>
                <textarea rows="4" cols="50" name="post-description"><?php echo $row->description;?></textarea>
                <br><br>
            <?php
                    endforeach;
                endif;
            ?>
                <input type="submit" value="Update" name="sUpdate">
            </form>
        </div>
    </div>
</body>
</html>
