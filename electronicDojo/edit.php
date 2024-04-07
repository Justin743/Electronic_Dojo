<?php require 'templates/header.php';
        require 'lib/sqlQueries.php'?>


<?php
if(isset($_GET['ID'])){
    require_once "src/DBconnect.php";

    $id = $_GET["ID"];

    $sql = deleteUserQ();

    $statement = $connection->prepare($sql);
    $statement->bindParam(':ID', $id);
    $statement->execute();

    $success = "User ". $id. " successfully deleted";
}
if(isset($_POST['submit'])){
    try {
        require 'common.php';
        require_once 'src/DBconnect.php';

        $sql = "SELECT user.* , address, loyaltyPoints
            FROM user
            INNER JOIN customer ON user.ID = customer.user_ID
            WHERE user.email = :email";

        $email = $_POST['email'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    }catch (PDOException $error){
        echo $sql . "<br>" . $error ->getMessage();
    }
}


if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0){
        ?>
            <link type="text/css" rel="stylesheet" href="css/update.css">
        <h2>Results</h2>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Password</th>
                <th>Home Address</th>
                <th>Total loyalty points</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $row){ ?>
                <tr>
                    <td><?php echo escape($row["ID"])?></td>
                    <td><?php echo escape($row["firstname"])?></td>
                    <td><?php echo escape($row["lastname"])?></td>
                    <td><?php echo escape($row["email"])?></td>
                    <td><?php echo escape($row["password"])?></td>
                    <td><?php echo escape($row["address"])?></td>
                    <td><?php echo escape($row["loyaltyPoints"])?></td>
                    <td><a href="update-single.php?ID=<?php echo escape($row['ID']);?>">Edit</a></td>
                    <td><a href="edit.php?ID=<?php echo escape($row['ID']);?>">Delete</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        > No Results found for <?php echo escape($_POST['email']); ?>
    <?php }
}
?>

<h2>Find user based on email</h2>

<form method="post">
    <label for="email">Enter User email</label>
    <input type="text" id="email" name="email">
    <input type="submit" name="submit" value="View Results">

</form>

<a href="index.php">Back to Homepage</a>

