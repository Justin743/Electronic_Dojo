<?php
require_once 'src/sessions.php';

//Creates a new instance of session.
$session = new session();
//Calls forget session method to forget the session.
$session->forgetSession();
?>