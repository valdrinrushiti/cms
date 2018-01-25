<?php include "includes/db.php" ?>
<?php include "includes/header.php"; ?>


<!--  Navigation  -->
<?php include "includes/navigation.php"?>
<!-- Page Content -->
<div class="container">
    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if(isset($_GET['p_id'])){
                $the_post_id = $_GET['p_id'];


            $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
            $send_query = mysqli_query($connection, $view_query);

            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $select_all_posts_query = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_all_posts_query)){
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_image = $row['post_image'];
                $post_date = $row['post_date'];
                $post_content = $row['post_content'];
                ?> <!--Ktu eshte bere mbyllja e php per arsye te kemi mundesi te shtojme html por while loop eshte e hapur ende -->

                <!-- Ktu eshte bere dizajni i postimit se si do shfaqet -->
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php  echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts?author=<?php  echo $post_author ?>"><?php  echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php  echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php  echo $post_content ?>.</p>


                <hr>
            <?php  }
                }
                else{
                    header("Location: index.php");
                }


            ?> <!-- Ktu eshte hap dhe mbyll tagu i php perarsye se eshte dashur te mbyllet while loop -->

            <!-- Blog Comments -->


            <?php

                if(isset($_POST['create_comment'])){
                    $the_post_id = $_GET['p_id'];

                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    $comment_date = date('d-m-y');
                    $comment_post_id = $_GET['p_id'];
                    $comment_status = "unaprove";

                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){

                        $query = "INSERT INTO comments (comment_post_id,comment_author, comment_email, comment_content, comment_status, comment_date)";
                        $query .= " VALUES ($comment_post_id,'{$comment_author}','{$comment_email}','{$comment_content}','unaproved', now())";

                        $create_comments_query = mysqli_query($connection,$query);


                        if(!$create_comments_query){
                            die("Query Failed " .mysqli_error($connection));
                        }

                            // numrimi i komenteve Old Version
                       /* $query = "UPDATE posts SET post_comment_count = post_comment_count + 1";
                        $query .= " WHERE post_id = $the_post_id";

                        $update_comment_count = mysqli_query($connection, $query);*/



                        /*if(!$update_comment_count){
                            die("QUERY Failed" . mysqli_error($connection));
                        }*/

                    }
                    else{
                        echo "<script>alert('Fields cannot be empty')</script>";
                    }
                }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="POST" role="form">

                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" class="form-control" name="comment_author" >
                    </div>

                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                    </div>


                    <div class="form-group">
                        <label for="Comment">Your Comment</label>
                        <textarea class="form-control" name="comment_content" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
            $query .= "AND comment_status = 'approve' ";
            $query .= "ORDER BY comment_id DESC";

            $select_comment_query = mysqli_query($connection, $query);
            if(!$select_all_posts_query){
                die('Query Failded' . mysqli_error($select_comment_query));
            }
            while($row = mysqli_fetch_assoc($select_comment_query)){
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
                ?>
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small><?php echo $comment_date; ?></small>
                    </h4>
                    <?php echo $comment_content; ?>
                </div>
            </div>


        <?php } ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php  include "includes/sidebar.php"?>
    </div>
    <!-- /.row -->
    <hr>

    <?php include "includes/footer.php"; ?>
