<?php
    include_once'connection.php';
    session_start();
    if (!$_SESSION['id']) {
        header('location:login.php');
    }
    $uid = $_SESSION['id'];
    $result = $conn->prepare("SELECT * FROM addpost where user_id=$uid");
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_OBJ);
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $counter = 0;
                            foreach($users as $user):
                        ?>
                        <tr>
                            <th scope="row"><?php echo ++$counter; ?></th>
                            <td><a class="nounderline" href="single.php?id=<?php echo $user->id; ?>"><?php echo $user->title; ?></a></td>
                            <td>
                                <a class="ajax-action-links" href='edit.php?id=<?php echo $user->id; ?>'>
                                    <img src="icon/edit.png" title="Edit" />
                                </a>
                                <a class="ajax-action-links" href='delete.php?id=<?php echo $user->id; ?>'>
                                    <img src="icon/delete.png" title="Delete" />
                                </a>
                            </td>
                        </tr>
                        <?php
                            endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 
    <?php
        }else echo "<h1>Please login first.</h1>";
    ?>
    <!--include footer file -->
    <?php include  'lib/footer.php'; ?>
