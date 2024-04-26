<?php
session_start();

require "lib/functions.php";
require "templates/header.php";
require "Classes/productsClass.php";

$userId = $_SESSION['UserID'];
$orders = displayOrders($userId);
?>

<!-- Order Details -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-5 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Your Order</h3>
                </div>
                <div class="order-summary">
                    <?php if (empty($orders)): ?>
                        <p>You have not placed any orders.</p>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <?php
                            $Order = new Order();
                            $Order->setCustomerID($order['customer_ID_order']);
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "templates/footer.php"; ?>
