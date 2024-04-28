<?php
require "../src/common.php";
require "../Classes/userClass.php";

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
    ], $errorMessages, false);

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
