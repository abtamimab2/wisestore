<?php

include_once("navbar.php");
$record;
if(isset($_GET["productID"]))
{
    $productID = $_GET["productID"];
    $result =$conn->query("SELECT COUNT(*) FROM product where productID=$productID")->fetch_array()[0];
    if($result == 1)
    {
        $sql = "SELECT * FROM product where productID=$productID";
        $result =$conn->query($sql);
        $record = $result->fetch_assoc();
    }
    
}

?>


?>




<!-- End of Offcanvas Overlay -->


<!-- start of product details files -->







    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Product Details</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li class="active" aria-current="page">Product Details Default</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- Start Product Details Section -->
    <div class="product-details-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="product-details-gallery-area" data-aos="fade-up" data-aos-delay="0">
                        <!-- Start Large Image -->
                        <div class="product-large-image product-large-image-horaizontal swiper-container">
                            <div class="swiper-wrapper">
                            <?php

                                $qry = "SELECT * FROM PImages WHERE productID = $productID";
                                $r = $conn->query($qry);
                                $i = 0;
                                foreach($r as $re){
                                $imgrul = $re["PImagesPP"];
                            ?>
                                <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                    <img src="webroot/images/products/<?php echo $imgrul; ?>" alt="">
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- End Large Image -->
                        <!-- Start Thumbnail Image -->
                        <div
                            class="product-image-thumb product-image-thumb-horizontal swiper-container pos-relative mt-5">
                            <div class="swiper-wrapper">
                            <?php

                                $qry = "SELECT * FROM PImages WHERE productID = $productID";
                                $r = $conn->query($qry);
                                $i = 0;
                                foreach($r as $re){
                                $imgrul = $re["PImagesPP"];
                            ?>
                                <div class="product-image-thumb-single swiper-slide">
                                    <img class="img-fluid" src="webroot/images/products/<?php echo $imgrul; ?>" alt="">
                                </div>
                            <?php } ?>
                            </div>
                            <!-- Add Arrows -->
                            <div class="gallery-thumb-arrow swiper-button-next"></div>
                            <div class="gallery-thumb-arrow swiper-button-prev"></div>
                        </div>
                        <!-- End Thumbnail Image -->
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="product-details-content-area product-details--golden" data-aos="fade-up"
                        data-aos-delay="200">
                        <!-- Start  Product Details Text Area-->
                        <div class="product-details-text">
                            <h4 class="title"><?php echo $record['pname']; ?></h4>
                            <div class="d-flex align-items-center">
                                <ul class="review-star">
                                    <?php
                                    $totalstar = $record['totalstar'];
                                    for($i = 1; $i<=5;$i++){
                                        if($i <= $totalstar){
                                    ?>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <?php }else { ?>
                                    <li class="empty"><i class="ion-android-star"></i></li>
                                    <?php }} ?>
                                </ul>
                                <span> <?php echo $record['rating']; ?></span>
                            </div>
                            <div class="price">
                                <?php
                                    $discoutPercentage = $record["discoutPercentage"];
                                    if($discoutPercentage > 0){
                                        $originalPrice = $record['salesPrice'];
                                        $discountedPrice = $originalPrice - ($originalPrice * ($discoutPercentage / 100));
                                        echo "$<del>".$record['salesPrice']."</del> <i class='fa fa-arrow-circle-right text-primary'></i> <b>$".$discountedPrice."</b>";
                                    }else{
                                        echo "$".$record['salesPrice'];
                                    }
                                ?>
                            </div>
                            <h5><?php echo $record['pTitle']; ?></h5>
                        </div> <!-- End  Product Details Text Area-->
                        <!-- Start Product Variable Area -->
                        <div class="product-details-variable">
                            <h4 class="title">Available Options</h4>
                            <!-- Product Variable Single Item -->
                            <div class="variable-single-item">
                                <div class="product-stock"> <span class="product-stock-in"><i
                                            class="ion-checkmark-circled"></i></span> <?php if($record['qtyStock']>0){ echo $record['qtyStock']." IN STOCK"; }else{ echo "<span class='text-danger'>N/A</span>"; } ?> </div>
                            </div>
                            <!-- Product Variable Single Item -->
                            <div class="d-flex align-items-center ">
                                
                                <?php
                                    $sql = "SELECT PImagesPP FROM PImages WHERE productID = $productID ORDER BY PImagesID LIMIT 2";
                                    $result = $conn->query($sql);
                                    
                                    // Fetch the image URLs and store them in an array
                                    $imageURLs = array();
                                    while ($row = $result->fetch_assoc()) {
                                        $imageURLs[] = $row['PImagesPP'];
                                    }
                                ?>

                                <div class="product-add-to-cart-btn">
                                    <form action="../phpProces/addtoorder2.php" method="POST" id="addtoorder">
                                        <input type="hidden" name="productID" value="<?php echo $productID; ?>">
                                        <input type="hidden" name="userID" value="<?php if(isset($_SESSION['userID'])){echo $_SESSION['userID'];}else{echo -1;} ?>">
                                        <button type="submit" value="submit" name="submit" id="addToCartBtn" class="btn btn-block btn-lg btn-black-default-hover" ><?php echo $record["linkName"]; ?></a>
                                    </form>
                                </div>
                            </div>
                            <!-- Start  Product Details Meta Area-->
                            <div class="product-details-meta mb-20 pt-2 mt-2">
                                <a href="#" data-productid="<?php echo $productID; ?>" data-productname="<?php echo $record['pname']; ?>" data-productimg="<?php echo $imageURLs[0]; ?>" data-userid="<?php if(isset($_SESSION['userID'])){echo $_SESSION['userID'];}else{echo -1;} ?>" class="icon-space-right add-wishlist-btn"><i class="fa fa-heart <?php if(isset($userID)){ $totalWishlist = $conn->query("SELECT COUNT(*) FROM wishlist WHERE userID=$userID AND productID=$productID")->fetch_array()[0]; if($totalWishlist>0){ echo "text-danger"; } } ?>"></i>Add to
                                    wishlist</a>
                            </div> <!-- End  Product Details Meta Area-->
                        </div> <!-- End Product Variable Area -->

                        <!-- Start  Product Details Catagories Area-->
                        <div class="product-details-catagory mb-2">
                            <span class="title">CATEGORY:</span>
                            <ul>
                                <li><a href="#">
                                <?php
                                        $categoryId = $record['pCategory'];
                                        $qry = "select * from category where categoryID=$categoryId";
                                        $r = $conn->query($qry);
                                        $category = $r->fetch_assoc();
                                    ?>
                                    <td><?php echo $category["name"]; ?></td>
                                </a></li>
                            </ul>
                        </div> <!-- End  Product Details Catagories Area-->
                        <!-- Start  Product Details Social Area-->
                        <div class="product-details-social">
                            <span class="title">SHARE THIS PRODUCT:</span>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div> <!-- End  Product Details Social Area-->
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Product Details Section -->

    <!-- Start Product Content Tab Section -->
    <div class="product-details-content-tab-section section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-details-content-tab-wrapper" data-aos="fade-up" data-aos-delay="0">

                        <!-- Start Product Details Tab Button -->
                        <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                            <li><a class="nav-link active" data-bs-toggle="tab" href="#description">
                                    Description
                                </a></li>
                        </ul> <!-- End Product Details Tab Button -->

                        <!-- Start Product Details Tab Content -->
                        <div class="product-details-content-tab">
                            <div class="tab-content">
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane active show" id="description">
                                    <div class="single-tab-content-item">
                                        <p><?php echo $record['pDescription']; ?></p>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                            </div>
                        </div> <!-- End Product Details Tab Content -->

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Product Content Tab Section -->

    <!-- Start Product Default Slider Section -->
    <div class="product-default-slider-section section-top-gap-100 section-fluid">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="secton-content">
                                <h3 class="section-title">RELATED PRODUCTS</h3>
                                <p>Browse the collection of our related products.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Section Content Text Area -->
        <div class="product-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-slider-default-1row default-slider-nav-arrow">
                            <!-- Slider main container -->
                            <div class="swiper-container product-default-slider-4grid-1row">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                <?php
                                    $sql = "SELECT * FROM product WHERE pCategory=$categoryId LIMIT 8";
                                    $result = $conn->query($sql);
                                    foreach($result as $record){
                                        $companyID = $record['pBrand'];
                                        $sql = "SELECT * FROM company WHERE companyID = $companyID";
                                        $r = $conn->query($sql); 
                                        $brand = $r->fetch_assoc();
                                        $productID = $record["productID"]; 
                                ?>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--golden swiper-slide">
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
                                                <img style="width:300px;height:300px" src="../../webroot/images/products/<?php echo $imageURLs[0]; ?>" alt="">
                                                <img style="width:300px;height:300px" src="../../webroot/images/products/<?php echo $imageURLs[1]; ?>" alt="">
                                            </a>
                                            <div class="tag">
                                            <?php
                                                $discoutPercentage = $record["discoutPercentage"]; 
                                                if($discoutPercentage > 0){
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
                                                    <a  href="#" data-productid="<?php echo $productID; ?>" data-productname="<?php echo $record['pname']; ?>" data-productimg="<?php echo $imageURLs[0]; ?>" data-userid="<?php if(isset($_SESSION['userID'])){echo $_SESSION['userID'];}else{echo -1;} ?>" class="add-wishlist-btn" >
                                                        <i class="fa fa-heart <?php if(isset($userID)){ $totalWishlist = $conn->query("SELECT COUNT(*) FROM wishlist WHERE userID=$userID AND productID=$productID")->fetch_array()[0]; if($totalWishlist>0){ echo "text-danger"; } } ?>"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="action-link-blog w-100">
                                            <a href="post.php?id=<?php echo $record['PostId']; ?>" class="w-100">Read Case Stady</a>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="productDetails.php?productID=<?php echo $productID; ?>"><?php echo $record['pname']; ?></a></h6>
                                                <ul class="review-star">
                                                    <?php
                                                    $totalstar = $record['totalstar'];
                                                    for($i = 1; $i<=5;$i++){
                                                        if($i <= $totalstar){
                                                    ?>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <?php }else {
                                                    ?>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                    <?php } }?>
                                                    <span><?php echo $record['rating']; ?></span>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price">
                                                <?php
                                                    if($discoutPercentage > 0){
                                                        $originalPrice = $record['salesPrice'];
                                                        $discountedPrice = $originalPrice - ($originalPrice * ($discoutPercentage / 100));
                                                        echo "<span class='price'><del>$".$record['salesPrice']."</del>$".$discountedPrice."</span>";
                                                    }else{
                                                        echo "$".$record['salesPrice'];
                                                    }

                                                 ?>
                                                </span>
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
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Default Slider Section -->









<!-- End of product details files -->





<?php include_once("footer.php"); ?>