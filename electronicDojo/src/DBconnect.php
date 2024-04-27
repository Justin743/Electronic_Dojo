<!-- Used to connect to the DB -->

<?php
require_once 'config.php';

//Make a new PDO object
try{
    $connection = new PDO($dsn, $username, $password, $options);
}catch (PDOException $e){
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
