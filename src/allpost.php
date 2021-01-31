<?php
    include_once'connection.php';
    session_start();
    if (!$_SESSION['id']) {
        header('location:login.php');
    }
    $uid = $_SESSION['id'];
    $uName = $_SESSION['name'];
?>
    <!-- include header file -->
    <?php include  'lib/header.php'; ?>
    <!-- include menubar file -->
    <?php include'lib/menu.php'?>

    <?php
        if (isset($_SESSION['email'])) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <table class="table table-hover">
                    <thead>
                        <tr class="table-secondary">
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $limit = 1; 
                                if (isset($_GET["page"] )){
                                    $page  = $_GET["page"]; 
                                } 
                                else{
                                    $page=1; 
                                };
                            $record_index= ($page-1) * $limit;
                            $result = $conn->prepare("SELECT * FROM addpost ORDER BY id DESC LIMIT $record_index, $limit");
                            $result->execute();
                            $users = $result->fetchAll(PDO::FETCH_OBJ);
                            $i=$record_index;
                            foreach($users as $user):
                        ?>
                        <tr>
                        <?php
                            echo '<th scope="row">';
                                 echo ++$i;
                            echo '</th>';
                        ?>
                            <td><a class="nounderline" href="single.php?id=<?php echo $user->id; ?>"><?php echo $user->title; ?></a></td>
                        </tr>
                        <?php
                            endforeach;
                        ?>
                    </tbody> <!--End table body -->
                </table>
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
                                    exit('No page are found');
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
