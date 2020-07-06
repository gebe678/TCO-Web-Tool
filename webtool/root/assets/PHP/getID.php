<?php 
    include "assets/PHP/connectDatabase.php";

    // cost component variables
    $vehicleBody = $_GET["vehicleBody"];
    $powertrain = $_GET["powertrain"];
    $regionality = $_GET["regionality"];
    $modelYear = $_GET["modelYear"];

    // fuel price data
    $annualFuelPriceIncrease = $_GET["annualFuelPriceIncrease"];
    $biofuelCost = $_GET["biofuelCost"];
    $biofuelPremium = $_GET["biofuelPremium"];
    $hydrogenCost = $_GET["hydrogenCost"];
    $hydrogenPremium = $_GET["hydrogenPremium"];
    $fuelType = $_GET["fuel"];
    $technology = $_GET["technology"];
    $bevRange = $_GET["bevRange"];
    $vmtType = $_GET["vmt"];

    $bevMPGRange = "BEV_" . $bevRange . "_MPG";

    // fuel mpg query
    $fuelMPGQuery = "SELECT MPG FROM vehicle_mpg WHERE Powertrain LIKE '$powertrain' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Size LIKE '$modelYear'";
    $bevMPGQuery = "SELECT $bevMPGRange FROM bev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE $modelYear";  
    // cost component query data
    $vehicleQuery = "SELECT Size_ID FROM vehicle_size WHERE Size LIKE '$vehicleBody'";
    $powertrainQuery = "SELECT Powertrain_ID FROM powertrain WHERE Powertrain LIKE '$powertrain'";
    $vmtQuery = "SELECT $vmtType FROM annual_vmt";

    
    // vehicle body query results
    $sizeID = $connect->query($vehicleQuery); $sizeID = $sizeID->fetch_assoc(); $sizeID = $sizeID["Size_ID"];
    $powertrainID = $connect->query($powertrainQuery); $powertrainID = $powertrainID->fetch_assoc(); $powertrainID = $powertrainID["Powertrain_ID"];

    // fuel price query results
    $fuelMPG = $connect->query($fuelMPGQuery); $fuelMPG = $fuelMPG->fetch_assoc(); $fuelMPG = $fuelMPG["MPG"];
    $bevMPG = $connect->query($bevMPGQuery); $bevMPG = $bevMPG->fetch_assoc(); $bevMPG = $bevMPG[$bevMPGRange];
    $annualVmt = $connect->query($vmtQuery); $annualVmt = $annualVmt->fetch_assoc(); $annualVmt = $annualVmt[$vmtType];
?>