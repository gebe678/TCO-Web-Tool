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

    $phevRange = $_POST["phevRange"];
    $phevMPGRange = "PHEV_" . $phevRange . "_MPG";
    $phevCost = "PHEV_" . $phevRange;

    $fuelYear = $_POST["fuelYear"];
    $hydrogenSuccess = $_POST["hydrogenSuccessFactor"];
    $userDefinedFuel = $_POST["userDefinedFuel"];
    $premiumGasMarkup = $_POST["premiumGasModifier"];

    // Labour data
    $laborCost = $_POST["laborCost"];

    // vehicle input data
    $vehicleInput = $_POST["vehicleCostInput"];

    // vehicle body data
    $markupFactor = $_POST["markupFactor"];
    $depreciationRate = $_POST["depreciationRate"];
    $writeOff = $_POST["writeOff"];

    // insurance data
    $insuranceFixed = $_POST["insuranceFixed"];
    $insuranceProportional = $_POST["insuranceProportional"];

    // fuel mpg query
    $fuelMPGQuery = "SELECT MPG FROM vehicle_mpg WHERE Powertrain LIKE '$powertrain' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Size LIKE '$modelYear'";
    $bevMPGQuery = "SELECT $bevMPGRange FROM bev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
    $bevCostQuery = "SELECT $bevCost FROM bev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
    $bevAeoQuery = "SELECT $bevCost FROM bev_costs WHERE Model_Year LIKE 'AEO_Model_Year_2020' AND Size LIKE '$vehicleBody'";
    $bevRealWorldQuery = "SELECT $bevCost FROM bev_costs WHERE Model_Year LIKE 'Real_World_Today' AND Size LIKE '$vehicleBody'";
    $bevAeoMPGQuery = "SELECT $bevMPGRange FROM bev_costs WHERE Model_Year LIKE 'AEO_Model_Year_2020' AND Size LIKE '$vehicleBody'";
    $bevRealWorldMPGQuery = "SELECT $bevMPGRange FROM bev_costs WHERE Model_Year LIKE 'Real_World_Today' AND Size LIKE '$vehicleBody'";

    $phevMPGQuery = "SELECT $phevMPGRange FROM phev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
    $phevCostQuery = "SELECT $phevCost FROM phev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE $modelYear";
    $phevAeoQuery = "SELECT $phevCost FROM phev_costs WHERE Model_Year LIKE 'AEO_Model_Year_2020' AND Size LIKE '$vehicleBody'";
    $phevRealWorldQuery = "SELECT $phevCost FROM phev_costs WHERE Model_Year LIKE 'Real_World_Today' AND Size LIKE '$vehicleBody'";
    $phevAeoMPGQuery = "SELECT $phevMPGRange FROM phev_costs WHERE Model_Year LIKE 'AEO_Model_Year_2020' AND Size LIKE '$vehicleBody'";
    $phevRealWorldMPGQuery = "SELECT $phevMPGRange FROM phev_costs WHERE Model_Year LIKE 'Real_World_Today' AND Size LIKE '$vehicleBody'";

    $fuelAeoMPGQuery = "SELECT MPG FROM vehicle_mpg WHERE Powertrain LIKE '$powertrain' AND Size LIKE '$vehicleBody' AND Model_Size LIKE 'AEO_Model_Year_2020'";
    $fuelRealWorldMPGQuery = "SELECT MPG FROM vehicle_mpg WHERE Powertrain LIKE '$powertrain' AND Size LIKE '$vehicleBody' AND Model_Size LIKE 'Real_World_Today'";

    // Vehice_body_query
    $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrain' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";

    // vehcile cost input query
    $vehicleAeoQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrain' AND Size LIKE '$vehicleBody' AND Model_Year LIKE 'AEO_Model_Year_2020'";
    $vehicleRealWorldTodayQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE  Powertrain LIKE '$powertrain' AND Size LIKE '$vehicleBody' AND Model_Year LIKE 'Real_World_Today'";

    // cost component query data
    $vehicleQuery = "SELECT Size_ID FROM vehicle_size WHERE Size LIKE '$vehicleBody'";
    $powertrainQuery = "SELECT Powertrain_ID FROM powertrain WHERE Powertrain LIKE '$powertrain'";
    $vmtQuery = "SELECT $vmtType FROM annual_vmt";

    
    // vehicle body query results
    $sizeID = $connect->query($vehicleQuery); $sizeID = $sizeID->fetch_assoc(); $sizeID = $sizeID["Size_ID"];
    $powertrainID = $connect->query($powertrainQuery); $powertrainID = $powertrainID->fetch_assoc(); $powertrainID = $powertrainID["Powertrain_ID"];
    $vehicleBodyCost = $connect->query($vehicleBodyCostQuery); $vehicleBodyCost = $vehicleBodyCost->fetch_assoc(); $vehicleBodyCost = $vehicleBodyCost["Body_Cost"];

    // vehicle body cost results
    $vehicleAeoCost = $connect->query($vehicleAeoQuery); $vehicleAeoCost = $vehicleAeoCost->fetch_assoc(); $vehicleAeoCost = $vehicleAeoCost["Body_Cost"];
    $vehicleRealWorldCost = $connect->query($vehicleRealWorldTodayQuery); $vehicleRealWorldCost = $vehicleRealWorldCost->fetch_assoc(); $vehicleRealWorldCost = $vehicleRealWorldCost["Body_Cost"];

    // fuel price query results
    $fuelMPG = $connect->query($fuelMPGQuery); $fuelMPG = $fuelMPG->fetch_assoc(); $fuelMPG = $fuelMPG["MPG"];
    $fuelAeoMPG = $connect->query($fuelAeoMPGQuery); $fuelAeoMPG = $fuelAeoMPG->fetch_assoc(); $fuelAeoMPG = $fuelAeoMPG["MPG"];
    $fuelRealWorldMPG = $connect->query($fuelRealWorldMPGQuery); $fuelRealWorldMPG = $fuelRealWorldMPG->fetch_assoc(); $fuelRealWorldMPG = $fuelRealWorldMPG["MPG"];

    $bevMPG = $connect->query($bevMPGQuery); $bevMPG = $bevMPG->fetch_assoc(); $bevMPG = $bevMPG[$bevMPGRange];
    $bevAeoMPG = $connect->query($bevAeoMPGQuery); $bevAeoMPG = $bevAeoMPG->fetch_assoc(); $bevAeoMPG = $bevAeoMPG[$bevMPGRange];
    $bevRealWorldMPG = $connect->query($bevRealWorldMPGQuery); $bevRealWorldMPG = $bevRealWorldMPG->fetch_assoc(); $bevRealWorldMPG = $bevRealWorldMPG[$bevMPGRange];

    $bevCostResult = $connect->query($bevCostQuery); $bevCostResult = $bevCostResult->fetch_assoc(); $bevCostResult = $bevCostResult[$bevCost];
    $bevAeoResult = $connect->query($bevAeoQuery); $bevAeoResult = $bevAeoResult->fetch_assoc(); $bevAeoResult = $bevAeoResult[$bevCost];
    $bevRealWorldResult = $connect->query($bevRealWorldQuery); $bevRealWorldResult = $bevRealWorldResult->fetch_assoc(); $bevRealWorldResult = $bevRealWorldResult[$bevCost];

    $phevMPG = $connect->query($phevMPGQuery); $phevMPG = $phevMPG->fetch_assoc(); $phevMPG = $phevMPG[$phevMPGRange];
    $phevAeoMPG = $connect->query($phevAeoMPGQuery); $phevAeoMPG = $phevAeoMPG->fetch_assoc(); $phevAeoMPG = $phevAeoMPG[$phevMPGRange];
    $phevRealWorldMPG = $connect->query($phevRealWorldMPGQuery); $phevRealWorldMPG = $phevRealWorldMPG->fetch_assoc(); $phevRealWorldMPG = $phevRealWorldMPG[$phevMPGRange];

    $phevCostResult = $connect->query($phevCostQuery); $phevCostResult = $phevCostResult->fetch_assoc(); $phevCostResult = $phevCostResult[$phevCost];
    $phevAeoResult = $connect->query($phevAeoQuery); $phevAeoResult = $phevAeoResult->fetch_assoc(); $phevAeoResult = $phevAeoResult[$phevCost];
    $phevRealWorldResult = $connect->query($phevRealWorldQuery); $phevRealWorldResult = $phevRealWorldResult->fetch_assoc(); $phevRealWorldResult = $phevRealWorldResult[$phevCost];

    $i = 0;
    $h = $connect->query($vmtQuery);
    while($vmtYear = $h->fetch_assoc())
    {
        $annualVmtYears[$i] = $vmtYear[$vmtType];
        $i++;
    }
?>