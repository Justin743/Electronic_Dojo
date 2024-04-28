<?php
session_start();

require "../Classes/productsClass.php";
include '../templates/header.php';
include '../lib/functions.php';

$priceTotal = 0.00;
$loyaltyPtsTotal = 0.00;

if (isset($_POST['product_ID'])){
    require_once '../src/DBconnect.php';

    $pdo = get_connection();

    $prodID = $_POST['product_ID'];

    $statement = $pdo->prepare('SELECT * FROM products WHERE product_ID = :product_ID');
    $statement->bindParam(':product_ID', $prodID);
    $statement->execute();

    $product = $statement->fetch(PDO::FETCH_ASSOC);

    //Checks if product exists
    if ($product){
        //Checks if the session[active] key is set and if the session variable is set to an array
        if (isset($_SESSION['Active']) && is_array($_SESSION['Active'])){
            //Checks if the session is not set to an array and sets it to an array id not
            if (!isset($_SESSION['Active'])){
                $_SESSION['Active'] = array();
            }
        }else{
            $_SESSION['Active'] = array($prodID => 1);
        }
    }

    //Fetches product from the session array
    $products = isset($_SESSION['Active']) ? $_SESSION['Active'] : array();

    //If a product is added to the cart, display details
    if ($products){
        $prodID = implode(',', array_keys($products));
        $statement = $pdo->query('SELECT * FROM products WHERE product_ID IN ('. $prodID . ')');

        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        $productPrice = (float)$product['price'];
    }
}

$order = new Order();
$order->setTotal($productPrice);
$shippingCost = $order->calculateShippingCost();
$totalWithShipping = $productPrice + $shippingCost;

?>

    <link type="text/css" rel="stylesheet" href="../css/cart.css">

    <div class="cart-list">
        <div class="container">
            <h1 class="card-title text-left">Shopping Cart</h1>
            <div class="card-body py-md-4">
                <div class="form-group">
                    <form action="checkout.php" method="post">
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
                            <div class = checkout>
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
                            </div>
                            </tbody>
                        </table>

                        <div class="text-success">
                            <span class="text">Subtotal</span>
                            <span class="price">&dollar;<?=$totalWithShipping?></span>
                        </div>

                        <div class="text-success">
                            <span class="text">Total Loyalty Points</span>
                            <span class="loyaltyPoints"><?=$loyaltyPtsTotal?></span>
                        </div>

                        <form method="post" action="../electronicDojo/checkout.php">
                            <form method="post" action="checkout.php">
                                <div class="add-to-cart-btn">
                                    <input type="hidden" name="product_ID" value="<?php echo $product['product_ID']?>">
                                    <input type="submit" value="Checkout" id="placeorder" name="placeorder">
                                </div>
                            </form>
                        </form>
                </div>
            </div>
        </div>
    </div>
<?php require '../templates/footer.php'; ?>