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

    function calculateExtraChargingTime($numYears)
    {
        include "getID.php";

        $totalCost;

        $technology = $_POST["technology"];
        $vehicleSize = $_POST["vehicleBody"];
        $modelYear = $_POST["modelYear"];

        $utilityFactorQuery = "SELECT PHEV_Utility_Factor FROM hdv_phev_utility_factor WHERE Technology LIKE '$technology' AND Size LIKE '$vehicleSize' AND Model_Year LIKE '$modelYear'";
        $utilityFactor = $connect->query($utilityFactorQuery); $utilityFactor = $utilityFactor->fetch_assoc(); $utilityFactor = $utilityFactor["PHEV_Utility_Factor"];

        $costPerMile = ((37.95 / $fuelMPG) / 50) * 30;

        for($i = 0; $i < $numYears; $i++)
        {
            if($_POST["powertrain"] === "PHEV")
            {
                $totalCost[$i] = $costPerMile * $annualVmtYears[$i] * $utilityFactor;
            }
            else if($_POST["powertrain"] === "BEV")
            {
                $totalCost[$i] = $costPerMile * $annualVmtYears[$i];
            }
            else
            {
                $totalCost[$i] = 0;
            }
        }

        return $totalCost;
    }

    function calculateNewLaborCost($numYears)
    {
        include "getID.php";

        $totalCost;
        $extraPayload;
        $downTime;
        $extraCharge;

        $laborCostPerMile = .789968;

        $chargingTime = calculateExtraChargingTime($numYears);

        if($_POST["vehicleClassSize"] === "HDV")
        {
            for($i = 0; $i < $numYears; $i++)
            {
                $totalCost[$i] = $laborCostPerMile * $annualVmtYears[$i] + $chargingTime[$i];
            }
        }
        else
        {
            for($i = 0; $i < $numYears; $i++)
            {
                $totalCost[$i] = 0;
            }
        }

        return $totalCost;
    }
?>