<?php

//SQL queries modularised as functions that return the query string.
function insertIntoUserQ()
{
    return "INSERT INTO user(firstname, lastname, email, password) 
            VALUES (:firstname, :lastname, :email, :password)";
}

function insertIntoCustomerQ()
{
    return "INSERT INTO customer (address, loyaltyPoints, user_ID) 
             VALUES (:address, :loyaltyPoints, :userID)";
}

function insertIntoAdminQ()
{
    return "INSERT INTO admin (admin_level, user_ID) 
             VALUES (:admin_level, :user_ID)";
}
function deleteUserQ()
{
    return "DELETE user, customer 
            FROM user
            INNER JOIN customer ON user.ID = customer.user_ID
            WHERE user.ID = :ID";
}

function checkAdminQ(){
    return "SELECT COUNT(*) FROM admin";
}

function deleteProductQ(){
    return "DELETE FROM products WHERE product_ID = :product_ID";
}

function deleteFromCategoryQ($categoryLower)
{
    return "DELETE FROM $categoryLower WHERE product_ID_$categoryLower = :product_ID";
}

function getCategoryQ()
{
    return "SELECT category FROM products WHERE product_ID = :product_ID";
}
function insertIntoProfileQ()
{
    return "INSERT INTO profile (customer_ID_profile ) VALUES (:customer_ID_profile)";
}

function checkEmailQ()
{
    return "SELECT COUNT(*) FROM user WHERE email = :email";
}

function updateUserQ()
{
    return "UPDATE user
            SET ID = :ID,
            firstname = :firstname,
            lastname  = :lastname,
            email     = :email,
            password  = :password
            WHERE ID = :ID";
}

function updateCustomerQ()
{
    return"UPDATE customer SET address = :address,
            loyaltyPoints = :loyaltyPoints
            WHERE user_ID = :ID";
}

function readUserWithEmailQ()
{
    return "SELECT user.* , address, loyaltyPoints
            FROM user
            INNER JOIN customer ON user.ID = customer.user_ID
            WHERE user.email = :email";
}

function readUserWithIDQ()
{
    return "SELECT user.* , address, loyaltyPoints FROM user 
                INNER JOIN customer ON user.ID = customer.user_ID
                WHERE ID = :ID";
}
