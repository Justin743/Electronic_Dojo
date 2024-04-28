<?php
require "../src/config.php";
try {
    $connection = new PDO("mysql:host=$host", $username, $password, $options);
    $sql = file_get_contents("../data/init.sql");
    $connection->exec($sql);

    echo "Database created!";
}catch (PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}
