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
    if (!$_SESSION['id']) {
        header('location:login.php');
    }
    $uid = $_SESSION['id'];

    $result = $conn->prepare("SELECT * FROM addpost WHERE id='$id' ");
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simgle Post</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        button.like{
            width: 30px;
            height: 30px;
            margin: 0 auto;
            line-heigth: 50px;
            border-radius: 50%;
            color: rgba(0,150,136 ,1);
            background-color:rgba(38,166,154 ,0.3);
            border-color: rgba(0,150,136 ,1);
            border-width: 1px;
            font-size: 15px;
        }

        button.dislike{
            width: 30px;
            height: 30px;
            margin: 0 auto;
            line-heigth: 50px;
            border-radius: 50%;
            color: rgba(255,82,82 ,1);
            background-color: rgba(255,138,128 ,0.3);
            border-color: rgba(255,82,82 ,1);
            border-width: 1px;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <?php include'lib/menu.php'?>
        </div>
    </div>
    <div>
        <?php
            foreach($users as $user):
        ?>
        <h1 style="font-size:60px;"><?php echo $user->title; ?></h1>
        <p><?php echo $user->description; ?></p>
        <?php
            endforeach;
        ?>
    </div>
    <div class="container">
        <div class="row">
            <button class="like">
                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
            </button>
            <button class="dislike">
                <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
            </button>
            <div class="count">
            <span><i>10</i></span>
            <span><i>10</i></span>
            </div>

        </div>
        <div class="comment">
            <h5><span><i>(10)</i></span> Show All Comment</h5>
            <?php
                //Show comment Query
                $cmmt = $conn->prepare("SELECT users.id, users.name, comnt.comment 
                                FROM users INNER JOIN comnt ON users.id = comnt.user_id 
                                where post_id= $id");
                $cmmt->execute();
                while($row = $cmmt->fetch(PDO::FETCH_OBJ)){  
            ?>
                <H3><?php echo $row->name; ?></H3>
                <p><?php echo $row->comment; ?></p>

            <?php
                }
            ?>
        <div class="row">
            <div>
                <label>
                    <span>Comment</span><span>*</span>
                </label>

                <div>
                    <form action="process.php" method="post">
                        <?php
                            foreach($users as $user):
                        ?>
                        <input type="hidden" name="user_id" value="<?php echo $uid; ?>">
                        <input type="hidden" name="post_id" value="<?php echo $user->id; ?>">
                        <?php 
                            endforeach;
                        ?>
                        <textarea placeholder="YOUR TEXT" rows="4"  cols="50"  name="user-comment"></textarea>
                        <br>
                        <input type="submit" value="comment" name="comment">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
