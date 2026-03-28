<?php 
include_once("navbar.php");
include_once("../phpProces/checklogin.php");


?>




<!-- End of Offcanvas Overlay -->


<!-- start of cart files -->




    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Cart</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li class="active" aria-current="page">Cart</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Cart Section:::... -->
    <div class="cart-section">
        <!-- Start Cart Table -->
        <div class="cart-table-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="table_page table-responsive">
                                <table>
                                    <!-- Start Cart Table Head -->
                                    <thead>
                                        <tr>
                                            <th class="product_remove">Delete</th>
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_quantity">Quantity</th>
                                            <th class="product_total">Total</th>
                                        </tr>
                                    </thead> <!-- End Cart Table Head -->
                                    <tbody>
                                    <?php
                                        $sql = "SELECT * FROM card WHERE userID=$userID";
                                        $result = $conn->query($sql);
                                        $totalPrice=0;
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
                                            $price = (int)$price;
                                            $quantity = $record['quantity'];
                                            $totalProductPrice = $price * $quantity;
                                            $totalPrice = $totalPrice + $totalProductPrice;
                                            
                                    ?>
                                        <!-- Start Cart Single Item-->
                                        <tr>
                                            <td class="product_remove"><a href="#" data-productid="<?php echo $productID; ?>" data-userid="<?php if(isset($_SESSION['userID'])){echo $_SESSION['userID'];}else{echo -1;} ?>" class="product_R_F_C"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td class="product_thumb"><a href="productDetails.php?productID=<?php echo $productID; ?>"><img src="webroot/images/products/<?php echo $record['PFimgurl']; ?>" alt=""></a></td>
                                            <td class="product_name"><a href="productDetails.php?productID=<?php echo $productID; ?>"><?php echo $record['productName']; ?></a></td>
                                            <td class="product-price"><?php echo "$".$price; ?></td>
                                            <td class="product_quantity"><label>Quantity</label> <input data-product-price="<?php echo $price; ?>" data-carttid="<?php echo $record['cardID']; ?>" class="product_Q_I" min="1"
                                                    max="100" value="<?php echo $record['quantity']; ?>" type="number"></td>
                                            <td class="product_total">$<?php echo $totalProductPrice; ?></td>
                                        </tr> <!-- End Cart Single Item-->
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart_submit">
                                <button class="btn btn-md btn-golden update_Q_btn" >update cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Cart Table -->

        <!-- Start Coupon Start -->
        <div class="coupon_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="coupon_code right" data-aos="fade-up" data-aos-delay="400">
                            <h3>Cart Totals</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal">
                                    <p>Subtotal</p>
                                    <p class="cart_amount cart_amount_s">$<?php echo $totalPrice; ?></p>
                                </div>
                                <div class="cart_subtotal ">
                                    <p>Shipping</p>
                                    <p class="cart_amount"><span>Flat Rate:</span> Free</p>
                                </div>
                                <hr>

                                <div class="cart_subtotal">
                                    <p>Total</p>
                                    <p class="cart_amount cart_amount_t">$<?php echo $totalPrice; ?></p>
                                </div>
                                <div class="checkout_btn">
                                    <a href="checkout.php" class="btn btn-md btn-golden">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Coupon Start -->
    </div> <!-- ...:::: End Cart Section:::... -->








<!-- End of cart files -->





<?php include_once("footer.php"); ?>