<?php 
    function newMaintenanceMain($numYears)
    {
        include "connectDatabase.php";

        $totalMaintenance;
        $sumProduct;

        $maintenanceInfoQuery = "SELECT * FROM maintenance_updated";
        $powertrain = $_POST["powertrain"];

        $maintenanceInformationFetch = $connect->query($maintenanceInfoQuery);

        $maintenanceActivity;
        $cost;
        $firstService;
        $repeatVMT;
        $ice_si_cost;
        $ice_ci_cost;
        $hev_si_cost;
        $phev_cost;
        $fcev_cost;
        $bev_cost;
        $pricePerServiceForRevelantPowertrains;
        $powertrainScalingFactor;

        $i = 0;

        while($maintenanceInformation = $maintenanceInformationFetch->fetch_assoc())
        {
            $maintenanceActivity[$i] = $maintenanceInformation["Maintenance_Activity"];
            $cost[$i] = $maintenanceInformation["Cost"];
            $firstService[$i] = $maintenanceInformation["First_Service"];
            $repeatVMT[$i] = $maintenanceInformation["Repeat_VMT"];
            $ice_si_cost[$i] = $maintenanceInformation["ICE_SI"];
            $ice_ci_cost[$i] = $maintenanceInformation["ICE_CI"];
            $hev_si_cost[$i] = $maintenanceInformation["HEV_SI"];
            $phev_cost[$i] = $maintenanceInformation["PHEV"];
            $fcev_cost[$i] = $maintenanceInformation["FCEV"];
            $bev_cost[$i] = $maintenanceInformation["BEV"];
            $pricePerServiceForRevelantPowertrains[$i] = $maintenanceInformation["Price_Per_Service_For_Revelant_Powertrain"];

            $i++;
        }

        switch($powertrain)
        {
            case "ICE-SI":
                $powertrainScalingFactor = $ice_si_cost;
                break;
            case "ICE-CI":
                $powertrainScalingFactor = $ice_ci_cost;
                break;
                case "HEV-SI":
                $powertrainScalingFactor = $hev_si_cost;
                break;
            case "PHEV":
                $powertrainScalingFactor = $phev_cost;
                break;
            case "FCEV":
                $powertrainScalingFactor = $fcev_cost;
                break;
            case "BEV":
                $powertrainScalingFactor = $bevcost;
                break;
        }

        for($i = 0; $i < $numYears; $i++)
        {
            for($j = 0; $j < sizeof($maintenanceActivity); $j++)
            {
                $sumProduct[$j] = ((floor((calculateCumulativeVmt($i) + $repeatVMT[$j] - $firstService[$j]) / $repeatVMT[$j])) - (floor((calculateCumulativeVmt($i - 1) + $repeatVMT[$j] - $firstService[$j]) / $repeatVMT[$j]))) * $powertrainScalingFactor[$j];
            }
            $totalMaintenance[$i] = array_sum($sumProduct);
            echo $totalMaintenance[$i] .  " " . " " . " " . "  ";
        }
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

        if($numYears == 0)
        {
            return $annualVmtYears[0];
        }
        else if($numYears < 0)
        {
            return 0;
        }

        return $totalVMT;
    }
?>