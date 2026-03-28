<?php include_once("navbar.php"); ?>




<!-- End of Offcanvas Overlay -->




<!-- Start Hero Slider Section large devices-->
<div class="slider-with-banner d-none d-lg-block" style="margin-top: -20px;">
    <div class="row">
        <!-- Begin Slider Area -->
        <div class="col-lg-12">
            <div class="slider-area pt-sm-30 pt-xs-30">
                <div class="slider-active owl-carousel">
                    <?php
                    $sql = "SELECT * FROM slideshow";
                    $result = $conn->query($sql);
                    $slideCount = 1;
                    foreach ($result as $slideshow) {
                        $imagePath = __DIR__ . "/webroot/images/slideshow/" . $slideshow['photopath'];
                        if (!file_exists($imagePath) || empty($slideshow['photopath'])) {
                            $slideFilename = "slideshow1.jpg";
                        } else {
                            $slideFilename = $slideshow['photopath'];
                        }
                        $imageURL = "webroot/images/slideshow/" . $slideFilename;
                        $slideClass = "bg-" . $slideCount;
                    ?>
                        <!-- Begin Single Slide Area -->
                        <div class="single-slide align-center-left animation-style-02 <?php echo $slideClass; ?>" style="background-image: url('<?php echo $imageURL; ?>'); background-repeat: no-repeat; background-position: center center; background-size: cover; min-height: 475px; width: 100%;">
                            <div class="slider-progress"></div>
                            <div class="slider-content">
                                <h5><?php echo $slideshow['title1']; ?></h5>
                                <h2><?php echo $slideshow['title2']; ?></h2>
                                <h3><span><?php echo $slideshow['title3']; ?></span></h3>
                                <div class="default-btn slide-btn">
                                    <a class="links" style="background: black;color:white;" href="<?php echo $slideshow['link']; ?>">Shopping Now</a>
                                </div>
                            </div>
                        </div>
                    <?php
                        $slideCount++;
                    }
                    ?>
                    <!-- Single Slide Area End Here -->
                </div>
            </div>
        </div>
        <!-- Slider Area End Here -->
    </div>
</div>
<!-- End Hero Slider Section large devices-->




<!-- Start Hero Slider Section small devices-->
<div class="slider-with-banner d-block d-lg-none" style="margin-top: -5px;">
    <div class="row">
        <!-- Begin Slider Area -->
        <div class="col-lg-12">
            <div class="slider-area pt-sm-30 pt-xs-30">
                <div class="slider-active owl-carousel">
                    <?php
                    $sql = "SELECT * FROM mobile_slideshow";
                    $result = $conn->query($sql);
                    $slideCount = 1;
                    foreach ($result as $slideshow) {
                        $imagePath = __DIR__ . "/webroot/images/slideshow/" . $slideshow['photopath'];
                        if (!file_exists($imagePath) || empty($slideshow['photopath'])) {
                            $slideFilename = "slideshow4.jpg";
                        } else {
                            $slideFilename = $slideshow['photopath'];
                        }
                        $imageURL = "webroot/images/slideshow/" . $slideFilename;
                        $slideClass = "bg-" . $slideCount;
                    ?>
                        <!-- Begin Single Slide Area -->
                        <div class="single-slide align-center-left animation-style-02 <?php echo $slideClass; ?>" style="background-image: url('<?php echo $imageURL; ?>'); background-repeat: no-repeat; background-position: center center; background-size: cover; min-height: 475px; width: 100%;">
                            <div class="slider-progress"></div>
                            <div class="slider-content" style="margin-top: 300px;">
                                <h5><?php echo $slideshow['title1']; ?></h5>
                                <h2><?php echo $slideshow['title2']; ?></h2>
                                <h3><span><?php echo $slideshow['title3']; ?></span></h3>
                                <div class="default-btn slide-btn">
                                    <a class="links" style="background: black;color:white;" href="<?php echo $slideshow['link']; ?>">Shopping Now</a>
                                </div>
                            </div>
                        </div>
                    <?php
                        $slideCount++;
                    }
                    ?>
                    <!-- Single Slide Area End Here -->
                </div>
            </div>
        </div>
        <!-- Slider Area End Here -->
    </div>
</div>
<!-- End Hero Slider Section  devices-->






