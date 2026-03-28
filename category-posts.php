<?php include_once("navbar.php"); ?>



<?php
$category;
$posts;
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE category_id=$id";
    $post_result = mysqli_query($conn,$query);
    if(!$post_result)
    {
        header('location: index.php');
        die();
    }
    $posts = mysqli_fetch_assoc($post_result);
    $query = "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($conn,$query);
    if(!$result)
    {
        header('location: index.php');
        die();
    }
    $category = mysqli_fetch_assoc($result);
}else{
    header('location: index.php');
    die();
}




?>

<!-- End of Offcanvas Overlay -->
<!-- start of Index files -->
    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title"><?= $category['title'] ?></h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li class="active" aria-current="page">post categories</li>
                                </ul>
                            </nav>
                        </div>
                         <!-------------------------------- START OF SEARCHBAR ------------------------>
                         <section class="search__bar">
                            <form action="blogsearch.php" method="get" class="container search__bar-container">
                                <div>
                                    <i class="fa fa-search-plus"></i>
                                    <input type="search" name="keyword" placeholder="Search post" id="">
                                </div>
                                <button type="submit" class="btn">Go</button>
                            </form>
                        </section>
                        <!-------------------------------- END OF SEARCHBAR ------------------------>

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->


<!---------------------------- START OF POST SECTION--------------------->
<section class="posts">
    <div class="container posts__container">
        <div class="row">
        <?php
            //fetch posts from database\\
            $sql = "SELECT * FROM posts WHERE category_id=$id";
            $result = mysqli_query($conn,$sql);
            while($post=mysqli_fetch_assoc($result)) :
                $post_id = $post['id'];
        ?>
        <div class="col-md-4">
            <a href="post.php?id=<?php echo $post['id']; ?>">
        <article class="post">
            <div class="post__thumbnail">
                <img src="webroot/images/posts/<?= $post['thumbnail'] ?>" alt="">
                <div class="comment-box">
                    <i class="fa fa-comment"></i>
                    <span class="comment-count"><?php echo $conn->query("SELECT COUNT(*) FROM comment where post_id=$post_id")->fetch_array()[0]; ?></span>
                </div>   
            </div>
            <div class="post__info">
                <h3 class="post__title"><a href="post.php?id=<?php echo $post['id']; ?>"><?= $post['title'] ?></a></h3>
                <p class="post__body">
                    <?php $words = implode(' ', array_slice(str_word_count($post['body'], 1), 0, 20)); echo $words;  ?><a href="post.php?id=<?php echo $post['id']; ?>"> Reade More...</a>
                </p>
            </div>
        </article>
        </a>
        </div>
        <?php endwhile ?>
        </div>
    </div>
</section>
<!---------------------------- END OF POST SECTION--------------------->



<!--------------------- START OF CATEGORY TAG SECTION------------------->
<section class="category__buttons">
    <div class="container category__buttons-container">
    <?php
        //fetch 6 category from database\\
        $sql = "SELECT * FROM categories LIMIT 6";
        $result = mysqli_query($conn,$sql);
        while($category=mysqli_fetch_assoc($result)) :
    ?>
    <a href="category-posts.php?id=<?php echo $category['id']; ?>" class="category__button"><?= $category['title'] ?></a>
    <?php endwhile ?>
    </div>
</section>
<!---------------------- END OF CATEGORY TAG SECTION-------------------->





<!-- End of Index files -->





<?php include_once("footer.php"); ?>