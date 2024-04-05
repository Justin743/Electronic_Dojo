<?php

require  "sqlQueries.php";
require "Classes/userClass.php";
function registerUser($data){
    try {
        require_once "src/DBconnect.php";

        $user = new userClass(
            escape($data['firstname']),
            escape($data['lastname']),
            escape($data['email']),
            escape($data['password'])
        );

        $sql_User = insertIntoUserQ();

        $statement_User = $connection->prepare($sql_User);

        $statement_User->execute([
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);

        $userID = $connection->lastInsertId();

        $defaultLPoints = 0;

        $customer = new customer(
            $user->getFirstname(),
            $user->getLastname(),
            $user->getEmail(),
            $user->getPassword(),
            escape($_POST['address']),
            $defaultLPoints,
            $userID
        );


        $sql_customer = insertIntoCustomerQ();

        $statement_customer = $connection->prepare($sql_customer);

        $statement_customer->execute([
            'address' => $customer->getAddress(),
            'loyaltyPoints' => $defaultLPoints,
            'userID' => $customer->getUserID()
        ]);
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}

/**
 * @param $data
 * @return void
 */
function createAdmin()
{
    try {
        require_once "src/DBconnect.php";

        $admin_fname = "Ryan";
        $admin_lname = "Dunne";
        $admin_email = "adminElDojo@gmail.com";
        $admin_pass  = "admin_RD2234?";
        $admin_level = 2;

        $user = new userClass(
            escape($admin_fname),
            escape($admin_lname),
            escape($admin_email),
            escape($admin_pass)
        );

        $sql_Admin = insertIntoUserQ();

        $statement_user = $connection->prepare($sql_Admin);

        $statement_user->execute([
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);


        $userID = $connection->lastInsertID();

        $admin = new admin(
            $user ->getFirstname(),
            $user ->getLastname(),
            $user ->getEmail(),
            $user ->getPassword(),
            $admin_level,
            $userID
        );

        $sql_Admin = insertIntoAdminQ();

        $statement_admin = $connection->prepare($sql_Admin);

        $statement_admin->execute([
           'level' => $admin->getAdminLevel(),
           'userID' => $admin->getUserID()
        ]);


    }catch (PDOException $e){
        echo e->getMessage();
    }

}

