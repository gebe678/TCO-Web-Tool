<?php
    include "fuelPriceCalculations.php";
    include "maintenancePriceCalculations.php";
    include "vehicleCalculations.php";
    include "insuranceCalculations.php";
    include "taxesAndFeesCalculations.php";
    include "financeCalculations.php";

    $analysisWindow = $_POST["analysisWindow"];

    $vehicleBodyCost = calculateDepreciation($analysisWindow);
    $financeCost = calculateInterestPayment($analysisWindow);
    $annualFuelCost = calculateAnnualFuelcost($analysisWindow);
    $insuranceCost = calculateInsurancecost($analysisWindow);
    $taxesAndFees = calculateTaxesAndFees($analysisWindow);
    $maintenance = calculateTotalMaintenance($analysisWindow);
    $repair = calculateTotalRepair($analysisWindow);

    $TCO_information = array($vehicleBodyCost, $financeCost, $annualFuelCost, $insuranceCost, $taxesAndFees, $maintenance, $repair);

    echo json_encode($TCO_information);
?>