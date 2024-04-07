
<?php
require "common.php";
require "Classes/userClass.php";


if (isset($_POST['submit'])) {
    try {
        require_once "src/DBconnect.php";

        $user =[
            "ID" => escape($_POST['ID']),
            "firstname" => escape($_POST['firstname']),
            "lastname" => escape($_POST['lastname']),
            "email" => escape($_POST['email']),
            "password" => escape($_POST['password']),
        ];

        $sql_User = "UPDATE user
            SET ID = :ID,
            firstname = :firstname,
            lastname  = :lastname,
            email     = :email,
            password  = :password
            WHERE ID = :ID";


        $statement_User = $connection->prepare($sql_User);
        $statement_User->execute($user);

        $customer = [
            "ID" => escape($_POST['ID']),
            "address" => escape($_POST['address']),
            "loyaltyPoints" => escape($_POST['loyaltyPoints'])
        ];

        $sql_Customer = "UPDATE customer
                SET address = :address,
                    loyaltyPoints = :loyaltyPoints
                    WHERE user_ID = :ID";

        $statement_Customer = $connection->prepare($sql_Customer);
        $statement_Customer->execute($customer);

    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

if (isset($_GET['ID'])) {
    try{
        require_once "src/DBconnect.php";

        $id = $_GET['ID'];

        $sql = "SELECT user.* , address, loyaltyPoints FROM user 
                INNER JOIN customer ON user.ID = customer.user_ID
                WHERE ID = :ID";
        $statement = $connection->prepare($sql);
        $statement->bindValue(":ID", $id);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
    }catch (PDOException $error){
        echo $sql . "<br>" . $error->getMessage();
    }
}else{
    echo 'Error';
    exit;
}
?>

<?php require "templates/header.php"?>

<?php if (isset($_POST['submit']) && $statement) : ?>
    <?php echo escape($_POST['firstname']); ?> successfully updated.
<?php endif; ?>


<h2>Edit User</h2>

<form method="post">
    <?php foreach ($user as $userKey => $value) : ?>
        <label for="<?php echo $userKey; ?>"><?php echo ucfirst($userKey); ?></label>
        <input type="text" name="<?php echo $userKey; ?>" id="<?php echo $userKey; ?>"
               value="<?php echo escape($value); ?>"
            <?php echo ($userKey === 'ID' ? 'readonly' : null) ; ?>>
    <?php endforeach; ?>

    <input type="submit" name="submit" value="submit">
</form>

