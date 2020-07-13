<?php 
        function getMaintenanceFirstService()
        {
            include "connectDatabase.php";

            $firstServiceQuery = "SELECT First_Service_VMT FROM maintenance_cost";
            $firstService = $connect->query($firstServiceQuery);

            $i = 0;
            while($firstServiceResult = $firstService->fetch_assoc())
            {
                $firstServiceResults[$i] = $firstServiceResult["First_Service_VMT"];
                $i++;
            } 
            return $firstServiceResults;
        }
    
        function getMaintenanceRepeatService()
        {
            include "connectDatabase.php";

            $repeatServiceQuery = "SELECT Repeat_VMT FROM maintenance_cost";
            $repeatService = $connect->query($repeatServiceQuery);

            $i = 0;
            while($repeatServiceResult = $repeatService->fetch_assoc())
            {
                $repeatServiceResults[$i] = $repeatServiceResult["Repeat_VMT"];
                $i++;
            }
            return $repeatServiceResults;
        }

        function getMaintenanceCostDataResults()
        {
            include "connectDatabase.php";

            $costDataQuery = "SELECT Cost FROM maintenance_cost";
            $costData = $connect->query($costDataQuery);

            $i = 0;
            while($costDataResult = $costData->fetch_assoc())
            {
                $costDataResults[$i] = $costDataResult["Cost"];
                $i++;
            }
            return $costDataResults;
        }
        
        function getMaintenanceScalingFactor()
        {
            include "connectDatabase.php";

            $powertrain = $_GET["powertrain"];
            $scalingFactorPowertrain = $powertrain . "_Scaling_Factor";
            $scalingFactorPowertrain = str_replace("-", "_", $scalingFactorPowertrain);

            $scalingFactorQuery = "SELECT $scalingFactorPowertrain FROM maintenance_cost";
            $scalingFactor = $connect->query($scalingFactorQuery);

            $i = 0;
            while($scalingFactorResult = $scalingFactor->fetch_assoc())
            {
                $scalingFactorResults[$i] = $scalingFactorResult[$scalingFactorPowertrain];
                $i++;
            }
            return $scalingFactorResults;
        }
?>