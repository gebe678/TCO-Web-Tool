<?php 

    function calculateBiofuelCost($index)
    {
        include "getID.php";

        $totalCost;
        $min;

        for($i = 0; $i < 30; $i++)
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
            $totalCost[$i] = getGasolineData(0) + $biofuelPremium * ($biofuelCost - $min) / $biofuelCost;
            $totalCost[$i] = floor($totalCost[$i] * 100) / 100;
        }
        return $totalCost[$index];
    }

    function calculateHydrogenCost($index)
    {
        include "getID.php";

        $totalCost;
        $min;

        for($i = 0; $i < 30; $i++)
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
            $totalCost[$i] = floor($totalCost[$i] * 100) / 100;
        }
        return $totalCost[$index];
    }

    function caluclatePercentageIncrease()
    {
        include "getID.php";

        $totalCost[0] = getGasolineData(0);

        for($i = 1; $i < 30; $i++)
        {
            $totalCost[$i] = $totalCost[$i - 1] * (1 + ($annualFuelPriceIncrease * .01));
            $totalCost[$i] = $totalCost[$i];
        }
        return $totalCost;
    }

    function calculateAnnualFuelCost()
    {
        include "getID.php";

        $fuelPrice = 0;
        $MPGCost;
        if($powertrain === "BEV")
        {
            $MPGCost = $bevMPG;
        }
        else
        {
            $MPGCost = $fuelMPG;
        }
        $fuelPricePerMile = $MPGCost * (1 - .001);

        if($fuelType == "Biofuel")
        {
            $fuelPrice = calculateBiofuelCost(1);
        }
        else if($fuelType == "Hydrogen")
        {
            $fuelPrice = calculateHydrogenCost(1);
        }
        else
        {
            $fuelPrice = getFuelData(1);
        }

        $fuelPricePerMile = ($fuelPrice / $fuelMPG) * $annualVmt;
        $fuelPricePerMile = floor($fuelPricePerMile * 100) / 100;
        
        return $fuelPricePerMile;
    }
?>
