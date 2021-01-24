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
                            $limit = 10; 
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
                            $counter = 0;
                            foreach($users as $user):
                        ?>
                        <tr>
                            <th scope="row"><?php echo ++$counter; ?></th>
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
                        <nav aria-label="">
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
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