<style>
.slideshow.owl-carousel .owl-item img {
  height: 50px;
  width: 100%;
}
</style>

<div class="slideshow owl-carousel d-none d-lg-block">
    <?php
    $sql = "SELECT * FROM slideshow2";
    $result = $conn->query($sql);
    $slideCount = 1;
    foreach ($result as $slideshow) {
    ?>
  <div><a href="<?php echo $slideshow['link']; ?>"> <img src="webroot/images/slideshow/<?php echo $slideshow['photopath']; ?>" alt="Image 1"></a></div>
  <?php } ?>
</div>
<div class="slideshow owl-carousel d-block d-lg-none">
    <?php
    $sql = "SELECT * FROM mobile_slideshow2";
    $result = $conn->query($sql);
    $slideCount = 1;
    foreach ($result as $slideshow) {
    ?>
  <div><a href="<?php echo $slideshow['link']; ?>"> <img src="webroot/images/slideshow/<?php echo $slideshow['photopath']; ?>" alt="Image 1"></a></div>
  <?php } ?>
</div>

<!-- Add the necessary Owl Carousel script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
  $('.slideshow').owlCarousel({
    items: 1,
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true
  });
});
</script>





<!-- start of Index files -->





<!----------------------------------------this is the code--->
<div class="container">
<div class="row">
    <div class="col-md-3 mt-9 text-center order-2 order-md-1">

    <div id="slideshow2" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#slideshow2" data-slide-to="0" class="active"></li>
    <li data-target="#slideshow2" data-slide-to="1"></li>
    <li data-target="#slideshow2" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="webroot/images/posts/1696931123blog1.jpg" class="d-block w-100" alt="Image 1">
    </div>
    <div class="carousel-item">
      <img src="webroot/images/posts/1696931410blog5.jpg" class="d-block w-100" alt="Image 2">
    </div>
    <div class="carousel-item">
      <img src="webroot/images/posts/1696931541blog8.jpg" class="d-block w-100" alt="Image 3">
    </div>
  </div>
  <a class="carousel-control-prev" href="#slideshow2" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#slideshow2" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<script>
