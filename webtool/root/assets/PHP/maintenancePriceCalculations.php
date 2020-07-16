<?php 

    function calculateMaintenanceCost($component, $numYears)
    {
        include_once "getMaintenanceData.php";

        $previousNum = 0;
        $totalCost;
        $flag;
        $componentCost;
        $firstServiceResults = getMaintenanceFirstService();
        $repeatServiceResults = getMaintenanceRepeatService();
        $costDataResults = getMaintenanceCostDataResults();
        $scalingFactorResults = getMaintenanceScalingFactor();

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

    function calculateTotalMaintenance($numYears)
    {
        $maintenanceCost;
        $oilCost = calculateMaintenanceCost(0, $numYears);
        $tireCost = calculateMaintenanceCost(1, $numYears);
        $airFilterCost = calculateMaintenanceCost(2, $numYears);
        $batteryCost = calculateMaintenanceCost(3, $numYears);
        $fluidCost = calculateMaintenanceCost(4, $numYears);
        $brakes1Cost = calculateMaintenanceCost(5, $numYears);
        $beltsAndHosesCost = calculateMaintenanceCost(6, $numYears);

        for($i = 0; $i < $numYears; $i++)
        {
            $maintenanceCost[$i] = $oilCost[$i] + $tireCost[$i] + $airFilterCost[$i] + $batteryCost[$i] + $batteryCost[$i] + $fluidCost[$i] + $brakes1Cost[$i] + $beltsAndHosesCost[$i];
        }

        return $maintenanceCost;
    }

    function calculateRepairCost($component, $numYears)
    {
        include_once "getRepairData.php";

        $previousNum = 0;
        $totalCost;
        $flag;
        $componentCost;
        $firstRepairServiceResults = getRepairFirstService();
        $repeatRepairServiceResults = getRepairRepeatService();
        $repairCostDataResults = getRepairCostDataResults();
        $scalingRepairFactorResults = getRepairScalingFactor();

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

    function calculatetotalRepair($numYears)
    {
        $repairCost;
        $brakes2Cost = calculateRepairCost(0, $numYears);
        $transmissionCost = calculateRepairCost(1, $numYears);
        $engineCost = calculateRepairCost(2, $numYears);
        $hvBatteryCost = calculateRepairCost(3, $numYears);
        $fcStack = calculateRepairCost(4, $numYears);
        $bodyCost = calculateRepairCost(5, $numYears);

        for($i = 0; $i < $numYears; $i++)
        {
            $repairCost[$i] = $brakes2Cost[$i] + $transmissionCost[$i] + $engineCost[$i] + $hvBatteryCost[$i] + $fcStack[$i] + $bodyCost[$i];
        }

        return $repairCost;
    }

    function calculateCumulativeVmt($numYears)
    {
        include "connectDatabase.php";
        
        $vmtType = $_POST["vmt"];
        $vmtQuery = "SELECT $vmtType FROM annual_vmt";

        $i = 0;
        $h = $connect->query($vmtQuery);
        while($vmtYear = $h->fetch_assoc())
        {
            $annualVmtYears[$i] = $vmtYear[$vmtType];
            $i++;
        }
        
        $totalVMT = 0;

        for($i = 0; $i < $numYears + 1; $i++)
        {
            $totalVMT = $totalVMT + $annualVmtYears[$i];
        }

        return $totalVMT;
    }
?>