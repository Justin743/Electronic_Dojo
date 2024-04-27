<?php


namespace Tests\Unit;

use Tests\Support\UnitTester;
require "Classes/userClass.php";

//A test on verifying if certain data exists in the user table in our database.

class userTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;

    public function testInvalidFirstName()
    {

        //Set values for the user object
        $firstName = "Rya£n";
        $lastName = "Dunne";
        $email = "ryan@gmail.com";
        $password = "Ryandun45?";

        //Creates new user object with set values in constructor
        $user = new \userClass($firstName, $lastName, $email, $password);

        $this->expectException(\InvalidArgumentException::class);
        $user->setFirstname($user->getFirstname());

    }

    public function testInvalidLastName()
    {
        //Set values for the user object
        $firstName = "Ryan";
        $lastName = "Dun£e";
        $email = "ryan@gmail.com";
        $password = "Ryandun45?";

        //Creates new user object with set values in constructor
        $user = new \userClass($firstName, $lastName, $email, $password);

        $this->expectException(\InvalidArgumentException::class);
        $user->setLastname($user->getLastname());

    }

    public function testInvalidEmail()
    {
        //Set values for the user object
        $firstName = "Ryan";
        $lastName = "Dunne";
        $email = "ryan@gmail";
        $password = "Ryandun45?";

        //Creates new user object with set values in constructor
        $user = new \userClass($firstName, $lastName, $email, $password);

        $this->expectException(\InvalidArgumentException::class);
        $user->setEmail($user->getEmail());
    }

    public function testInvalidPassword()
    {
        //Set values for the user object
        $firstName = "Ryan";
        $lastName = "Dunne";
        $email = "ryan@gmail.com";
        $password = "invalidpassword";

        //Creates new user object with set values in constructor
        $user = new \userClass($firstName, $lastName, $email, $password);

        $this->expectException(\InvalidArgumentException::class);
        $user->setPassword($user->getPassword());

    }

}
