<?php
require '../lib/sqlQueries.php';
class userClass{
    private $ID;
    private $firstname;
    private $lastname;
    private $email;
    private $password;

    public function getID()
    {
        return $this->ID;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    //Setter methods in user and customer address have validation logic.
    public function setFirstname($firstname)
    {
        if (!preg_match("/^[a-zA-Z\s]*$/", $firstname)){
            throw new InvalidArgumentException("Invalid first name: Special characters are not allowed");
        }
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        if (!preg_match("/^[a-zA-Z\s]*$/", $lastname)){
            throw new InvalidArgumentException("Invalid last name: Special characters are not allowed");
        }
        $this->lastname = $lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email: Please use the correct email address format");
        }
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)){
            throw new InvalidArgumentException("Invalid password: Must contain one lowercase character, one uppercase character, one number and a special character");
        }
        $this->password = $password;
    }

    public function __construct($firstname, $lastname, $email, $password)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
    }
}

class admin extends userClass
{
    private $adminLevel;

    private $userID;

    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function getAdminLevel()
    {
        return $this->adminLevel;
    }

    public function setAdminLevel($adminLevel)
    {
        $this->adminLevel = $adminLevel;
    }

    public function __construct($firstname , $lastname , $email , $password, $adminLevel, $userID)
    {
        parent::__construct($firstname , $lastname , $email , $password);
        $this->adminLevel = $adminLevel;
        $this->userID = $userID;
    }
}

class customer extends userClass
{

    private $ID;

    private $address;

    private $loyaltyPoints;

    private $userID;

    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function getLoyaltyPoints()
    {
        return $this->loyaltyPoints;
    }

    public function setLoyaltyPoints($loyaltyPoints)
    {
        $this->loyaltyPoints = $loyaltyPoints;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        if (!preg_match("/^[a-zA-Z\s]*$/", $address)){
            throw new InvalidArgumentException("Invalid address: Special characters are not allowed");
        }
        $this->address = $address;
    }

