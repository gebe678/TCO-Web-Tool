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
        $carbonTax = caluclateCarbonEmission();

        $salesTax = $_POST["salesTax"] / 100;
        $initialVehicleRegistration = $_POST["annualRegistration"];
        $documentationFee = 300;
        $annualVehicleRegistration = 68;
        $otherCosts = 87;

        $vehicleCost = $vehicleBodyCost * $_POST["markupFactor"];

        if($powertrain === "BEV")
        {
            $otherCosts = 81;
            $annualVehicleRegistration = 141;
        }
        else if($powertrain === "HEV")
        {
            $annualVehicleRegistration = 75;
        }
        else if($powertrain === "PHEV")
        {
            $annualVehicleRegistration = 104;
        }
        else if($powertrain === "FCEV")
        {
            $annualVehicleRegistration = 141;
        }

        for($i = 0; $i < $numYears; $i++)
        {
            $totalCost[$i] = 0;

            if($i === 0 )
            {
                $totalCost[$i] += $vehicleCost * $salesTax + $initialVehicleRegistration + $documentationFee;
            }
            
            $totalCost[$i] += $annualVehicleRegistration + $otherCosts + $carbonTax;
        }
        return $totalCost;
    }

    function calculateHDVTaxesAndFees($numYears)
    {
        include "getID.php";

        $totalCost;
        $carbonTax = caluclateCarbonEmission();

        $exciseTax = .12;
        $salesTax = $_POST["salesTax"] / 100;
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
            
            $totalCost[$i] += ($tolls + $permitsAndLicenses) * $annualVmtYears[$i] + $registration + $carbonTax;
        }

        return $totalCost;
    }

    function caluclateCarbonEmission()
    {
        include "getID.php";

        $carbonTax = 0;
        $utilityFactorQuery = "SELECT PHEV_Utility_Factor FROM hdv_phev_utility_factor WHERE Technology LIKE '$technology' AND Size LIKE '$vehicleBody' AND Model_Year LIKE '$modelYear'";
        $PHEVUtilityFactor = $connect->query($utilityFactorQuery); $PHEVUtilityFactor = $PHEVUtilityFactor->fetch_assoc(); $PHEVUtilityFactor = $PHEVUtilityFactor["PHEV_Utility_Factor"];
        $ldvUtilityFactor = calculate_LDV_PHEV_UtilityFactor();

        $gasoline = 10800;
        $premiumGasoline = 10800;
        $diesel = 10700;
        $hydrogen = 12000;
        $electric = 16000;

        if($_POST["vehicleClassSize"] === "LDV")
        {
            $gasElec = $ldvUtilityFactor * $electric + (1 - $ldvUtilityFactor) * $gasoline;
            $premElec = $ldvUtilityFactor * $electric + (1 - $ldvUtilityFactor) * $premiumGasoline;
            $dieselElec = $ldvUtilityFactor * $electric + (1 - $ldvUtilityFactor) * $diesel;
        }
        else if($_POST["vehicleClassSize"] === "HDV")
        {
            $gasElec = $PHEVUtilityFactor * $electric + (1 - $PHEVUtilityFactor) * $gasoline;
            $premElec = $gasElec = $PHEVUtilityFactor * $electric + (1 - $PHEVUtilityFactor) * $premiumGasoline;
            $dieselElec = $PHEVUtilityFactor * $electric + (1 - $PHEVUtilityFactor) * $diesel;
        }

        $cng = 8800;
        $biofuel = 6500;

        $co2PerMile = 0;
        $co2CoEfficient = 0;

        switch($fuelType)
        {
            case "Gasoline":
                $co2CoEfficient = $gasoline;
                break;
            case "Premium_Gasoline":
                $co2CoEfficient = $premiumGasoline;
                break;
            case "Diesel":
                $co2CoEfficient = $diesel;
                break;
            case "CNG":
                $co2CoEfficient = $cng;
                break;
            case "Biofuel":
                $co2CoEfficient = $biofuel;
                break;
            case "Hydrogen":
                $co2CoEfficient = $hydrogen;
                break;
            case "Electric":
                $co2CoEfficient = $electric;
                break;
            case "Gas_Electric":
                $co2CoEfficient = $gasElec;
                break;
            case "Diesel_Electric":
                $co2CoEfficient = $dieselElec;
                break;
            case "Premium_Electric":
                $co2CoEfficient = $premElec;
                break;
        }

        $co2PerMile = $co2CoEfficient / $fuelMPG;

        if($_POST["vehicleClassSize"] === "HDV")
        {
            $co2PerMile = $co2PerMile * (137453 / 120080);
        }

        $carbonTax = $co2PerMile / 1000000 * $_POST["carbonEmission"];

        return $carbonTax;
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

    caluclateCarbonEmission();
?>