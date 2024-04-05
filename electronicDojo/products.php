<?php
require "lib/functions.php";
require "Classes/productSClass.php";
$products = get_products();
?>

<?php require "templates/Header.php"; ?>

<!-- SECTION -->
<!-- container -->

<div class="section">
<div class="container">
    <!-- row -->
    <div class="row">
        <!-- section title -->
        <div class="col-md-12">
            <div class="section-title">
                <h3 class="title">New Products</h3>
                <div class="section-nav">
                    <ul class="section-tab-nav tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Phones</a></li>
                        <li><a data-toggle="tab" href="#tab2">xxxx</a></li>
                        <li><a data-toggle="tab" href="#tab3">xxxx</a></li>
                        <li><a data-toggle="tab" href="#tab4">xxxx</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Products tab & slick -->
        <div class="col-md-12">
            <div class="row">
                <div class="products-tabs">
                    <!-- tab -->
                    <div id="tab1" class="tab-pane active">
                        <div class="products-slick slick-initialized slick-slider" data-nav="#slick-nav-1">
                            <div class="product slick-slide">
                            <?php foreach ($products as $product) {
                                if ($product['category'] === 'Phone') {
                                    $phone = new Phone();
                                    $phone->setImage($product['image']);
                                    $phone->setBio($product['bio']);
                                    $phone->setPrice($product['price']);
                                    $phone->setCategory($product['category']);
                                    $phone->setBrand($product['brand']);
                                    $phone->setProductName($product['product_name']);
                                    $phone->setLoyaltyPoints($product['loyalty_points']);
                                    $phone->displayPhone();
                                } elseif ($product['category'] === 'Laptop') {
                                    $laptop = new Laptop();
                                    $laptop->setImage($product['image']);
                                    $laptop->setBio($product['bio']);
                                    $laptop->setPrice($product['price']);
                                    $laptop->setCategory($product['category']);
                                    $laptop->setBrand($product['brand']);
                                    $laptop->setProductName($product['product_name']);
                                    $laptop->setLoyaltyPoints($product['loyalty_points']);
                                    $laptop->displayLaptop();
                                }elseif ($product['category'] === 'Television') {
                                    $television = new television();
                                    $television->setImage($product['image']);
                                    $television->setBio($product['bio']);
                                    $television->setPrice($product['price']);
                                    $television->setCategory($product['category']);
                                    $television->setBrand($product['brand']);
                                    $television->setProductName($product['product_name']);
                                    $television->setLoyaltyPoints($product['loyalty_points']);
                                    $television->displayTelevision();
                                }
                            } ?>
                            </div>
                        </div>

                    </div>
                    <!-- /tab -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php require "templates/footer.php"; ?>
