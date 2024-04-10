<?php
session_start();

$subtotal = 0.00;


if (isset($_POST['product_ID']) && is_numeric($_POST['product_ID'])){
    require_once 'src/DBconnect.php';

    $prodID = (int)$_POST['product_ID'];

    $statement = $connection->prepare('SELECT * FROM products WHERE product_id = ?');
    $statement->execute([$_POST['product_ID']]);

    $product = $statement->fetch(PDO::FETCH_ASSOC);

    if ($product > 0){
        if (isset($_SESSION['Active']) && is_array($_SESSION['Active'])){
            if (array_key_exists($prodID, $_SESSION['Active'])){
                $message = "This product is already in your cart!";
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
        $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
        $statement = $connection>preg_replace('SELECT * FROM products where product_ID IN ('. $array_to_question_marks . ')');

        $statement->execute(array_keys($products_in_cart));

        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product){
            $subtotal += (float)$product['price'] * (int)$products_in_cart[$prodID];
        }
    }
}
?>

<?php include 'templates/header.php'; ?>

<div class="cart content-wrapper">
    <h1>Shopping Cart</h1>
    <form action="index.php?page=cart" method="post">
        <table>
            <thead>
            <tr>
                <td colspan="2">Product</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Total</td>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td class="img">
                            <a href="index.php?page=product&id=<?=$product['id']?>">
                                <img src="imgs/<?=$product['img']?>" width="50" height="50" alt="<?=$product['name']?>">
                            </a>
                        </td>
                        <td>
                            <a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['name']?></a>
                            <br>
                            <a href="index.php?page=cart&remove=<?=$product['id']?>" class="remove">Remove</a>
                        </td>
                        <td class="price">&dollar;<?=$product['price']?></td>
                        <td class="quantity">
                            <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                        </td>
                        <td class="price">&dollar;<?=$product['price'] * $products_in_cart[$product['id']]?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price">&dollar;<?=$subtotal?></span>
        </div>
        <div class="buttons">
            <input type="submit" value="Update" name="update">
            <input type="submit" value="Place Order" name="placeorder">
        </div>
    </form>
</div>



