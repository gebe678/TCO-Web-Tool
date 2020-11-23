<?php


function calculateSalvageValue($numYears)
{

}

function calculateBatterySalvage($numYears)
{

}

function calculateVehicleSalvage($numYears)
{
    
}

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

function calculateAdvancedExponentialDepreciation($numYears)
{
    include "getID.php";

    $vehicleValue = $vehicleBodyCost;
    $vehicleMarkupFactor = $markupFactor;
    $powertrain = $_POST["powertrain"];
    $advancedExponentionalValues;

    if($vehicleBody[0] === "L")
    {
        $powertrain = $powertrain . "_Luxury";
    }

    $startValue = $vehicleValue * $vehicleMarkupFactor;

    $factorAQuery = "SELECT factor_a FROM enhanced_exponentional_depreciation WHERE '$powertrain' LIKE powertrain";
    $factorBQuery = "SELECT factor_b FROM enhanced_exponentional_depreciation WHERE '$powertrain' LIKE powertrain";

    $factorA = $connect->query($factorAQuery); $factorA = $factorA->fetch_assoc(); $factorA = $factorA["factor_a"];
    $factorB = $connect->query($factorBQuery); $factorB = $factorB->fetch_assoc(); $factorB = $factorB["factor_b"];

    $oldValue = $startValue;

    for($i = 0; $i < $numYears; $i++)
    {
        $advancedExponentionalValues[$i] = $oldValue;

        $oldValue = $startValue * $factorA * exp(($i + 1) * $factorB);
    }

    return $advancedExponentionalValues;
}

function calculateUserDefinedDepreciation($numYears)
{
    include "getID.php";

    $vehicleValue = $vehicleBodyCost;
    $vehicleMarkupFactor = $markupFactor;

    $startValue = $vehicleValue * $vehicleMarkupFactor;
}

function calcuateUpperDeprecation($numYears)
{
    include "getID.php";

    $vehicleValue = $vehicleBodyCost;
    $vehicleMarkupFactor = $markupFactor;
    $powertrain = $_POST["powertrain"];
    $vehicleSize = $_POST["vehicleClassSize"];
    $isLuxury = 0;
    $upperDepreciationValues;


    $LDVClassAjustmentQuery = "SELECT ajustment FROM ldv_size_class_ajustment WHERE '$powertrain' LIKE powertrain";
    $ajustment = $connect->query($LDVClassAjustmentQuery); $ajustment = $ajustment->fetch_assoc(); $ajustment = $ajustment["ajustment"];

    $ajustmentValue = 1;

    if($vehicleBody === "Compact Sedan" OR $vehicleBody === "Midsize Sedan" OR $vehicleBody === "Luxury Compact" OR $vehicleBody === "Luxury Midsize Car")
    {
        $ajustmentValue = -1;
    }
    else
    {
        if($vehicleBody === "Small SUV" OR $vehicleBody === "Medium SUV" OR $vehicleBody === "Pickup" OR $vehicleBody === "Luxury Medium SUV" OR $vehicleBody === "Luxury Pickup")
        {
            $ajustmentValue = 1;
        }
        else
        {
            $ajustmentValue = 0;
        }
    }
    
    $vehicleMultiplier = 1 + $ajustment / 2 * $ajustmentValue;
    $highConfidenceValues;
    
    if($vehicleBody[0] === "L")
    {
        $powertrain = $powertrain . "_Luxury";
        $isLuxury = 1;
    }

    $powertrain = str_replace("-", "_", $powertrain);

    $startValue = $vehicleValue * $vehicleMarkupFactor;

    $highConfidenceQuery = "SELECT $powertrain FROM high_confidence_scrappage_value";

    $value = $connect->query($highConfidenceQuery);

    $iterator = 0;
    while($result = $value->fetch_assoc())
    {
        $highConfidenceValues[$iterator] = $result[$powertrain];
        $iterator++;
    }

    for($i = 0; $i < $numYears; $i++)
    {
        $upperDepreciationValues[$i] = $startValue * ($highConfidenceValues[$i] + 6 * $isLuxury) * $vehicleMultiplier;
    }

    return $upperDepreciationValues;
}

