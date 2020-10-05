<?php 
    function calculateInterestPayment($numYears)
    {
        include "getID.php";

        $vBodyCost;
        $vehicleIncentive = $_POST["vehicleIncentive"];

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

        if($vBodyCost == 0)
        {
            $vBodyCost = $_POST["bodyCostPlugin"];
        }
        
        $financeTerm = $_POST["financeTerm"];
        $year = 1;
        $markupFactor = $_POST["markupFactor"];
        if($vehicleIncentive > $vBodyCost)
        {
            $vehicleIncentive = $vBodyCost;
        }
        $vBodyCost = $vBodyCost - $vehicleIncentive;
        $vehicleCost = $vBodyCost * $markupFactor;
        $financeRate = .045;
        $downPaymentPercentage = .15;
        $loanPayment[0] = $vehicleCost * (1 - .15);
        $monthlyPayment = round($loanPayment[0] * ($financeRate / 12) * pow((1 + $financeRate / 12), $financeTerm * 12) / (pow((1 + $financeRate / 12), $financeTerm * 12) - 1), 7);
        $fianceCost;
        for($i = 1; $i < $numYears; $i++)
        {
            if($i < $financeTerm)
            {
                 $loanPayment[$i] = $loanPayment[$i - 1] - ($monthlyPayment * 12 - $loanPayment[$i - 1] * $financeRate);
            }
            else
            {
                $loanPayment[$i] = 0;
            }
        }

        for($i = 0; $i < $numYears; $i++)
        {
            $financeCost[$i] = $financeRate * $loanPayment[$i];
        }
        return $financeCost;
    }
?>
