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

        $insuranceLiability = 0;

        $insuranceType = $_POST["insuranceType"];

        if($insuranceType === "average")
        {
            $insuranceLiability = $AVERAGE;
        }
        else if($insuranceType === "min")
        {
            $insuranceLiability = $MIN;
        }
        else if($insuranceType === "max")
        {
            $insuranceLiability = $MAX;
        }
        else if($insuranceType === "SD1+")
        {
            $insuranceLiability = $SD1HIGH;
        }
        else if($insuranceType === "SD1-")
        {
            $insuranceLiability = $SD1LOW;
        }

        calculateLDVInsurance(30, $insuranceLiability);
        calcualteHDVInsurance(30, $insuranceLiability);
        
    }

    function calcualteHDVInsurance($numYears, $insuranceLiability)
    {
        include "getID.php";

        $totalInsurance;
        $HDVRetainedValue;

        $vmt = $annualVmtYears;

        $HDVInsuranceFixedCosts = .062;
        $HDVPhysicalDamageInsruance = 2.5;

        $vehicleType = $_POST["vehicleBody"];

        $factorA = 0;
        $factorB = 0;

        switch($vehicleType)
        {
            case "Tractor Sleeper":
                $factorA = -0.0975300074517685;
                $factorB = -0.000956136815567892;
                break;
            case "Tractor Day Cab":
                $factorA = -0.0928929490503211;
                $factorB = -0.000891127462516952;
                break;
            case "Class 8 Vocational":
                $factorA = -0.0812317827637767;
                $factorB = -0.000122323141189712;
                break;
            case "Class 6 Pickup Delivery":
                $factorA = -0.104546162034194;
                $factorB = -0.000947008683718151;
                break;
            case "Class 3 Pickup Delivery":
                $factorA = -0.0680478228079685;
                $factorB = -0.000444861177599875;
                break;
            case "Class 8 Bus":
                $factorA = -0.0812317827637767;
                $factorB = -0.000122323141189712;
                break;
            case "Class 8 Refuse":
                $factorA = -0.0812317827637767;
                $factorB = -0.000122323141189712;
                break;
        }
        
        for($i = 0; $i < $numYears; $i++)
        {
            $HDVRetainedValue[$i] = exp($factorA * ($i + 1) + $factorB * $vmt[$i + 1] / 1000);
            $totalInsurance[$i] = ($HDVInsuranceFixedCosts * $vmt[$i]) + ($HDVPhysicalDamageInsruance * $HDVRetainedValue[$i] / 1000);
        }

        return $totalInsurance;
    }

    function calculateLDVInsurance($numYears, $insuranceLiability)
    {
        $totalInsurance;
        $residualValue;

        $deductible = 500;
        $comprehensiveCutoff = .1;
        $comprehensivePremiumB = 0;
        $comprehensivePremiumA = 0;

        
        $depreciationType = $_POST["depreciation"];
        $vehicleType = $_POST["vehicleBody"];

        switch($vehicleType)
        {
            case "Compact Sedan":
            case "Midsize Sedan":
            case "Luxury Midsize Car":
            case "Luxury Compact":
                $comprehensivePremiumB = .009;
                $comprehensivePremiumA = 261.8;
                break;

            case "Medium SUV":
            case "Small SUV":
            case "Luxury Small SUV":
            case "Luxury Medium SUV":
                $comprehensivePremiumB = .005;
                $comprehensivePremiumA = 285.6;
                break;
            
            case "Pickup":
            case "Luxury Pickup":
                $comprehensivePremiumB = .006;
                $comprehensivePremiumA = 249.9;
                break;
        }

        switch($depreciationType)
        {
            case "simple":

                include_once "vehicleCalculations.php";
                $residualValue = calculateSimpleDepreciation($numYears);

                break;
            case "advanced":

                include "residualValueCalculations.php";
                $residualValue = calculateAdvancedExponentialDepreciation($numYears);

                break;
            case "userDefined":

                include "residualValueCalculations.php";
                $residualValue = calculateUserDefinedDepreciation($numYears);

                break;
            case "upper":

                include "residualValueCalculations.php";
                $residualValue = calculateUpperDepreciation($numYears);

                break;
            case "lower":

                include "residualValueCalculations.php";
                $residualValue = calculateLowerDepreciation($numYears);

                break;
        }

        for($i = 0; $i < $numYears; $i++)
        {
            if(($residualValue[$i] - $deductible) * $comprehensiveCutoff > $residualValue[0] * $comprehensivePremiumA + $comprehensivePremiumB)
            {
                $totalInsurance[$i] = $insuranceLiability + $residualValue[0] * $comprehensivePremiumA + $comprehensivePremiumB;
            }
            else
            {
                $totalInsurance[$i] = 0;
            }
            
        }

        return $totalInsurance;
    }

    calculateNewInsruanceCost(0);

?>