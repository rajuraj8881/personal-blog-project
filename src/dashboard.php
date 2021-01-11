<?php
    include_once'connection.php';
    session_start();
    $uId = $_SESSION['id'];
    $uName = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php
        if (isset($_SESSION['email'])) {
    ?>
    <div class="container">
        <div class="row">
            <table id="table-body">
                <thead>
                    <tr>
                        <th class="table-header" width="20%">Id</th>
                        <th class="table-header" width="20%">Title</th>
                        <th class="table-header" width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $result = $conn->prepare("SELECT * FROM addpost WHERE user_id=$uId");
                        $result->execute();
                        $users = $result->fetchAll();
                        $counter = 0;
                        foreach($users as $user):
                    ?>
                    <tr class="table-row">
                        <td><?php echo ++$counter; ?></td>
                        <td><?php echo $user['title']; ?></td>
                        <td>
                            <a class="ajax-action-links" href='#'>
                                <img src="icon/edit.png" title="Edit" />
                            </a>
                            <a class="ajax-action-links" href='#'>
                                <img src="icon/delete.png" title="Delete" />
                            </a>
                        </td>
                    </tr>
                    <?php
                        endforeach;
                    ?>
                 </tbody> <!--End table body -->
            </table>
        </div>
    </div>
    
    <h4><a href="addpost.php?id=<?php echo $uId; ?>&&name=<?php echo $uName; ?>">Add Post</a></h4>
    <h4><a href="logout.php">Logout</a></h4>
    
    <?php
        }else echo "<h1>Please login first.</h1>";
    ?>
</body>
</html>