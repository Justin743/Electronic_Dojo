<?php
session_start();
require '../templates/adminHeader.php';
require '../lib/sqlQueries.php';
require '../src/common.php';
?>

<?php
require_once "../src/DBconnect.php";

if (isset($_GET['product_ID'])){

    $prodID = $_GET["product_ID"];

    $connection->beginTransaction();

    try {
        $sqlGetCategory = getCategoryQ();
        $statementGetCategory = $connection->prepare($sqlGetCategory);
        $statementGetCategory->bindParam(":product_ID", $prodID);
        $statementGetCategory->execute();
        $category = $statementGetCategory->fetchColumn();

        $categoryLower = strtolower($category);

        $sqlDeleteCategory = deleteFromCategoryQ($categoryLower);
        $statementCategory = $connection->prepare($sqlDeleteCategory);
        $statementCategory->bindParam(":product_ID", $prodID);
        $statementCategory->execute();

        $sqlDeleteProducts = deleteProductQ();
        $statementProducts = $connection->prepare($sqlDeleteProducts);
        $statementProducts->bindParam(":product_ID", $prodID);
        $statementProducts->execute();

        $connection->commit();
    } catch (Exception $e) {

        $connection->rollback();
    }
}
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
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo escape($product["product_ID"])?></td>
                <td><?php echo escape($product["product_name"])?></td>
                <td><?php echo escape($product["bio"])?></td>
                <td><?php echo escape($product["price"])?></td>
                <td><?php echo escape($product["loyalty_points"])?></td>
                <td><?php echo escape($product["brand"])?></td>
                <td><?php echo escape($product["category"])?></td>
                <td><a href="../update-single-product.php?product_ID=<?php echo escape($product['product_ID']);?>">Edit</a></td>
                <td><a href="productModify.php?product_ID=<?php echo escape($product['product_ID']);?>">Delete</a></td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<?php require '../templates/footer.php' ?>