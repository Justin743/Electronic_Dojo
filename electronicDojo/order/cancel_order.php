<?php
//Starts the session.
session_start();

require "../lib/functions.php";
require "../Classes/productsClass.php";

//Checks if cancel_order has been submitted.
if (isset($_POST['cancel_order'])) {
    //Checks if ($_SESSION['UserID']) is set.
    if(isset($_SESSION['UserID'])) {
        //Retrieves information from order_id field.
        $orderId = $_POST['order_id'];

        //Calls cancelOrder function for the
        cancelOrder($orderId);

        //Redirect to viewOrder.php
        header("Location: viewOrder.php");
        exit();
    }
}
?>
