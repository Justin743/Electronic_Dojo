<?php

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

