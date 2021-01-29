<?php
    include_once'connection.php';

    if(isset($_POST['subImages'])){
        $target = "uploads/".basename($_FILES['image']['name']);

        $file_name = $_FILES['image']['name'];
        // $file_type = $_FILES['image']['type'];
        // $file_tmp = $_FILES['image']['tmp_name'];
        // $file_error = $_FILES['image']['error'];
        // $file_size = $_FILES['image']['size'];
        
        $imgIns = $conn->prepare("INSERT INTO img (imgs) VALUES(:images)");
        $imgIns->bindParam(':images', $file_name);
        $imgIns->execute();
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            echo"Success";
        }else{
            echo "Wrong";
        }
    }


?>

<!-- include header file -->
<?php include  'lib/header.php'; ?>
    <!-- include menubar file -->
    <?php include'lib/menu.php'?>

    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1><strong>Profile</strong></h1>
                <form action="profile.php" method="post" enctype="multipart/form-data">
                    <div class="profile-thumb-block">
                        <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="profile-image" class="profile"/>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="file" name="image" class="form-control-file" id="myFile" require>
                            <button type="submit" name="subImages" class="btn btn-success">Upload</button>
                        </div>
                    </div>
                </form>

                <form>
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
                            <button type="submit" value="Submit" name="profileDet" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- include footer file -->
<?php include  'lib/footer.php'; ?>