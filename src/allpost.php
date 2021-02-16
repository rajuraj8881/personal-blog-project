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

    $result = $conn->prepare("SELECT users.id, users.imgs, users.name, addpost.id, addpost.title, addpost.description FROM users INNER JOIN addpost ON users.id = addpost.user_id WHERE user_id=$uid ORDER BY addpost.id DESC");
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
                <?php
                    foreach($users as $user):
                ?>
                <div class="row my-2 p-2 shadow-block">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-10 my-2">
                                <img src="uploads/<?php echo $user->imgs;?>" class="rounded-circle" alt="Cinque Terre" width="50" height="50" >
                                <strong class="ms-0 mt-3 text-info"><?php echo $user->name;?></strong>
                            </div>
                            <div class="col-md-2 my-3">
                                <a class="ajax-action-links mx-2" href='edit.php?id=<?php echo $user->id; ?>'>
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="ajax-action-links mx-2" href='delete.php?id=<?php echo $user->id; ?>'>
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                            <hr style="height:2px; width:100%; border-width:0;" class="shadow-block">
                            <div class="col-md-12 mt-2">
                                <h5><a class="nounderline" href="single.php?id=<?php echo $user->id; ?>"><?php echo $user->title; ?></a></h5>
                                 <p class="lead mb-0"><?php echo $user->description; ?></p>
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-5">
                                    <hr style="height:2px; width:100%; border-width:0;" class="shadow-block px-4">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-2">Like <span>20</span></div>
                                    <div class="col-md-2">dislike <span>20</span></div>
                                    <div class="col-md-4 ms-2">comment <span>20</span></div>
                                </div>
                                <hr style="height:2px; width:100%; border-width:0;" class="shadow-block">
                            </div>
                            <div class="col-md-12">
                                <div class="row shadow-block mt-0 mx-0">
                                    <div class="col-md-12 my-1">
                                        <img src="uploads/<?php echo $user->imgs;?>" class="rounded-circle" alt="Cinque Terre" width="20" height="20" >
                                        <strong>Raju Mondal</strong>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="lead mb-2" style="font-size: 15px; font-style: normal;"><span>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae molestias amet inventore quia magnam corrupti ad facere libero tempore possimus maiores deserunt consequuntur beatae nemo ratione adipisci debitis, consectetur voluptates dolore veniam voluptas rem? Magni quos eos aliquam, fuga expedita enim, molestias repudiandae ipsam quod, dolore accusantium amet rem impedit!</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-1 mt-2">
                                        <img src="uploads/<?php echo $user->imgs;?>" class="rounded-circle" alt="Cinque Terre" width="50" height="50" >
                                    </div>
                                    <div class="col-md-11 mt-3">
                                        <input type="text" name="comment" class="form-control" placeholder="Write Comments">  
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
