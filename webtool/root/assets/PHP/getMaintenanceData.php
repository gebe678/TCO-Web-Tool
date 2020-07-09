<?php 
        include "connectDatabase.php";

        $powertrain = $_GET["powertrain"];
        $scalingFactorPowertrain = $powertrain . "_Scaling_Factor";
        $scalingFactorPowertrain = str_replace("-", "_", $scalingFactorPowertrain);
        $firstServiceQuery = "SELECT First_Service_VMT FROM maintenance_cost";
        $repeatServiceQuery = "SELECT Repeat_VMT FROM maintenance_cost";
        $costDataQuery = "SELECT Cost FROM maintenance_cost";
        $scalingFactorQuery = "SELECT $scalingFactorPowertrain FROM maintenance_cost";

        $firstService = $connect->query($firstServiceQuery);
        $repeatService = $connect->query($repeatServiceQuery);
        $costData = $connect->query($costDataQuery);
        $scalingFactor = $connect->query($scalingFactorQuery);

        function getMaintenanceFirstService()
        {
            $i = 0;
            while($firstServiceResult = $firstService->fetch_assoc())
            {
                $firstServiceResults[$i] = $firstServiceResult["First_Service_VMT"];
                $i++;
            } 
            return firstServiceResults;
        }
    
        function getMaintenanceRepeatService()
        {
            $i = 0;
            while($repeatServiceResult = $repeatService->fetch_assoc())
            {
                $repeatServiceResults[$i] = $repeatServiceResult["Repeat_VMT"];
                $i++;
            }
    
            $i = 0;
            while($costDataResult = $costData->fetch_assoc())
            {
                $costDataResults[$i] = $costDataResult["Cost"];
                $i++;
            }
        }
        
        function getMaintenanceScalingFactor()
        {
            $i = 0;
            while($scalingFactorResult = $scalingFactor->fetch_assoc())
            {
                $scalingFactorResults[$i] = $scalingFactorResult[$scalingFactorPowertrain];
                $i++;
            }
        }
?>