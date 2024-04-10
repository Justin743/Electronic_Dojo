<?php
$errorMessages = [];

    if (isset($_POST['submit'])){

        require_once "Classes/userClass.php";

        require "common.php";
        registerUser($_POST, $errorMessages);


    }
?>

<?php require "templates/noLoginHeader.php"; ?>

<!--<div class="register">-->
<!--    <form method="post">-->
<!--        <label for="firstname">First Name</label>-->
<!--        <input type="text" id="firstname" name="firstname" required>-->
<!--        <label for="lastname">Last Name</label>-->
<!--        <input type="text" id="lastname" name="lastname" required>-->
<!--        <label for="email">Email Address</label>-->
<!--        <input type="email" id="email" name="email" required>-->
<!--        <label for="password">Create Password</label>-->
<!--        <input type="password" id="password" name="password" required>-->
<!--        <label for="address">Home Address</label>-->
<!--        <input type="text" id="address" name="address" required>-->
<!--        <input type="submit" name="submit" class="submit" value="Register">-->
<!--    </form>-->
<!--</div>-->

    <div class="register">
    <form method="post">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                        <h2 class="card-title text-center">Register</h2>
                        <div class="card-body py-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="firstname" placeholder="First name" name="firstname" required>
                                    <?php if (!empty($errorMessages['fNameError'])) {
                                        echo '<span class="error">' . $errorMessages['fNameError'] . '</span><br><br>';}?>
                                </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname" required>
                                    <?php if (!empty($errorMessages['lNameError'])) {
                                        echo '<span class="error">' . $errorMessages['lNameError'] . '</span><br><br>';}?>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                                    <?php if (!empty($errorMessages['emailError'])) {
                                        echo '<span class="error">' . $errorMessages['emailError'] . '</span><br><br>';}?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                                    <?php if (!empty($errorMessages['passError'])) {
                                         echo '<span class="error">' . $errorMessages['passError'] . '</span><br><br>';} ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="address" placeholder="Address" name="address" required>
                                    <?php if (!empty($errorMessages['addressError'])) {
                                        echo '<span class="error">' . $errorMessages['addressError'] . '</span><br><br>';}?>
                                </div>
                                <div class="d-flex flex-row align-items-center justify-content-between">
                                    <h4>Already have an account? <a href="login.php">Login</a></h4>

                                    <input type="submit" name="submit" class="submit" value="Register">
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>

<?php include "templates/footer.php";

