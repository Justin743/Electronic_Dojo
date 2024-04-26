<?php
require 'C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/lib/functions.php';

//THIS IS VALIDATION TEST FOR CANCELING AN ORDER.
//cancelOrderTest function is used to cancel an order.
function cancelOrderTest(){

    //Order id to be canceled.
    $orderId = 4;

    try {
        //Call cancelOrder function from the functions.php.
        cancelOrder($orderId);

        //Get a connection and fetch results to see if the cancelOrderTest worked.
        $pdo = get_connection();
        $stmt = $pdo->prepare("SELECT * FROM `order` WHERE order_ID = :order_id");
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();
        $result = $stmt->fetch();

        //If the order does not exist throw this error.
        if(empty($result)){
            echo "Test failed, order does not exist";
            return false;
        }

        //Print out if the result is empty or not, if its empty then the test worked, if not empty the test did not work.
        if (!empty($result)) {
            echo "Test failed, order did not cancel";
            return false;
        } else {
            echo "Test worked, order was canceled";
            return true;
        }
        //catch any errors related to DB.
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        return false;
    };
}
cancelOrderTest();
?>
