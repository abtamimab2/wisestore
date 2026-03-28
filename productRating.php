<?php

include_once("navbar.php");
$record;
if(isset($_GET["orderDetailID"]))
{
    $orderDetailID = $_GET["orderDetailID"];
    $result =$conn->query("SELECT COUNT(*) FROM orderDetail where orderDetailID=$orderDetailID")->fetch_array()[0];
    if($result == 1)
    {
        $sql = "SELECT * FROM orderDetail where orderDetailID=$orderDetailID";
        $result =$conn->query($sql);
        $record = $result->fetch_assoc();
    }
    
}

?>






<!-- End of Offcanvas Overlay -->


<!-- start of product details files -->








    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Product Details - Default</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.html">Shop</a></li>
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
                                <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                    <img src="webroot/images/products/<?php echo $record['productPhotoName']; ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- End Large Image -->
                        <!-- Start Thumbnail Image -->
                        <div class="product-image-thumb-horizontal swiper-container ">
                            
                        </div>
                        <!-- End Thumbnail Image -->
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="product-details-content-area product-details--golden" data-aos="fade-up"
                        data-aos-delay="200">
                        <!-- Start  Product Details Text Area-->
                        <div class="product-details-text">
                            <h4 class="title"><?php echo $record['productName']; ?></h4>
                            <div class="d-flex align-items-center">
                                <ul class="review-star">
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="empty"><i class="ion-android-star"></i></li>
                                </ul>
                                <a href="#" class="customer-review ml-2">(customer review )</a>
                            </div>
                            <div class="price">$<?php echo $record['price']; ?></div>
                            <p><?php echo $record['productTittle']; ?></p>
                        </div> <!-- End  Product Details Text Area-->
                        <!-- Start Product Variable Area -->
                        <div class="product-details-variable">
                            <h4 class="title">Quantity You Bought</h4>
                            <!-- Product Variable Single Item -->
                            <div class="variable-single-item">
                                <div class="product-stock"> <span class="product-stock-in"><i
                                            class="ion-checkmark-circled"></i></span> <?php echo $record['quantity']; ?> Item</div>
                            </div>
                        </div> <!-- End Product Variable Area -->

                        <!-- Start  Product Details Catagories Area-->
                        <div class="product-details-catagory mb-2">
                            <span class="title">CATEGORY:</span>
                            <ul>
                                <li><b><?php echo $record['categoryName']; ?></b>   </li>
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
                                    Get Reviews
                                </a></li>
                        </ul> <!-- End Product Details Tab Button -->

                        <!-- Start Product Details Tab Content -->
                        <div class="product-details-content-tab">
                            <div class="tab-content">
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane active show" id="description">
                                    <div class="single-tab-content-item">
                                        <div class="review-form">

                                            <form>
                                                <div class="row">
                                                    <div class="col-md-12 text-center d-flex justify-content-center ">
                                                    <div style="width:400px;height:75px; box-shadow:2px 2px 10px 0px;" class="rounded-pill" >
                                                        <ul class="list-inline" >
                                                            <li class="list-inline-item" ><a href="#"><i class=" fa fa-star-o text-warning mt-2 sr" style="font-size:60px;" ></i></a></li>
                                                            <li class="list-inline-item" ><a href="#"><i class=" fa fa-star-o text-warning mt-2 sr" style="font-size:60px;" ></i></a></li>
                                                            <li class="list-inline-item" ><a href="#"><i class=" fa fa-star-o text-warning mt-2 sr" style="font-size:60px;" ></i></a></li>
                                                            <li class="list-inline-item" ><a href="#"><i class=" fa fa-star-o text-warning mt-2 sr" style="font-size:60px;" ></i></a></li>
                                                            <li class="list-inline-item" ><a href="#"><i class=" fa fa-star-o text-warning mt-2 sr" style="font-size:60px;" ></i></a></li>
                                                        </ul>
                                                    </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="default-form-box">
                                                            <label for="comment-review-text">Your review
                                                                <span>*</span></label>
                                                            <textarea id="comment-review-text" placeholder="Write a review" required></textarea>
                                                            <input type="hidden" id="productID" value="<?php echo $record['productID']; ?>">
                                                            <input type="hidden" id="userID" value="<?php echo $_SESSION['userID']; ?>">
                                                            <input type="hidden" id="ordersID" value="<?php echo $record['ordersID']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button class="btn btn-md btn-black-default-hover" id="revSubBtn">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                            </div>
                        </div> <!-- End Product Details Tab Content -->

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Product Content Tab Section -->






<!-- End of product details files -->





<?php include_once("footer.php"); ?>