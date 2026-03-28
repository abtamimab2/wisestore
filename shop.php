<?php 
include_once("navbar.php");
$gsql;
$forcount;
$firstQeuePagination;
if(isset($_GET["categoryID"]))
{
    $categoryID = filter_var($_GET["categoryID"],FILTER_SANITIZE_NUMBER_INT);
    $gsql = "SELECT * FROM product WHERE pCategory = $categoryID";
    $forcount = "SELECT COUNT(*) FROM product WHERE pCategory = $categoryID";
}else{
    $gsql = "SELECT * FROM product";
    $forcount = "SELECT COUNT(*) FROM product"; 
}

if(isset($_GET["search"]))
{
    $search = filter_var($_GET["search"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if(!$search == ""){
        $gsql = $gsql." WHERE pname LIKE '%$search%'";
        $forcount = $forcount." WHERE pname LIKE '%$search%'";
    }
}

$totalproductfound = $conn->query($forcount)->fetch_array()[0];
$totalpaginationNumber = ceil($totalproductfound / 9);
if(isset($_GET["paginationNumber"]))
{
    $paginationNumber = filter_var($_GET["paginationNumber"],FILTER_SANITIZE_NUMBER_INT);
    if($paginationNumber>$totalpaginationNumber || $paginationNumber<1)
    {
        echo "<script>Please Enter a valid number</script>";
    }else
    {
        $firstQeuePagination = 0;
        if($paginationNumber > 1)
        {
            $firstQeuePagination = $paginationNumber - 1;
        }
        $f = $firstQeuePagination * 9;
        $l = $f + 9;
        $gsql = $gsql." LIMIT $f,$l";
    }
}else{
    $gsql = $gsql." LIMIT 9";
}



?>



<!-- End of Offcanvas Overlay -->


<!-- start of shop files -->








    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Shop
                        <?php 
                            if(isset($_GET['categoryID']))
                            {
                                $catID = $_GET['categoryID'];
                                $sql = "SELECT * FROM category WHERE categoryID = $catID";
                                $r = $conn->query($sql); 
                                $cat = $r->fetch_assoc();
                                echo "----- " .$cat["name"];
                            }
                        ?>
                        </h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li class="active" aria-current="page">Shop</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Shop Section:::... -->
    <div class="shop-section">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-lg-3">
                    <!-- Start Sidebar Area -->
                    <div class="siderbar-section" data-aos="fade-up" data-aos-delay="0">

                        <!-- Start Single Sidebar Widget -->
                        <div class="sidebar-single-widget">
                            <h6 class="sidebar-title">CATEGORIES</h6>
                            <div class="sidebar-content">
                                <ul class="sidebar-menu">
                                    <?php
                                        $sql = "SELECT * FROM category";
                                        $result = $conn->query($sql);
                                        foreach($result as $record){
                                    ?>
                                    <li ><a class="<?php 
                                    if(isset($_GET['categoryID']))
                                    {
                                        $linkNavCatID = $_GET['categoryID'];
                                        if($linkNavCatID == $record['categoryID'] )
                                        {
                                            echo "active-nav";
                                        }
                                    }
                                    ?>" href="shop.php?categoryID=<?php echo $record['categoryID']; ?>"><?php echo $record['name']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div> <!-- End Single Sidebar Widget -->

                    </div> <!-- End Sidebar Area -->
                </div>
                <div class="col-lg-9">
                    <!-- Start Shop Product Sorting Section -->
                    <div class="shop-sort-section">
                        <div class="container">
                            <div class="row">
                                <!-- Start Sort Wrapper Box -->
                                <div class="sort-box d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column"
                                    data-aos="fade-up" data-aos-delay="0">
                                    <!-- Start Sort tab Button -->
                                    <div class="sort-tablist d-flex align-items-center">
                                        <ul class="tablist nav sort-tab-btn">
                                            <li><a class="nav-link active" data-bs-toggle="tab"
                                                    href="#layout-3-grid"><img src="../../assets/images/icons/bkg_grid.png"
                                                        alt=""></a></li>
                                            <li><a class="nav-link" data-bs-toggle="tab" href="#layout-list"><img
                                                        src="../../assets/images/icons/bkg_list.png" alt=""></a></li>
                                        </ul>

                                        <!-- Start Page Amount -->
                                        <div class="page-amount ml-2">
                                            <span> <?php echo $totalproductfound." PRODUCT FOUND"; ?> <!--   Showing 1–9 of 21 results --></span>
                                        </div> <!-- End Page Amount -->
                                    </div> <!-- End Sort tab Button -->



                                </div> <!-- Start Sort Wrapper Box -->
                            </div>
                        </div>
                    </div> <!-- End Section Content -->

                    <!-- Start Tab Wrapper -->
                    <div class="sort-product-tab-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content tab-animate-zoom">
                                        <!-- Start Grid View Product -->
                                        <div class="tab-pane active show sort-layout-single" id="layout-3-grid">
                                            <div class="row">
                                            <?php
                                                
                                                $result = $conn->query($gsql);
                                                foreach($result as $record){
                                                    $companyID = $record['pBrand'];
                                                    $sql = "SELECT * FROM company WHERE companyID = $companyID";
                                                    $r = $conn->query($sql); 
                                                    $brand = $r->fetch_assoc();
                                                    $productID = $record["productID"]; 
                                            ?>
                                                <div class="col-xl-4 col-sm-6 col-12">
                                                    <!-- Start Product Default Single Item -->
                                                    <div class="product-default-single-item product-color--golden"
                                                        data-aos="fade-up" data-aos-delay="200">
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
                                                </div>
                                            <?php } ?>
                                            </div>
                                        </div> <!-- End Grid View Product -->
                                        <!-- Start List View Product -->
                                        <div class="tab-pane sort-layout-single" id="layout-list">
                                            <div class="row">
                                                <?php
                                                    $result = $conn->query($gsql);
                                                    foreach($result as $record){
                                                        $companyID = $record['pBrand'];
                                                        $sql = "SELECT * FROM company WHERE companyID = $companyID";
                                                        $r = $conn->query($sql); 
                                                        $brand = $r->fetch_assoc();
                                                        $productID = $record["productID"]; 
                                                ?>
                                                <div class="col-12">
                                                    <!-- Start Product Defautlt Single -->
                                                    <div class="product-list-single product-color--golden">
                                                        <a href="productDetails.php?productID=<?php echo $productID; ?>"
                                                            class="product-list-img-link">
                                                            <?php
                                                                $sql = "SELECT PImagesPP FROM PImages WHERE productID = $productID ORDER BY PImagesID LIMIT 2";
                                                                $result = $conn->query($sql);
                                                                
                                                                // Fetch the image URLs and store them in an array
                                                                $imageURLs = array();
                                                                while ($row = $result->fetch_assoc()) {
                                                                    $imageURLs[] = $row['PImagesPP'];
                                                                }
                                                            ?>
                                                            <img class="img-fluid"
                                                                src="webroot/images/products/<?php echo $imageURLs[0]; ?>"
                                                                alt="">
                                                            <img class="img-fluid"
                                                                src="webroot/images/products/<?php echo $imageURLs[1]; ?>"
                                                                alt="">
                                                        </a>
                                                        <div class="product-list-content">
                                                            <h5 class="product-list-link"><a
                                                                    href="product-details-default.html"><?php echo $record["pname"];  ?></a></h5>
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
                                                            <span class="product-list-price">
                                                            <?php
                                                                $discoutPercentage = $record["discoutPercentage"]; 
                                                                if($discoutPercentage > 0){
                                                                    $originalPrice = $record['salesPrice'];
                                                                    $discountedPrice = $originalPrice - ($originalPrice * ($discoutPercentage / 100));
                                                                    echo "<span class='price'><del>$".$record['salesPrice']."</del>$".$discountedPrice."</span>";
                                                                }else{
                                                                    echo "$".$record['salesPrice'];
                                                                }

                                                            ?>
                                                            </span>
                                                            <p><?php echo $record['pTitle']; ?></p>
                                                        </div>
                                                    </div> <!-- End Product Defautlt Single -->
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div> <!-- End List View Product -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Tab Wrapper -->

                    <!-- Start Pagination -->
                   <!-- <div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                        <ul>
                            <li><a class="active" href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#"><i class="ion-ios-skipforward"></i></a></li>
                        </ul>
                    </div>
                                                            -->
                     <!-- End Pagination -->
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Shop Section:::... -->









<!-- End of shop files -->





<?php include_once("footer.php"); ?>