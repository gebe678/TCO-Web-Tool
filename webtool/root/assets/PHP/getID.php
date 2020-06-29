<?php 
    include "assets/PHP/connectDatabase.php";

    // cost component variables
    $vehicleBody = $_GET["vehicleBody"];
    $powertrain = $_GET["powertrain"];
    $regionality = $_GET["regionality"];

    // fuel price data
    $annualFuelPriceIncrease = $_GET["annualFuelPriceIncrease"];
    $biofuelCost = $_GET["biofuelCost"];
    $biofuelPremium = $_GET["biofuelPremium"];
    $hydrogenCost = $_GET["hydrogenCost"];
    $hydrogenPremium = $_GET["hydrogenPremium"];

    // cost component query data
    $vehicleQuery = "SELECT Size_ID FROM vehicle_size WHERE Size LIKE '$vehicleBody'";
    $powertrainQuery = "SELECT Powertrain_ID FROM powertrain WHERE Powertrain LIKE '$powertrain'";

    

    $sizeID = $connect->query($vehicleQuery); $sizeID = $sizeID->fetch_assoc(); $sizeID = $sizeID["Size_ID"];
    $powertrainID = $connect->query($powertrainQuery); $powertrainID = $powertrainID->fetch_assoc(); $powertrainID = $powertrainID["Powertrain_ID"];
?>