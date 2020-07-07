<?php 
    function calculateMaintenanceCost()
    {
        include "getID.php";

        
    }

    function calculateOilCost()
    {
        include "getID.php";

        $previousNum = 0;
        $totalCost;

        for($i = 0; $i < 20; $i++)
        {
            if(calculateCumulativeVmt($i) < $firstServiceResults[0] + $repeatServiceResults[0] And $previousNum + 0 == 0)
            {
                floor(caluclateCumulativeVmt($i) / $firstServiceResults[0]);
            }
            else
            {
                
            }
        }
    }

    function calculateCumulativeVmt($numYears)
    {
        include "getID.php";
        
        $totalVMT = 0;

        for($i = 0; $i < $numYears; $i++)
        {
            $totalVMT = $totalVMT + $annualVmtYears[$i];
        }

        return $totalVMT;
    }
?>