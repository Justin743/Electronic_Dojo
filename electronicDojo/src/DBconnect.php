<?php

require_once 'C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/config.php';

try{
    $connection = new PDO($dsn, $username, $password, $options);
}catch (PDOException $e){
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
