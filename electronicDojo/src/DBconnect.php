<!-- Used to connect to the DB -->

<?php
require 'C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/src/config.php';

//Make a new PDO object
try{
    $connection = new PDO($dsn, $username, $password, $options);
}catch (PDOException $e){
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>

<?php
function get_connection()
{
    require 'C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/src/config.php';

    try {
        $pdo = new PDO(
            $dsn, $username, $password, $options
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }catch(PDOException $e){
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
?>
