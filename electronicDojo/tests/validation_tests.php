<?php
//THIS IS VALIDATION TEST FOR CANCELING AN ORDER.

require_once 'C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/lib/functions.php';
require_once 'C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/src/DBconnect.php';

echo "Test 1 : Canceling an order";
echo "<br>";

//cancelOrderTest function is used to cancel an order.
function cancelOrderTest(){

    //Order id to be canceled.
    $orderId = 128;

    try {
        //Get a connection and fetch results to see if the order exists.
        $pdo = get_connection();
        $stmt = $pdo->prepare("SELECT * FROM `order` WHERE order_ID = :order_id");
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();
        $result = $stmt->fetch();

        //If the order does not exist, throw an error.
        if(empty($result)){
            echo "Test failed, order does not exist";
            return false;
        }

        //Call cancelOrder function from the functions.php to cancel the order.
        cancelOrder($orderId);

        //Check if the order still exists after cancellation.
        $stmt = $pdo->prepare("SELECT * FROM `order` WHERE order_ID = :order_id");
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();
        $result = $stmt->fetch();

        //If the order still exists after cancellation, the test failed.
        if (!empty($result)) {
            echo "Test failed, order was not canceled";
            return false;
        } else {
            echo "Test worked, order was canceled";
            return true;
        }
    }
        //catch any errors related to DB.
    catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        return false;
    }
}
cancelOrderTest();
?>

<br>
<br>

<?php
//THIS IS A VALIDATION TEST TO SEE IF A CERTAIN USER EXISTS IN THE DB.

require_once 'C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/Classes/userClass.php';
require_once 'C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/src/DBconnect.php';

echo "Test 2 : Checking if user exists within DB.";
echo "<br>";

//Values to be tested
$firstName = "Justin";
$lastName = "Juozaitis";
$email = "justin.juoz99@gmail.com";
$password = "Hello123??";

//Creates new user object
$user = new userClass($firstName, $lastName, $email, $password);

//Converts user object values to an array
$userToArray = [
    'firstname' => $user->getFirstname(),
    'lastname' => $user->getLastname(),
    'email' => $user->getEmail(),
    'password' =>$user->getPassword()
];

try {
    //Gets a connection
    $pdo = get_connection();

    //Query to fetch info from DB.
    $sql = "SELECT * FROM user WHERE firstname='{$userToArray['firstname']}' AND lastname='{$userToArray['lastname']}' AND email='{$userToArray['email']}' AND password='{$userToArray['password']}'";
    $stmt = $pdo->query($sql);

    //If row count is greater tahn 0, user exists.
    if ($stmt->rowCount() > 0) {
        echo "User details are correct and exists within the DB.";
    } else {
        echo "User does not exist.";
    }

}catch (PDOException $e) {
    echo "DB connection failed " . $e->getMessage();
}
?>



