<?php 
    function calculateTaxesAndFees($numYears)
    {
        $purchaceCost = $_GET["purchaseCost"];
        $salesTaxAndTitle = $_GET["salesTax"];
        $annualRegistration = $_GET["annualRegistration"];
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