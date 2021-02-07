<?php 
    include_once 'connection.php';
    // include header file
    include 'lib/header.php';
    // include menubar file
    include 'lib/menu.php';
?>
   <div class="container-flued">
        <div class="row mx-5">
            <div class="col-md-12 mx-5">
                <h1>Edit Post</h1>
            </div>
            <form action="process.php" method="post">
                <?php
                    $id = NULL;
                    if(isset($_POST['id'])){
                        $id = $_POST['id'];
                    }

                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                    }
                
                    $query = $conn->prepare("SELECT * FROM addpost WHERE id=:id");
                    $query->bindParam(':id', $id);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0):
                        foreach($result as $row):
                ?>
                <div class="col-md-12 mx-5">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                <input type="hidden" name="id" value="<?php echo $row->id;?>">
                                    <div class="form-group">
                                        <input type="text" name="post-title" class="form-control" value="<?php echo $row->title;?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="file" name="image" class="form-control-file" id="myFile" require>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="post-description" class="form-control" id="exampleFormControlSelect1" rows="8"><?php echo $row->description;?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                                endforeach;
                            endif;
                        ?>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" value="Update" name="updatePost" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>  
        </div>
    </div>
    <!-- include footer file -->
<?php 
    include  'lib/footer.php'; 
?>
