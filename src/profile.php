<!-- include header file -->
<?php include  'lib/header.php'; ?>
    <!-- include menubar file -->
    <?php include'lib/menu.php'?>

    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1><strong>Profile</strong></h1>
                <form action="/action_page.php">
                    <div class="profile-thumb-block">
                        <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="profile-image" class="profile"/>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="file" class="form-control-file" id="myFile" name="filename">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-4">
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-form-label">Addresss</label>
                        <div class="col-md-4">
                            <input type="text" name="addresss" class="form-control" placeholder="address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-4">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" value="Submit" name="profileSubmit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- include footer file -->
<?php include  'lib/footer.php'; ?>