$(document).ready(function() {
  $('#slideshow2').carousel({
    interval: false, // Disable automatic sliding
    touch: false, // Disable touch events
    keyboard: false // Disable keyboard navigation
  });

  // Manually control the sliding direction
  $('.carousel-control-prev').click(function() {
    $('#slideshow2').carousel('next');
  });

  $('.carousel-control-next').click(function() {
    $('#slideshow2').carousel('prev');
  });
});
</script>


    

    <h6 class="sidebar-title">FEATURED PRODUCT</h6>
    <div class="row">
        <?php
        $sql = "SELECT * FROM product WHERE featured > 0";
        $result = $conn->query($sql);
        foreach ($result as $record) {
            $companyID = $record['pBrand'];
            $sql = "SELECT * FROM company WHERE companyID = $companyID";
            $r = $conn->query($sql);
            $brand = $r->fetch_assoc();
            $productID = $record["productID"];
        ?>
            <div class="col-12 pb-8">
                <!-- Start Product Default Single Item -->
                <div class="product-default-single-item product-color--golden" data-aos="fade-up" data-aos-delay="200">
                    <div class="image-box">
                        <?php
                        $sql = "SELECT PImagesPP FROM PImages WHERE productID = $productID ORDER BY PImagesID LIMIT 2";
                        $result = $conn->query($sql);

                        // Fetch the image URLs and store them in an array
                        $imageURLs = array();
                        while ($row = $result->fetch_assoc()) {
                            $imageURLs[] = $row['PImagesPP'];
                        }
                        ?>
                        <a href="productDetails.php?productID=<?php echo $productID; ?>" class="image-link">
                            <img style="width:300px;height:300px" src="webroot/images/products/<?php echo $imageURLs[0]; ?>" alt="">
                            <img style="width:300px;height:300px" src="webroot/images/products/<?php echo $imageURLs[1]; ?>" alt="">
                        </a>
                        <div class="tag">
                            <?php
                            $discoutPercentage = $record["discoutPercentage"];
                            if ($discoutPercentage > 0) {
                            ?>
                                <span>OFF:<?php echo $discoutPercentage; ?>%</span>
                            <?php } ?>
                        </div>
                        <div class="action-link">
                            <div class="action-link-left">
                                <form action="../phpProces/addtoorder2.php" method="POST" id="addtoorder">
                                    <input type="hidden" name="productID" value="<?php echo $productID; ?>">
                                    <button type="submit" value="submit" name="submit" style="color:white;font-weight: bold;" onmouseover="this.style.color='aqua'" onmouseout="this.style.color='white';"><?php echo $record["linkName"]; ?></button>
                                </form>
                            </div>
                            <div class="action-link-right">
                                <a href="#" data-productid="<?php echo $productID; ?>" data-productname="<?php echo $record['pname']; ?>" data-productimg="<?php echo $imageURLs[0]; ?>" data-userid="<?php if (isset($_SESSION['userID'])) {
                                                                                                                                                                                                            echo $_SESSION['userID'];
                                                                                                                                                                                                        } else {
                                                                                                                                                                                                            echo -1;
                                                                                                                                                                                                        } ?>" class="add-wishlist-btn">
                                    <i class="fa fa-heart <?php if (isset($userID)) {
                                                                $totalWishlist = $conn->query("SELECT COUNT(*) FROM wishlist WHERE userID=$userID AND productID=$productID")->fetch_array()[0];
                                                                if ($totalWishlist > 0) {
                                                                    echo "text-danger";
                                                                }
                                                            } ?>"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="action-link-blog w-100">
                        <a href="post.php?id=<?php echo $record['PostId']; ?>" class="w-100">Read Case Stady</a>
                    </div>
                    <div class="content">
                        <div class="content-left">
                            <h6 class="title"><a href="productDetails.php?productID=<?php echo $productID; ?>"> <?php echo $record['pname']; ?> </a></h6>
                            <ul class="review-star">
                                <?php
                                $totalstar = $record['totalstar'];
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $totalstar) {
                                ?>
                                        <li class="fill"><i class="ion-android-star"></i></li>
                                    <?php } else {
                                    ?>
                                        <li class="empty"><i class="ion-android-star"></i></li>
                                <?php }
                                } ?>
                                <span><?php echo $record['rating']; ?></span>
                            </ul>
                        </div>
                        <div class="content-right">
                            <span class="price">
                                <?php
                                if ($discoutPercentage > 0) {
                                    $originalPrice = $record['salesPrice'];
                                    $discountedPrice = $originalPrice - ($originalPrice * ($discoutPercentage / 100));
                                    echo "<span class='price'><del>$" . $record['salesPrice'] . "</del>$" . $discountedPrice . "</span>";
                                } else {
                                    echo "$" . $record['salesPrice'];
                                }

                                ?>
                            </span>
                        </div>

                    </div>
                </div>
                <!-- End Product Default Single Item -->
            </div>
        <?php } ?>
    </div>

    </div>

    
    <div class="col-md-6 col-sm-12 order-1 order-md-2" data-aos="fade-up" data-aos-delay="200">
        <!---------------------- START OF SINGLE POST SECTION------------------------->
        <section class="singlepost">
            <div class="container singlepost__container">
                <div class="text-center">
                <h2>
                    this is title photo ?>
                </h2>
                </div>
                <div class="singlepost__thumbnail">
                    <img src="webroot/images/posts/1696931483blog7.jpg" alt="">
                </div>
                <div class="desc_area">
                Description Area
                </div>
                <hr class="hr">
                
            </div>
        </section>
        <!---------------------- END OF SINGLE POST SECTION------------------------->
    </div>
    <div class="col-md-3 mt-9 text-center order-3 order-md-3">

    
    







    
   

    <h6 class="sidebar-title">RELATED POSTS</h6>
        <?php
            //fetch posts from database\\
            $sql = "SELECT * FROM posts WHERE featured_post > 0 ORDER BY featured_post";
            $result = mysqli_query($conn,$sql);
            while($post=mysqli_fetch_assoc($result)) :
                $post_id = $post['id'];
        ?>
        <div class="w-100 p-3">
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
</div>
<!----------------------------------------this is the code--->





















