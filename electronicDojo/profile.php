<?php
require_once "lib/functions.php";
require "Classes/productSClass.php";

$orders = displayOrders();

?>

<?php require "templates/header.php"?>
<!-- Order Details -->

<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-5 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Your Order</h3>
                </div>
                <div class="order-summary">
                    <div class="order-col">
                        <div><strong>PRODUCT</strong></div>
                        <div><strong>TOTAL</strong></div>
                    </div>

                    <?php foreach ($orders as $order): ?>

                        $Order = new order();

                        <div class="order-products">

                            <div class="order-col">
                                <?php if(isset($order['product_name'])): ?>
                                    <div><?php echo $order['product_name']; ?></div> <!-- Display product name -->
                                    <div>$<?php echo $order['price']; ?></div> <!-- Display product price -->
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="order-col">
                            <div><strong>Order ID:</strong> <?php echo $order['order_ID']; ?></div> <!-- Display order ID -->
                            <div><strong>Date of Order:</strong> <?php echo $order['date_of_order']; ?></div> <!-- Display date of order -->
                        </div>
                        <div class="order-col">
                            <div><strong>Payment Method:</strong><?php echo isset($order['payment_ID']) ? $order['payment_ID'] : 'N/A'; ?></div> <!-- Display payment method -->
                        </div>

                    <?php endforeach; ?>

                    <div class="order-col">
                        <div>Shipping</div>
                        <div><strong>FREE</strong></div>
                    </div>
                    <div class="order-col">
                        <div><strong>TOTAL</strong></div>
                        <div><strong class="order-total">$<?php echo $order['total']; ?></strong></div> <!-- Display total order price -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<a href="index.php">Back to home</a>
<?php include "templates/footer.php"?>
