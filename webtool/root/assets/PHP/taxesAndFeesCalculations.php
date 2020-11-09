<?php 
    function calculateTaxesAndFees($numYears)
    {
        $vehicleBodyCost = $_POST["vehicleBody"];
        $markupFactor = $_POST["markupFactor"];
        $purchaseCost = $vehicleBodyCost * $markupFactor;
        
        $salesTaxAndTitle = $_POST["salesTax"];
        $annualRegistration = $_POST["annualRegistration"];
        $totalCost;

        for($i = 0; $i < $numYears; $i++)
        {
            if($i == 0)
            {
                $totalCost[$i] = $purchaseCost * $salesTaxAndTitle + $annualRegistration;
            }
            else
            {
                $totalCost[$i] = $annualRegistration;
            }
        }

        return $totalCost;
    }

    function calculateLDVTaxesAndFees($numYears)
    {
        include "getID.php";

        $totalCost;

        $salesTax = .084;
        $initialVehicleRegistration = 268;
        $documentationFee = 300;
        $annualVehicleRegistration = 68;
        $otherCosts = 87;

        $vehicleCost = $vehicleBodyCost * $_POST["markupFactor"];

        for($i = 0; $i < $numYears; $i++)
        {
            $totalCost[$i] = 0;

            if($i === 0 )
            {
                $totalCost[$i] += $vehicleCost * $salesTax + $initialVehicleRegistration + $documentationFee;
            }
            
            $totalCost += $annualVehicleRegistration + $otherCosts;
        }
        return $totalCost;
    }

    function calculateHDVTaxesAndFees($numYears)
    {
        $exciseTax = .12;
        $salesTax = .084;
        $highwayUseTax = 0;
        $tolls = .03054;
        $permitsAndLicenses = .024432;

        $tractorSleeper = 1723.53719686858;
        $tractorDayCab = 1723.53719686858;
        $class8Vocational = 902.429083749901;
        $class6Pickup = 902.429083749901;
        $class3Pickup = 902.429083749901;
        $class8Bus = 902.429083749901;
        $class8Refuse = 902.429083749901;

        $vehicleBody = $_POST["vehicleBody"];
    }

    calculateNewTaxesAndFees(0);
?>