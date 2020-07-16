<?php 
    function calculateTaxesAndFees($numYears)
    {
        $purchaceCost = $_POST["purchaseCost"];
        $salesTaxAndTitle = $_POST["salesTax"];
        $annualRegistration = $_POST["annualRegistration"];
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