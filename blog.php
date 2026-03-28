<?php include_once("navbar.php"); ?>





<!-- End of Offcanvas Overlay -->
<!-- start of Index files -->



    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Blog</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li class="active" aria-current="page">blog</li>
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


    <!---------------------------- START OF FEATURE SECTION--------------------->
    <?php
    $sql = "SELECT * FROM posts WHERE is_featured = 1";
    $result = $conn->query($sql);
    $feature_post = $result->fetch_assoc();
    $featured_post_id = $feature_post['id'];
    ?>
<?php if($feature_post) : ?>
<section class="featured">
    <div class="container featured__container">
        
        <div class="post__thumbnail">
            <img src="webroot/images/posts/<?php echo $feature_post['thumbnail'] ?>">
            <div class="comment-box">
                <i class="fa fa-comment"></i>
                <span class="comment-count"><?php echo $conn->query("SELECT COUNT(*) FROM comment where post_id=$featured_post_id")->fetch_array()[0]; ?></span>
            </div>    
        </div>
        <div class="post__info">
            
            <h2 class="post__tittle"><a href="post.php?id=<?php echo $feature_post['id']; ?>"><?= $feature_post['title'] ?></a></h2>
            <p class="post__body"><?php $words = implode(' ', array_slice(str_word_count($feature_post['body'], 1), 0, 60)); echo $words;  ?><a href="post.php?id=<?php echo $feature_post['id']; ?>"> Reade More...</a></p>
            </div>
    </div>
</section>
<?php endif ?>
<!---------------------------- END OF FEATURE SECTION--------------------->



<!---------------------------- START OF POST SECTION--------------------->
<section class="posts">
    <div class="container posts__container">
        <div class="row">
        <?php
            //fetch posts from database\\
            $sql = "SELECT * FROM posts";
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