function calculateLowerDepreciation($numYears)
{
    include "getID.php";

    $vehicleValue = $vehicleBodyCost;
    $vehicleMarkupFactor = $markupFactor;
    $powertrain = $_POST["powertrain"];
    $vehicleSize = $_POST["vehicleClassSize"];
    $isLuxury = 0;
    $lowerDepreciationValues;


    $LDVClassAjustmentQuery = "SELECT ajustment FROM ldv_size_class_ajustment WHERE '$powertrain' LIKE powertrain";
    $ajustment = $connect->query($LDVClassAjustmentQuery); $ajustment = $ajustment->fetch_assoc(); $ajustment = $ajustment["ajustment"];

    $ajustmentValue = 1;

    if($vehicleBody === "Compact Sedan" OR $vehicleBody === "Midsize Sedan" OR $vehicleBody === "Luxury Compact" OR $vehicleBody === "Luxury Midsize Car")
    {
        $ajustmentValue = -1;
    }
    else
    {
        if($vehicleBody === "Small SUV" OR $vehicleBody === "Medium SUV" OR $vehicleBody === "Pickup" OR $vehicleBody === "Luxury Medium SUV" OR $vehicleBody === "Luxury Pickup")
        {
            $ajustmentValue = 1;
        }
        else
        {
            $ajustmentValue = 0;
        }
    }
    
    $vehicleMultiplier = 1 + $ajustment / 2 * $ajustmentValue;
    $lowConfidenceValues;
    
    if($vehicleBody[0] === "L")
    {
        $powertrain = $powertrain . "_Luxury";
        $isLuxury = 1;
    }

    $powertrain = str_replace("-", "_", $powertrain);

    $startValue = $vehicleValue * $vehicleMarkupFactor;

    $lowConfidenceQuery = "SELECT $powertrain FROM low_confidence_scrappage_value";

    $value = $connect->query($lowConfidenceQuery);

    $iterator = 0;
    while($result = $value->fetch_assoc())
    {
        $lowConfidenceValues[$iterator] = $result[$powertrain];
        $iterator++;
    }

    for($i = 0; $i < $numYears; $i++)
    {
        $lowerDepreciationValues[$i] = $startValue * ($lowConfidenceValues[$i] + 6 * $isLuxury) * $vehicleMultiplier;
    }

    return $lowerDepreciationValues;
}

    // function calculateAdvancedDepreciation($numYears)
    // {
    //     include "getID.php";

    //     $year = 1;
    //     $vBodyCost;
    //     $vehicleIncentive = $_POST["vehicleIncentive"];

    //     if($bodyType === "BEV")
    //     {
    //         if($vehicleInput == "autonomie")
    //         {
    //             $vBodyCost = $bevCostResult;
    //         }
    //         else if($vehicleInput == "aeo")
    //         {
    //             $vBodyCost = $bevAeoResult;
    //         }
    //         else if($vehicleInput == "real_world_today")
    //         {
    //             $vBodyCost = $bevRealWorldResult;
    //         }
    //     }
    //     else if($bodyType === "PHEV")
    //     {
    //         if($vehicleInput == "autonomie")
    //         {
    //             $vBodyCost = $phevCostResult;
    //         }
    //         else if($vehicleInput == "aeo")
    //         {
    //             $vBodyCost = $phevAeoResult;
    //         }
    //         else if($vehicleInput == "real_world_today")
    //         {
    //             $vBodyCost = $phevRealWorldResult;
    //         }
    //     }
    //     else
    //     {
    //         if($vehicleInput == "autonomie")
    //         {
    //             $vBodyCost = $vehicleBodyCost;
    //         }
    //         else if($vehicleInput == "aeo")
    //         {
    //             $vBodyCost = $vehicleAeoCost;
    //         }
    //         else if($vehicleInput == "real_world_today")
    //         {
    //             $vBodyCost = $vehicleRealWorldCost;
    //         }
    //     }

    //     if($vehicleIncentive > $vBodyCost)
    //     {
    //         $vehicleIncentive = $vBodyCost;
    //     }

    //     $vBodyCost = $vBodyCost - $vehicleIncentive;
    //     $bodyCost = $vBodyCost * $markupFactor;
    //     $rate;
    //     $rate[0] = 0;
    //     for($i = 0; $i < $numYears; $i++)
    //     {
    //         if($year <= $writeOff)
    //         {
    //             $rate[$i] = $bodyCost / $writeOff;
    //         }
    //         else
    //         {
    //             $rate[$i] = 0;
    //         }
    //         $year++;
    //     }

    //     return $rate;
    // }

    function calculateDepreciation($numYears)
    {
        $depreciationType = $_POST["depreciation"];
        $depreciation;

        if($depreciationType === "simple")
        {
            $depreciation = calculateSimpleDepreciation($numYears);
        }
        else if($depreciationType === "advanced")
        {
            $depreciation = calculateAdvancedExponentialDepreciation($numYears);
        }
        else if($depreciationType === "upper")
        {
            $depreciation = calcuateUpperDeprecation($numYears);
        }
        else if($depreciationType === "lower")
        {
            $depreciation = calculateLowerDepreciation($numYears);
        }

        return $depreciation;
    }

    // function calculateBodyDepreciation($numYears)
    // {
    //     include "getID.php";

    //     $vBodyCost;
    //     $vehicleIncentive = $_POST["vehicleIncentive"];

    //     $depreciationType = $_POST["depreciation"];

    //     if($powertrain === "BEV")
    //     {
    //         if($vehicleInput == "autonomie")
    //         {
    //             $vBodyCost = $bevCostResult;
    //         }
    //         else if($vehicleInput == "aeo")
    //         {
    //             $vBodyCost = $bevAeoResult;
    //         }
    //         else if($vehicleInput == "real_world_today")
    //         {
    //             $vBodyCost = $bevRealWorldResult;
    //         }
    //     }
    //     else if($powertrain === "PHEV")
    //     {
    //         if($vehicleInput == "autonomie")
    //         {
    //             $vBodyCost = $phevCostResult;
    //         }
    //         else if($vehicleInput == "aeo")
    //         {
    //             $vBodyCost = $phevAeoResult;
    //         }
    //         else if($vehicleInput == "real_world_today")
    //         {
    //             $vBodyCost = $phevRealWorldResult;
    //         }
    //     }
    //     else
    //     {
    //         if($vehicleInput == "autonomie")
    //         {
    //             $vBodyCost = $vehicleBodyCost;
    //         }
    //         else if($vehicleInput == "aeo")
    //         {
    //             $vBodyCost = $vehicleAeoCost;
    //         }
    //         else if($vehicleInput == "real_world_today")
    //         {
    //             $vBodyCost = $vehicleRealWorldCost;
    //         }
    //     }

    //     if($vehicleInput == "userDefined")
    //     {
    //         $vBodyCost = $_POST["purchaseCost"];
    //     }

    //     $bodyCost;

    //     $depreciation = calculateSimpleDepreciation($numYears);

    //     if($vehicleIncentive > $vBodyCost)
    //     {
    //         $vehicleIncentive = $vBodyCost;
    //     }

    //     $vBodyCost = $vBodyCost - $vehicleIncentive;
    //     $previousCost = $vBodyCost * $markupFactor;
    //     $bodyCost[0] = $previousCost;

    //     for($i = 1; $i < $numYears; $i++)
    //     {
    //         $bodyCost[$i] = $previousCost - $depreciation[$i - 1];
    //         $previousCost = $bodyCost[$i];
    //     }

    //     return $bodyCost;
    // }

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
