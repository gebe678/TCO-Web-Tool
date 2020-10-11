<?php

    function calculateSimpleDepreciation($numYears)
    {
        include "getID.php";

        $bodyCost;
        $bodyType = $powertrain;
        $vBodyCost;
        $vehicleIncentive = $_POST["vehicleIncentive"];

        if($bodyType === "BEV")
        {
            if($vehicleInput == "autonomie")
            {
                $vBodyCost = $bevCostResult;
            }
            else if($vehicleInput == "aeo")
            {
                $vBodyCost = $bevAeoResult;
            }
            else if($vehicleInput == "real_world_today")
            {
                $vBodyCost = $bevRealWorldResult;
            }
        }
        else if($bodyType === "PHEV")
        {
            if($vehicleInput == "autonomie")
            {
                $vBodyCost = $phevCostResult;
            }
            else if($vehicleInput == "aeo")
            {
                $vBodyCost = $phevAeoResult;
            }
            else if($vehicleInput == "real_world_today")
            {
                $vBodyCost = $phevRealWorldResult;
            }
        }
        else
        {
            if($vehicleInput == "autonomie")
            {
                $vBodyCost = $vehicleBodyCost;
            }
            else if($vehicleInput == "aeo")
            {
                $vBodyCost = $vehicleAeoCost;
            }
            else if($vehicleInput == "real_world_today")
            {
                $vBodyCost = $vehicleRealWorldCost;
            }
        }

        if($vehicleInput == "userDefined")
        {
            $vBodyCost = $_POST["purchaseCost"];
        }

        if($vBodyCost == 0)
        {
            $vBodyCost = $_POST["bodyCostPlugin"];
        }

        if($vehicleIncentive > $vBodyCost)
        {
            $vehicleIncentive = $vBodyCost;
        }

        $vBodyCost = $vBodyCost - $vehicleIncentive;
        $bodyCost[0] = $vBodyCost * $markupFactor;
        $oldCost = $bodyCost[0];

        for($i = 0; $i < $numYears; $i++)
        {
            $bodyCost[$i] = $oldCost * $depreciationRate;
            $oldCost = $oldCost - $bodyCost[$i];
        }

        return $bodyCost;
    }

    function calculateAdvancedDepreciation($numYears)
    {
        include "getID.php";

        $year = 1;
        $vBodyCost;
        $vehicleIncentive = $_POST["vehicleIncentive"];

        if($bodyType === "BEV")
        {
            if($vehicleInput == "autonomie")
            {
                $vBodyCost = $bevCostResult;
            }
            else if($vehicleInput == "aeo")
            {
                $vBodyCost = $bevAeoResult;
            }
            else if($vehicleInput == "real_world_today")
            {
                $vBodyCost = $bevRealWorldResult;
            }
        }
        else if($bodyType === "PHEV")
        {
            if($vehicleInput == "autonomie")
            {
                $vBodyCost = $phevCostResult;
            }
            else if($vehicleInput == "aeo")
            {
                $vBodyCost = $phevAeoResult;
            }
            else if($vehicleInput == "real_world_today")
            {
                $vBodyCost = $phevRealWorldResult;
            }
        }
        else
        {
            if($vehicleInput == "autonomie")
            {
                $vBodyCost = $vehicleBodyCost;
            }
            else if($vehicleInput == "aeo")
            {
                $vBodyCost = $vehicleAeoCost;
            }
            else if($vehicleInput == "real_world_today")
            {
                $vBodyCost = $vehicleRealWorldCost;
            }
        }

        if($vehicleIncentive > $vBodyCost)
        {
            $vehicleIncentive = $vBodyCost;
        }

        $vBodyCost = $vBodyCost - $vehicleIncentive;
        $bodyCost = $vBodyCost * $markupFactor;
        $rate;
        $rate[0] = 0;
        for($i = 0; $i < $numYears; $i++)
        {
            if($year <= $writeOff)
            {
                $rate[$i] = $bodyCost / $writeOff;
            }
            else
            {
                $rate[$i] = 0;
            }
            $year++;
        }

        return $rate;
    }

    function calculateDepreciation($numYears)
    {
        $depreciationType = $_POST["depreciation"];
        $depreciation;

        if($depreciationType == "simple")
        {
            $depreciation = calculateSimpleDepreciation($numYears);
        }
        else if($depreciationType == "advanced")
        {
            $depreciation = calculateAdvancedDepreciation($numYears);
        }

        return $depreciation;
    }

    function calculateBodyDepreciation($numYears)
    {
        include "getID.php";

        $vBodyCost;
        $vehicleIncentive = $_POST["vehicleIncentive"];

        $depreciationType = $_POST["depreciation"];

        if($powertrain === "BEV")
        {
            if($vehicleInput == "autonomie")
            {
                $vBodyCost = $bevCostResult;
            }
            else if($vehicleInput == "aeo")
            {
                $vBodyCost = $bevAeoResult;
            }
            else if($vehicleInput == "real_world_today")
            {
                $vBodyCost = $bevRealWorldResult;
            }
        }
        else if($powertrain === "PHEV")
        {
            if($vehicleInput == "autonomie")
            {
                $vBodyCost = $phevCostResult;
            }
            else if($vehicleInput == "aeo")
            {
                $vBodyCost = $phevAeoResult;
            }
            else if($vehicleInput == "real_world_today")
            {
                $vBodyCost = $phevRealWorldResult;
            }
        }
        else
        {
            if($vehicleInput == "autonomie")
            {
                $vBodyCost = $vehicleBodyCost;
            }
            else if($vehicleInput == "aeo")
            {
                $vBodyCost = $vehicleAeoCost;
            }
            else if($vehicleInput == "real_world_today")
            {
                $vBodyCost = $vehicleRealWorldCost;
            }
        }

        if($vehicleInput == "userDefined")
        {
            $vBodyCost = $_POST["purchaseCost"];
        }

        $bodyCost;

        $depreciation = calculateSimpleDepreciation($numYears);

        if($vehicleIncentive > $vBodyCost)
        {
            $vehicleIncentive = $vBodyCost;
        }

        $vBodyCost = $vBodyCost - $vehicleIncentive;
        $previousCost = $vBodyCost * $markupFactor;
        $bodyCost[0] = $previousCost;

        for($i = 1; $i < $numYears; $i++)
        {
            $bodyCost[$i] = $previousCost - $depreciation[$i - 1];
            $previousCost = $bodyCost[$i];
        }

        return $bodyCost;
    }

    function calculate_LDV_PHEV_UtilityFactor()
    {
        $phevRange = $_POST["phevRange"];
        $economyInput = $_POST["vehicleCostInput"];
        $result = 0;

        if($phevRange === "20")
        {
            if($economyInput === "aeo")
            {
                $result = 0.271;
            }
            else
            {
                $result = 0.456;
            }
        }
        else if($phevRange === "50")
        {
            if($economyInput === "aeo")
            {
                $result = 0.677;
            }
            else
            {
                $result = 0.743;
            }
        }

        return $result;
    }

    function calculateBatterySize()
    {
        include "connectDatabase.php";

        $powertrain = $_POST["powertrain"];
        $vehicleBody = $_POST["vehicleBody"];
        $technology = $_POST["technology"];
        $modelYear = $_POST["modelYear"];

        $phevRange = $_POST["phevRange"];
        $phevMPGRange = "PHEV_" . $phevRange . "_MPG";

        $bevRange = $_POST["bevRange"];
        $bevMPGRange = "BEV_" . $bevRange . "_MPG";

        $bevFuelEconomyQuery = "SELECT $bevMPGRange FROM bev_costs WHERE Technology LIKE '$technology' AND Size LIKE '$vehicleBody' AND Model_Year LIKE '$modelYear'";
        $bevFuelEconomy = $connect->query($bevFuelEconomyQuery); $bevFuelEconomy = $bevFuelEconomy->fetch_assoc(); $bevFuelEconomy = $bevFuelEconomy[$bevMPGRange];

        $phevFuelEconomyQuery = "SELECT $phevMPGRange FROM phev_costs WHERE Technology LIKE '$technology' AND Size LIKE '$vehicleBody' AND Model_Year LIKE '$modelYear'";
        $phevFuelEconomy = $connect->query($phevFuelEconomyQuery); $phevFuelEconomy = $phevFuelEconomy->fetch_assoc(); $phevFuelEconomy = $phevFuelEconomy[$phevMPGRange];

        $batterySize = 0;

        if($powertrain === "BEV")
        {
            $batterySize = ($bevRange / $bevFuelEconomy) * 33.7;
        }
        else if($powertrain === "PHEV")
        {
            if($phevRange === "20")
            {
                $batterySize = (20 / $phevFuelEconomy) * 33.7;
            }
            else if($phevRange === "50")
            {
                $batterySize = (50 / $phevFuelEconomy) * 33.7;
            }
        }

        return $batterySize;
    }
?>
