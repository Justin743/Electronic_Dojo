<?php
session_start();

require "lib/functions.php";
require "Classes/productsClass.php";

if (isset($_POST['cancel_order'])) {
    if(isset($_SESSION['UserID'])) {
        $orderId = $_POST['order_id'];

        cancelOrder($orderId);

        header("Location: viewOrder.php");
        exit();
    }
}
?>
