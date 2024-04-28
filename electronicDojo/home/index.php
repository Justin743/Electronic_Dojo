<?php
session_start();
//The webpage will display different headers depending on if an admin or customer logs in.
if (isset($_SESSION['Active']) && $_SESSION['Active'] == true ){
    require "../templates/header.php";
} else if (isset($_SESSION['AdminActive']) && $_SESSION['AdminActive'] == true){
    require '../templates/adminHeader.php';
}else
    require "../templates/noLoginHeader.php" ?>

    <body>

<?php
//If a customer logs in they will be redirected to the index page with a welcome message.
if (isset($_SESSION['Active']) && $_SESSION['Active'] == true){
    $name = $_SESSION['firstname'];
    echo "<h2 class='text-center'>Welcome $name, select products from the navigation bar to start shopping!</h2>";
} ?>

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="../image/shop01.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>New Laptop<br>Collection</h3>
                            <a href="../product/products.php" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="../image/phoneImage1.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>New Phone<br>Collection</h3>
                            <a href="../product/products.php" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="../image/TVImage.webp" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>New Camera<br>Collection</h3>
                            <a href="../product/products.php" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->


    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">

                        <h2 class="text-uppercase">crazy hot deals</h2>
                        <p>For all your electronic needs</p>
                        <a class="primary-btn cta-btn" href="../product/products.php">Shop now</a>
                        <?php
                        //Displays message to user to log in before shopping.
                        if (!isset($_SESSION['Active']) && !isset($_SESSION['AdminActive'])){
                            echo "<p2>Please log in before continuing</p2>";
                        }else
                        ?>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->
    </body>
<?php include "../templates/footer.php" ?>