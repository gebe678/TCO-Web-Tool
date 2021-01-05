<?php 

    function newMaintenanceMain($numYears)
    {
        $totalMaintenance;
        if($_POST["vehicleClassSize"] === "LDV")
        {
            $totalMaintenance = newLDVMaintenanceMain($numYears);
        }
        else
        {
            $totalMaintenance = newHDVMaintenanceMain($numYears);
        }

        return $totalMaintenance;
    }

    function newLDVMaintenanceMain($numYears)
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
                $powertrainScalingFactor = $bev_cost;
                break;
        }

        for($i = 0; $i < $numYears; $i++)
        {
            for($j = 0; $j < sizeof($maintenanceActivity); $j++)
            {
                $sumProduct[$j] = ((floor((calculateCumulativeVmt($i) + $repeatVMT[$j] - $firstService[$j]) / $repeatVMT[$j])) - (floor((calculateCumulativeVmt($i - 1) + $repeatVMT[$j] - $firstService[$j]) / $repeatVMT[$j]))) * $powertrainScalingFactor[$j];
            }
            $totalMaintenance[$i] = array_sum($sumProduct);
        }

        for($i = 0; $i < $numYears; $i++)
        {
            if($i - 2 == -2)
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 3;
            }
            else if($i - 2 == -1)
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 4;
            }
            else if($i + 2 == $numYears)
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1]) / 4;
            }
            else if($i + 2 == $numYears + 1)
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i]) / 3;
            }
            else
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 5;
            }
        }

        return $smoothedMaintenanceCost;
    }

    function newHDVMaintenanceMain($numYears)
    {
        include "connectDatabase.php";

        $totalMaintenance;
        $smoothedMaintenanceCost;

        $vehicleBodyInfo = $_POST["vehicleBody"];
        $vehicleInfo;
        $i = 0;

        $getInfoQuery = "SELECT * FROM maintenance_updated_hdv";

        $c = $connect->query($getInfoQuery);

        while($h = $c->fetch_assoc())
        {
            $vehicleInfo[$i] = $h[$vehicleBodyInfo];
            $i++;
        }

        $vmtType = $_POST["vmt"];
        $vmtQuery = "SELECT $vmtType FROM annual_vmt";

        $i = 0;
        $h = $connect->query($vmtQuery);
        while($vmtYear = $h->fetch_assoc())
        {
            $annualVmtYears[$i] = $vmtYear[$vmtType];
            $i++;
        }

        for($i = 0; $i < $numYears; $i++)
        {
            $totalMaintenance[$i] = $vehicleInfo[$i] * $annualVmtYears[$i];
        }

        for($i = 0; $i < $numYears; $i++)
        {
            if($i - 2 == -2)
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 3;
            }
            else if($i - 2 == -1)
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 4;
            }
            else if($i + 2 == $numYears)
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1]) / 4;
            }
            else if($i + 2 == $numYears + 1)
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i]) / 3;
            }
            else
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 5;
            }
        }

        return $smoothedMaintenanceCost;
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

    function newLDVRepair($numYears)
    {
        include "getID.php";

        $ldvRepairCurve;
        $repairAgingFactor = Array(0, 0, 0.00333333333333333, 0.01,	0.016666667, 0.02, 0.023333333, 0.026666667, 0.03, 0.033333333, 0.036666667, 0.04, 0.043333333, 0.046666667, 0.05, 0.053333333, 0.056666667, 0.06, 0.063333333, 0.066666667, 0.07, 0.073333333, 0.076666667, 0.08, 0.083333333, 0.086666667, 0.09, 0.093333333, 0.096666667, 0.1, 0.103333333, 0.106666667, 0.11, 0.113333333, 0.116666667);

        $vehicleBody = $_POST["vehicleBody"];
        $powertrain = $_POST["powertrain"];
        $sizeMultiplier = 0;
        $powertrainMultiplier = 0;

        // reminder remove the 8600 for the APU add in
        $vehicleCost = $vehicleBodyCost * $_POST["markupFactor"] + 8600;

        $ldvRepair;

        switch($vehicleBody)
        {
            case "Compact Sedan":
            case "Midsize Sedan":
            case "Luxury Compact":
            case "Luxury Midsize Car":
                $sizeMultiplier = 1;
                break;
            
            case "Small SUV":
            case "Medium SUV":
            case "Luxury Small SUV":
            case "Luxury Medium SUV":
                $sizeMultiplier = .95;
                break;

            case "Pickup":
            case "Luxury Pickup":
                $sizeMultiplier = .75;
                break;

            default:
                $sizeMultiplier = 0;
        }

        switch($powertrain)
        {
            case "ICE-SI":
                $powertrainMultiplier = 1;
                break;
            case "ICE-CI":
                $powertrainMultiplier = 1;
                break;
            case "HEV-SI":
                $powertrainMultiplier = .89;
                break;
            case "PHEV":
                $powertrainMultiplier = .86;
                break;
            case "FCEV":
                $powertrainMultiplier = .67;
                break;
            case "BEV":
                $powertrainMultiplier = .67;
                break;

            default:
                $powertrainMultiplier = 0;
        }

        for($i = 0; $i < $numYears; $i++)
        {
            $ldvRepairCurve[$i] = $repairAgingFactor[$i] * $sizeMultiplier * $powertrainMultiplier * exp(0.00002 * $vehicleCost);
            $ldvRepair[$i] = $ldvRepairCurve[$i] * $annualVmtYears[$i];
        }

        return $ldvRepair;
    }

    function newRepairCalculations($numYears)
    {
        $repair;
        if($_POST["vehicleClassSize"] === "LDV")
        {
            $repair = newLDVRepair($numYears);
        }
        else
        {
            for($i = 0; $i < $numYears; $i++)
            {
                $repair[$i] = 0;
            }
        }

        return $repair;
    }
?>