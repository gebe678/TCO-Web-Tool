<?php 
    function calculateInterestPayment($numYears)
    {
        include "getID.php";

        $vBodyCost;
        if($powertrain == "BEV")
        {
            $vBodyCost = $bevCostResult;
        }
        else
        {
            $vBodyCost = $vehicleBodyCost;
        }

        if($vBodyCost == 0)
        {
            $vBodyCost = $_GET["bodyCostPlugin"];
        }
        
        $financeTerm = 30;
        $year = 1;
        $markupFactor = 1.5;
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