<!-- Start Banner Section -->
<div class="banner-section section-top-gap-100">
    <div class="banner-wrapper">
        <div class="container-fluid">
            <div class="row mb-n6">
                <div class="col-md-3 mb-6">
                    <?php
                    $sql = "SELECT * FROM bunner_ads WHERE id=1";
                    $result = $conn->query($sql);
                    $bunnerads = $result->fetch_assoc();
                    ?>
                    <!-- Start Banner Single Item -->
                    <a href="<?php echo $bunnerads['link']; ?>">
                        <div class="banner-single-item banner-style-11 banner-animation banner-color--green img-responsive" data-aos="fade-up" data-aos-delay="0">
                            <div class="image">
                                <img src="webroot/images/bunnerads/<?php echo $bunnerads['thumbnail']; ?>" alt="">
                            </div>
                        </div>
                    </a>
                    <!-- End Banner Single Item -->
                </div>
                <div class="col-md-6 mb-6">
                    <?php
                    $sql = "SELECT * FROM bunner_ads WHERE id=2";
                    $result = $conn->query($sql);
                    $bunnerads = $result->fetch_assoc();
                    ?>
                    <!-- Start Banner Single Item -->
                    <a href="<?php echo $bunnerads['link']; ?>">
                        <div class="banner-single-item banner-style-12 banner-animation banner-color--green img-responsive" data-aos="fade-up" data-aos-delay="200">
                            <div class="image">
                                <img src="webroot/images/bunnerads/<?php echo $bunnerads['thumbnail']; ?>" alt="">
                            </div>
                        </div>
                    </a>
                    <!-- End Banner Single Item -->
                </div>
                <div class="col-md-3 mb-6">
                    <?php
                    $sql = "SELECT * FROM bunner_ads WHERE id=3";
                    $result = $conn->query($sql);
                    $bunnerads = $result->fetch_assoc();
                    ?>
                    <!-- Start Banner Single Item -->
                    <a href="<?php echo $bunnerads['link']; ?>">
                        <div class="banner-single-item banner-style-11 banner-animation banner-color--green img-responsive" data-aos="fade-up" data-aos-delay="400">
                            <div class="image">
                                <img src="webroot/images/bunnerads/<?php echo $bunnerads['thumbnail']; ?>" alt="">
                            </div>
                        </div>
                    </a>
                    <!-- End Banner Single Item -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Banner Section -->

<!-- Start Product Default Tab Slider Section -->
<div class="product-default-tab-slider-section section-top-gap-100 section-fluid">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <ul class="tablist-default tablist nav">
                                <li><a class="nav-link active" data-bs-toggle="tab" href="#feature">FEATURED</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Section Content Text Area -->
        <div class="product-wrapper" data-aos="fade-up" data-aos-delay="200">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content">
                            <!-- Start Tab Item Single Item -->
                            <div class="tab-pane active show" id="feature">
                                <div class="product-slider-default-1row default-slider-nav-arrow">
                                    <!-- Slider main container -->
                                    <div class="swiper-container product-default-slider-4grid-1row">
                                        <!-- Additional required wrapper -->
                                        <div class="swiper-wrapper">
                                            <!-- End Product Default Single Item -->
                                            
                                            <?php
                                            $sql = "SELECT * FROM posts limit 8";
                                            $result = mysqli_query($conn, $sql);
                                            while ($post = mysqli_fetch_assoc($result)) {
                                                $post_id = $post['id'];
                                            ?>
                                            

                                            <!-- Start Product Default Single Item -->
                                            <div class="product-default-single-item product-color--aqua swiper-slide">
                                                <div class="image-box">
                                                        
                                                    <a href="productDetails.php?productID=<?php echo $productID; ?>" class="image-link">
                                                        <img style="width:300px;height:300px" src="webroot/images/posts/<?= $post['thumbnail'] ?>" alt="">
                                                    </a>
                                                        
                                                    <div class="action-link-blog w-100">
                                                        <a href="post.php?id=<?php echo $post_id ?>" class="w-100">Read Case Stady</a>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <div class="content-left" style="margin:0 auto; text-align:center;">
                                                        <h6 class="title"><a href="post.php?id=<?php echo $post_id ?>"><?php echo $post['title'] ?></a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Product Default Single Item -->
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!-- If we need navigation buttons -->
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>
                            <!-- End Tab Item Single Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End Product Default Tab Slider Section -->








<!-- End of Index files -->





<?php include_once("footer.php"); ?>