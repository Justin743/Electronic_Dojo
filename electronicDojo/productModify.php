<?php require 'templates/header.php';
require 'lib/sqlQueries.php'?>

<?php
require_once "src/DBconnect.php";

function fetchAllProducts($connection) {
    $sql = "SELECT * FROM products";
    $statement = $connection->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
}

$products = fetchAllProducts($connection);
?>

    <form method="post">
        <input type="submit" name="submitCheck" value="Check products">
    </form>

<?php if (isset($_POST['submitCheck'])): ?>
    <h2>Products</h2>
    <table>
        <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Bio</th>
            <th>Price</th>
            <th>Loyalty Points</th>
            <th>Brand</th>
            <th>Category</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product["product_ID"])?></td>
                <td><?php echo htmlspecialchars($product["product_name"])?></td>
                <td><?php echo htmlspecialchars($product["bio"])?></td>
                <td><?php echo htmlspecialchars($product["price"])?></td>
                <td><?php echo htmlspecialchars($product["loyalty_points"])?></td>
                <td><?php echo htmlspecialchars($product["brand"])?></td>
                <td><?php echo htmlspecialchars($product["category"])?></td>
                <td><a href="update-single-product.php?ID=<?php echo htmlspecialchars($product['product_ID']);?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<?php require 'templates/footer.php'?>