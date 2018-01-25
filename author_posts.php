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

            if(isset($_GET['author'])){
                //$the_post_id = $_GET['p_id'];
                $the_post_author = $_GET['author'];

            }


            $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}'";
            $select_all_posts_query = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_all_posts_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_image = $row['post_image'];
                $post_date = $row['post_date'];
                $post_content = $row['post_content'];
                $post_status = $row['post_status'];
                if($post_status == 'published'){


                ?> <!--Ktu eshte bere mbyllja e php per arsye te kemi mundesi te shtojme html por while loop eshte e hapur ende -->

                <!-- Ktu eshte bere dizajni i postimit se si do shfaqet -->
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php  echo $post_title ?></a>
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
            <?php  } }?> <!-- Ktu eshte hap dhe mbyll tagu i php perarsye se eshte dashur te mbyllet while loop -->

            <!-- Blog Comments -->




            <!-- Comments Form -->


            <hr>

            <!-- Posted Comments -->



        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php  include "includes/sidebar.php"?>
    </div>
    <!-- /.row -->
    <hr>

    <?php include "includes/footer.php"; ?>
