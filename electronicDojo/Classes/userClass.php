<?php
require 'C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/lib/sqlQueries.php';
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

function registerUser($data, &$errorMessages){
    require_once "src/DBconnect.php";

    $user = new userClass(
        escape($data['firstname']),
        escape($data['lastname']),
        escape($data['email']),
        escape($data['password'])
    );


    try {
        $user->setFirstname(escape($data['firstname']));
    } catch (InvalidArgumentException $e) {
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

    $userID = $connection->lastInsertId();

    $defaultLPoints = 0;

    $customer = new customer(
        $user->getFirstname(),
        $user->getLastname(),
        $user->getEmail(),
        $user->getPassword(),
        escape($data['address']),
        $defaultLPoints,
        $userID
    );

    try {
        $customer->setAddress(escape($data['address']));
    }catch (InvalidArgumentException $e){
        $errorMessages['addressError'] = $e->getMessage();
    }


    if (!empty($errorMessages)) {
        return;
    }

    try {

        $sql_User = insertIntoUserQ();
        $statement_User = $connection->prepare($sql_User);
        $statement_User->execute([
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);





        $sql_customer = insertIntoCustomerQ();
        $statement_customer = $connection->prepare($sql_customer);
        $statement_customer->execute([
            'address' => $customer->getAddress(),
            'loyaltyPoints' => $defaultLPoints,
            'userID' => $customer->getUserID()
        ]);

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


        $checkAdmin = checkAdminQ();

        $statement = $connection->prepare($checkAdmin);
        $statement->execute();
        $adminCount = $statement->fetchColumn();

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

            $statement_user = $connection->prepare($sql_User);

            $statement_user->execute([
                'firstname' => $user->getFirstname() ,
                'lastname' => $user->getLastname() ,
                'email' => $user->getEmail() ,
                'password' => $user->getPassword()
            ]);


            $userID = $connection->lastInsertID();

            $admin = new admin(
                $user->getFirstname() ,
                $user->getLastname() ,
                $user->getEmail() ,
                $user->getPassword() ,
                $admin_level ,
                $userID
            );

            $sql_Admin = insertIntoAdminQ();

            $statement_admin = $connection->prepare($sql_Admin);

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

