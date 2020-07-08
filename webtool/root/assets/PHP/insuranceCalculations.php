<?php 
    function calculateInsuranceCost($numYears)
    {
        include "getID.php";

        $insuranceCost;
        $insuranceProportionalNumber = 0;
        $bodyCost = calculateBodyDepreciation($numYears);

        for($i = 0; $i < $numYears; $i++)
        {
            $insuranceProportionalNumber = $insuranceProportional * $bodyCost[$i];
            $insuranceCost[$i] = $insuranceProportionalNumber + $insuranceFixed;
        }

        return $insuranceCost;
    }

?>