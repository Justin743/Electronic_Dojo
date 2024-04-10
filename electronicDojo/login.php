<?php
session_start();
require_once ('lib/functions.php');
?>

<?php
if (isset($_POST['Submit'])) {
    try {

        $email = $_POST['Email'];
        $password = $_POST['Password'];

        $admin = checkAdminLogin($email, $password);
        if ($admin) {


            $_SESSION['AdminActive'] = true;
            $_SESSION['UserID'] = $admin['ID'];
            $_SESSION['Email'] = $admin['email'];
            header("location: products.php");
            exit;
        } else {

            $user = checkLogin($email, $password);
            if ($user) {
                // User login successful
                $_SESSION['Active'] = true;
                $_SESSION['UserID'] = $user['ID'];
                $_SESSION['Email'] = $user['email'];
                header("location: products.php");
                exit;
            } else {

                throw new Exception('Incorrect Username or Password');
            }
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }
}

require "templates/nologinHeader.php";
?>

<body>
    <div class="container">
        <form action="" method="post" name="Login_Form" class="form-signin">
            <h2 class="form-signin-heading">Please sign in or <a href="register.php">Register</a> </h2>
            <label for="input" >Email</label>
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
