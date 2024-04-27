<?php
//Start the session.
session_start();

require "lib/functions.php";
require "Classes/productsClass.php";
require "templates/header.php";

//Assigns UserID key from the session to userId variable.
$userId = $_SESSION['UserID'];
//Display method used to display orders for users with user_ID as userId
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
                    <!-- Checks if the order is empty for the user, if its empty then it will print "You have not placed any orders" -->
                    <?php if (empty($orders)): ?>
                        <p>You have not placed any orders.</p>
                    <?php else: ?>
                        <!-- If order is not empty, then print every order associated with the customer -->
                        <?php foreach ($orders as $order): ?>
                            <?php

                            //Make a new order object ands set values contained from tables in DB.
                            $Order = new Order();
                            $Order->setCustomerID($order['customer_ID_order']);
                            $Order->setOrderID($order['order_ID']);
                            $Order->setDateOfOrder($order['date_of_order']);
                            $Order->setTotal($order['total']);

                            //Make a new product object and set values from DB.
                            $Product = new Product();
                            $Product->setProductID($order['product_ID']);
                            $Product->setProductName($order['product_name']);
                            $Product->setPrice($order['price']);
                            $Order->addProduct($Product);

                            //Display order function.
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
