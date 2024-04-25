<?php
require "C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/common.php";
require "C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/lib/sqlQueries.php";

$host   ="localhost";
$username   ="root";
$password   ="Juoz9988/";
$dbname     ="electronic_dojo";
$dsn        ="mysql:host=$host;dbname=$dbname";
$options    =array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

$connection = new PDO($dsn, $username, $password, $options);

function registerUser($data, &$errorMessages){
    //Access connection
    global $connection;

    $fNameError = "";
    $lNameError = "";
    $emailError = "";
    $passError = "";
    $addressError = "";

    $userPattern = "/^[a-zA-Z']*$/";
    $addressPattern = "/^[a-zA-Z0-9'\s]*$/";
    $passPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

    try {
        if (!preg_match($userPattern, $data['firstname'])){
            $fNameError = "Invalid first name: Special characters or numbers are not allowed";
        }

        if (!preg_match($userPattern, $data['lastname'])){
            $lNameError = "Invalid last name: Special characters or numbers are not allowed";
        }

        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $emailError = "Invalid email: Please use the correct email address format";
        }

        if (!preg_match($passPattern, $data['password'])){
            $passError = "Invalid password: Must contain one lowercase character, one uppercase character, one number and a special character";
        }

        if (!preg_match($addressPattern, $data['address'])){
            $addressError = "Invalid Address: Special characters are not allowed";
        }

        if (!empty($fNameError)) {
            $errorMessages['fNameError'] = $fNameError;
        }

        if (!empty($lNameError)) {
            $errorMessages['lNameError'] = $lNameError;
        }

        if (!empty($emailError)){
            $errorMessages['emailError'] = $emailError;
        }

        if (!empty($passError)) {
            $errorMessages['passError'] = $passError;
        }

        if (!empty($addressError)){
            $errorMessages['addressError'] = $addressError;
        }

        if (empty($errorMessages)){
            // If form fields pass validation checks, proceed with registration
            $sql_User = insertIntoUserQ();

            $statement_User = $connection->prepare($sql_User);

            $statement_User->execute([
                'firstname' => escape($data['firstname']),
                'lastname' => escape($data['lastname']),
                'email' => escape($data['email']),
                'password' => escape($data['password'])
            ]);

            $userID = $connection->lastInsertId();

            $defaultLPoints = 0;

            $sql_customer = insertIntoCustomerQ();

            $statement_customer = $connection->prepare($sql_customer);

            $statement_customer->execute([
                'address' => escape($data['address']),
                'loyaltyPoints' => $defaultLPoints,
                'userID' => $userID
            ]);
        }

    } catch (PDOException $e){
        echo $e->getMessage();
    }
}


// Test data
$testData = [
    //valid test data
    ["Justin", "Juozaitis", "B00155152@mytudublin.ie", "Hello123??", "123 Tallaght Springfield"],
    //Invalid test data
    ["??//123", "??//123", "notMyEmail.gmail", "123", "??//123"]
];

foreach ($testData as $data) {
    $errorMessages = [];

    //Calls registerUser
    registerUser([
        'firstname' => $data[0],
        'lastname' => $data[1],
        'email' => $data[2],
        'password' => $data[3],
        'address' => $data[4]
    ], $errorMessages);

    if (!empty($errorMessages)) {
        //Implode - returns a string from elements from array.
        echo "Error occurred for test data: " . implode(", ", $data) . "<br>";
        foreach ($errorMessages as $error) {
            echo "$error<br>";
        }
    } else {
        echo "Registration successful for test data: " . implode(", ", $data) . "<br>";
    }
    echo "<br>";
}
?>
