<?php
    // session start
    session_start();
    //set database Connection
    include_once'connection.php';
    // include header file
    include'lib/header.php';
    // include menubar file
    include'lib/menu.php';

    if (!$_SESSION['id']) {
        header('location:login.php');
    }
    $uid = $_SESSION['id'];

    //post comment add
    if (isset($_POST['Dcomment'])) {
        $cmnt = $_POST['user-comment'];
        $user_id = $_SESSION["id"];
        $post_id = $_POST['post_id'];
        
        $cmmt = $conn->prepare("INSERT INTO comnt(user_id, post_id, comment) VALUES(:user_id, :post_id, :comment)");
        $cmmt->bindParam(':user_id', $user_id);
        $cmmt->bindParam(':post_id', $post_id);
        $cmmt->bindParam(':comment', $cmnt);
        $showPage = $cmmt->execute();
    }

    $result = $conn->prepare("SELECT users.id, users.imgs, users.name, addpost.id, addpost.title, addpost.description FROM users INNER JOIN addpost ON users.id = addpost.user_id WHERE user_id=$uid ORDER BY addpost.id DESC");
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_OBJ);
?>  
    <?php
        if (isset($_SESSION['email'])) {
    ?>
    
    <div class="container-flued">
        <div class="row mx-0 mt-5">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 bg-transparent my-3">
                <?php
                    foreach($users as $user):
                ?>
                <div class="row my-2 p-2 shadow-block mt-4">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-10 my-4">
                                <img src="uploads/<?php echo $user->imgs;?>" class="rounded-circle" alt="Cinque Terre" width="50" height="50" >
                                <strong class="ms-0 text-info"><?php echo $user->name;?></strong>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr style="height:2px; width:100%; border-width:0;" class="shadow-block px-4">
                                        <?php
                                            //like dislike System
                                            if (isset($_POST['like']) ) {
                                                $post_id = $_POST['post_id'];
                                                $type = true;
                                                $type2 = false;

                                                //check user already like
                                                $query = $conn->prepare( "SELECT * FROM likesdislikes WHERE post_id = :post_id AND user_id = :user_id AND islikes = :islikes");
                                                $query->execute(array(':post_id'=> $post_id,
                                                                        ':user_id'=> $uid,
                                                                        ':islikes' => $type
                                                    ));
                                                if ($query->rowCount() == 0) {
                                                    //If before the user does not like  then insert 1(like)
                                                    $like = $conn->prepare("INSERT INTO likesdislikes(user_id, post_id, islikes) VALUES(:user_id, :post_id, :islikes)");
                                                    $like->bindParam(':user_id', $uid);
                                                    $like->bindParam(':post_id', $post_id);
                                                    $like->bindParam(':islikes', $type);
                                                    $like->execute();
                                                }elseif ($query->rowCount() == 1){
                                                    //If before the user does not like  then insert 1(like)
                                                    $like = $conn->prepare("DELETE FROM likesdislikes WHERE user_id = $uid AND post_id = $post_id");
                                                    $like->execute();
                                                }

                                                //check user already dislike 
                                                $unlikeChack = $conn->prepare( "SELECT * FROM likesdislikes WHERE post_id = :post_id AND user_id = :user_id AND islikes = :islikes");
                                                $unlikeChack->execute(array(':post_id'=> $post_id,
                                                                        ':user_id'=> $uid,
                                                                        ':islikes' => $type2
                                                    ));
                                                if ($unlikeChack->rowCount() == 1) {
                                                    //if user allready dislike then like
                                                    $dele = $conn->prepare( "DELETE FROM likesdislikes WHERE post_id = :post_id AND user_id = :user_id AND islikes = :islikes");
                                                    $dele->bindParam(":post_id",$post_id,PDO::PARAM_INT);
                                                    $dele->bindParam(":user_id",$uid,PDO::PARAM_INT);
                                                    $dele->bindParam(":islikes",$type2,PDO::PARAM_INT);
                                                    $dele->execute();
                                                }

                                            }else if (isset($_POST['dislike']) ) {
                                                $post_id = $_POST['post_id'];
                                                $type = false;
                                                $type2 = true;

                                                //check user already like
                                                $query = $conn->prepare( "SELECT * FROM likesdislikes WHERE post_id = :post_id AND user_id = :user_id AND islikes = :islikes");
                                                $query->execute(array(':post_id'=> $post_id,
                                                                        ':user_id'=> $uid,
                                                                        ':islikes' => $type
                                                    ));
                                                if ($query->rowCount() == 0) {
                                                    //If the user does not dislike before then insert 0(dislike)
                                                    $dislike = $conn->prepare("INSERT INTO likesdislikes(user_id, post_id, islikes) VALUES(:user_id, :post_id, :islikes)");
                                                    $dislike->bindParam(':user_id', $uid);
                                                    $dislike->bindParam(':post_id', $post_id);
                                                    $dislike->bindParam(':islikes', $type);
                                                    $dislike->execute();
                                                }elseif ($query->rowCount() == 1){
                                                    //If before the user does not like  then insert 1(like)
                                                    $like = $conn->prepare("DELETE FROM likesdislikes WHERE user_id = $uid AND post_id = $post_id");
                                                    $like->execute();
                                                }

                                                //check user already like 
                                                $likeChack = $conn->prepare( "SELECT * FROM likesdislikes WHERE post_id = :post_id AND user_id = :user_id AND islikes = :islikes");
                                                $likeChack->execute(array(':post_id'=> $post_id,
                                                                        ':user_id'=> $uid,
                                                                        ':islikes' => $type2
                                                    ));
                                                if ($likeChack->rowCount() == 1) {
                                                    //if user allready like then dislike
                                                    $dele = $conn->prepare( "DELETE FROM likesdislikes WHERE post_id = :post_id AND user_id = :user_id AND islikes = :islikes");
                                                    $dele->bindParam(":post_id",$post_id,PDO::PARAM_INT);
                                                    $dele->bindParam(":user_id",$uid,PDO::PARAM_INT);
                                                    $dele->bindParam(":islikes",$type2,PDO::PARAM_INT);
                                                    $dele->execute();
                                                }
                                            }
                                        ?>
                                        <form action="" method="post">
                                            <div class="row">
                                                <input type="hidden" name="post_id" value="<?php echo $user->id; ?>">
                                                <div class="col-md-1">
                                                    <button class="like" type="submit" name="like">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                            <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="col-md-1">
                                                    <?php
                                                        $checkLike = $conn->prepare("SELECT COUNT(islikes) FROM likesdislikes WHERE post_id = ($user->id) AND islikes = 1");
                                                        $checkLike->execute();
                                                        $totaLike = $checkLike->fetchColumn();
                                                    ?>
                                                    <h4><span class="text-success"><?php echo $totaLike;?></span></h4>
                                                </div>
                                                <div class="col-md-1">
                                                    <button class="dislike" type="submit" name="dislike">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                                                            <path d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856 0 .289-.036.586-.113.856-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a9.877 9.877 0 0 1-.443-.05 9.364 9.364 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964l-.261.065zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a8.912 8.912 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581 0-.211-.027-.414-.075-.581-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.224 2.224 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.866.866 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="col-md-1">
                                                    <?php
                                                        $checkdisLike = $conn->prepare("SELECT COUNT(islikes) FROM likesdislikes WHERE post_id = ($user->id) AND islikes = 0");
                                                        $checkdisLike->execute();
                                                        $totaDislike = $checkdisLike->fetchColumn();
                                                    ?>
                                                    <h4><span class="mx-0 text-danger"><?php echo $totaDislike;?></span></h4>
                                                </div>

                                                <!-- show number of comenter section -->
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="col-md-8 mt-0">
                                                            <h5><span class="text-secondary">Comment</span></h5> 
                                                        </div>
                                                        <div class="col-md-4 mt-0">
                                                            <?php
                                                                $Comment = $conn->prepare("SELECT COUNT(user_id) FROM comnt WHERE post_id = ($user->id) ORDER BY user_id DESC");
                                                                $Comment->execute();
                                                                $totaComment = $Comment->fetchColumn();
                                                            ?>
                                                            <h5><span class="text-secondary"><?php echo $totaComment; ?></span></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <hr style="height:2px; width:100%; border-width:0;" class="shadow-block px-4">
                                        <!-- show comment  -->
                                        <div class="row shadow-block mt-0 mx-0">
                                            <?php
                                                //Show comment Query
                                                $cmmt = $conn->prepare("SELECT users.id, users.imgs, users.name, comnt.comment 
                                                                    FROM users INNER JOIN comnt ON users.id = comnt.user_id 
                                                                    where post_id= ($user->id)");
                                                $cmmt->execute();
                                                while($row = $cmmt->fetch(PDO::FETCH_OBJ)):
                                            ?>
                                            <div class="col-md-12 my-3">
                                                <img src="uploads/<?php echo $row->imgs;?>" style="margin-top: 1px;" class="rounded-circle" alt="Cinque Terre" width="20" height="20" >
                                                <strong><?php echo $row->name; ?></strong>
                                            </div>
                                            <div class="col-md-12">
                                                <p class="lead mb-2" style="font-size: 15px; font-style: normal;"><span><?php echo $row->comment; ?></span></p>
                                            </div>
                                            <?php
                                                endwhile;
                                            ?>
                                        </div>
                                        <!-- insert comment -->
                                        <div class="col-md-12">
                                            <div class="row">
                                                <form action="allpost.php" method="post">
                                                    <?php 
                                                        $CmtImg = $conn->prepare("SELECT * FROM users WHERE id=$uid");
                                                        $CmtImg->execute();
                                                        $showImage = $CmtImg->fetchAll(PDO::FETCH_OBJ);
                                                        foreach($showImage as $img):
                                                    ?>
                                                    <input type="hidden" name="post_id" value="<?php echo $user->id; ?>">
                                                    <div class="col-md-12 mb-2">
                                                        <div class="row mt-2">
                                                            <div class="col-md-1 my-3">
                                                                <img src="uploads/<?php echo $img->imgs;?>" class="rounded-circle" alt="Cinque Terre" width="40" height="40">
                                                            </div>
                                                            <div class="col-md-11">
                                                                <input type="text" name="user-comment" class="form-control" placeholder="Write Comments">  
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-2">
                                                                    <button type="submit" value="comment" name="Dcomment" class="btn btn-success">Comment</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        endforeach;
                                                    ?>
                                                </form>
                                            </div>
                                        </div>
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
