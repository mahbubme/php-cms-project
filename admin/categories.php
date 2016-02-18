<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                        
                        <div class="col-xs-6">
                            
                            <?php 
                                
                                // Insert category data into the database
                                if ( isset( $_POST['submit'] ) ) {
                                    
                                    $cat_title = $_POST['cat_title'];
                                    
                                    if ( $cat_title == "" || empty( $cat_title ) ) {
                                        
                                        echo "This field should not be empty."; 
                                        
                                    }else {
                                        
                                        $query = "INSERT INTO categories(cat_title)"; 
                                        $query .= "VALUE('{$cat_title}')";
                                        
                                        $create_category_query = mysqli_query( $connection, $query );
                                        
                                        if ( !$create_category_query ) {
                                            
                                            die( 'QUERY FAILED' . mysqli_error( $connection ) );
                                            
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
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>
                            
                        </div>
                        
                        <div class="col-xs-6">
                            
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Delete Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                        
                                        // Find all categories query
                                        $query = "SELECT * FROM categories";
                                        $select_categories = mysqli_query( $connection, $query );
                                        
                                        while ( $row = mysqli_fetch_assoc( $select_categories ) ) {
                                            
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            
                                            $output  = "<tr>";
                                            $output .= "<td>{$cat_id}</td>";
                                            $output .= "<td>{$cat_title}</td>";
                                            $output .= "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                            $output .= "</tr>";
                                            
                                            echo $output;
                                            
                                        }
                                    ?>
                                    
                                    <?php 
                                        
                                        // Delete category data from the database
                                        if ( isset( $_GET['delete'] ) ) {
                                            
                                            $the_cat_id = $_GET['delete'];
                                            $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
                                            $delete_query = mysqli_query( $connection, $query );
                                            header("Location: categories.php");
                                            
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

<?php include "includes/admin_footer.php"; ?>