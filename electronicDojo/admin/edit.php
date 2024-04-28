<?php
session_start();
require '../templates/adminHeader.php';
require '../lib/sqlQueries.php';
require '../lib/functions.php';
?>

<?php
//Logic for deleting the user.
if(isset($_GET['ID'])){
    require_once "../src/DBconnect.php";
    $pdo = get_connection();

    $id = $_GET["ID"];

    //Fetches the delete user query
    $sql = deleteUserQ();

    $statement = $pdo->prepare($sql);
    $statement->bindParam(':ID', $id);
    $statement->execute();

    $success = "User ". $id. " successfully deleted";
}
//Fetches users from the database.
if(isset($_POST['submit'])){
    try {
        require '../src/common.php';
        require_once '../src/DBconnect.php';
        $pdo = get_connection();

        $sql = readUserWithEmailQ();

        $email = $_POST['email'];

        $statement = $pdo->prepare($sql);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    }catch (PDOException $error){
        echo $sql . "<br>" . $error ->getMessage();
    }
}

// Displays results if a matching email is in the database
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0){
        ?>
            <link type="text/css" rel="stylesheet" href="../css/update.css">
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
    <?php //If no users match the email submitted it will display a message
    } else { ?>
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

<a href="../home/index.php">Back to Homepage</a>

