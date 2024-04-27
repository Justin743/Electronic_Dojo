<?php

function get_connection()
{
    require 'config.php';

    $pdo = new PDO(
        $dsn, $username, $password, $options
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

function get_products(){

    $pdo = get_connection();
    $query = "SELECT 
    products.product_ID,
    products.product_name,
    products.bio,
    products.price,
    products.loyalty_points,
    products.brand,
    products.category,
    COALESCE(phone.image, laptop.image, television.image) AS image
FROM 
    products 
LEFT JOIN 
    phone ON products.product_ID = phone.product_ID_phone
LEFT JOIN 
    laptop ON products.product_ID = laptop.product_ID_laptop
LEFT JOIN 
    television ON products.product_ID = television.product_ID_television;";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $products;
}


function displayOrders($userId)
{
    $pdo = get_connection();
    $stmt = $pdo->prepare("SELECT o.*, p.*, c.customer_ID FROM `order` o 
                       INNER JOIN products p ON o.product_ID_order = p.product_ID 
                       INNER JOIN customer c ON o.customer_ID_order = c.customer_ID
                       WHERE c.user_ID = :userId");

    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $orders;
}

function cancelOrder($orderId) {
    $pdo = get_connection();
    $stmt = $pdo->prepare("DELETE FROM `order` WHERE order_ID = :order_id");

    $stmt->bindParam(':order_id', $orderId);
    $stmt->execute();
}

function checkLogin($email, $password)
{
    $pdo = get_connection();
    $query = "SELECT * FROM user WHERE email = :email AND password = :password";

    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':email' => $email, ':password' => $password));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function checkAdminLogin($email, $password)
{
    $pdo = get_connection();
    $query = "SELECT u.* FROM user u 
              INNER JOIN admin a ON u.ID = a.user_ID 
              WHERE u.email = :email AND u.password = :password";

    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':email' => $email, ':password' => $password));
    $adminUser = $stmt->fetch(PDO::FETCH_ASSOC);
    return $adminUser;
}

function getUserDetails($userId){

    $pdo = get_connection();
        $sql = "SELECT u.firstname, u.lastname, u.email, c.address FROM user u LEFT JOIN customer c ON u.ID = c.user_id WHERE u.ID = :userId";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

}

//Gets row of data from user table according to the userID
function getUserID($userID) {
   $pdo = get_connection();


    $statement = $pdo->prepare("SELECT * FROM user WHERE ID = :userID");
    $statement->bindParam(':userID', $userID, PDO::PARAM_INT);
    $statement->execute();


    $userID = $statement->fetch(PDO::FETCH_ASSOC);


    return $userID;
}











