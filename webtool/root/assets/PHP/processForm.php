<?php
    include "fuelPriceCalculations.php";
    include "maintenancePriceCalculations.php";
    include "vehicleCalculations.php";
    include "insuranceCalculations.php";
    include "taxesAndFeesCalculations.php";
    include "financeCalculations.php";
    include "getID.php";

    $analysisWindow = $_POST["analysisWindow"];
    $discountRate = $_POST["discountRate"];
    $showPowertrainGraph = $_POST["showPowertrainGraph"];

    $vehicleBodyCost = calculateDepreciation($analysisWindow);
    $financeCost = calculateInterestPayment($analysisWindow);
    $annualFuelCost = calculateAnnualFuelCost($analysisWindow);
    $insuranceCost = calculateInsuranceCost($analysisWindow);
    $taxesAndFees = calculateTaxesAndFees($analysisWindow);
    $maintenance = calculateTotalMaintenance($analysisWindow);
    $repair = calculateTotalRepair($analysisWindow);
    $vehicleVmt = getVmtData();

    for($i = 0; $i < $analysisWindow; $i++)
    {
        $year = $i + 1;
        $vehicleBodyCost[$i] = $vehicleBodyCost[$i] / pow((1 + $discountRate), $year);
        $financeCost[$i] = $financeCost[$i] / pow((1 + $discountRate), $year);
        $annualFuelCost[$i] = $annualFuelCost[$i] / pow((1 + $discountRate), $year);
        $insuranceCost[$i] = $insuranceCost[$i] / pow((1 + $discountRate), $year);
        $taxesAndFees[$i] = $taxesAndFees[$i] / pow((1 + $discountRate), $year);
        $maintenance[$i] = $maintenance[$i] / pow((1 + $discountRate), $year);
        $repair[$i] = $repair[$i] / pow((1 + $discountRate), $year);
    }

    runPowertrainGraph("ICE-SI");

    if($showPowertrainGraph == "no")
    {
        $TCO_information = array($vehicleBodyCost, $financeCost, $annualFuelCost, $insuranceCost, $taxesAndFees, $maintenance, $repair, $vehicleVmt);
    }
    else if($showPowertrainGraph == "yes")
    {
        $icesi = runPowertrainGraph("ICE-SI");
        $iceci = runPowertrainGraph("ICE-CI");
        $hevsi = runPowertrainGraph("HEV-SI");
        $phev = runPowertrainGraph("PHEV");
        $fcev = runPowertrainGraph("FCEV");
        $bev = runPowertrainGraph("BEV");

        $TCO_information = array($vehicleBodyCost, $financeCost, $annualFuelCost, $insuranceCost, $taxesAndFees, $maintenance, $repair, $vehicleVmt, $icesi, $iceci, $hevsi, $phev, $fcev, $bev);
    }

    echo json_encode($TCO_information);

    function getVmtData()
    {
        include "getID.php";

        return $annualVmtYears;
    }

    function runPowertrainGraph($powertrainType)
    {
        include_once "powertrainData.php";

        $powertrainComponent[0] = calculateBodyCost($powertrainType);
        $powertrainComponent[1] = calculateFinancingCost($powertrainType);
        $powertrainComponent[2] = calculateFuelCost($powertrainType);
        $powertrainComponent[3] = calculateInsruance($powertrainType);
        $powertrainComponent[4] = calculateTaxes();
        $powertrainComponent[5] = calculateMaintenance($powertrainType);
        $powertrainComponent[6] = calculateRepair($powertrainType);

        return $powertrainComponent;
    }
?>