<?php
    include_once'connection.php';
    // include header file
    include  'lib/header.php';
    // include menubar file
    include 'lib/menu.php';

    session_start();
    if (!$_SESSION['id']) {
        header('location:login.php');
    }
    $uid = $_SESSION['id'];
    $result = $conn->prepare("SELECT * FROM addpost where user_id=$uid");
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_OBJ);
?>  
    <?php
        if (isset($_SESSION['email'])) {
    ?>
    
    <div class="container-flued">
        <div class="row mx-0">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 bg-transparent">
                <div class="row">
                    <div class="col-md-12">
                    <?php
                                $counter = 0;
                                foreach($users as $user):
                            ?>
                        <div class="row shadow-block mt-3">
                            
                            <div class="col-md-1 mt-2">
                                <h5><?php echo ++$counter."."; ?></h5>
                            </div>
                            <div class="col-md-9 mt-2">
                                <h5><a class="nounderline" href="single.php?id=<?php echo $user->id; ?>"><?php echo $user->title; ?></a></h5>
                            </div>
                            <div class="col-md-2 mt-2">
                                <a class="ajax-action-links mx-2" href='edit.php?id=<?php echo $user->id; ?>'>
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="ajax-action-links mx-2" href='delete.php?id=<?php echo $user->id; ?>'>
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                            
                        </div>
                        <?php
                                endforeach;
                            ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div>

    <?php
        }else echo "<h1>Please login first.</h1>";
    ?>
    <!--include footer file -->
<?php 
    include  'lib/footer.php'; 
?>
