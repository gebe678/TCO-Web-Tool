<?php 
    function calculateTaxesAndFees($numYears)
    {
        $vehicleBodyCost = $_POST["vehicleBody"];
        $markupFactor = $_POST["markupFactor"];
        $purchaseCost = $vehicleBodyCost * $markupFactor;
        
        $salesTaxAndTitle = $_POST["salesTax"];
        $annualRegistration = $_POST["annualRegistration"];
        $totalCost;

        for($i = 0; $i < $numYears; $i++)
        {
            if($i == 0)
            {
                $totalCost[$i] = $purchaseCost * $salesTaxAndTitle + $annualRegistration;
            }
            else
            {
                $totalCost[$i] = $annualRegistration;
            }
        }

        return $totalCost;
    }
?>