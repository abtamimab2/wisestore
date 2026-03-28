<?php 
include_once("navbar.php");
include_once("../phpProces/checklogin.php");

?>




<!-- End of Offcanvas Overlay -->


<!-- start of wishlist files -->




   <!-- ...:::: Start Breadcrumb Section:::... -->
   <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Wishlist</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li class="active" aria-current="page">Wishlist</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Wishlist Section:::... -->
    <div class="wishlist-section">
        <!-- Start Cart Table -->
        <div class="wishlish-table-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="table_page table-responsive">
                                <table>
                                    <!-- Start Wishlist Table Head -->
                                    <thead>
                                        <tr>
                                            <th class="product_remove">Delete</th>
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_stock">Stock Status</th>
                                            <th class="product_addcart">Check This in amazon</th>
                                        </tr>
                                    </thead> <!-- End Cart Table Head -->
                                    <tbody>
                                        <!-- Start Wishlist Single Item-->
                                        
                                        <?php
                                            $sql = "SELECT * FROM wishlist WHERE userID=$userID";
                                            $result = $conn->query($sql);
                                            foreach($result as $record){
                                                $productID = $record['productID'];
                                                $sql = "SELECT * FROM product WHERE productID = $productID";
                                                $r = $conn->query($sql); 
                                                $product = $r->fetch_assoc();

                                                $price  = $product['salesPrice'];
                                                $discoutPercentage = $product["discoutPercentage"]; 
                                                if($discoutPercentage > 0){
                                                    $price = $price - ($price * ($discoutPercentage / 100));
                                                }
                                                
                                        ?>
                                        <tr>
                                            <td class="product_remove"><a data-productid="<?php echo $productID; ?>" data-userid="<?php if(isset($_SESSION['userID'])){echo $_SESSION['userID'];}else{echo -1;} ?>" class="product_R_F_w" href="#"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td class="product_thumb"><a href="productDetails.php"><img
                                                        src="webroot/images/products/<?php echo $record['PFimgurl']; ?>"
                                                        alt=""></a></td>
                                            <td class="product_name"><a href="productDetails.php"><?php echo $record['productName']; ?></a></td>
                                            <td class="product-price"><?php echo "$".$price; ?></td>
                                            <td class="product_stock"><?php if($product['qtyStock'] >0){ echo "IN STOCK"; }else{ echo "N/A"; } ?></td>
                                            <td class="product_addcart">
                                                <form action="../phpProces/addtoorder2.php" method="POST" id="addtoorder">
                                                    <input type="hidden" name="productID" value="<?php echo $productID; ?>">
                                                    <input type="hidden" name="userID" value="<?php if(isset($_SESSION['userID'])){echo $_SESSION['userID'];}else{echo -1;} ?>">
                                                    <button type="submit" value="submit" name="submit" id="addToCartBtn" style="color:black;font-weight: bold;" onmouseover="this.style.color='aqua'" onmouseout="this.style.color='black';" >Check This in amazon</button>
                                                </form>
                                            </td>
                                        </tr> <!-- End Wishlist Single Item-->
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Cart Table -->
    </div> <!-- ...:::: End Wishlist Section:::... -->










<!-- End of wishlist files -->





<?php include_once("footer.php"); ?>