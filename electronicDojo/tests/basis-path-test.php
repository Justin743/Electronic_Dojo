<?php
require "C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/Classes/productsClass.php";

//Function to test bais path for shipping costs.
function testShippingCost($totalPrice, $expectedShippingCost) {
    $order = new Order();
    $order->setTotal($totalPrice);
    $actualShippingCost = $order->calculateShippingCost();
    echo "Total Price: $totalPrice, Expected Shipping Cost:€$expectedShippingCost, Actual Shipping Cost: €$actualShippingCost<br>";
}

echo "<h2>Shipping Cost Tests</h2>";
// Test cases
testShippingCost(400, 20);
testShippingCost(600, 15);
testShippingCost(800, 10);
testShippingCost(1200, 5);
testShippingCost(1600, 2.5);
testShippingCost(2100, 0);
?>