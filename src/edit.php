<?php 
    include_once'connection.php';
?>
    <!-- include header file -->
    <?php include  'lib/header.php'; ?>
    <?php include'lib/menu.php'?>  
    <!-- include menubar file -->
     
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1><strong>Edit Post</strong></h1>
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
                    <input type="hidden" name="id" value="<?php echo $row->id;?>">
                    <div class="form-group row">
                        <label class="col-md-1 col-form-label"><strong>Title:</strong></label>
                        <div class="col-md-11">
                            <input type="text" name="post-title" class="form-control" value="<?php echo $row->title;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><strong>Description</strong></label>
                        <textarea name="post-description" class="form-control" id="exampleFormControlSelect1" rows="4"><?php echo $row->description;?></textarea>
                    </div>
                        <?php
                                endforeach;
                            endif;
                        ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" value="Update" name="updatePost" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- include footer file -->
    <?php include  'lib/footer.php'; ?>
