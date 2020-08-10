<?php
    include "getID.php";

    $vehicleInput;
    $annualFuel;

    if($vehicleInput == "autonomie")
    {
        if($powertrain == "bev")
        {
            $vehicleInput = $bevCostResult;
            $annualFuel = $bevMPG;
        }
        else if($powertrain == "phev")
        {
            $vehicleInput = $phevCostResult;
            $annualFuel = $phevMPG;
        }
        else
        {
            $vehicleInput = $vehicleBodyCost;
            $annualFuel = $fuelMPG;
        }
    }
    else if($vehicleInput == "aeo")
    {
        if($powertrain == "bev")
        {
            $vehicleInput = $bevAeoResult;
            $annualFuel = $bevAeoMPG;
        }
        else if($powertrain == "phev")
        {
            $vehicleInput = $phevAeoResult;
            $annualFuel = $phevAeoMPG;
        }
        else
        {
            $vehicleInput = $vehicleAeoCost;
            $annualFuel = $fuelAeoMPG;
        }
    }
    else if($vehicleInput == "real_world_today")
    {
        if($powertrain == "bev")
        {
            $vehicleInput = $bevRealWorldResult;
            $annualFuel = $bevRealWorldMPG;
        }
        else if($powertrain == "phev")
        {
            $vehicleInput = $phevRealWorldResult;
            $annualFuel = $phevRealWorldMPG;
        }
        else
        {
            $vehicleInput = $vehicleRealWorldCost;
            $annualFuel = $fuelRealWorldMPG;
        }
    }

    if($vehicleInput == 0)
    {
        echo "vehicle yes ";
    }
    else
    {
        echo "vehicle no ";
    }

    if($annualFuel == 0)
    {
        echo "fuel yes";
    }
    else
    {
        echo "fuel no";
    }
?>