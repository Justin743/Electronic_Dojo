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
        if ($price < 0){
            throw new \InvalidArgumentException("Price must be a positive number");
        }
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

    public function displayPhone($productID) {



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
        echo "<form method='post' action='/electronicDojo/cart.php'>";
        echo "<input type='hidden' name='product_ID' value=" . $productID . ">";
        echo "<button type='submit' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Add to cart</button>";
        echo "</form>";
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

    public function displayLaptop($productID) {

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
        echo "<form method='post' action='/electronicDojo/cart.php'>";
        echo "<input type='hidden' name='product_ID' value=" . $productID . ">";
        echo "<button type='submit' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Add to cart</button>";
        echo "</form>";
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

    public function displayTelevision($productID) {

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
        echo "<form method='post' action='/electronicDojo/cart.php'>";
        echo "<input type='hidden' name='product_ID' value=" . $productID . ">";
        echo "<button type='submit' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Add to cart</button>";
        echo "</form>";
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
    private $customer_ID;

    private $product_ID;

    private $products = array();

    /**
     * @return mixed
     */
    public function getProductID()
    {
        return $this->product_ID;
    }

    /**
     * @param mixed $product_ID
     */
    public function setProductID($product_ID): void
    {
        $this->product_ID = $product_ID;
    }



    public function getCustomerID()
    {
        return $this->customer_ID;
    }

    public function setCustomerID($customer_ID)
    {
        $this->customer_ID = $customer_ID;
    }

    public function getOrderID() {
        return $this->order_ID;
    }

    public function setOrderID($order_ID) {
        $this->order_ID = $order_ID;
    }

    public function getDateOfOrder() {
        return $this->date_of_order;
    }

    public function setDateOfOrder($date_of_order) {
        $this->date_of_order = $date_of_order;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function displayOrder() {
        echo "<h2>Customer ID: " . $this->getCustomerID() . "</h2>";
        echo "<h2>Order ID: " . $this->getOrderID() . "</h2>";
        echo "<p>Date of Order: " . $this->getDateOfOrder() . "</p>";

        $shippingCost = $this->calculateShippingCost();
        $totalWithShipping = $this->getTotal() + $shippingCost;
        $this->setTotal($totalWithShipping);

        echo "<p>Total: $" . $this->getTotal() . "</p>";
        echo "<p>Shipping Cost: €" . $shippingCost . "</p>";

        echo "<h3>Products:</h3>";
        echo "<ul>";
        foreach ($this->products as $product) {
            echo "<li>";
            echo "<p>Product Name: " . $product->getProductName() . "</p>";
            echo "<p>Price: $" . $product->getPrice() . "</p>";
            echo "</li>";
        }
        echo "</ul>";

        echo '<form method="post" action="cancel_order.php">';
        echo '<input type="hidden" name="order_id" value="' . $this->getOrderID() . '">';
        echo '<button type="submit" name="cancel_order" >Cancel Order</button>';
        echo '</form>';
    }

    public function calculateShippingCost() {
        $totalPrice = $this->getTotal();
        $shippingCost = 0;

        if ($totalPrice < 500) {
            $shippingCost = 20;
        } elseif ($totalPrice >= 500 && $totalPrice < 750) {
            $shippingCost = 15;
        } elseif ($totalPrice >= 750 && $totalPrice < 1000) {
            $shippingCost = 10;
        } elseif ($totalPrice >= 1000 && $totalPrice < 1500) {
            $shippingCost = 5;
        } elseif ($totalPrice >= 1500 && $totalPrice < 2000) {
            $shippingCost = 2.50;
        } elseif ($totalPrice >= 2000) {
            $shippingCost = 0;
        }

        return $shippingCost;
    }
}

