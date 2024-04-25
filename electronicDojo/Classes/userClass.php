<?php
require "C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/lib/sqlQueries.php";
class userClass{
    private $ID;
    private $firstname;
    private $lastname;
    private $email;
    private $password;

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function __construct($firstname, $lastname, $email, $password)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
}

class admin extends userClass
{
    private $adminLevel;

    private $userID;

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getAdminLevel()
    {
        return $this->adminLevel;
    }

    /**
     * @param mixed $adminLevel
     */
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

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }


    /**
     * @return mixed
     */
    public function getLoyaltyPoints()
    {
        return $this->loyaltyPoints;
    }

    /**
     * @param mixed $loyaltyPoints
     */
    public function setLoyaltyPoints($loyaltyPoints)
    {
        $this->loyaltyPoints = $loyaltyPoints;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
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
    $fNameError = "";
    $lNameError = "";
    $passError = "";

    $userPattern = "/^[a-zA-Z']*$/";
    $addressPattern = "/^[a-zA-Z0-9'\s]*$/";
    $passPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';



    try {
        require_once "C:/Users/Justin/Desktop/Programs/laragon/www/Electronic_Dojo/electronicDojo/src/DBconnect.php";

        if (!preg_match($userPattern, $data['firstname'])){
            $fNameError = "Invalid first name: Special characters or numbers are not allowed";
        }
        //Anonymous PHP Forms - Validate E-Mail and URL [online], Available from: <https://www.w3schools.com/php/php_form_url_email.asp> .
        //w3Schools helped with the form validation for first name, last name, email and address

        if (!preg_match($userPattern, $data['lastname'])){
            $lNameError = "Invalid last name: Special characters or numbers are not allowed";
        }

        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $emailError = "Invalid email: Please use the correct email address format";
        }

        if (!preg_match($passPattern, $data['password'])){
            $passError = "Invalid password: Must contain one lowercase character, one uppercase character, one number and a special character";
        }

        if (!preg_match($addressPattern, $data['address'])){
            $addressError = "Invalid Address: Special characters are not allowed";
        }
        //A, V. (2024) PHP Password Validation Check for Strength [online], Available from:
        // <https://phppot.com/php/php-password-validation/#:~:text=The%20PHP%20preg_match%20function%20returns,is%20matched%20with%20this%20pattern.&text=This%20password%20validation%20returns%20true,a%20minimum%208%2Dcharacter%20length.> .
        //Form validation for password was created using key aspects from the link above

        if (!empty($fNameError)) {
            $errorMessages['fNameError'] = $fNameError;
        }
        if (!empty($lNameError)) {
            $errorMessages['lNameError'] = $lNameError;
        }

        if (!empty($emailError)){
            $errorMessages['emailError'] = $emailError;
        }

        if (!empty($passError)) {
            $errorMessages['passError'] = $passError;
        }

        if (!empty($addressError)){
            $errorMessages['addressError'] = $addressError;
        }


//If form fields pass validation checks, proceed with registration
        if (empty($errorMessages)){

            $user = new userClass(
                escape($data['firstname']),
                escape($data['lastname']),
                escape($data['email']),
                escape($data['password'])
            );
            
            $sql_User = insertIntoUserQ();

            $statement_User = $connection->prepare($sql_User);

            $statement_User->execute([
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ]);

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


            $sql_customer = insertIntoCustomerQ();

            $statement_customer = $connection->prepare($sql_customer);

            $statement_customer->execute([
                'address' => $customer->getAddress(),
                'loyaltyPoints' => $defaultLPoints,
                'userID' => $customer->getUserID()
            ]);
            header("location:login.php");

            exit;

        }


    }catch (PDOException $e){
        echo $e->getMessage();
    }
}

function createAdmin()
{
    try {
        require "common.php";
        require_once "src/DBconnect.php";


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

