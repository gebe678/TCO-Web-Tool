<?php 

    function calculateBiofuelCost($numYears)
    {
        include "getID.php";

        $totalCost;
        $min;

        for($i = 0; $i < $numYears + 1; $i++)
        {
            $fuelData = $biofuelCost;
            $yearInfo = getFuelID($i);

            if($yearInfo <= $fuelData)
            {
                $min = $yearInfo;
            }
            else if($fuelData < $yearInfo)
            {
                $min = $fuelData;
            }
            $totalCost[$i] = getGasolineData($i) + $biofuelPremium * ($biofuelCost - $min) / $biofuelCost;
            $totalCost[$i] = round($totalCost[$i], 2);
        }
        return $totalCost;
    }

    function calculateHydrogenCost($numYears)
    {
        include "getID.php";

        $totalCost;
        $min;

        for($i = 0; $i < $numYears + 1; $i++)
        {
            $yearInfo = getFuelID($i);

            if($yearInfo <= $hydrogenCost)
            {
                $min = $yearInfo;
            }
            else if($hydrogenCost > $yearInfo)
            {
                $min = $hydrogenCost;
            }
            $totalCost[$i] = 5 + $hydrogenPremium * ($hydrogenCost - $min) / $hydrogenCost;
            $totalCost[$i] = round($totalCost[$i], 2);
        }

        return $totalCost;
    }

    function calculateDieselElectricCost($numYears)
    {
        include "getID.php";
        $PHEVUtilityFactor = 0.3;
        $totalCost;

        for($i = 0; $i < $numYears + 1; $i++)
        {
            $totalCost[$i] = getDieselData($i) * (1 - $PHEVUtilityFactor) + getElectricData($i) * $PHEVUtilityFactor;
        }

        return $totalCost;
    }

    function calculatePremiumGasolineCost($numYears)
    {
        include "getID.php";

        $totalCost;

        for($i = 0; $i < $numYears + 1; $i++)
        {
            $totalCost[$i] = getGasolineData($i) + $premiumGasMarkup;
        }

        return $totalCost;
    }

    function caluclatePercentageIncrease($numYears)
    {
        include "getID.php";

        $fuelPriceType = $_POST["fuelPriceMethod"];
        
        if($fuelPriceType == "increase")
        {
            if($fuelType == "Diesel_Electric")
            {
                $dieselElec = calculateDieselElectricCost($numYears);
                $totalCost[0] = $dieselElec[0];
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

    function calculateAnnualFuelCost($numYears)
    {
        include "getID.php";
        include_once "getFuelCostData.php";

        $fuelPrice;
        $MPGCost;
        $fuelPricePerMile;
        $annualFuelPrice;
        $mpgYearDegradation = .001;
        $fuelPriceType = $_POST["fuelPriceMethod"];

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

        if($MPGCost == 0)
        {
            $MPGCost = $_POST["mpgPlugin"];
        }
        
        if($fuelPriceType == "defined")
        {
            if($fuelType == "Biofuel")
            {
                $fuelPrice = calculateBiofuelCost($numYears);
            }
            else if($fuelType == "Hydrogen")
            {
                $fuelPrice = calculateHydrogenCost($numYears);
            }
            else if($fuelType == "Diesel_Electric")
            {
                $fuelPrice = calculateDieselElectricCost($numYears);
            }
            else if($fuelType == "Premium_Gasoline")
            {
                $fuelPrice = calculatePremiumGasolineCost($numYears);
            }
            else
            {
                for($i = 0; $i < $numYears + 1; $i++)
                {
                    $fuelPrice[$i] = getFuelData($i);
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
            $MPGCost = round($MPGCost * (1 - $mpgYearDegradation), 8);
            $fuelPricePerMile[$i] = $fuelPrice[$i + 1] / $MPGCost;
        }
        
        for($i = 0; $i < $numYears; $i++)
        {
            $annualFuelPrice[$i] = $fuelPricePerMile[$i] * $annualVmtYears[$i];
        }
       
        return $annualFuelPrice;
    }
?>
