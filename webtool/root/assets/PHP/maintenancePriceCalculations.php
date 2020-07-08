<?php 

    function calculateMaintenanceCost($component, $numYears)
    {
        include "getID.php";

        $previousNum = 0;
        $totalCost;
        $flag;
        $componentCost;

        for($i = 0; $i < $numYears; $i++)
        {
            if(calculateCumulativeVmt($i) < $firstServiceResults[$component] + $repeatServiceResults[$component] And $previousNum + 0 == 0)
            {
                $flag[$i] = floor(calculateCumulativeVmt($i) / $firstServiceResults[$component]);
                $flag[$i] = round($flag[$i]);
                $previousNum += $flag[$i];
            }
            else
            {
                $flag[$i] = floor((calculateCumulativeVmt($i) - $firstServiceResults[$component] - ($previousNum - 1) * $repeatServiceResults[$component]) / $repeatServiceResults[$component]);
                $previousNum += $flag[$i];
            }

            $componentCost[$i] = $flag[$i] * $costDataResults[$component] * $scalingFactorResults[$component];
        }

        return $componentCost;
    }

    function calculateRepairCost($component, $numYears)
    {
        include "getID.php";

        $previousNum = 0;
        $totalCost;
        $flag;
        $componentCost;

        for($i = 0; $i < $numYears; $i++)
        {
            if(calculateCumulativeVmt($i) < $firstRepairServiceResults[$component] + $repeatRepairServiceResults[$component] And $previousNum + 0 == 0)
            {
                $flag[$i] = floor(calculateCumulativeVmt($i) / $firstRepairServiceResults[$component]);
                $flag[$i] = round($flag[$i]);
                $previousNum += $flag[$i];
            }
            else
            {
                $flag[$i] = floor((calculateCumulativeVmt($i) - $firstRepairServiceResults[$component] - ($previousNum - 1) * $repeatRepairServiceResults[$component]) / $repeatRepairServiceResults[$component]);
                $previousNum += $flag[$i];
            }

            $componentCost[$i] = $flag[$i] * $repairCostDataResults[$component] * $scalingRepairFactorResults[$component];
        }

        return $componentCost;
    }

    function calculateCumulativeVmt($numYears)
    {
        include "getID.php";
        
        $totalVMT = 0;

        for($i = 0; $i < $numYears + 1; $i++)
        {
            $totalVMT = $totalVMT + $annualVmtYears[$i];
        }

        return $totalVMT;
    }
?>