<?php
session_start();
require_once('lib/functions.php');

if (!isset($_SESSION['Active']) || $_SESSION['Active'] !== true) {
    header("Location: login.php");
    exit;
}

$userDetails = getUserDetails($_SESSION['UserID']);

include "templates/header.php";
?>

<body>
<h1>User Profile</h1>
<p>First Name: <?php echo ($userDetails['firstname']); ?></p>
<p>Last Name: <?php echo ($userDetails['lastname']); ?></p>
<p>Email: <?php echo ($userDetails['email']); ?></p>
<p>Address: <?php echo ($userDetails['address']); ?></p>

<a href="/electronicDojo/viewOrder.php">My Orders</a>
</body>

    <form action="logout.php" method="post" name="Logout_Form" class="form-signin">
        <button name="Submit" value="Logout" class="button" type="submit">Log out</button>
    </form>
</html>

<?php
include "templates/footer.php"
?>