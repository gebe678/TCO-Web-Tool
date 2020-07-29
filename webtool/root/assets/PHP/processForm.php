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
        $vehicleVmt[$i] = floatval($vehicleVmt[$i]);
    }

    if(empty($_POST["showPowertrainGraph"]))
    {
        $TCO_information = array($vehicleBodyCost, $financeCost, $annualFuelCost, $insuranceCost, $taxesAndFees, $maintenance, $repair, $vehicleVmt);
    }
    else if(!empty($_POST["showPowertrainGraph"]))
    {
        $pBody = calculatePowertrainBody("ICE-SI");
        $pFinance = calculatePowerTrainFinance("ICE-CI");
        $pFuel = calculatePowertrainFUel("HEV-SI");
        $pInsurance = calculatePowertrainInsurance("PHEV");
        $pTaxes = calculatePowertrainTaxes("FCEV");
        $pMaintenance = calculatePowertrainMaintenance("BEV");
        $pRepair = calculatePowertrainRepair();

        $TCO_information = array($vehicleBodyCost, $financeCost, $annualFuelCost, $insuranceCost, $taxesAndFees, $maintenance, $repair, $vehicleVmt, $pBody, $pFinance, $pFuel, $pInsurance, $pTaxes, $pMaintenance, $pRepair);
    }

    echo json_encode($TCO_information);

    function getVmtData()
    {
        include "getID.php";

        return $annualVmtYears;
    }

    function calculatePowertrainBody()
    {
        include_once "powertrainData.php";

        $powertrainBody[0] = calculateBodyCost("ICE-SI");
        $powertrainBody[1] = calculateBodyCost("ICE-CI");
        $powertrainBody[2] = calculateBodyCost("HEV-SI");
        $powertrainBody[3] = calculateBodyCost("PHEV");
        $powertrainBody[4] = calculateBodyCost("FCEV");
        $powertrainBody[5] = calculateBodyCost("BEV");

        return $powertrainBody;
    }

    function calculatePowerTrainFinance()
    {
        include_once "powertrainData.php";

        $powertrainFinance[0] = calculateFinancingCost("ICE-SI");
        $powertrainFinance[1] = calculateFinancingCost("ICE-CI");
        $powertrainFinance[2] = calculateFinancingCost("HEV-SI");
        $powertrainFinance[3] = calculateFinancingCost("PHEV");
        $powertrainFinance[4] = calculateFinancingCost("FCEV");
        $powertrainFinance[5] = calculateFinancingCost("BEV");

        return $powertrainFinance;
    }

    function calculatePowertrainFuel()
    {
        include_once "powertrainData.php";

        $powertrainFuel[0] = calculateFuelCost("ICE-SI");
        $powertrainFuel[1] = calculateFuelCost("ICE-CI");
        $powertrainFuel[2] = calculateFuelCost("HEV-SI");
        $powertrainFuel[3] = calculateFuelCost("PHEV");
        $powertrainFuel[4] = calculateFuelCost("FCEV");
        $powertrainFuel[5] = calculateFuelCost("BEV");

        return $powertrainFuel;
    }

    function calculatePowertrainInsurance()
    {
        include_once "powertrainData.php";

        $powertrainInsurance[0] = calculateInsruance("ICE-SI");
        $powertrainInsurance[1] = calculateInsruance("ICE-CI");
        $powertrainInsurance[2] = calculateInsruance("HEV-SI");
        $powertrainInsurance[3] = calculateInsruance("PHEV");
        $powertrainInsurance[4] = calculateInsruance("FCEV");
        $powertrainInsurance[5] = calculateInsruance("BEV");

        return $powertrainInsurance;
    }

    function calculatePowertrainTaxes()
    {
        include_once "powertrainData.php";

        $powertrainTaxes[0] = calculateTaxes();
        $powertrainTaxes[1] = calculateTaxes();
        $powertrainTaxes[2] = calculateTaxes();
        $powertrainTaxes[3] = calculateTaxes();
        $powertrainTaxes[4] = calculateTaxes();
        $powertrainTaxes[5] = calculateTaxes();

        return $powertrainTaxes;
    }

    function calculatePowertrainMaintenance()
    {
        include_once "powertrainData.php";

        $powertrainMaintenance[0] = calculateMaintenance("ICE-SI");
        $powertrainMaintenance[1] = calculateMaintenance("ICE-CI");
        $powertrainMaintenance[2] = calculateMaintenance("HEV-SI");
        $powertrainMaintenance[3] = calculateMaintenance("PHEV");
        $powertrainMaintenance[4] = calculateMaintenance("FCEV");
        $powertrainMaintenance[5] = calculateMaintenance("BEV");

        return $powertrainMaintenance;
    }

    function calculatePowertrainRepair()
    {
        include_once "powertrainData.php";

        $powertrainRepair[0] = calculateRepair("ICE-SI");
        $powertrainRepair[1] = calculateRepair("ICE-CI");
        $powertrainRepair[2] = calculateRepair("HEV-SI");
        $powertrainRepair[3] = calculateRepair("PHEV");
        $powertrainRepair[4] = calculateRepair("FCEV");
        $powertrainRepair[5] = calculateRepair("BEV");

        return $powertrainRepair;
    }
?>