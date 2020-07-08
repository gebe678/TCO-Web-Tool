<?php 
    function calculateTaxesAndFees($numYears)
    {
        $purchaceCost = 20000;
        $salesTaxAndTitle = .05;
        $annualRegistration = 100;
        $totalCost;

        for($i = 0; $i < $numYears; $i++)
        {
            if($i == 0)
            {
                $totalCost[$i] = $purchaceCost * $salesTaxAndTitle + $annualRegistration;
            }
            else
            {
                $totalCost[$i] = $annualRegistration;
            }
        }

        return $totalCost;
    }
?>