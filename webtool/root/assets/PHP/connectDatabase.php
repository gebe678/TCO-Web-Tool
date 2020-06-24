<?php 

$serverName = "127.0.0.1";
$userName = "root";
$password = "usbw";
$database = "tco_vehicle_information";

$connect = new mysqli($serverName, $userName, $password, $database);

if($connect->connect_error)
{
    die("Connection failed: " . $connect->connect_error);
}

?>