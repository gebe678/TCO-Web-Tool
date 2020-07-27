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

    function caluclatePercentageIncrease($numYears)
    {
        include "getID.php";

        if($fuelType == "Biofuel")
        {
            $bioCost = calculateBiofuelCost(1);
            $totalCost[0] = $bioCost[0];
        }
        else if($fuelType == "Hydrogen")
        {
            $hydroCost = calculateHydrogenCost(1);
            $totalCost[0] = $hydroCost[0];
        }
        else if($fuelType == "Diesel_Electric")
        {
            $dieselElec = calculateDieselElectricCost($numYears);
            $totalCost[0] = $dieselElec[0];
        }
        else
        {
            $totalCost[0] = getFuelData(0);
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
            $MPGCost = $bevMPG;
        }
        else
        {
            $MPGCost = $fuelMPG;
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
