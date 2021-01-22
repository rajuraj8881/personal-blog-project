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
            <table id="table-body">
                <thead>
                    <tr>
                        <th class="table-header" width="20%">Id</th>
                        <th class="table-header" width="20%">Title</th>
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
                    <tr class="table-row">
                        <td><?php echo ++$counter; ?></td>
                        <td><a href="single.php?id=<?php echo $user->id; ?>"><?php echo $user->title; ?></a></td>
                    </tr>
                    <?php
                        endforeach;
                    ?>
                 </tbody> <!--End table body -->
            </table>
        </div>
    </div>
    
    <?php
        }else echo "<h1>Please login first.</h1>";
    ?>

    <!-- include footer file -->
    <?php include  'lib/footer.php'; ?>
