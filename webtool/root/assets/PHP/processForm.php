<?php
    include "fuelPriceCalculations.php";
    include "maintenancePriceCalculations.php";
    include "vehicleCalculations.php";
    include "insuranceCalculations.php";
    include "taxesAndFeesCalculations.php";
    include "financeCalculations.php";

    $vehicleBodyCost = calculateSimpleDepreciation(30);
    $financeCost = calculateInterestPayment(30);
    $annualFuelCost = calculateAnnualFuelcost(30);
    $insuranceCost = calculateInsurancecost(30);
    $taxesAndFees = calculateTaxesAndFees(30);
    $maintenance = calculateTotalMaintenance(30);
    $repair = calculateTotalRepair(30);

    $TCO_information = array($vehicleBodyCost, $financeCost, $annualFuelCost, $insuranceCost, $taxesAndFees, $maintenance, $repair);

    echo json_encode($TCO_information);
?>