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
    COALESCE(phones.image, laptop.image, television.image) AS image
FROM 
    products 
LEFT JOIN 
    phones ON products.product_ID = phones.product_ID_phone
LEFT JOIN 
    laptop ON products.product_ID = laptop.product_ID_laptop
LEFT JOIN 
    television ON products.product_ID = television.product_ID_television;";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $products;
}

function displayOrders() {
    $pdo = get_connection();

    $query = "SELECT o.order_ID, o.date_of_order, o.total,
                     p.product_ID, p.product_name, p.price,
                     pm.payment_ID
              FROM `order` AS o
              JOIN products AS p ON o.product_ID_order = p.product_ID
              JOIN paymentmethod AS pm ON o.payment_ID_order = pm.payment_ID";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $orders;
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



