
<?php
session_start();
require "../src/common.php";
require "../Classes/userClass.php";
require "../lib/sqlQueries.php";

//Function for updating user and customer table data in database
if (isset($_POST['submit'])) {
    try {
        require_once "../src/DBconnect.php";

        $pdo = get_connection();

        $user =[
            "ID" => escape($_POST['ID']),
            "firstname" => escape($_POST['firstname']),
            "lastname" => escape($_POST['lastname']),
            "email" => escape($_POST['email']),
            "password" => escape($_POST['password']),
        ];

        $sql_User = updateUserQ();


        $statement_User = $pdo->prepare($sql_User);
        $statement_User->execute($user);

        $customer = [
            "ID" => escape($_POST['ID']),
            "address" => escape($_POST['address']),
            "loyaltyPoints" => escape($_POST['loyaltyPoints'])
        ];

        $sql_Customer = updateCustomerQ();

        $statement_Customer = $pdo->prepare($sql_Customer);
        $statement_Customer->execute($customer);

    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

//Fetches data from database using user ID
if (isset($_GET['ID'])) {
    try{
        require_once "../src/DBconnect.php";
        $pdo = get_connection();

        $id = $_GET['ID'];

        $sql = readUserWithIDQ();
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":ID", $id);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
    }catch (PDOException $error){
        echo $error->getMessage();
    }
}else{
    echo 'Error';
    exit;
}
?>

<?php require "../templates/adminHeader.php" ?>

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

