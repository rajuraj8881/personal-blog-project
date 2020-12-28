<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Module</title>
</head>
<body>
    <form action="process.php" method="post">
        <label>Email:</label>
        <input type="email" name="email"><br>
        <label>Password:</label>
        <input type="password" name="password"><br>
        <button type="submit" name="logSubmit">Login</button>
        <a href="index.php">Registration</a>
    </form>
</body>
</html>