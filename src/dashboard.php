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
        $result = $conn->prepare("SELECT users.id, users.imgs, users.name, addpost.id, addpost.title, addpost.description FROM users INNER JOIN addpost ON users.id = addpost.user_id ORDER BY addpost.id DESC LIMIT $record_index, $limit");
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
                            <div class="col-md-6 my-2">
                                <img src="uploads/<?php echo $user->imgs;?>" class="rounded-circle" alt="Cinque Terre" width="50" height="50" >
                                <strong class="ms-0 mt-3 text-info"><?php echo $user->name;?></strong><span class="ms-3 text-muted">25 min ago.</span>
                            </div>
                        </div>
                    </div>
                    <hr style="height:2px; width:100%; border-width:0;" class="shadow-block">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-11 mt-2">
                                <h5><a class="nounderline" href="single.php?id=<?php echo $user->id; ?>"><?php echo $user->title; ?></a></h5>
                                <p class="lead mb-0"><?php echo $user->description; ?></p>
                            </div>
                        </div>
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
                        <div class="row shadow-block mt-2 mx-2">
                            <div class="col-md-12">
                                <img src="uploads/<?php echo $user->imgs;?>" class="rounded-circle" alt="Cinque Terre" width="20" height="20" >
                                <strong>Raju Mondal</strong>
                            </div>
                            <div class="col-md-12">
                                <p class="lead mb-2" style="font-size: 15px; font-style: normal;"><span>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae molestias amet inventore quia magnam corrupti ad facere libero tempore possimus maiores deserunt consequuntur beatae nemo ratione adipisci debitis, consectetur voluptates dolore veniam voluptas rem? Magni quos eos aliquam, fuga expedita enim, molestias repudiandae ipsam quod, dolore accusantium amet rem impedit!</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?php 
                            $CmtImg = $conn->prepare("SELECT * FROM users WHERE id=$uid");
                            $CmtImg->execute();
                            $users = $CmtImg->fetchAll(PDO::FETCH_OBJ);
                            
                            foreach($users as $user):
                        ?>
                        <div class="row">
                            <div class="col-md-1 mt-2">
                                <img src="uploads/<?php echo $user->imgs;?>" class="rounded-circle" alt="Cinque Terre" width="50" height="50" >
                            </div>
                            <div class="col-md-11 mt-3">
                                <input type="text" name="comment" class="form-control" placeholder="Write Comments">  
                            </div>
                        </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                </div>
                <?php
                    endforeach;
                ?>
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
