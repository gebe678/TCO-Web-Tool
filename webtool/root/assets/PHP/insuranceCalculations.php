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

    function calculateNewInsruanceCost($numYears)
    {
        $AVERAGE = 600;
        $MIN = 300;
        $MAX = 1000;
        $SD1HIGH = 750;
        $SD1LOW = 400;
        $comprehensiveCutoff = .1;
        $deductible = 500;

        $insuranceType = $_POST["insuranceType"];

        
    }

    function calcualteHDVInsurance($numYears)
    {

    }

    function calculateLDVInsurance($numYears)
    {

    }

    calculateNewInsruanceCost(0);
?>