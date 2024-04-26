<?php


namespace Tests\Unit;

use Tests\Support\UnitTester;
require "Classes/userClass.php";

//A test on verifying if certain data exists in the user table in our database.

class userTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;

    public function testInputDB()
    {
        require "lib/functions.php";

        $firstName = "Ryan";
        $lastName = "Dunne";
        $email = "ryan@gmail.com";
        $password = "Ryandun45?";

        //Creates new user object
        $user = new \userClass($firstName, $lastName, $email, $password);

        //Converts user object values to an array
        $userToArray = [
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'password' =>$user->getPassword()
        ];


        //Verifies if the provided user data exists within the user table within our database.
        $this->tester->seeInDatabase('user', $userToArray);
    }
}
