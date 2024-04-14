<?php


session_start();

include 'templates/header.php';

$priceTotal = 0.00;
$loyaltyPtsTotal = 0.00;


if (isset($_POST['product_ID']) && is_numeric($_POST['product_ID'])){
    require_once 'src/DBconnect.php';

    $prodID = $_POST['product_ID'];

    $statement = $connection->prepare('SELECT * FROM products WHERE product_id = ' .$prodID);
    $statement->execute();

    $product = $statement->fetch(PDO::FETCH_ASSOC);


    if ($product){
        if (isset($_SESSION['Active']) && is_array($_SESSION['Active'])){
            if (!isset($_SESSION['Active'])){
                $_SESSION['Active'] = [];
            }else{
                $_SESSION['Active'][$prodID] = 1;
                $message = "This product has been added to your cart";
            }
        }else{
            $_SESSION['Active'] = array($prodID => 1);
            $message = "This product has been added to your cart";
        }
    }


    $products_in_cart = isset($_SESSION['Active']) ? $_SESSION['Active'] : array();
    $products = array();

    if ($products_in_cart){
        $prodID = implode(',', array_keys($products_in_cart));
        $statement = $connection->query('SELECT * FROM products WHERE product_ID IN ('. $prodID . ')');

        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product){
            $priceTotal += (float)$product['price'] * (int)$products_in_cart[$product['product_ID']];
            $loyaltyPtsTotal += (float)$product['loyalty_points'] * (int)$products_in_cart[$product['product_ID']];
        }
    }
}

?>

<link type="text/css" rel="stylesheet" href="css/cart.css">

<div class="cart content-wrapper">
    <h1>Shopping Cart</h1>
    <form action="index.php?page=cart" method="post">
        <table>
            <thead>
            <tr>
                <td>Product</td>
                <td>Price</td>
                <td>Loyalty Points</td>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($products)): ?>
                <tr>
                    <td>You have no products added in your Shopping Cart</td>
                </tr>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <tr>

                        <td
                            <?=$product['product_ID']?>"><?=$product['product_name']?></a>
                        </td>
                        <td
                            class="price">&dollar;<?=$product['price']?>
                        </td>
                        <td
                            class="loyaltyPoints"><?=$product['loyalty_points']?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price">&dollar;<?=$priceTotal?></span>
        </div>

        <div class="subtotal">
            <span class="text">Total Loyalty Points</span>
            <span class="loyaltyPoints"><?=$loyaltyPtsTotal?></span>
        </div>
        <div class="buttons">
            <input type="submit" value="Place Order" name="placeorder">
        </div>
    </form>
</div>



