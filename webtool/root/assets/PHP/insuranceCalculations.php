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
        $userDefined = $_POST["insuranceLiability"];
        // add new value for user defined
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
        else if($insuranceType = "userDefined")
        {
            $insuranceLiability = $userDefined;
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
            $totalInsurance = calculateLDVInsurance($numYears, $insuranceLiability);
        }
        else
        {
            $totalInsurance = calcualteHDVInsurance($numYears);
        }

        return $totalInsurance;
    }

    function calcualteHDVInsurance($numYears)
    {
        include "getID.php";

        $totalInsurance;

        $vmt = $annualVmtYears;

        $HDVInsuranceFixedCosts = .06466;
        $HDVPhysicalDamageInsruance = 2.5;
        $HDVRetainedValue = calculateHDVRetainedValue($numYears);

        $insuranceType = $_POST["insuranceType"];
        $vehicleType = $_POST["vehicleBody"];
        $busOccupancy = $_POST["busOccupancy"];

        if($insuranceType === "variable")
        {
            for($i = 0; $i < $numYears; $i++)
            {
                $insuranceLiability = $HDVInsuranceFixedCosts * $annualVmtYears[$i];
                $insurancePhysicalDamage = ($HDVPhysicalDamageInsruance * 12) * $HDVRetainedValue[$i] / 1000;
                $totalInsurance[$i] = $insuranceLiability + $insurancePhysicalDamage;
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
            $userDefined = $_POST["fixedInsurance"];
            // user defined -- custom fixed value

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
        else if($insuranceType === "userDefined")
        {
            $HDVTotalInsurance = $_POST["fixedInsurance"];

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

        $insuranceType = $_POST["insuranceType"];

        if($insuranceType === "userDefined")
        {
            $deductible = $_POST["insuranceDeductable"];
        }
        else
        {
            $deductible = 500;
        }
        
        // add user defined deductible
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

            case "upper":

                include "residualValueCalculations.php";
                $residualValue = calculateUpperDepreciation($numYears);

                break;
            case "lower":

                include "residualValueCalculations.php";
                $residualValue = calculateLowerDepreciation($numYears);

                break;

            case "userDefined":

                include "residualValueCalculations.php";
                $residualValue = calculateSimpleDepreciation($numYears);
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

    function calculateHDVRetainedValue($numYears)
    {
        include "getID.php";

        $vehicle = $_POST["vehicleBody"];
        $retainedValue;

        $tractorSleeperA = -0.0975300074517685;
        $tractorSleeperB = -0.000956136815567892;

        $tractorDaycabA = -0.0928929490503211;
        $tractorDaycabB = -0.000891127462516952;

        $classBox8A = -0.0812317827637767;
        $classBox8B = -0.000122323141189712;

        $classBox6A = -0.104546162034194;
        $classBox6B = -0.000947008683718151;

        $class4StepA = -0.0680478228079685;
        $class4StepB = -0.000444861177599875;

        for($i = 0; $i < $numYears; $i++)
        {
            if($vehicle === "Tractor Sleeper")
            {
                $retainedValue[$i] = exp($tractorSleeperA * ($i + 1) + $tractorSleeperB * calculateCumulativeVmtInsurance($i) / 1000);
            }
            else if($vehicle === "Tractor Day Cab")
            {
                $retainedValue[$i] = exp($tractorDaycabA * ($i + 1) + $tractorDaycabB * calculateCumulativeVmtInsurance($i) / 1000);
            }
            else if($vehicle === "Class 8 Vocational")
            {
                $retainedValue[$i] = exp($classBox8A * ($i + 1) + $classBox8B * calculateCumulativeVmtInsurance($i) / 1000);
            }
            else if($vehicle === "Class 6 Pickup Delivery")
            {
                $retainedValue[$i] = exp($classBox6A * ($i + 1) + $classBox6B * calculateCumulativeVmtInsurance($i) / 1000);
            }
            else if($vehicle === "Class 3 Pickup Delivery")
            {
                $retainedValue[$i] = exp($class4StepA * ($i + 1) + $class4StepB * calculateCumulativeVmtInsurance($i) / 1000);
            }
            else if($vehicle === "Class 8 Bus")
            {
                $retainedValue[$i] = exp($classBox8A * ($i + 1) + $classBox8B * calculateCumulativeVmtInsurance($i) / 1000);
            }
            else if($vehicle === "Class 8 Refuse")
            {
                $retainedValue[$i] = exp($classBox8A * ($i + 1) + $classBox8B * calculateCumulativeVmtInsurance($i) / 1000);
            }

            $retainedValue[$i] = $retainedValue[$i] * $vehicleBodyCost;
        }
        
        return $retainedValue;
    }

    function calculateCumulativeVmtInsurance($numYears)
    {
        include "connectDatabase.php";

        $vmtType = $_POST["vmt"];
        $vmtQuery = "SELECT $vmtType FROM annual_vmt";

        $i = 0;
        $h = $connect->query($vmtQuery);
        while($vmtYear = $h->fetch_assoc())
        {
            $annualVmtYears[$i] = $vmtYear[$vmtType];
            $i++;
        }
        
        $totalVMT = 0;

        for($i = 0; $i < $numYears + 1; $i++)
        {
            $totalVMT = $totalVMT + $annualVmtYears[$i];
        }

        if($numYears == 0)
        {
            return $annualVmtYears[0];
        }
        else if($numYears < 0)
        {
            return 0;
        }

        return $totalVMT;
    }
?>