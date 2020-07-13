<?php 
        function getRepairFirstService()
        {
            include "connectDatabase.php";

            $firstRepairServiceQuery = "SELECT First_Service_VMT FROM repair_activity";
            $firstRepairService = $connect->query($firstRepairServiceQuery);

            $i = 0;
            while($firstRepairServiceResult = $firstRepairService->fetch_assoc())
            {
                $firstRepairServiceResults[$i] = $firstRepairServiceResult["First_Service_VMT"];
                $i++;
            }

            return $firstRepairServiceResults;
        }

        function getRepairRepeatService()
        {
            include "connectDatabase.php";

            $repeatRepairServiceQuery = "SELECT Repeat_VMT FROM repair_activity";
            $repeatRepairService = $connect->query($repeatRepairServiceQuery);

            $i = 0;
            while($repeatRepairServiceResult = $repeatRepairService->fetch_assoc())
            {
                $repeatRepairServiceResults[$i] = $repeatRepairServiceResult["Repeat_VMT"];
                $i++;
            }

            return $repeatRepairServiceResults;
        }

        function getRepairCostDataResults()
        {
            include "connectDatabase.php";

            $repairCostDataQuery = "SELECT Cost FROM repair_activity";
            $costRepairData = $connect->query($repairCostDataQuery);

            $i = 0;
            while($repairCostDataResult = $costRepairData->fetch_assoc())
            {
                $repairCostDataResults[$i] = $repairCostDataResult["Cost"];
                $i++;
            }

            return $repairCostDataResults;
        }
        
        function getRepairScalingFactor()
        {
            include "connectDatabase.php";

            $powertrain = $_GET["powertrain"];
            $scalingRepairFactorPowertrain = $powertrain . "_Scaling_Factor";
            $scalingRepairFactorPowertrain = str_replace("-", "_", $scalingRepairFactorPowertrain);

            $scalingRepairFactorQuery = "SELECT $scalingRepairFactorPowertrain FROM repair_activity";
            $scalingRepairFactor = $connect->query($scalingRepairFactorQuery);

            $i = 0;
            while($scalingRepairFactorResult = $scalingRepairFactor->fetch_assoc())
            {
                $scalingRepairFactorResults[$i] = $scalingRepairFactorResult[$scalingRepairFactorPowertrain];
                $i++;
            }

            return $scalingRepairFactorResults;
        }
?>