<?php
    session_start();
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
    <h1>Welcome <?php echo $_SESSION['name']; ?></h1><br>
    <h1> <?php echo $_SESSION['id']; ?></h1><br>
    <h1> <?php echo $_SESSION['email']; ?></h1><br>
    <h4><a href="logout.php">Logout</a></h4>
    <?php
        }else echo "<h1>Please login first.</h1>";
    ?>
</body>
</html>