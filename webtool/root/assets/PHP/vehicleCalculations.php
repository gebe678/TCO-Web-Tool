<?php

    function calculateSimpleDepreciation()
    {
        include "getID.php";

        $depreciationRate = .9;
        $markupFactor = 1.5;

        $bodyCost = $vehicleBodyCost * $markupFactor;

        for($i = 0; $i < 30; $i++)
        {
            $bodyCost = $bodyCost * $depreciationRate;
        }
    }

    function caluclateAdvancedDepreciation()
    {
        $vehicleWriteOff = 10;
        $year = 0;
        $bodyCost = $vehicleBodyCost * $markupFactor;

        if($year <= $vehicleWriteOff)
        {
            $bodyCost = $bodyCost / $markupFactor;
        }
        else
        {
            $bodyCost = 0;
        }
    }
?>
