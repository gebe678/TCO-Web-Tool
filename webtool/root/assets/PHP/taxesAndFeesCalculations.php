<?php 
    // No longer used old calculations
    
    // function calculateTaxesAndFees($numYears)
    // {
    //     $vehicleBodyCost = $_POST["vehicleBody"];
    //     $markupFactor = $_POST["markupFactor"];
    //     $purchaseCost = $vehicleBodyCost * $markupFactor;
        
    //     $salesTaxAndTitle = $_POST["salesTax"];
    //     $annualRegistration = $_POST["annualRegistration"];
    //     $totalCost;

    //     for($i = 0; $i < $numYears; $i++)
    //     {
    //         if($i == 0)
    //         {
    //             $totalCost[$i] = $purchaseCost * $salesTaxAndTitle + $annualRegistration;
    //         }
    //         else
    //         {
    //             $totalCost[$i] = $annualRegistration;
    //         }
    //     }

    //     return $totalCost;
    // }

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
            
            $totalCost[$i] += $annualVehicleRegistration + $otherCosts;
        }
        return $totalCost;
    }

    function calculateHDVTaxesAndFees($numYears)
    {
        include "getID.php";

        $totalCost;

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

        $vehicleCost = $vehicleBodyCost * $_POST["markupFactor"];

        $vehicleBody = $_POST["vehicleBody"];

        $registration = 0;

        switch($vehicleBody)
        {
            case "Tractor Sleeper":
                $registration = $tractorSleeper;
            break;
            case "Tractor Day Cab":
                $registration = $tractorDayCab;
            break;
            case "Class 8 Vocational":
                $registration = $class8Vocational;
            break;
            case "Class 6 Pickup Delivery":
                $registration = $class6Pickup;
            break;
            case "Class 3 Pickup Delivery":
                $registration = $class3Pickup;
            break;
            case "Class 8 Bus":
                $registration = $class8Bus;
            break;
            case "Class 8 Refuse":
                $registration = $class8Refuse;
            break;
        }

        for($i = 0; $i < $numYears; $i++)
        {
            $totalCost[$i] = 0;

            if($i === 0 AND ($vehicleBody === "Tractor Sleeper" OR $vehicleBody === "Tractor Day Cab" OR $vehicleBody === "Class 8 Vocational" OR $vehicleBody === "Class 8 Bus" OR $vehicleBody === "Class 8 Refuse"))
            {
                $totalCost[$i] += $vehicleCost * $exciseTax;
                $totalCost[$i] += $vehicleCost * $salesTax;   /// This should only happen if a vehicle is new
            }
            
            $totalCost[$i] += ($tolls + $permitsAndLicenses) * $annualVmtYears[$i] + $registration;
        }

        return $totalCost;
    }

    function calculateNewTaxesAndFees($numYears)
    {
        $totalCost;

        if($_POST["vehicleClassSize"] === "LDV")
        {
            $totalCost = calculateLDVTaxesAndFees($numYears);
        }
        else
        {
            $totalCost = calculateHDVTaxesAndFees($numYears);
        }

        return $totalCost;
    }
?>