<?php include "./includes/admin_header.php" ?>

    <div id="wrapper">

   

        <!-- Navigation -->

        <?php include "./includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin Page
                            <small>Subheading</small>
                        </h1>

                        <div class="col-xs-6">
                            <?php 
                                    if(isset($_POST['submit'])) {
                                        $cat_title = $_POST['cat_title'];
                                        if($cat_title == "" || empty($cat_title)) {
                                            echo "This field should not be empty";
                                        } else {
                                            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";
                                            $create_category_query = mysqli_query($connection, $query);
                                            if(!$create_category_query) {
                                                die('Query Failed' . mysqli_error($connection));
                                            }
                                        }
                                    }
                            
                            ?>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-6">


                            <?php 
                                $query = "SELECT * FROM categories";
                                $select_categories = mysqli_query($connection, $query);
                            ?>





                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                <?php 
                                    while($row = mysqli_fetch_assoc($select_categories)) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];

                                        echo "<tr>";
                                        echo "<td>{$cat_id}</td>";
                                        echo "<td>{$cat_title}</td>";
                                    }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include "./includes/admin_footer.php" ?>