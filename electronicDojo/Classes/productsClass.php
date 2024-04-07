<?php

class Product {
    private $product_ID;
    private $product_name;
    private $bio;
    private $price;
    private $loyalty_points;
    private $brand;
    private $category;

    public function getProductID() {
        return $this->product_ID;
    }

    public function setProductID($product_ID) {
        $this->product_ID = $product_ID;
    }

    public function getProductName() {
        return $this->product_name;
    }

    public function setProductName($product_name) {
        $this->product_name = $product_name;
    }

    public function getBio() {
        return $this->bio;
    }

    public function setBio($bio) {
        $this->bio = $bio;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getLoyaltyPoints() {
        return $this->loyalty_points;
    }

    public function setLoyaltyPoints($loyalty_points) {
        $this->loyalty_points = $loyalty_points;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }
}

class Phone extends Product {
    private $phone_ID;
    private $manufacturer;
    private $image;


    public function getPhoneID() {
        return $this->phone_ID;
    }

    public function setPhoneID($phone_ID) {
        $this->phone_ID = $phone_ID;
    }

    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function displayPhone() {

        echo "<h2 id='tab1'></h2>";
        echo "<div class='product'>";
        echo "<div class='product-img'>";
        echo "<img src='" . $this->getImage() . "' alt='' style='width: 400px; height: 400px;'>";
        echo "<div class='product-label'>";
        echo "<span class='sale'>-30%</span>";
        echo "<span class='new'>NEW</span>";
        echo "</div>";
        echo "</div>";
        echo "<div class='product-body'>";
        echo "<p class='product-category'>Brand : " . $this->getBrand() . "</p>";
        echo "<p class='product-category'>" . $this->getCategory() . "</p>";
        echo "<h3 class='product-name'>" . $this->getProductName() . "</h3>";
        echo "<h4 class='product-price'>$" . $this->getPrice() . "</h4>";
        echo "<p class='product-bio'>" . $this->getBio() . "</p>";
        echo "<p class='product-category'>You will earn " . $this->getLoyaltyPoints() . " Loyatly points from this purchase</p>";
        echo "</div>";
        echo "<div class='add-to-cart'>";
        echo "<button class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> add to cart</button>";
        echo "</div>";
        echo "</div>";
    }
}

class laptop extends Product {
    private $laptop_ID;
    private $manufacturer;
    private $image;

    public function getLaptopID()
    {
        return $this->laptop_ID;
    }

    public function setLaptopID($laptop_ID)
    {
        $this->laptop_ID = $laptop_ID;
    }

    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function displayLaptop() {

        echo "<h2 id='tab2'></h2>";
        echo "<div class='product'>";
        echo "<div class='product-img'>";
        echo "<img src='" . $this->getImage() . "' alt='' style='width: 400px; height: 400px;'>";
        echo "<div class='product-label'>";
        echo "<span class='sale'>-30%</span>";
        echo "<span class='new'>NEW</span>";
        echo "</div>";
        echo "</div>";
        echo "<div class='product-body'>";
        echo "<p class='product-category'>Brand : " . $this->getBrand() . "</p>";
        echo "<p class='product-category'>" . $this->getCategory() . "</p>";
        echo "<h3 class='product-name'>" . $this->getProductName() . "</h3>";
        echo "<h4 class='product-price'>$" . $this->getPrice() . "</h4>";
        echo "<p class='product-bio'>" . $this->getBio() . "</p>";
        echo "<p class='product-category'>You will earn " . $this->getLoyaltyPoints() . " Loyatly points from this purchase</p>";
        echo "</div>";
        echo "<div class='add-to-cart'>";
        echo "<button class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> add to cart</button>";
        echo "</div>";
        echo "</div>";
    }
}


class television extends Product {
    private $television_ID;
    private $manufacturer;
    private $image;

    public function getTelevisionID()
    {
        return $this->television_ID;
    }

    public function setTelevisionID($television_ID)
    {
        $this->television_ID = $television_ID;
    }

    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function displayTelevision() {

        echo "<h2 id='tab3'></h2>";
        echo "<div class='product'>";
        echo "<div class='product-img'>";
        echo "<img src='" . $this->getImage() . "' alt='' style='width: 400px; height: 400px;'>";
        echo "<div class='product-label'>";
        echo "<span class='sale'>-30%</span>";
        echo "<span class='new'>NEW</span>";
        echo "</div>";
        echo "</div>";
        echo "<div class='product-body'>";
        echo "<p class='product-category'>Brand : " . $this->getBrand() . "</p>";
        echo "<p class='product-category'>" . $this->getCategory() . "</p>";
        echo "<h3 class='product-name'>" . $this->getProductName() . "</h3>";
        echo "<h4 class='product-price'>$" . $this->getPrice() . "</h4>";
        echo "<p class='product-bio'>" . $this->getBio() . "</p>";
        echo "<p class='product-category'>You will earn " . $this->getLoyaltyPoints() . " Loyatly points from this purchase</p>";
        echo "</div>";
        echo "<div class='add-to-cart'>";
        echo "<button class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> add to cart</button>";
        echo "</div>";
        echo "</div>";
    }
}
class PaymentMethod {
    private $payment_ID;
    private $amount;

    public function __construct($payment_ID, $amount) {
        $this->payment_ID = $payment_ID;
        $this->amount = $amount;
    }
    public function getPaymentID() {
        return $this->payment_ID;
    }

    public function setPaymentID($payment_ID)
    {
        $this->payment_ID = $payment_ID;
    }
    public function getAmount()
    {
        return $this->amount;
    }
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }
}

class Card extends PaymentMethod {
    private $card_ID;
    private $name;
    private $type;
    private $card_number;


    public function __construct($card_ID, $name, $card_number) {
        $this->card_ID = $card_ID;
        $this->name = $name;
        $this->card_number = $card_number;

    }

    public function getCardID() {
        return $this->card_ID;
    }

    public function setCardID($card_ID) {
        $this->card_ID = $card_ID;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }


    public function getCardNumber() {
        return $this->card_number;
    }

    public function setCardNumber($card_number) {
        $this->card_number = $card_number;
    }
}
class Order {
    private $order_ID;
    private $date_of_order;
    private $total;
    private $products = array(); // Array to store products in the order



    public function getOrderID()
    {
        return $this->order_ID;
    }

    public function setOrderID($order_ID)
    {
        $this->order_ID = $order_ID;
    }

    public function getDateOfOrder()
    {
        return $this->date_of_order;
    }

    public function setDateOfOrder($date_of_order)
    {
        $this->date_of_order = $date_of_order;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function displayOrder()
    {
        echo "<h2>Order ID: " . $this->getOrderID() . "</h2>";
        echo "<p>Date of Order: " . $this->getDateOfOrder() . "</p>";
        echo "<p>Total: $" . $this->getTotal() . "</p>";

        echo "<h3>Products:</h3>";
        echo "<ul>";
        foreach ($this->products as $product) {
            echo "<li>";
            echo "<p>Product Name: " . $product->getProductName() . "</p>";
            echo "<p>Price: $" . $product->getPrice() . "</p>";
            echo "</li>";
        }
        echo "</ul>";
    }
}