    public function __construct($firstname , $lastname , $email , $password , $address , $loyaltyPoints , $userID)
    {
        parent::__construct($firstname , $lastname , $email , $password);
        $this->address = $address;
        $this->userID = $userID;
        $this->loyaltyPoints = $loyaltyPoints;
    }
}
//Function for registering a user. Includes form validation,
function registerUser($data, &$errorMessages)
{
    require_once "../src/DBconnect.php";

    $pdo = get_connection();

    //Creates an instance of user using details submitted in register.php
    $user = new userClass(
        escape($data['firstname']) ,
        escape($data['lastname']) ,
        escape($data['email']) ,
        escape($data['password'])
    );

    //If an invalid value is submitted for a registration field an error message will display
    try {
        $user->setFirstname(escape($data['firstname']));
    } catch (InvalidArgumentException $e) {
        //Gets the exception message thrown in the setter methods. Stores it in the errormessages array.
        $errorMessages['fNameError'] = $e->getMessage();
    }

    try {
        $user->setLastname(escape($data['lastname']));
    } catch (InvalidArgumentException $e) {
        $errorMessages['lNameError'] = $e->getMessage();
    }


    try {
        $user->setEmail(escape($data['email']));
    } catch (InvalidArgumentException $e) {
        $errorMessages['emailError'] = $e->getMessage();
    }


    try {
        $user->setPassword(escape($data['password']));
    } catch (InvalidArgumentException $e) {
        $errorMessages['passError'] = $e->getMessage();
    }

    //The default amount of loyalty points for new users.
    $defaultLPoints = 0;

    //Logic for checking if an email already exists
    $checkEmail = escape($data['email']);
    $sql_checkEmail = checkEmailQ();
    $statement_checkEmail = $pdo->prepare($sql_checkEmail);
    $statement_checkEmail->bindParam(':email', $checkEmail);
    $statement_checkEmail->execute();

    //Sets the value of the check to a boolean.
    $checkIfExist = (bool)$statement_checkEmail->fetchColumn();

    //If an email submitted matches an email in the database it throws an error.
    if ($checkIfExist){
        $errorMessages['emailError'] = "Email already exists. Please use a different email.";
    }

    //If there are no errors stored in the error messages array, continue with registration,
    if (!empty($errorMessages)) {
        return;
    }

    try {
        //Insert data into user table
        $sql_User = insertIntoUserQ();
        $statement_User = $pdo->prepare($sql_User);
        $statement_User->execute([
            'firstname' => $user->getFirstname() ,
            'lastname' => $user->getLastname() ,
            'email' => $user->getEmail() ,
            'password' => $user->getPassword()
        ]);

        //Gets the user ID to be set as the customer table's user_ID foreign key
        $userID = $pdo->lastInsertId();

        //
        $customer = new customer(
            $user->getFirstname() ,
            $user->getLastname() ,
            $user->getEmail() ,
            $user->getPassword() ,
            escape($data['address']) ,
            $defaultLPoints ,
            $userID
        );

        //Throws an error message if the customer's address is invalid
        try {
            $customer->setAddress(escape($data['address']));
        } catch (InvalidArgumentException $e) {
            $errorMessages['addressError'] = $e->getMessage();
        }


        $sql_customer = insertIntoCustomerQ();
        $statement_customer = $pdo->prepare($sql_customer);
        $statement_customer->execute([
            'address' => $customer->getAddress() ,
            'loyaltyPoints' => $defaultLPoints ,
            'userID' => $customer->getUserID()
        ]);

        //Gets the customer ID to be stored as a foreign key in profile
        $customerID = $pdo->lastInsertId();

        //Inputs entry of new customer into profile table
        $sql_profile = insertIntoProfileQ();
        $statement_profile = $pdo->prepare($sql_profile);
        $statement_profile->bindParam(':customer_ID_profile' , $customerID);
        $statement_profile->execute();


        //Sends the user to log in when the registration is successful
        header("location:login.php");
        exit;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return;
    }
}


function createAdmin()
{
    try {
        require "../src/common.php";
        require_once "../src/DBconnect.php";

        $pdo = get_connection();

        //Logic for checking if an admin already exists in the db. If an admin exists another one cannot be created.
        $checkAdmin = checkAdminQ();

        $statement = $pdo->prepare($checkAdmin);
        $statement->execute();
        $adminCount = $statement->fetchColumn();

        //If no admin exists, an admin can be created.
        if ($adminCount == 0) {

            $admin_fname = "Ryan";
            $admin_lname = "Dunne";
            $admin_email = "adminElDojo@gmail.com";
            $admin_pass = "admin_RD2234?";
            $admin_level = 2;

            $user = new userClass(
                escape($admin_fname) ,
                escape($admin_lname) ,
                escape($admin_email) ,
                escape($admin_pass)
            );

            $sql_User = insertIntoUserQ();

            $statement_user = $pdo->prepare($sql_User);

            $statement_user->execute([
                'firstname' => $user->getFirstname() ,
                'lastname' => $user->getLastname() ,
                'email' => $user->getEmail() ,
                'password' => $user->getPassword()
            ]);


            $userID = $pdo->lastInsertID();

            $admin = new admin(
                $user->getFirstname() ,
                $user->getLastname() ,
                $user->getEmail() ,
                $user->getPassword() ,
                $admin_level ,
                $userID
            );

            $sql_Admin = insertIntoAdminQ();

            $statement_admin = $pdo->prepare($sql_Admin);

            $statement_admin->execute([
                'admin_level' => $admin->getAdminLevel() ,
                'user_ID' => $admin->getUserID()
            ]);

            echo $user->getFirstname() . " successfully created as Admin";
        }
        else echo "Admin already exists";


    }catch (PDOException $e){
        echo $e->getMessage();
    }
}

