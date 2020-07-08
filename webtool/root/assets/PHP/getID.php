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

    // vehicle body data
    $markupFactor = $_GET["markupFactor"];
    $depreciationRate = $_GET["depreciationRate"];
    $writeOff = $_GET["writeOff"];

    // insurance data
    $insuranceFixed = $_GET["insuranceFixed"];
    $insuranceProportional = $_GET["insuranceProportional"];

    // fuel mpg query
    $fuelMPGQuery = "SELECT MPG FROM vehicle_mpg WHERE Powertrain LIKE '$powertrain' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Size LIKE '$modelYear'";
    $bevMPGQuery = "SELECT $bevMPGRange FROM bev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE $modelYear";

    // Vehice_body_query
    $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrain' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";

    // Maintenance query
    $scalingFactorPowertrain = $powertrain . "_Scaling_Factor";
    $scalingFactorPowertrain = str_replace("-", "_", $scalingFactorPowertrain);
    $firstServiceQuery = "SELECT First_Service_VMT FROM maintenance_cost";
    $repeatServiceQuery = "SELECT Repeat_VMT FROM maintenance_cost";
    $costDataQuery = "SELECT Cost FROM maintenance_cost";
    $scalingFactorQuery = "SELECT $scalingFactorPowertrain FROM maintenance_cost";

    // Repair Query
    $scalingRepairFactorPowertrain = $powertrain . "_Scaling_Factor";
    $scalingRepairFactorPowertrain = str_replace("-", "_", $scalingFactorPowertrain);
    $firstRepairServiceQuery = "SELECT First_Service_VMT FROM repair_activity";
    $repeatRepairServiceQuery = "SELECT Repeat_VMT FROM repair_activity";
    $repairCostDataQuery = "SELECT Cost FROM repair_activity";
    $scalingRepairFactorQuery = "SELECT $scalingRepairFactorPowertrain FROM repair_activity";

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
    $annualVmt = $connect->query($vmtQuery); $annualVmt = $annualVmt->fetch_assoc(); $annualVmt = $annualVmt[$vmtType];

    $i = 0;
    $h = $connect->query($vmtQuery);
    while($vmtYear = $h->fetch_assoc())
    {
        $annualVmtYears[$i] = $vmtYear[$vmtType];
        $i++;
    }

    // Maintenance Query
    $i = 0;
    $firstService = $connect->query($firstServiceQuery);
    $repeatService = $connect->query($repeatServiceQuery);
    $costData = $connect->query($costDataQuery);
    $scalingFactor = $connect->query($scalingFactorQuery);

    while($firstServiceResult = $firstService->fetch_assoc())
    {
        $firstServiceResults[$i] = $firstServiceResult["First_Service_VMT"];
        $i++;
    }

    $i = 0;
    while($repeatServiceResult = $repeatService->fetch_assoc())
    {
        $repeatServiceResults[$i] = $repeatServiceResult["Repeat_VMT"];
        $i++;
    }

    $i = 0;
    while($costDataResult = $costData->fetch_assoc())
    {
        $costDataResults[$i] = $costDataResult["Cost"];
        $i++;
    }

    $i = 0;
    while($scalingFactorResult = $scalingFactor->fetch_assoc())
    {
        $scalingFactorResults[$i] = $scalingFactorResult[$scalingFactorPowertrain];
        $i++;
    }

    // Repair Query
    $i = 0;
    $firstRepairService = $connect->query($firstRepairServiceQuery);
    $repeatRepairService = $connect->query($repeatRepairServiceQuery);
    $costRepairData = $connect->query($repairCostDataQuery);
    $scalingRepairFactor = $connect->query($scalingRepairFactorQuery);

    while($firstRepairServiceResult = $firstRepairService->fetch_assoc())
    {
        $firstRepairServiceResults[$i] = $firstRepairServiceResult["First_Service_VMT"];
        $i++;
    }

    $i = 0;
    while($repeatRepairServiceResult = $repeatRepairService->fetch_assoc())
    {
        $repeatRepairServiceResults[$i] = $repeatRepairServiceResult["Repeat_VMT"];
        $i++;
    }

    $i = 0;
    while($repairCostDataResult = $costRepairData->fetch_assoc())
    {
        $repairCostDataResults[$i] = $repairCostDataResult["Cost"];
        $i++;
    }

    $i = 0;
    while($scalingRepairFactorResult = $scalingRepairFactor->fetch_assoc())
    {
        $scalingRepairFactorResults[$i] = $scalingRepairFactorResult[$scalingRepairFactorPowertrain];
        $i++;
    }
?>