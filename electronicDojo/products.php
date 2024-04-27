<?php
//Starts the session.
session_start();

//Checks if admin is logged in, if not relocate to login.php.
if (!(isset($_SESSION['AdminActive']) && $_SESSION['AdminActive'] === true) &&
    !(isset($_SESSION['Active']) && $_SESSION['Active'] === true)) {
    header("location:login.php");
    exit;
}

//If the admin session is active then it will use admin header, else if a normal user is logged in then it will use normal header.
if (isset($_SESSION['AdminActive']) && $_SESSION['AdminActive'] === true) {
    include('templates/adminHeader.php');
} else if (isset($_SESSION['Active']) && $_SESSION['Active'] === true) {
    include('templates/header.php');
}

require "lib/functions.php";
require "Classes/productSClass.php";

//Variable porducts calls get_products function, to retrieve products from DB.
$products = get_products();
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">New Products</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <!-- Anchor links to navigate the products page -->
                            <li class="active">
                                <a data-toggle="tab" href="#tab1">Phones</a></li>
                            <li><a data-toggle="tab" href="#tab2">Laptops</a></li>
                            <li><a data-toggle="tab" href="#tab3">TVs</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick slick-initialized slick-slider" data-nav="#slick-nav-1">
                                <div class="product slick-slide">
                                    <!-- Loops and prints products as product-->
                                    <?php foreach ($products as $product) {
                                        ?>
                                        <?php
                                        //Prints the product based of Phone category.
                                        if ($product['category'] === 'Phone') {
                                            //Make a new Phone object and print all the phones from DB.
                                            $phone = new Phone();
                                            $phone->setImage($product['image']);
                                            $phone->setBio($product['bio']);
                                            $phone->setPrice($product['price']);
                                            $phone->setCategory($product['category']);
                                            $phone->setBrand($product['brand']);
                                            $phone->setProductName($product['product_name']);
                                            $phone->setLoyaltyPoints($product['loyalty_points']);

                                            //Display method for phones.
                                            $phone->displayPhone($product['product_ID']);

                                            //Else if category is Laptop.
                                        } elseif ($product['category'] === 'Laptop') {
                                            //Make a new laptop object and print all the Laptops in the DB.
                                            $laptop = new Laptop();
                                            $laptop->setImage($product['image']);
                                            $laptop->setBio($product['bio']);
                                            $laptop->setPrice($product['price']);
                                            $laptop->setCategory($product['category']);
                                            $laptop->setBrand($product['brand']);
                                            $laptop->setProductName($product['product_name']);
                                            $laptop->setLoyaltyPoints($product['loyalty_points']);

                                            //Display method for laptops.
                                            $laptop->displayLaptop($product['product_ID']);

                                            //Else if category is Television.
                                        } elseif ($product['category'] === 'Television') {
                                            //Make a new television object and print all the televisions from the DB.
                                            $television = new television();
                                            $television->setImage($product['image']);
                                            $television->setBio($product['bio']);
                                            $television->setPrice($product['price']);
                                            $television->setCategory($product['category']);
                                            $television->setBrand($product['brand']);
                                            $television->setProductName($product['product_name']);
                                            $television->setLoyaltyPoints($product['loyalty_points']);

                                            //Display method for televisions.
                                            $television->displayTelevision($product['product_ID']);
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "templates/footer.php"; ?>
