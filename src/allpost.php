    <?php 
        //database connection
        include_once'connection.php';
        // include header file
        include  'lib/header.php';
        // include menubar file 
        include'lib/menu.php';

        // session start 
        session_start();
        if (!$_SESSION['id']) {
            header('location:login.php');
        }
        //get login user id and name
        $uid = $_SESSION['id'];
        $uName = $_SESSION['name'];

        $limit = 5; 
            if (isset($_GET["page"] )){
                $page  = $_GET["page"]; 
            } 
            else{
                $page=1; 
            };
        $record_index= ($page-1) * $limit;
        $result = $conn->prepare("SELECT * FROM addpost INNER JOIN users ON users.id = addpost.user_id ORDER BY addpost.id DESC LIMIT $record_index, $limit");
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
                <div class="row my-2 p-2">
                    <?php 
                        foreach($users as $user):
                    ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <img src="images/profile.png" class="rounded-circle" alt="Cinque Terre" width="50" height="50" >
                                <strong class="ms-2 mt-3 text-info"><?php echo $user->name;?></strong><span class="ms-3 text-muted">25 min ago.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-11 mt-2">
                                
                                <h5><?php echo $user->title; ?></h5>
                                <p class="lead mb-0"><?php echo $user->description; ?></p>  
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row mt-5">
                            <div class="col-md-1"></div>
                            <div class="col-md-2">Like <span>20</span></div>
                            <div class="col-md-2">dislike <span>20</span></div>
                            <div class="col-md-4 ms-2">comment <span>20</span></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row mt-3">
                            <div class="col-md-1 mt-2">
                                <img src="images/comment.jpg" class="rounded-circle" alt="Cinque Terre" width="50" height="50" >
                            </div>
                            <div class="col-md-11 mt-3">
                                <input type="text" name="comment" class="form-control" placeholder="Write Comments">  
                            </div>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    ?>

                </div>
            </div>
            <div class="col-md-3">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <nav aria-label="...">
                            <?php
                                $nextPag = $conn->prepare("SELECT * FROM addpost");
                                $nextPag->execute();
                                $rows = $nextPag->fetchAll(PDO::FETCH_ASSOC);
                                // $totalRecord = $row[0];
                                $totalPage = ceil(count($rows) / $limit);

                                if($page > $totalPage){
                                    exit('No Data Found');
                                }

                                echo "<ul class='pagination'>";
                                    echo "<li class='page-item'>";
                                        if($page > 1){
                                        echo "<a class='nounderline' href='allpost.php?page=".($page-1)."' class='button'><span class='page-link'>Previous</span></a>";
                                        }
                                    echo "</li>";
                                    for ($i = 1; $i <= $totalPage; $i++)  {
                                        if ($i < 3 || $totalPage- $i < 1 || abs($page - $i) < 3) {
                                            echo "<li class='page-item'><a class='page-link' href='allpost.php?page=".$i."' tabindex='-1'>".$i."</a></li>";
                                        }
                                    }
                                    echo "<li>";
                                    if($page < $totalPage){
                                        echo "<a class='nounderline' href='allpost.php?page=".($page+1)."' class='button'><span class='page-link'>NEXT<span></a>";
                                    }
                                    echo "</li>";
                                echo "</ul>";
                            ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php
        }else echo "<h1>Please login first.</h1>";
    ?>

    <!-- include footer file -->
    <?php include  'lib/footer.php'; ?>
