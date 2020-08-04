<?php 
    include "connectDatabase.php";

    // // cost component variables
    $vehicleBody = $_POST["vehicleBody"];
    $powertrain = $_POST["powertrain"];
    $regionality = $_POST["regionality"];
    $modelYear = $_POST["modelYear"];

    // fuel price data
    $annualFuelPriceIncrease = $_POST["annualFuelPriceIncrease"];
    $biofuelCost = $_POST["biofuelCost"];
    $biofuelPremium = $_POST["biofuelPremium"];
    $hydrogenCost = $_POST["hydrogenCost"];
    $hydrogenPremium = $_POST["hydrogenPremium"];
    $fuelType = $_POST["fuel"];
    $technology = $_POST["technology"];
    $bevRange = $_POST["bevRange"];
    $vmtType = $_POST["vmt"];
    $bevMPGRange = "BEV_" . $bevRange . "_MPG";
    $bevCost = "BEV_" . $bevRange;
    $fuelYear = $_POST["fuelYear"];
    $hydrogenSuccess = $_POST["hydrogenSuccessFactor"];
    $userDefinedFuel = $_POST["userDefinedFuel"];
    $premiumGasMarkup = $_POST["premiumGasModifier"];

    // vehicle body data
    $markupFactor = $_POST["markupFactor"];
    $depreciationRate = $_POST["depreciationRate"];
    $writeOff = $_POST["writeOff"];

    // insurance data
    $insuranceFixed = $_POST["insuranceFixed"];
    $insuranceProportional = $_POST["insuranceProportional"];

    // fuel mpg query
    $fuelMPGQuery = "SELECT MPG FROM vehicle_mpg WHERE Powertrain LIKE '$powertrain' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Size LIKE '$modelYear'";
    $bevMPGQuery = "SELECT $bevMPGRange FROM bev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE $modelYear";
    $bevCostQuery = "SELECT $bevCost FROM bev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE $modelYear";

    // Vehice_body_query
    $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrain' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";

    // cost component query data
    $vehicleQuery = "SELECT Size_ID FROM vehicle_size WHERE Size LIKE '$vehicleBody'";
    $powertrainQuery = "SELECT Powertrain_ID FROM powertrain WHERE Powertrain LIKE '$powertrain'";
    $vmtQuery = "SELECT $vmtType FROM annual_vmt";

    
    // vehicle body query results
    $sizeID = $connect->query($vehicleQuery); $sizeID = $sizeID->fetch_assoc(); $sizeID = $sizeID["Size_ID"];
    $powertrainID = $connect->query($powertrainQuery); $powertrainID = $powertrainID->fetch_assoc(); $powertrainID = $powertrainID["Powertrain_ID"];
    $vehicleBodyCost = $connect->query($vehicleBodyCostQuery); $vehicleBodyCost = $vehicleBodyCost->fetch_assoc(); $vehicleBodyCost = $vehicleBodyCost["Body_Cost"];

    // fuel price query results
    $fuelMPG = $connect->query($fuelMPGQuery); $fuelMPG = $fuelMPG->fetch_assoc(); $fuelMPG = $fuelMPG["MPG"];

    $bevMPG = $connect->query($bevMPGQuery); $bevMPG = $bevMPG->fetch_assoc(); $bevMPG = $bevMPG[$bevMPGRange];
    $bevCostResult = $connect->query($bevCostQuery); $bevCostResult = $bevCostResult->fetch_assoc(); $bevCostResult = $bevCostResult[$bevCost];


    $i = 0;
    $h = $connect->query($vmtQuery);
    while($vmtYear = $h->fetch_assoc())
    {
        $annualVmtYears[$i] = $vmtYear[$vmtType];
        $i++;
    }
?>