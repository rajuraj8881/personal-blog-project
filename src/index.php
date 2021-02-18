<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <title>Sign Up</title>
    <style>
        .form-group{
            margin-top:20px;
        }
        .bg-light{
            border-radius: 10px;
        } 
    </style>
  </head>
  <body>
    <div class="container-fluid bg-primary">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="row my-5 p-5 bg-light" >
                    <h1 class="text-center mt-1">Sign Up</h1>
                    <?php
                        $msg = "";
                        if (isset($_GET['error'])) {
                            $msg = "Please Fill in the Blanks.";
                            echo '<div class="alert alert-danger ">'.$msg.'</div>';
                        }
                        if (isset($_GET['exist'])) {
                            $msg = "Email allready Exist.";
                            echo '<div class="alert alert-danger ">'.$msg.'</div>';
                        }
                    ?>
                    <form action="process.php" method="post">
                        <div class="form-group">
                            <label for="usr"><Strong>Name</Strong></label>
                            <input type="text" name="name" class="form-control mt-1" placeholder="Full Name">
                        </div>
                        <div class="form-group">
                            <label for="usr"><Strong>Email Address</Strong></label>
                            <input type="email" name="email" class="form-control mt-1" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="usr"><Strong>Password</Strong></label>
                            <input type="password" name="password" class="form-control mt-1" placeholder="Enter Password"> 
                        </div>
                        <div class="form-check mt-3">
                            <label class="form-check-label">
                            <input class="form-check-input" type="checkbox"> Accept all terms and conditions.
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="regSubmit" class="btn btn-primary btn-lg w-100">Sign Up</button>
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <p class="text-right">
                                <span class="text-right">Already have an account?<a href="login.php" class="text-decoration-none"> Sign in</a> now.</span>
                            </p> 
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
    <script src="css/js/bootstrap.js"></script>
  </body>
</html>