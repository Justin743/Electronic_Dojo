<?php
//Config file containing DB details.
$host   ="localhost";
$username   ="root";
$password   ="";
$dbname     ="electronic_dojo";
$dsn        ="mysql:host=$host;dbname=$dbname";
$options    =array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
