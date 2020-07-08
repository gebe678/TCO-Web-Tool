<?php 

    function calculateMaintenanceCost($index)
    {
        include "getID.php";

        $previousNum = 0;
        $totalCost;
        $flag;
        $componentCost;

        for($i = 0; $i < 20; $i++)
        {
            if(calculateCumulativeVmt($i) < $firstServiceResults[$index] + $repeatServiceResults[$index] And $previousNum + 0 == 0)
            {
                $flag[$i] = floor(calculateCumulativeVmt($i) / $firstServiceResults[$index]);
                $flag[$i] = round($flag[$i]);
                $previousNum += $flag[$i];
            }
            else
            {
                $flag[$i] = floor((calculateCumulativeVmt($i) - $firstServiceResults[$index] - ($previousNum - 1) * $repeatServiceResults[$index]) / $repeatServiceResults[$index]);
                $previousNum += $flag[$i];
            }

            $componentCost[$i] = $flag[$i] * $costDataResults[$index] * $scalingFactorResults[$index];

            echo $componentCost[$i] . "<br>";
        }

        return $componentCost;
    }

    function calculateRepairCost($index)
    {
        include "getID.php";

        $previousNum = 0;
        $totalCost;
        $flag;
        $componentCost;

        for($i = 0; $i < 20; $i++)
        {
            if(calculateCumulativeVmt($i) < $firstRepairServiceResults[$index] + $repeatRepairServiceResults[$index] And $previousNum + 0 == 0)
            {
                $flag[$i] = floor(calculateCumulativeVmt($i) / $firstRepairServiceResults[$index]);
                $flag[$i] = round($flag[$i]);
                $previousNum += $flag[$i];
            }
            else
            {
                $flag[$i] = floor((calculateCumulativeVmt($i) - $firstRepairServiceResults[$index] - ($previousNum - 1) * $repeatRepairServiceResults[$index]) / $repeatRepairServiceResults[$index]);
                $previousNum += $flag[$i];
            }

            $componentCost[$i] = $flag[$i] * $repairCostDataResults[$index] * $scalingRepairFactorResults[$index];

            echo $componentCost[$i] . "<br>";
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