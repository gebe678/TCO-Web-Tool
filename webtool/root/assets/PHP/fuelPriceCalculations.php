<?php 

    function calculateBiofuelCost()
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
        return $totalCost;
    }

    function calculateHydrogenCost()
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
        return $totalCost;
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
?>
