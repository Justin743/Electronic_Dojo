<?php
session_start();
if ($_SESSION['Active'] == true){
    require "templates/header.php";
} else
    require "templates/noLoginHeader.php"?>

    <body>

<?php if (isset($_SESSION['Active']) == true){
    $name = $_SESSION['firstname'];
    echo "<h2>Welcome $name</h2>";
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
                            <img src="image/shop01.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>New Laptop<br>Collection</h3>
                            <a href="products.php" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="image/phoneImage1.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>New Phone<br>Collection</h3>
                            <a href="products.php" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="image/TVImage.webp" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>New Camera<br>Collection</h3>
                            <a href="products.php" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
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
                        <a class="primary-btn cta-btn" href="products.php">Shop now</a>
                        <?php
                        if (isset($_SESSION['Active']) == false){
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
<?php include "templates/footer.php"?>