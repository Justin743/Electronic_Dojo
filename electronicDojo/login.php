<?php
session_start();

require_once ('lib/functions.php');

?>

<?php
if(isset($_POST['Submit'])) {

    $email = $_POST['Email'];
    $password = $_POST['Password'];

    if (checkLogin($email, $password)) {
        $_SESSION['Active'] = true;
        header("location:products.php");
        exit;
    } else {
        echo 'Incorrect Username or Password';
    }
}

require "templates/nologinHeader.php";
?>

<body>
    <div class="container">
        <form action="" method="post" name="Login_Form" class="form-signin">
            <h2 class="form-signin-heading">Please sign in or <a href="register.php">Register</a> </h2>
            <label for="input" >Username</label>
            <input name="Email" type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
            <label for="inputPassword">Password</label>
            <input name="Password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button name="Submit" value="Login" class="button" type="submit">Sign in</button>

        </form>

</body>
</html>
