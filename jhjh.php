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
                                                </div>
                                                <div class="action-link-blog w-100">
                                                    <a href="post.php?id=<?php echo $post_id ?>" class="w-100">Read Case Stady</a>
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