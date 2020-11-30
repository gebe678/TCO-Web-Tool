<?php 

    // No longer used
    // function calculateBiofuelCost($numYears)
    // {
    //     include "getFuelCostData.php";

    //     $totalCost;
    //     $min;
    //     $fuelModifier = 0;

    //     switch($modelYear)
    //     {
    //         case 2020:
    //             $fuelModifier = 0;
    //             break;
    //         case 2025:
    //             $fuelModifier = 5;
    //             break;
    //         case 2030:
    //             $fuelModifier = 10;
    //             break;
    //         case 2035:
    //             $fuelModifier = 15;
    //             break;
    //         case 2050:
    //             $fuelModifier = 30;
    //     }

    //     for($i = 0; $i < $numYears + 1; $i++)
    //     {
    //         if($i + $fuelModifier === 31)
    //         {
    //             $fuelModifier--;
    //         }

    //         $fuelData = $biofuelCost;
    //         $yearInfo = getFuelID($i + $fuelModifier);

    //         if($yearInfo <= $fuelData)
    //         {
    //             $min = $yearInfo;
    //         }
    //         else if($fuelData < $yearInfo)
    //         {
    //             $min = $fuelData;
    //         }
    //         $totalCost[$i] = getGasolineData($i + $fuelModifier) + $biofuelPremium * ($biofuelCost - $min) / $biofuelCost;
    //         $totalCost[$i] = round($totalCost[$i], 2);
    //     }
    //     return $totalCost;
    // }
    
    // No longer used
    // function calculateHydrogenCost($numYears)
    // {
    //     include "getID.php";

    //     $totalCost;
    //     $min = 0;
    //     $fuelModifier = 0;

    //     switch($modelYear)
    //     {
    //         case 2020:
    //             $fuelModifier = 0;
    //             break;
    //         case 2025:
    //             $fuelModifier = 5;
    //             break;
    //         case 2030:
    //             $fuelModifier = 10;
    //             break;
    //         case 2035:
    //             $fuelModifier = 15;
    //             break;
    //         case 2050:
    //             $fuelModifier = 30;
    //     }

    //     for($i = 0; $i < $numYears + 1; $i++)
    //     {
    //         if($i + $fuelModifier === 31)
    //         {
    //             $fuelModifier--;
    //         }

    //         $yearInfo = getFuelID($i + $fuelModifier);

    //         if($yearInfo <= $hydrogenCost)
    //         {
    //             $min = $yearInfo;
    //         }
    //         else if($hydrogenCost > $yearInfo)
    //         {
    //             $min = $hydrogenCost;
    //         }
    //         $totalCost[$i] = 5 + $hydrogenPremium * ($hydrogenCost - $min) / $hydrogenCost;
    //         $totalCost[$i] = round($totalCost[$i], 2);
    //     }

    //     return $totalCost;
    // }

    function calculateDieselElectricCost($numYears)
    {
        include "getID.php";
        $PHEVUtilityFactor = calculate_LDV_PHEV_UtilityFactor();
        $totalCost;
        $fuelModifier = 0;

        switch($modelYear)
        {
            case 2020:
                $fuelModifier = 0;
                break;
            case 2025:
                $fuelModifier = 5;
                break;
            case 2030:
                $fuelModifier = 10;
                break;
            case 2035:
                $fuelModifier = 15;
                break;
            case 2050:
                $fuelModifier = 30;
        }

        for($i = 0; $i < $numYears + 1; $i++)
        {
            if($i + $fuelModifier === 31)
            {
                $fuelModifier--;
            }

            $totalCost[$i] = getDieselData($i + $fuelModifier) * (1 - $PHEVUtilityFactor) + getElectricData($i + $fuelModifier) * $PHEVUtilityFactor;
        }

        return $totalCost;
    }

    function calculateGasElectricCost($numYears)
    {
        include "getID.php";
        $PHEVUtilityFactor = calculate_LDV_PHEV_UtilityFactor();
        $totalCost;
        $fuelModifier = 0;

        switch($modelYear)
        {
            case 2020:
                $fuelModifier = 0;
                break;
            case 2025:
                $fuelModifier = 5;
                break;
            case 2030:
                $fuelModifier = 10;
                break;
            case 2035:
                $fuelModifier = 15;
                break;
            case 2050:
                $fuelModifier = 30;
        }

        for($i = 0; $i < $numYears + 1; $i++)
        {
            if($i + $fuelModifier === 31)
            {
                $fuelModifier--;
            }

            $totalCost[$i] = getGasolineData($i + $fuelModifier) * (1 - $PHEVUtilityFactor) + getElectricData($i + $fuelModifier) * $PHEVUtilityFactor;
        }

        return $totalCost;
    }

    function calculatePremiumGasElectricCost($numYears)
    {
        include "getID.php";
        $PHEVUtilityFactor = calculate_LDV_PHEV_UtilityFactor();
        $totalCost;
        $fuelModifier = 0;

        switch($modelYear)
        {
            case 2020:
                $fuelModifier = 0;
                break;
            case 2025:
                $fuelModifier = 5;
                break;
            case 2030:
                $fuelModifier = 10;
                break;
            case 2035:
                $fuelModifier = 15;
                break;
            case 2050:
                $fuelModifier = 30;
        }

        for($i = 0; $i < $numYears + 1; $i++)
        {
            if($i + $fuelModifier === 31)
            {
                $fuelModifier--;
            }

            $totalCost[$i] = getPremiumGasolineData($i + $fuelModifier) * (1 - $PHEVUtilityFactor) + getElectricData($i + $fuelModifier) * $PHEVUtilityFactor;
        }

        return $totalCost;
    }

    // No longer used
    // function calculatePremiumGasolineCost($numYears)
    // {
    //     include "getID.php";

    //     $totalCost;
    //     $fuelModifier = 0;

    //     switch($modelYear)
    //     {
    //         case 2020:
    //             $fuelModifier = 0;
    //             break;
    //         case 2025:
    //             $fuelModifier = 5;
    //             break;
    //         case 2030:
    //             $fuelModifier = 10;
    //             break;
    //         case 2035:
    //             $fuelModifier = 15;
    //             break;
    //         case 2050:
    //             $fuelModifier = 30;
    //     }

    //     for($i = 0; $i < $numYears + 1; $i++)
    //     {
    //         if($i + $fuelModifier === 31)
    //         {
    //             $fuelModifier--;
    //         }

    //         $totalCost[$i] = getGasolineData($i + $fuelModifier) + $premiumGasMarkup;
    //     }

    //     return $totalCost;
    // }

    function caluclatePercentageIncrease($numYears)
    {
        include "getID.php";

        $fuelPriceType = $_POST["fuelPriceMethod"];
        
        if($fuelPriceType == "increase")
        {
            if($fuelType === "Diesel_Electric")
            {
                $dieselElec = calculateDieselElectricCost($numYears);
                $totalCost[0] = $dieselElec[0];
            }
            else if($fuelType === "Gas_Electric")
            {
                $gasElec = calculateGasElectricCost($numYears);
                $totalCost[0] = $gasElec[0];
            }
            else if($fuelType === "Premium_Electric")
            {
                $premiumElec = calculatePremiumGasElectricCost($numYears);
                $totalCost[0] = $premiumElec[0];
            }
            else
            {
                $totalCost[0] = getEnergyUseData();
            }
        }
        else if($fuelPriceType == "userDefined")
        {
            $totalCost[0] = $userDefinedFuel;
        }

        for($i = 1; $i < $numYears; $i++)
        {
            $totalCost[$i] = $totalCost[$i - 1] * (1 + ($annualFuelPriceIncrease * .01));
        }
    

        return $totalCost;
    }

    function calculateIdlingCost($numYears)
    {
        // THis calculation needs to be fixed

        // if there is an APU then use .2 
        // if there is not an APU use .8 
        // multiply the APU factor by the idle time (1800)
        return .2 * 1800;
    }

    function calculateAnnualFuelCost($numYears)
    {
        include "getID.php";
        include_once "getFuelCostData.php";

        $fuelPrice;
        $MPGCost;
        $fuelPricePerMile;
        $annualFuelPrice;
        $mpgYearDegradation = $_POST["fuelEfficiencyDegradation"];
        $fuelPriceType = $_POST["fuelPriceMethod"];
        $fuelModifier = 0;

        switch($modelYear)
        {
            case 2020:
                $fuelModifier = 0;
                break;
            case 2025:
                $fuelModifier = 5;
                break;
            case 2030:
                $fuelModifier = 10;
                break;
            case 2035:
                $fuelModifier = 15;
                break;
            case 2050:
                $fuelModifier = 30;
        }

        if($powertrain === "BEV")
        {
            if($vehicleInput == "autonomie")
            {
                $MPGCost = $bevMPG;
            }
            else if($vehicleInput == "aeo")
            {
                $MPGCost = $bevAeoMPG;
            }
            else if($vehicleInput == "real_world_today")
            {
                $MPGCost = $bevRealWorldMPG;
            }
        }
        else if($powertrain === "PHEV")
        {
            if($vehicleInput == "autonomie")
            {
                $MPGCost = $phevMPG;
            }
            else if($vehicleInput == "aeo")
            {
                $MPGCost = $phevAeoMPG;
            }
            else if($vehicleInput == "real_world_today")
            {
                $MPGCost = $phevRealWorldMPG;
            }
        }
        else
        {
            if($vehicleInput == "autonomie")
            {
                $MPGCost = $fuelMPG;
            }
            else if($vehicleInput == "aeo")
            {
                $MPGCost = $fuelAeoMPG;
            }
            else if($vehicleInput == "real_world_today")
            {
                $MPGCost = $fuelRealWorldMPG;
            }
        }

        if($vehicleInput == "userDefined" or $MPGCost == 0)
        {
            $MPGCost = $_POST["userDefinedMPG"];
        }
        
        if($fuelPriceType === "defined")
        {
            if($fuelType == "Diesel_Electric")
            {
                $fuelPrice = calculateDieselElectricCost($numYears);
            }
            else if($fuelType === "Gas_Electric")
            {
                $fuelPrice = calculateGasElectricCost($numYears);
            }
            else if($fuelType === "Premium_Electric")
            {
                $fuelPrice = calculatePremiumGasElectricCost($numYears);
            }
            else
            {
                for($i = 0; $i < $numYears + 1; $i++)
                {
                    if($i + $fuelModifier === 31)
                    {
                        $fuelModifier--;
                    }

                    $fuelPrice[$i] = getFuelData($i + $fuelModifier);
                }
            } 
        }
        else if($fuelPriceType == "increase")
        {
            $fuelPrice = caluclatePercentageIncrease($numYears + 1);
        }

        else if($fuelPriceType == "userDefined")
        {  
            $fuelPrice = caluclatePercentageIncrease($numYears + 1);
        }

        for($i = 0; $i < $numYears; $i++)
        {
            $MPGCost = $MPGCost * (1 - $mpgYearDegradation);
            $fuelPricePerMile[$i] = $fuelPrice[$i + 1] / $MPGCost;
        }
        
        for($i = 0; $i < $numYears; $i++)
        {
            $annualFuelPrice[$i] = $fuelPricePerMile[$i] * $annualVmtYears[$i];
            if($vehicleBody === "Tractor Sleeper" AND ($powertrain === "HEV-SI" OR $powertrain === "ICE-CI"))
            {
                $annualFuelPrice[$i] += calculateIdlingCost($numYears);
            }
        }
       
        return $annualFuelPrice;
    }
?>
