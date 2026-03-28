<?php 
include_once("navbar.php");
include_once("../phpProces/checklogin.php");
$record;
if(isset($_GET["orderID"]))
{
    $orderID = $_GET["orderID"];
    $result =$conn->query("SELECT COUNT(*) FROM orders where ordersID=$orderID")->fetch_array()[0];
    if($result == 1)
    {
        $sql = "SELECT * FROM orders where ordersID=$orderID";
        $result =$conn->query($sql);
        $record = $result->fetch_assoc();
    }else{
        echo '<script>window.location.href = "error404.php";</script>';
        exit();
    }
    
}else{
    echo '<script>window.location.href = "error404.php";</script>';
    exit();
}

?>




<!-- End of Offcanvas Overlay -->


<!-- start of cart files -->




    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">View Order</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li class="active" aria-current="page">View Order</li>
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
                                            <th class="product_rating">Get Rate</th>
                                            <th class="product_thumb">Image</th>
                                            <th class="product_name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product_quantity">Quantity</th>
                                            <th class="product_total">Total</th>
                                        </tr>
                                    </thead> <!-- End Cart Table Head -->
                                    <tbody>
                                    <?php
                                        $orderID = $record['ordersID'];
                                        $totalPrice = $record['totalPrice'];
                                        $sql = "SELECT * FROM orderDetail WHERE ordersID=$orderID";
                                        $result = $conn->query($sql);
                                        foreach($result as $record){
                                            $productID = $record['productID'];
                                            
                                    ?>
                                        <!-- Start Cart Single Item-->
                                        <tr>
                                            <td class="product_rating"><a href="productRating.php?orderDetailID=<?php echo $record['orderDetailID']; ?>"><img style="widht:50px;height:50px;" src="../../webroot/images/site/rating.png" alt=""></a></td>
                                            <td class="product_thumb"><img src="webroot/images/products/<?php echo $record['productPhotoName']; ?>" alt=""></td>
                                            <td class="product_name"><?php echo $record['productName']; ?></td>
                                            <td class="product-price"><?php echo "$". $record['price']; ?></td>
                                            <td class="product_quantity"><?php echo $record['quantity']; ?></td>
                                            <td class="product_total">$<?php echo ($record['quantity'] * $record['price']); ?></td>
                                        </tr> <!-- End Cart Single Item-->
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart_submit">
                                <h3>Total: <?php echo $totalPrice; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Cart Table -->

    </div> <!-- ...:::: End Cart Section:::... -->








<!-- End of cart files -->





<?php include_once("footer.php"); ?>