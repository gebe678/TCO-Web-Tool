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
    }

    $TCO_information = array($vehicleBodyCost, $financeCost, $annualFuelCost, $insuranceCost, $taxesAndFees, $maintenance, $repair, $vehicleVmt);

    echo json_encode($TCO_information);

    function getVmtData()
    {
        include "getID.php";

        return $annualVmtYears;
    }
?>