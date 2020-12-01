<?php 
    // function calculatePayloadCost($numYears)
    // {
    //     include "getID.php";

    //     // add to detailed view
    //     $costPerMile = $_POST["payloadCost"];
    //     $vmt = $annualVmtYears;
    //     $totalCost;

    //     for($i = 0; $i < $numYears; $i++)
    //     {
    //         $totalCost[$i] = $costPerMile * $vmt[$i];
    //     }

    //     return $totalCost;
    // }

    // function calculateChargingTime($numYears)
    // {
    //     include "getID.php";

    //     // add to detailed view
    //     $costPerMile = $_POST["chargingTime"];
    //     $vmt = $annualVmtYears;
    //     $totalCost;

    //     for($i = 0; $i < $numYears; $i++)
    //     {
    //         $totalCost[$i] = $costPerMile * $vmt[$i];
    //     }

    //     return $totalCost;
    // }

    // function calculateFuelInfrastructure($numYears)
    // {
    //     // add to detailed view
    //     $costPerYearVehicle = $_POST["fuelInfrastructure"];
    //     $totalCost;

    //     for($i = 0; $i < $numYears; $i++)
    //     {
    //         $totalCost[$i] = $costPerYearVehicle;
    //     }

    //     return $totalCost;
    // }

    function calculateOperationalCost($numYears)
    {
        $totalCost;
        $payload = calculatePayloadCost($numYears);
        $chargingTime = calculateChargingTime($numYears);
        $fuelInfrastructure = calculateChargingTime($numYears);

        for($i = 0; $i < $numYears; $i++)
        {
            $totalCost[$i] = $payload[$i] + $chargingTime[$i] + $fuelInfrastructure[$i];
        }

        return $totalCost;
    }
?>