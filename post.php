<?php
include_once("navbar.php");
$post;
$id;
$user;
$category_id;
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($conn,$query);
    if(!$result)
    {
        header('location: index.php');
        die();
    }
    $post = mysqli_fetch_assoc($result);
    $category_id = $post['category_id'];
}else{
    header('location: index.php');
    die();
}




?>


<div class="container">
<div class="row">
    <div class="col-md-2">
        <!-- Start Sidebar Area -->
        <div class="siderbar-section mt-9" data-aos="fade-up" data-aos-delay="0">

        <!-- Start Single Sidebar Widget -->
        <div class="sidebar-single-widget">
            <h6 class="sidebar-title">CATEGORIES</h6>
            <div class="sidebar-content">
                <ul class="sidebar-menu">
                    <?php
                        $sql = "SELECT * FROM categories";
                        $result = $conn->query($sql);
                        foreach($result as $record){
                    ?>
                    <li ><a href="category-posts.php?id=<?php echo $record['id']; ?>"><?php echo $record['title']; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div> <!-- End Single Sidebar Widget -->

        </div> <!-- End Sidebar Area -->
    </div>
    <div class="col-md-7">
        <!---------------------- START OF SINGLE POST SECTION------------------------->
        <section class="singlepost">
            <div class="container singlepost__container">
                <div class="text-center">
                <h2>
                    <?= $post['title'] ?>
                </h2>
                </div>
                <div class="singlepost__thumbnail">
                    <img src="webroot/images/posts/<?php echo $post['thumbnail'] ?>" alt="">
                </div>
                <div class="desc_area">
                <?php 
                $postdesc =  $post['post_dec_id'];
                $sqlc = "SELECT * FROM tbl_ckeditor WHERE id = $postdesc";
                $result = $conn->query($sqlc);
                $postdescription = $result->fetch_assoc();
                echo $postdescription['content'];
                ?>
                </div>
                <hr class="hr">
                <div class="comment-input-box">
                <form action="../phpProces/add-comment.php" method="POST">
                    <input type="hidden" name="post_id" value="<?= $id ?>" id="">
                <!-- both -->
                <div class="InputAddOn">
                <span class="InputAddOn-item"><i class="fa fa-comment-alt"></i></span>
                <input name="description" required placeholder="Add Your Comment Here" class="InputAddOn-field">
                <button type="submit" name="submit" class="InputAddOn-item"><i class="fa fa-arrow-right"></i></button>
                </div>
                </form>
                <hr class="hr">
                <div class="comment-block">
                    <div class="comment-head">
                        <h3>
                        <i class="fa fa-comment-dots"></i>
                            (<?php echo $conn->query("SELECT COUNT(*) FROM comment where post_id=$id")->fetch_array()[0]; ?>) Comments
                        </h3>
                    </div>
                    <div class="comment-body">
                        <?php
                            $query = "SELECT * FROM comment WHERE post_id=$id";
                            $result = mysqli_query($conn,$query);
                            if(!$result)
                            {
                                header('location: index.php');
                                die();
                            }
                            foreach($result as $comment):
                        ?>
                        <div class="comment-inner-body">
                            <?php
                                $uid = $comment['user_id'];
                                $uquery = "SELECT * FROM users WHERE userID=$uid";
                                $uresult = mysqli_query($conn,$uquery);
                                if(!$uresult)
                                {
                                    header('location: index.php');
                                    die();
                                }
                                $user = mysqli_fetch_assoc($uresult);
                            ?>
                            <div class="comment-avatar">
                                <img src="webroot/images/users/<?php echo $user['userPhotoPath'] ?>" alt="">
                            </div>
                            <div class="uname-description">
                                <div class="comment-username">
                                    <?= $user['userName'] ?>
                                    <small class="comment-time"><?= $comment['date_time'] ?></small>
                                </div>
                                <?php
                                if(isset($_SESSION['userID']))
                                {
                                if($comment['user_id']==$_SESSION['userID']){
                                ?>
                                <div class="comment-option">
                                    <form class="comment-form" action="../phpProces/deletecomment.php" method="POST">
                                        <input type="hidden" name="postID" value="<?= $id ?>">
                                        <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                                        <i id="three-dot-btn" class="fa fa-ellipsis-h"></i>
                                    </form>
                                </div>
                                <?php
                                }}
                                ?>
                                <div class="comment-description">
                                    <?= $comment['description'] ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
                </div>
            </div>
        </section>
        <!---------------------- END OF SINGLE POST SECTION------------------------->
    </div>
    <div class="col-md-3 mt-9 text-center">
    <h6 class="sidebar-title">RELATED POSTS</h6>
        <?php
            //fetch posts from database\\
            $sql = "SELECT * FROM posts WHERE category_id = $category_id limit 3";
            $result = mysqli_query($conn,$sql);
            while($post=mysqli_fetch_assoc($result)) :
                $post_id = $post['id'];
        ?>
        <div class="w-100 p-3">
            <a href="post.php?id=<?php echo $post['id']; ?>">
        <article class="post">
            <div class="post__thumbnail">
                <img src="../../webroot/images/posts/<?= $post['thumbnail'] ?>" alt="">
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
</div>



<?php
include_once("footer.php");
?>
