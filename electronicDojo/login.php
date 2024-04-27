<?php
//Starts the session.
session_start();

require_once('lib/functions.php');
?>

<?php
//Checks if the submit button is present in the POST array.
if (isset($_POST['Submit'])) {
    try {

        //Retrieve values for email and password from the POST array.
        $email = $_POST['Email'];
        $password = $_POST['Password'];

        //Checks admin loggin details from checkAdminLogin function.
        $admin = checkAdminLogin($email, $password);
        //If information belongs to admin.
        if ($admin) {

            //Set AdminActive session to true, and assings admnin details.
            $_SESSION['AdminActive'] = true;
            $_SESSION['UserID'] = $admin['ID'];
            $_SESSION['Email'] = $admin['email'];

            //Redirect to index.php
            header("location: index.php");
            exit;

            //Else if the details do not belong to admin, it will check if details belong to normal user.
        } else {

            //Checks user loggin details from checkLogin function.
            $user = checkLogin($email, $password);
            //If information belongs to normal user.
            if ($user) {

                //Calls getUserID function.
                $userData = getUserID($user['ID']);

                //Sets session Active to true, and assings user details.
                $_SESSION['Active'] = true;
                $_SESSION['UserID'] = $user['ID'];
                $_SESSION['Email'] = $user['email'];
                $_SESSION['firstname'] = $userData['firstname'];

                header("location: index.php");

                exit;

                //Else if details are wrong throws an exception.
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
        <h2 class="form-signin-heading">Please sign in or <a href="register.php">Register</a></h2>
        <label for="input">Email</label>
        <input name="Email" type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword">Password</label>
        <input name="Password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <!-- Submit button -->
        <button name="Submit" value="Login" class="button" type="submit">Sign in</button>
    </form>
</body>

