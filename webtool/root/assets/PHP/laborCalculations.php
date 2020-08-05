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
?>