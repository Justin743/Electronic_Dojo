<?php
session_start();

require "lib/functions.php";

$orders = displayOrders();

require "templates/header.php";
require "Classes/productsClass.php"
?>

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
                        <?php foreach ($orders as $order): ?>

                            <?php $Order = new Order();
                            $Order->setOrderID($order['order_ID']);
                            $Order->setDateOfOrder($order['date_of_order']);
                            $Order->setTotal($order['total']);

                            $Product = new Product();
                            $Product->setProductID($order['product_ID']);
                            $Product->setProductName($order['product_name']);
                            $Product->setPrice($order['price']);
                            $Order->addProduct($Product);

                            $Order->displayOrder();
                            ?>

                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>