<?php
    include_once 'connection.php';
    // include header file
    include  'lib/header.php';
    // include menubar file
    include 'lib/menu.php';

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

    //show login user all post
    $result = $conn->prepare("SELECT users.name, addpost.id, addpost.title, addpost.description FROM users INNER JOIN addpost ON users.id = addpost.user_id WHERE addpost.id='$id'");
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_OBJ);
?>
    <div class="container-flued">
        <div class="row mx-0">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <?php 
                    foreach($users as $user):
                ?>
                <div class="row my-2 p-2">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <img src="images/profile.png" class="rounded-circle" alt="Cinque Terre" width="50" height="50" >
                                <strong class="ms-0 mt-3 text-info"><?php echo $user->name;?></strong><span class="ms-3 text-muted">25 min ago.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-11 mt-2">
                                <h5><a class="nounderline" href="single.php?id=<?php echo $user->id; ?>"><?php echo $user->title; ?></a></h5>
                                <p class="lead mb-0"><?php echo $user->description; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    endforeach;
                ?>
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div>

 <!-- include footer file -->
 <?php 
    include  'lib/footer.php';
?>