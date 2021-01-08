<?php
    include_once'connection.php';
    session_start();
    $result = $conn->prepare("SELECT * FROM addpost");
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_OBJ);
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
                        $counter = 0;
                        foreach($users as $user):
                    ?>
                    <tr class="table-row">
                        <td><?php echo ++$counter; ?></td>
                        <td><?php echo $user->title; ?></td>
                        <td>
                            <a class="ajax-action-links" href='edit.php?id=<?php echo $user->id; ?>'>
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
                </tbody>
            </table>
        </div>
    </div>
    
    <h4><a href="addpost.php">Add Post</a></h4>
    <h4><a href="logout.php">Logout</a></h4>
    
    <?php
        }else echo "<h1>Please login first.</h1>";
    ?>
</body>
</html>