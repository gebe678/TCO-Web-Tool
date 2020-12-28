<?php 
    // Old insurance calculations no longer used

    // function calculateInsuranceCost($numYears)
    // {
    //     include "getID.php";

    //     $insuranceCost;
    //     $insuranceProportionalNumber = 0;
    //     $bodyCost = calculateBodyDepreciation($numYears);

    //     for($i = 0; $i < $numYears; $i++)
    //     {
    //         $insuranceProportionalNumber = $insuranceProportional * $bodyCost[$i];
    //         $insuranceCost[$i] = $insuranceProportionalNumber + $insuranceFixed;
    //     }

    //     return $insuranceCost;
    // }

    function calculateNewInsuranceCost($numYears)
    {
        $totalInsurance;

        $AVERAGE = 600;
        $MIN = 300;
        $MAX = 1000;
        // $SD1HIGH = 750;
        // $SD1LOW = 400;

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
        // else if($insuranceType === "SD1+")
        // {
        //     $insuranceLiability = $SD1HIGH;
        // }
        // else if($insuranceType === "SD1-")
        // {
        //     $insuranceLiability = $SD1LOW;
        // }

        if($_POST["vehicleClassSize"] === "LDV")
        {
            $totalInsurance = calculateLDVInsurance(30, $insuranceLiability);
        }
        else
        {
            $totalInsurance = calcualteHDVInsurance(30);
        }

        return $totalInsurance;
    }

    function calcualteHDVInsurance($numYears)
    {
        include "getID.php";

        $totalInsurance;
        $HDVRetainedValue;

        $vmt = $annualVmtYears;

        $HDVInsuranceFixedCosts = .062;
        $HDVPhysicalDamageInsruance = 2.5;

        $insuranceType = $_POST["insuranceType"];
        $vehicleType = $_POST["vehicleBody"];
        $busOccupancy = $_POST["busOccupancy"];

        if($insuranceType === "variable")
        {
            $HDVInsuranceFixedCosts = .065;
            $HDVPhysicalDamageInsruance = .025;
        

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
                echo $HDVRetainedValue[$i] . " " . " " . " ";
                $totalInsurance[$i] = ($HDVInsuranceFixedCosts * $vmt[$i]) + ($HDVPhysicalDamageInsruance * $HDVRetainedValue[$i] / 1000);
            }
        }
        else if($insuranceType === "fixed")
        {
            $sleeper = 7500;
            $daycab  = 7500;
            $cls8voc = 5000;
            $cls6pd  = 5000;
            $cls3pd  = 3000;
            $transbus_less15 = 9000;
            $transbus_plus15 = 35000;
            $cls8ref = 7500;

            $HDVTotalInsurance = 0;

            switch($vehicleType)
            {
                case "Tractor Sleeper":
                    $HDVTotalInsurance = $sleeper;
                    break;
                case "Tractor Day Cab":
                    $HDVTotalInsurance = $daycab;
                    break;
                case "Class 8 Vocational":
                    $HDVTotalInsurance = $cls8voc;
                    break;
                case "Class 6 Pickup Delivery":
                    $HDVTotalInsurance = $cls6pd;
                    break;
                case "Class 3 Pickup Delivery":
                    $HDVTotalInsurance = $cls3pd;
                    break;
                case "Class 8 Refuse":
                    $HDVTotalInsurance = $cls8ref;

                    if($busOccupancy === "lessThan15")
                    {
                        $HDVTotalInsurance = $transbus_less15;
                    }
                    else if($busOccupancy === "greaterThan15")
                    {
                        $HDVTotalInsurance = $transbus_plus15;
                    }
                    break;
                default:
                    echo "incorrect input";
            }

            for($i = 0; $i < $numYears; $i++)
            {
                $totalInsurance[$i] = $HDVTotalInsurance;
            }
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
                $comprehensivePremiumB = .01071;
                $comprehensivePremiumA = 261.8;
                break;

            case "Medium SUV":
            case "Small SUV":
            case "Luxury Small SUV":
            case "Luxury Medium SUV":
                $comprehensivePremiumB = .00595;
                $comprehensivePremiumA = 285.6;
                break;
            
            case "Pickup":
            case "Luxury Pickup":
                $comprehensivePremiumB = .00714;
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
            if((($residualValue[$i + 1] - $deductible) * $comprehensiveCutoff) > (($residualValue[0] * $comprehensivePremiumB) + $comprehensivePremiumA))
            {
                $totalInsurance[$i] = $insuranceLiability + (($residualValue[0] * $comprehensivePremiumB) + $comprehensivePremiumA);
            }
            else
            {
                $totalInsurance[$i] = $insuranceLiability;
            }
        }
        return $totalInsurance;
    }
?>