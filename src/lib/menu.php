    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="col-md-2"></div>
        <div class="col-md-6">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="dashboard.php">My Post</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="allpost.php">All Post</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="addpost.php">Add Post</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <div class="input-group rounded">
                <form action="search.php" method="post">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit" value="Submit" name="search_key"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </nav>