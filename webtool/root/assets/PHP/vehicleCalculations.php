<?php

    function calculateSimpleDepreciation($numYears)
    {
        include "getID.php";

        $bodyCost;
        $bodyType = $powertrain;
        $vBodyCost;

        if($bodyType === "BEV")
        {
            $vBodyCost = $bevCostResult;
        }
        else
        {
            $vBodyCost = $vehicleBodyCost;
        }

        if($vBodyCost == 0)
        {
            $vBodyCost = $_POST["bodyCostPlugin"];
        }

        $bodyCost[0] = $vBodyCost * $markupFactor;
        $oldCost = $bodyCost[0];

        for($i = 0; $i < $numYears; $i++)
        {
            $bodyCost[$i] = $oldCost * $depreciationRate;
            $oldCost = $oldCost - $bodyCost[$i];
        }

        return $bodyCost;
    }

    function calculateBodyDepreciation($numYears)
    {
        include "getID.php";

        $vBodyCost;

        if($powertrain === "BEV")
        {
            $vBodyCost = $bevCostResult;
        }
        else
        {
            $vBodyCost = $vehicleBodyCost;
        }

        $bodyCost;
        $depreciation = calculateSimpleDepreciation($numYears);
        $previousCost = $vBodyCost * $markupFactor;
        $bodyCost[0] = $previousCost;

        for($i = 1; $i < $numYears; $i++)
        {
            $bodyCost[$i] = $previousCost - $depreciation[$i - 1];
            $previousCost = $bodyCost[$i];
        }

        return $bodyCost;
    }

    function calculateAdvancedDepreciation($numYears)
    {
        include "getID.php";

        $year = 1;
        $bodyCost = $vehicleBodyCost * $markupFactor;
        $rate;
        $rate[0] = 0;
        echo "<br>";
        for($i = 0; $i < $numYears; $i++)
        {
            if($year <= $writeOff)
            {
                $rate[$i] = $bodyCost / $writeOff;
            }
            else
            {
                $rate[$i] = 0;
            }
            $year++;
        }

        return $rate;
    }
?>
