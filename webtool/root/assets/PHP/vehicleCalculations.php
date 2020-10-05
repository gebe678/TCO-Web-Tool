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
?>
