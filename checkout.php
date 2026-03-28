<?php include_once("navbar.php"); ?>




<!-- End of Offcanvas Overlay -->


<!-- start of checkout files -->





    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Checkout</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="cart.php">Cart</a></li>
                                    <li class="active" aria-current="page">Checkout</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Checkout Section:::... -->
    <div class="checkout-section">
        <div class="container">
            <!-- Start User Details Checkout Form -->
            <div class="checkout_form" data-aos="fade-up" data-aos-delay="400">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <form action="../phpProces/addtoorder.php" method="post" id="orderForm">
                            <h3>Your order</h3>
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = "SELECT * FROM card WHERE userID=$userID";
                                        $result = $conn->query($sql);
                                        $totalPrice=0;
                                        $totalpackage=0;
                                        foreach($result as $record){
                                            $productID = $record['productID'];
                                            $PFimgurl = $record['PFimgurl'];
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
                                            $totalpackage = $totalpackage + $quantity;
                                    ?>
                                        <tr>
                                            <td> <?php echo $record['productName']; ?> <strong> × <?php echo $record['quantity']; ?></strong></td>
                                            <td> $<?php echo $totalProductPrice; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Cart Subtotal</th>
                                            <td>$<?php echo $totalPrice; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td><strong>FREE</strong></td>
                                        </tr>
                                        <tr class="order_total">
                                        <input name="PFimgurl" value="<?php echo $PFimgurl; ?>" hidden />
                                        <input name="totalPrice" value="<?php echo $totalPrice; ?>" hidden />
                                        <input name="totalpackage" value="<?php echo $totalpackage; ?>" hidden />

                                            <th>Order Total</th>
                                            <td><strong>$<?php echo $totalPrice; ?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment_method">
                                <div class="order_button pt-3">
                                    <input class="btn btn-md btn-black-default-hover" type="button" data-bs-toggle="modal" data-bs-target="#modalAddcart" value="Proceed To Paypal" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- Start User Details Checkout Form -->
        </div>
    </div><!-- ...:::: End Checkout Section:::... -->




    <!-- Start Modal Add cart -->
    <div class="modal fade" id="modalAddcart"  tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-sm"  role="document">
            <div class="modal-content" style="margin-left:20%; width:500px;text-align:center;">
                <div class="modal-body" >
                    <div class="container">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-4">
                                    <div class="modal-add-cart-product-img">
                                        <img class="img-fluid"
                                            src="webroot/images/site/paypal.png" alt="">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div><i class="fa fa-cart-plus"></i> <strong>$<?php echo $totalPrice; ?></strong></div>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Email</span>
                                    </div>
                                    <input type="email" class="form-control" required>
                                    </div>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Password</span>
                                    </div>
                                    <input type="text" class="form-control" required>
                                    </div>
                                    <div class="input-group">
                                    <input type="button" id="orPrBtn" value ="Proceed $<?php echo $totalPrice; ?>" class="btn btn-outline-primary form-control">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Add cart -->




<!-- End of checkout files -->





<?php include_once("footer.php"); ?>