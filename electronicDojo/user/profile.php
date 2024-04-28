<?php
//Starts the session.
session_start();

require_once('../lib/functions.php');

//Calls the function getUserDetails using the UserID session key, and assigns result to userDetails variable.
$userDetails = getUserDetails($_SESSION['UserID']);

include "../templates/header.php";
?>

<body>
    <!-- Prints out user information using userDetails variable, information stored in DB -->
    <h1>User Profile</h1>
    <p>First Name: <?php echo ($userDetails['firstname']); ?></p>
    <p>Last Name: <?php echo ($userDetails['lastname']); ?></p>
    <p>Email: <?php echo ($userDetails['email']); ?></p>
    <p>Address: <?php echo ($userDetails['address']); ?></p>
    <a href="../order/viewOrder.php">My Orders</a>

    <!-- Log out button -->
    <form action="../user/logout.php" method="post" name="Logout_Form">
        <button name="Submit" value="Logout" type="submit">Log out</button>
    </form>
</body>

<?php include "../templates/footer.php" ?>