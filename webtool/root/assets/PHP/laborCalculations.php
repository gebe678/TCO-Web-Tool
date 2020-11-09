<?php 
    function calculateLaborCost($numYears)
    {
        include "getID.php";

        $totalCost;
        for($i = 0; $i < $numYears; $i++)
        {
            $totalCost[$i] = $annualVmtYears[$i] * $laborCost;
            $totalCost[$i] = round($totalCost[$i]);
        }

        return $totalCost;
    }

    function calculateNewLaborCost($numYears)
    {
        include "getID.php";

        $totalCost;
        $extraPayload;
        $downTime;
        $extraCharge;

        $laborCostPerMile = .789968;

        if($_POST["vehicleClassSize"] === "HDV")
        {
            for($i = 0; $i < $numYears; $i++)
            {
                $totalCost[$i] = $laborCostPerMile * $annualVmtYears[$i];
            }
        }
        else
        {
            for($i = 0; $i < $numYears; $i++)
            {
                $totalCost[$i] = 0;
            }
        }

        return $totalCost;
    }
    calculateNewLaborCost(30);
?>