<?php
    include_once'connection.php';
    session_start();
    if (!$_SESSION['id']) {
        header('location:login.php');
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
                <table class="table table-hover">
                    <thead>
                        <tr class="table-secondary">
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_POST['search_key'])):
                                $keyword= $_POST['search'];
                                $searchResult=$conn->prepare("SELECT * FROM addpost WHERE title OR description LIKE :keyword");
                                $searchResult->bindValue(':keyword','%'.$keyword.'%');
                                $searchResult->execute();
                                $counter = 0;
                                while ($row = $searchResult->fetch(PDO::FETCH_ASSOC)) :
                                    echo "<tr>";
                                        echo '<th scope="row">';
                                            echo ++$counter;
                                        echo '</th>';
                                        echo "<td>";
                                            echo '<a class="nounderline" href="single.php?id='.$row['id'].'">';
                                                echo $row['title'];
                                            echo '</a>';
                                        echo "</td>";
                                    echo "</tr>";
                                endwhile;
                            endif;
                        ?>
                    </tbody> <!--End table body -->
                </table>
            </div>
        </div>
    </div>


    <!--include footer file -->
    <?php include  'lib/footer.php'; ?>