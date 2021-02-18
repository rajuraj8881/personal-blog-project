    <div class="header">
        <div class="menu-bar">
            <nav class="navbar navbar-expand-lg fixed-top navbar-light">
                <div class="container-fluid mx-5">
                    <a class="navbar-brand" href="dashboard.php">Blog</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mt-1 mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="dashboard.php">All Post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="allpost.php">My Post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="addpost.php">Add Post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="profile.php">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        </ul>
                        <form class="d-flex" method="GET" action="search.php">
                            <input type="text" placeholder="Search.." name="search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit" value="Submit" name="search_key">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>