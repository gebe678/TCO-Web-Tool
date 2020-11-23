<?php 

    function calculateExtraPayloadCost($numYears)
    {
        $include "getID.php";

        $averageLostPayload
        $maxCargo;

        $poundsLost;
        $densityFunction = [0.327337059, 0.021192767, 0.037993616, 0.012269246, 0.067911802, 0.003142159, 0.013569916, 0.011235652, 0.019413392, 0.001805398, 0.053941842, 0.002000789, 0.013165971, 0.003779177, 0.010442722, 0.001683131, 0.056760236, 0.001263924, 0.002451938, 0.000674786, 0.039785142, 0.001030453, 0.002501075, 0.000294086, 0.004987094, 0.0000632188166629377,	0.007146832, 0.000106059, 0.005407912, 0.004291872, 0.071360019, 0.000595126, 0.001951327, 0.000955503, 0.003204052, 0.000784919, 0.004421243, 0.005529566, 0.002671055, 0.000339753, 0.025899947, 0.003009626, 0.000852256, 0.00096624, 0.001846688, 0.000398568, 0.000901518, 0.000524504, 0.001511042,0.0000580685827293109];

        $weightAllowence = 0;

        if($fuelType === "CNG" OR $powertrain === "BEV")
        {
            $weightAllowence = 2000;
        }

        for($i = 0; $i < 50; $i++)
        {
            if($i === 0)
            {
                $capacity = $vehicleWeight - $vehicleWeight - $weightAllowence;
                if($capacity > 0)
                {
                    $poundsLost[$i] = $capacity;
                }
                else
                {
                    $poundsLost = 0;
                }
            }
            else
            {
                if($poundsLost[$i - 1] > 0)
                {
                    $poundsLost[$i] = $poundsLost[$i - 1];
                }
                else
                {
                    $poundsLost[$i] = 0;
                }
            }
        }
        $fractionalLoss = 
    }

?>