<?php
session_start();

include '../templates/header.php';
include "../lib/functions.php";
include "../Classes/productsClass.php";



if (isset($_POST['placeorder']) && !empty($_SESSION['Active'])) {


    $name = $_SESSION['firstname'];

    echo "<div class='container'>";
    echo "<div class='row justify-content-center'>";
    echo "<div class='col-md-5'>";
    echo "<div class='card'>";
    echo "<h2 class='card-title text-center'>Thank you $name, your order has been placed! <br> <br> <br>Please check your orders in profile for your order summary.</h2>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

} else {
    echo "<h2>No product</h2>";

}

include '../templates/footer.php';
?>

