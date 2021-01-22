<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Registration</title>
    <style>
      body{
        margin-top:20px;
      }
      .form-group{
        margin-top:20px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="row">
            <h1 class="text-center">Register Here</h1>
            <form action="process.php" method="post">
              <div class="form-group row">
                  <label class="col-md-2 col-form-label">Name</label>
                  <div class="col-md-8">
                      <input type="text" name="name" class="form-control" placeholder="Name">
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-md-2 col-form-label">Email</label>
                  <div class="col-md-8">
                      <input type="email" name="email" class="form-control" placeholder="Email">
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-8">
                      <input type="password" name="password" class="form-control" placeholder="Password">
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-sm-6 offset-sm-2">
                      <button type="submit" name="regSubmit" class="btn btn-primary">Registration</button>
                      <a href="login.php" class="btn btn-primary">Login</a>
                  </div>
              </div> 
            </form> 
          </div>
        </div>
      </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </body>
</html>