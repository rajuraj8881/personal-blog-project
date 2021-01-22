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

    <?php
        if (isset($_SESSION['email'])) {
    ?>
    <div class="container">
    <?php include'lib/menu.php'?>
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
                            $result = $conn->prepare("SELECT * FROM addpost");
                            $result->execute();
                            $users = $result->fetchAll(PDO::FETCH_OBJ);
                            $counter = 0;
                            foreach($users as $user):
                        ?>
                        <tr class="table-primary">
                            <th scope="row"><?php echo ++$counter; ?></th>
                            <td><a class="nounderline" href="single.php?id=<?php echo $user->id; ?>"><?php echo $user->title; ?></a></td>
                        </tr>
                        <?php
                            endforeach;
                        ?>
                    </tbody> <!--End table body -->
                </table>
            </div>
        </div>
    </div>
    
    <?php
        }else echo "<h1>Please login first.</h1>";
    ?>

    <!-- include footer file -->
    <?php include  'lib/footer.php'; ?>
