<?php
session_start();

require "../src/common.php";
require_once 'C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/Classes/productsClass.php';

if (isset($_POST['submit'])) {
    try {
        require_once "../src/DBconnect.php";

        $product = [
            "product_ID" => escape($_POST['product_ID']),
            "product_name" => escape($_POST['product_name']),
            "bio" => escape($_POST['bio']),
            "price" => escape($_POST['price']),
            "loyalty_points" => escape($_POST['loyalty_points']),
            "brand" => escape($_POST['brand']),
            "category" => escape($_POST['category'])
        ];

        $sql_Product = "UPDATE products
            SET product_name = :product_name,
            bio = :bio,
            price = :price,
            loyalty_points = :loyalty_points,
            brand = :brand,
            category = :category
            WHERE product_ID = :product_ID";

        $statement_Product = $pdo = get_connection()->prepare($sql_Product);
        $statement_Product->execute($product);

    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

if (isset($_GET['product_ID'])) {
    try{
        require_once "../src/DBconnect.php";

        $prodID = $_GET['product_ID'];

        $sql = "SELECT * FROM products WHERE product_ID = :product_ID";
        $statement = $connection->prepare($sql);
        $statement->bindValue(":product_ID", $prodID);
        $statement->execute();

        $product = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
} else {
    echo 'Error';
    exit;
}
?>

<?php require "../templates/adminHeader.php" ?>

<?php if (isset($_POST['submit']) && $statement_Product) : ?>
    <?php echo escape($_POST['product_name']); ?> successfully updated.
<?php endif; ?>

<h2>Edit Product</h2>

<form method="post">
    <?php foreach ($product as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>"
               value="<?php echo escape($value); ?>">
    <?php endforeach; ?>

    <input type="submit" name="submit" value="Submit">
</form>

<?php require "../templates/footer.php" ?>
