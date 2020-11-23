<?php 

    // function calculate_LDV_PHEV_UtilityFactor()
    // {
    //     $phevRange = $_POST["phevRange"];
    //     $economyInput = $_POST["vehicleCostInput"];
    //     $result = 0;

    //     if($phevRange === "20")
    //     {
    //         if($economyInput === "aeo")
    //         {
    //             $result = 0.271;
    //         }
    //         else
    //         {
    //             $result = 0.456;
    //         }
    //     }
    //     else if($phevRange === "50")
    //     {
    //         if($economyInput === "aeo")
    //         {
    //             $result = 0.677;
    //         }
    //         else
    //         {
    //             $result = 0.743;
    //         }
    //     }

    //     return $result;
    // }

    function calculateExtraPayloadCost($numYears)
    {
        include "getID.php";

        $payloadCost;

        $averageLostPayload = 0;

        $poundsLost;
        $densityFunction = [0.327337059, 0.021192767, 0.037993616, 0.012269246, 0.067911802, 0.003142159, 0.013569916, 0.011235652, 0.019413392, 0.001805398, 0.053941842, 0.002000789, 0.013165971, 0.003779177, 0.010442722, 0.001683131, 0.056760236, 0.001263924, 0.002451938, 0.000674786, 0.039785142, 0.001030453, 0.002501075, 0.000294086, 0.004987094, 0.0000632188166629377,	0.007146832, 0.000106059, 0.005407912, 0.004291872, 0.071360019, 0.000595126, 0.001951327, 0.000955503, 0.003204052, 0.000784919, 0.004421243, 0.005529566, 0.002671055, 0.000339753, 0.025899947, 0.003009626, 0.000852256, 0.00096624, 0.001846688, 0.000398568, 0.000901518, 0.000524504, 0.001511042,0.0000580685827293109];

        $maxWeight = 80000;
        $weightAllowence = 0;

        $iceciVehicleWeightQuery = "SELECT Vehicle_Weight FROM vehicle_weight WHERE Powertrain LIKE 'ICE-CI' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
        $iceciVehicleWeight = $connect->query($iceciVehicleWeightQuery); $iceciVehicleWeight = $iceciVehicleWeight->fetch_assoc(); $iceciVehicleWeight = $iceciVehicleWeight["Vehicle_Weight"];

        if($fuelType === "CNG" OR $powertrain === "BEV")
        {
            $weightAllowence = 2000;
        }

        for($i = 0; $i < 50; $i++)
        {
            if($i === 0)
            {
                $capacity = $vehicleWeight - $iceciVehicleWeight - $weightAllowence;
                if($capacity > 0)
                {
                    $poundsLost[$i] = $capacity;
                }
                else
                {
                    $poundsLost[$i] = 0;
                }
            }
            else
            {
                if($poundsLost[$i - 1] - 500 > 0)
                {
                    $poundsLost[$i] = $poundsLost[$i - 1] - 500;
                }
                else
                {
                    $poundsLost[$i] = 0;
                }
            }
            $averageLostPayload += $poundsLost[$i] * $densityFunction[$i];
        }

        $maxCargo = ($maxWeight + $weightAllowence) - $vehicleWeight + $cargoWeight;
        
        $fractionalLoss = $averageLostPayload / $maxCargo;

        for($i = 0; $i < $numYears; $i++)
        {
            $payloadCost[$i] = $fractionalLoss * $annualVmtYears[$i];
        }

        return $payloadCost;
    }

    function calculateDowntimeOppurtunityCost($numYears)
    {
        include "getID.php";

        $averageDowntime = .1048;
        $downtimeOppurtunityCost;
        $laborCostPerHour = 30.00;

        $costPerMile = ((37.95 / $fuelMPG) / 50) * $laborCostPerHour;

        $phevUtilityFactor;

        if($_POST["vehicleClassSize"] === "HDV")
        {
            $phevUtilityFactorQuery = "SELECT PHEV_Utility_Factor FROM hdv_phev_utility_factor WHERE Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
            $phevUtilityFactor = $connect->query($phevUtilityFactorQuery); $phevUtilityFactor = $phevUtilityFactor->fetch_assoc(); $phevUtilityFactor = $phevUtilityFactor["PHEV_Utility_Factor"];
        }
        else
        {
            $phevUtilityFactor = calculate_LDV_PHEV_UtilityFactor();
        }

        if($powertrain === "BEV")
        {
            for($i = 0; $i < $numYears; $i++)
            {
                $downtimeOppurtunityCost[$i] = $costPerMile * $annualVmtYears[$i];
            }
        }
        else if($powertrain === "PHEV")
        {
            for($i = 0; $i < $numYears; $i++)
            {
                $downtimeOppurtunityCost[$i] = $costPerMile * $phevUtilityFactor;
            }
        }
        else
        {
            for($i = 0; $i < $numYears; $i++)
            {
                $downtimeOppurtunityCost[$i] = 0;
            }
        }

        return $downtimeOppurtunityCost;
    }

    function calculateNewOperationalCost($numYears)
    {
        $a = calculateExtraPayloadCost($numYears);
        $b = calculateDowntimeOppurtunityCost($numYears);

        $operationalCost;

        for($i = 0; $i < $numYears; $i++)
        {
            $operationalCost[$i] = $a[$i] + $b[$i];
            //echo $operationalCost[$i] .  " " . " " . " ";
        }

        return $operationalCost;
    }

    calculateNewOperationalCost(30);

?>