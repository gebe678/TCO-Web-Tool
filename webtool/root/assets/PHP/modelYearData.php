<?php

    /// Vehicle Calculations
    function calculateSimpleDepreciationModelYear($numYears, $modelYear)
    {
        include "connectDatabase.php";

        $depreciationType = $_POST["depreciation"];
        $vehicleBody = $_POST["vehicleBody"];
        $technology = $_POST["technology"];
        $powertrainType = $_POST["powertrain"];
        $bevRange = $_POST["bevRange"];
        $markupFactor = $_POST["markupFactor"];
        $depreciationRate = $_POST["depreciationRate"];
        $writeOff = $_POST["writeOff"];
        $vehicleInput = $_POST["vehicleCostInput"];
        $sum = 0;

        $bevCost = "BEV_" . 200;

        $phevRange = $_POST["phevRange"];
        $phevCost = "PHEV_" . $phevRange;

        $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrainType' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
        $vehicleBodyCost = $connect->query($vehicleBodyCostQuery); $vehicleBodyCost = $vehicleBodyCost->fetch_assoc(); $vehicleBodyCost = $vehicleBodyCost["Body_Cost"];

        $bevCostQuery = "SELECT $bevCost FROM bev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE $modelYear";
        $bevCostResult = $connect->query($bevCostQuery); $bevCostResult = $bevCostResult->fetch_assoc(); $bevCostResult = $bevCostResult[$bevCost];

        $phevCostQuery = "SELECT $phevCost FROM phev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE $modelYear";
        $phevCostResult = $connect->query($phevCostQuery); $phevCostResult = $phevCostResult->fetch_assoc(); $phevCostResult = $phevCostResult[$phevCost];

        $bodyCost;
        $bodyType = $powertrainType;
        $vBodyCost;

        $vehicleIncentive = $_POST["vehicleIncentive"];
    
        if($bodyType === "BEV")
        {
            if($vehicleInput == "autonomie")
            {
                $vBodyCost = $bevCostResult;
            }
            else if($vehicleInput == "aeo")
            {
                $vBodyCost = $bevAeoResult;
            }
            else if($vehicleInput == "real_world_today")
            {
                $vBodyCost = $bevRealWorldResult;
            }
        }
        else if($bodyType === "PHEV")
        {
            if($vehicleInput == "autonomie")
            {
                $vBodyCost = $phevCostResult;
            }
            else if($vehicleInput == "aeo")
            {
                $vBodyCost = $phevAeoResult;
            }
            else if($vehicleInput == "real_world_today")
            {
                $vBodyCost = $phevRealWorldResult;
            }
        }
        else
        {
            if($vehicleInput == "autonomie")
            {
                $vBodyCost = $vehicleBodyCost;
            }
            else if($vehicleInput == "aeo")
            {
                $vBodyCost = $vehicleAeoCost;
            }
            else if($vehicleInput == "real_world_today")
            {
                $vBodyCost = $vehicleRealWorldCost;
            }
        }
    
        if($vehicleInput == "userDefined")
        {
            $vBodyCost = $_POST["purchaseCost"];
        }
    
        if($vBodyCost == 0)
        {
            $vBodyCost = $_POST["bodyCostPlugin"];
        }
    
        if($vehicleIncentive > $vBodyCost)
        {
            $vehicleIncentive = $vBodyCost;
        }
    
        $vBodyCost = $vBodyCost - $vehicleIncentive;
    
        if($_POST["APU"] === "true")
        {
            $bodyCost[0] = $vBodyCost * $_POST["markupFactor"] + 8600;
        }
        else
        {
            $bodyCost[0] = $vBodyCost * $_POST["markupFactor"];
        }
        
        $oldCost = $bodyCost[0];
    
        for($i = 1; $i < $numYears + 1; $i++)
        {
            $bodyCost[$i] = $oldCost * (1 - $depreciationRate);
            $oldCost = $bodyCost[$i];
        }
    
        return $bodyCost;
    }

function calculateAdvancedExponentialDepreciationModelYear($numYears, $modelYear)
{
    include "connectDatabase.php";

    $depreciationType = $_POST["depreciation"];
    $vehicleBody = $_POST["vehicleBody"];
    $technology = $_POST["technology"];
    $powertrainType = $_POST["powertrain"];
    $powertrain = $powertrainType;
    $bevRange = $_POST["bevRange"];
    $markupFactor = $_POST["markupFactor"];
    $depreciationRate = $_POST["depreciationRate"];
    $writeOff = $_POST["writeOff"];
    $vehicleEconomy = $_POST["vehicleCostInput"];
    $vehicleMarkupFactor = $_POST["markupFactor"];
    $sum = 0;

    $bevCost = "BEV_" . 200;

    $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrainType' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
    $vehicleBodyCost = $connect->query($vehicleBodyCostQuery); $vehicleBodyCost = $vehicleBodyCost->fetch_assoc(); $vehicleBodyCost = $vehicleBodyCost["Body_Cost"];

    $bevCostQuery = "SELECT $bevCost FROM bev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
    $bevCostResult = $connect->query($bevCostQuery); $bevCostResult = $bevCostResult->fetch_assoc(); $bevCostResult = $bevCostResult[$bevCost];

    $bodyCost;
    $vBodyCost;

    $vehicleIncentive = $_POST["vehicleIncentive"];
    $advancedExponentionalValues;

    if($vehicleEconomy === "autonomie")
    {
        $vehicleValue = $vehicleBodyCost;
    }
    else if($vehicleEconomy === "userDefined")
    {
        $vehicleValue = $_POST["purchaseCost"];
    }

    if($vehicleBody[0] === "L")
    {
        $powertrainType = $powertrainType . "_Luxury";
    }

    if($_POST["APU"] === "true")
    {
        $startValue = $vehicleValue * $vehicleMarkupFactor + 8600;
    }
    else
    {
        $startValue = $vehicleValue * $vehicleMarkupFactor;
    }

    $factorAQuery = "SELECT factor_a FROM enhanced_exponentional_depreciation WHERE '$powertrainType' LIKE powertrain";
    $factorBQuery = "SELECT factor_b FROM enhanced_exponentional_depreciation WHERE '$powertrainType' LIKE powertrain";

    $factorA = $connect->query($factorAQuery); $factorA = $factorA->fetch_assoc(); $factorA = $factorA["factor_a"];
    $factorB = $connect->query($factorBQuery); $factorB = $factorB->fetch_assoc(); $factorB = $factorB["factor_b"];

    $oldValue = $startValue;

    for($i = 0; $i < $numYears + 1; $i++)
    {
        $advancedExponentionalValues[$i] = $oldValue;

        $oldValue = $startValue * $factorA * exp(($i + 1) * $factorB);
    }

    return $advancedExponentionalValues;
}

    function calculateBodyCostModelYear($modelYear)
    {
        include "connectDatabase.php";

        $depreciationType = $_POST["depreciation"];
        $vehicleBody = $_POST["vehicleBody"];
        $technology = $_POST["technology"];
        $bevRange = $_POST["bevRange"];
        $markupFactor = $_POST["markupFactor"];
        $depreciationRate = $_POST["depreciationRate"];
        $writeOff = $_POST["writeOff"];
        $setDiscountRate = $_POST["discountRate"] / 100;
        $powertrainType = $_POST["powertrain"];
        $sum = 0;

        $bevCost = "BEV_" . 200;

        $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrainType' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
        $vehicleBodyCost = $connect->query($vehicleBodyCostQuery); $vehicleBodyCost = $vehicleBodyCost->fetch_assoc(); $vehicleBodyCost = $vehicleBodyCost["Body_Cost"];

        $bevCostQuery = "SELECT $bevCost FROM bev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE $modelYear";
        $bevCostResult = $connect->query($bevCostQuery); $bevCostResult = $bevCostResult->fetch_assoc(); $bevCostResult = $bevCostResult[$bevCost];

        $bodyCost;
        $bodyType = $powertrainType;
        $vBodyCost;
    
        if($bodyType === "BEV")
        {
            $vBodyCost = $bevCostResult;
        }
        else
        {
            $vBodyCost = $vehicleBodyCost;
        }
    
        if($vBodyCost == 0)
        {
            $vBodyCost = $_POST["bodyCostPlugin"];
        }
    
        if($depreciationType === "simple")
        {
            $depreciationCost = calculateSimpleDepreciationModelYear(5, $modelYear);
        }
        else
        {
            $depreciationCost = calculateAdvancedExponentialDepreciationModelYear(5, $modelYear);
        }

        $startValue = $vBodyCost * $markupFactor;

        for($i = 0; $i < 5; $i++)
        {
            $remainingCost[$i] = $depreciationCost[$i] - $depreciationCost[$i + 1];
            //echo $remainingCost[$i] . " " . " ";
        }

        $discountRate = $depreciationCost[5];
        $discountRate2 = $discountRate * pow(($setDiscountRate + 1), - (5 - $_POST["usedVehicleYear"]));

        $sum = 0;
        for($i = 0; $i < 5; $i++)
        {
            if($startValue === 0)
            {
                continue;
            }
           $remainingCost[$i] = $remainingCost[$i] * ($startValue - $discountRate2) / ($startValue - $discountRate);
           $sum += $remainingCost[$i];
        }
    
        return $sum;
    }

    function calculateFinancingCostModelYear($modelYear)
    {
        include "connectDatabase.php";

        $depreciationType = $_POST["depreciation"];
        $vehicleBody = $_POST["vehicleBody"];
        $technology = $_POST["technology"];
        $powertrainType = $_POST["powertrain"];
        $bevRange = $_POST["bevRange"];
        $markupFactor = $_POST["markupFactor"];
        $financeTerm = $_POST["financeTerm"];
        $sum = 0;

        $bevCost = "BEV_" . 200;

        $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrainType' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
        $vehicleBodyCost = $connect->query($vehicleBodyCostQuery); $vehicleBodyCost = $vehicleBodyCost->fetch_assoc(); $vehicleBodyCost = $vehicleBodyCost["Body_Cost"];

        $bevCostQuery = "SELECT $bevCost FROM bev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE $modelYear";
        $bevCostResult = $connect->query($bevCostQuery); $bevCostResult = $bevCostResult->fetch_assoc(); $bevCostResult = $bevCostResult[$bevCost];

        if($powertrainType === "BEV")
        {
            $vBodyCost = $bevCostResult;
        }
        else
        {
            $vBodyCost = $vehicleBodyCost;
        }

        if($vBodyCost == 0)
        {
            $vBodyCost = $_POST["bodyCostPlugin"];
        }

        $vehicleCost = $vBodyCost * $markupFactor;
        $financeRate = .045;
        $downPaymentPercentage = .15;
        $loanPayment[0] = $vehicleCost * (1 - .15);
        $monthlyPayment = round($loanPayment[0] * ($financeRate / 12) * pow((1 + $financeRate / 12), $financeTerm * 12) / (pow((1 + $financeRate / 12), $financeTerm * 12) - 1), 7);
        $fianceCost;
        for($i = 1; $i < 5; $i++)
        {
            if($i < $financeTerm)
            {
                 $loanPayment[$i] = $loanPayment[$i - 1] - ($monthlyPayment * 12 - $loanPayment[$i - 1] * $financeRate);
            }
            else
            {
                $loanPayment[$i] = 0;
            }
        }

        for($i = 0; $i < 5; $i++)
        {
            $financeCost[$i] = $financeRate * $loanPayment[$i];
            $sum += $financeCost[$i];
        }
        
        return $sum;
    }

    // Fix function to calculate the fuel type based on the powertrain!!!!
    function calculateFuelCostModelYear($modelYear)
    {
        include "connectDatabase.php";
        include_once "getFuelCostData.php";

        $mpgCostQuery;
        $fuelPriceQuery;
        $fuelPrice;
        $sum = 0;
        $technology = $_POST["technology"];
        $vehicleBody = $_POST["vehicleBody"];
        $powertrainType = $_POST["powertrain"];
        $vmtType = $_POST["vmt"];
        $mpgYearDegradation = .001;
        $MPGCost = 0;
        
        $fuelModifier = 0;

        switch($modelYear)
        {
            case 2020:
                $fuelModifier = 0;
                break;
            case 2025:
                $fuelModifier = 5;
                break;
            case 2030:
                $fuelModifier = 10;
                break;
            case 2035:
                $fuelModifier = 15;
                break;
            case 2050:
                $fuelModifier = 30;
        }

        switch($powertrainType)
        {
            case "ICE-SI":
                $mpgCostQuery = "SELECT MPG FROM vehicle_mpg WHERE powertrain LIKE 'ICE-SI' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Size LIKE '$modelYear'";
                $fuelPriceQuery = "SELECT Gasoline FROM aeo_fuel_prices";
                $fuelConnect = $connect->query($fuelPriceQuery);
                for($i = 0; $i < 31; $i++)
                {
                    $tempFuel = $fuelConnect->fetch_assoc(); $fuelPrice[$i] = $tempFuel["Gasoline"];
                }
                break;
            case "ICE-CI":
                $mpgCostQuery = "SELECT MPG FROM vehicle_mpg WHERE powertrain LIKE 'ICE-CI' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Size LIKE '$modelYear'";
                $fuelPriceQuery = "SELECT Diesel FROM aeo_fuel_prices";
                $fuelConnect = $connect->query($fuelPriceQuery);
                for($i = 0; $i < 31; $i++)
                {
                    $tempFuel = $fuelConnect->fetch_assoc(); $fuelPrice[$i] = $tempFuel["Diesel"];
                }
                break;
            case "HEV-SI":
                $mpgCostQuery = "SELECT MPG FROM vehicle_mpg WHERE powertrain LIKE 'HEV-SI' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Size LIKE '$modelYear'";
                $fuelPriceQuery = "SELECT Gasoline FROM aeo_fuel_prices";
                $fuelConnect = $connect->query($fuelPriceQuery);
                for($i = 0; $i < 31; $i++)
                {
                    $tempFuel = $fuelConnect->fetch_assoc(); $fuelPrice[$i] = $tempFuel["Gasoline"];
                }
                break;
            case "PHEV":
                $mpgCostQuery = "SELECT MPG FROM vehicle_mpg WHERE powertrain LIKE 'PHEV' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Size LIKE '$modelYear'";
                $fuelPrice = calculateGasElectricCost(30);
                break;
            case "FCEV":
                 include_once "fuelPriceCalculations.php";

                 $mpgCostQuery = "SELECT MPG FROM vehicle_mpg WHERE powertrain LIKE 'FCEV' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Size LIKE '$modelYear'";
                 $fuelPriceQuery = "SELECT Hydrogen FROM aeo_fuel_prices";
                 $fuelConnect = $connect->query($fuelPriceQuery);
                 for($i = 0; $i < 31; $i++)
                 {
                     $tempFuel = $fuelConnect->fetch_assoc(); $fuelPrice[$i] = $tempFuel["Hydrogen"];
                 }
                 break;
                break;
            case "BEV":
                $mpgCostQuery = "SELECT MPG FROM vehicle_mpg WHERE powertrain LIKE 'BEV' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Size LIKE '$modelYear'";
                $fuelPriceQuery = "SELECT Electric FROM aeo_fuel_prices";
                $fuelConnect = $connect->query($fuelPriceQuery);
                for($i = 0; $i < 31; $i++)
                {
                    $tempFuel = $fuelConnect->fetch_assoc(); $fuelPrice[$i] = $tempFuel["Electric"];
                }
                break;
            default:
                echo "invalid powertrain selected";
        }   

        $MPGCost = $connect->query($mpgCostQuery); $MPGCost = $MPGCost->fetch_assoc(); $MPGCost = $MPGCost["MPG"];
        $vmtQuery = "SELECT $vmtType FROM annual_vmt";
        $vmt = $connect->query($vmtQuery);

        if($MPGCost == 0)
        {
            $MPGCost = 1;
        }

        for($i = 0; $i < 5; $i++)
        {
            $vmtSelect = $vmt->fetch_assoc(); $annualVmtYears[$i] = $vmtSelect[$vmtType];
        }

        for($i = 0; $i < 5; $i++)
        {
            if($i + $fuelModifier === 30)
            {
                $fuelModifier--;
            }

            $MPGCost = round($MPGCost * (1 - $mpgYearDegradation), 8);
            $fuelPricePerMile[$i] = $fuelPrice[$i + $fuelModifier + 1] / $MPGCost;
        }
        
        for($i = 0; $i < 5; $i++)
        {
            $annualFuelPrice[$i] = $fuelPricePerMile[$i] * $annualVmtYears[$i];
            $sum = $sum + $annualFuelPrice[$i];
        }
        
        if($MPGCost <= 1)
        {
            $sum = 0;
        }

        return $sum;
    }

    function calculateInsuranceModelYear($modelYear)
    {
        include "connectDatabase.php";

        $markupFactor = $_POST["markupFactor"];
        $vehicleBody = $_POST["vehicleBody"];
        $technology = $_POST["technology"];
        $powertrainType = $_POST["powertrain"];
        $depreciationRate = $_POST["depreciationRate"];
        $numYears = 5;

        $sum = 0;
        $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrainType' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
        $vehicleConnect = $connect->query($vehicleBodyCostQuery);
        $vehicleValue = $vehicleConnect->fetch_assoc(); $vehicleBodyCost = $vehicleValue["Body_Cost"];
        
        $depreciation[0] = $vehicleBodyCost * $markupFactor;
        $oldCost = $depreciation[0];
        $previousCost = $vehicleBodyCost * $markupFactor;
        $bodyCost[0] = $previousCost;

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
            }
            
            $sum = 0;
            for($i = 0; $i < $numYears; $i++)
            {
                if((($residualValue[$i + 1] - $deductible) * $comprehensiveCutoff) > (($residualValue[0] * $comprehensivePremiumB) + $comprehensivePremiumA))
                {
                    $totalInsurance[$i] = $insuranceLiability + (($residualValue[0] * $comprehensivePremiumB) + $comprehensivePremiumA);
                    $sum += $totalInsurance[$i];
                }
                else
                {
                    $totalInsurance[$i] = $insuranceLiability;
                    $sum += $totalInsurance[$i];
                }
            }
            return $sum;
        }
        else
        {
            $totalInsurance;
            $sum = 0;
            
            $vmtType = $_POST["vmt"];
            $vmtQuery = "SELECT $vmtType FROM annual_vmt";
            $i = 0;
            $h = $connect->query($vmtQuery);
            while($vmtYear = $h->fetch_assoc())
            {
                $annualVmtYears[$i] = $vmtYear[$vmtType];
                $i++;
            }

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
                $sum += $totalInsurance[$i];
            }
            return $sum;
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
        }

        return $sum;
    }

    function caluclateCarbonEmissionModelYear()
    {
        include "getID.php";

        $carbonTax = 0;
        $utilityFactorQuery = "SELECT PHEV_Utility_Factor FROM hdv_phev_utility_factor WHERE Technology LIKE '$technology' AND Size LIKE '$vehicleBody' AND Model_Year LIKE '$modelYear'";
        $PHEVUtilityFactor = $connect->query($utilityFactorQuery); $PHEVUtilityFactor = $PHEVUtilityFactor->fetch_assoc(); $PHEVUtilityFactor = $PHEVUtilityFactor["PHEV_Utility_Factor"];
        $ldvUtilityFactor = calculate_LDV_PHEV_UtilityFactor();

        $gasoline = 10800;
        $premiumGasoline = 10800;
        $diesel = 10700;
        $hydrogen = 12000;
        $electric = 16000;

        if($_POST["vehicleClassSize"] === "LDV")
        {
            $gasElec = $ldvUtilityFactor * $electric + (1 - $ldvUtilityFactor) * $gasoline;
            $premElec = $ldvUtilityFactor * $electric + (1 - $ldvUtilityFactor) * $premiumGasoline;
            $dieselElec = $ldvUtilityFactor * $electric + (1 - $ldvUtilityFactor) * $diesel;
        }
        else if($_POST["vehicleClassSize"] === "HDV")
        {
            $gasElec = $PHEVUtilityFactor * $electric + (1 - $PHEVUtilityFactor) * $gasoline;
            $premElec = $gasElec = $PHEVUtilityFactor * $electric + (1 - $PHEVUtilityFactor) * $premiumGasoline;
            $dieselElec = $PHEVUtilityFactor * $electric + (1 - $PHEVUtilityFactor) * $diesel;
        }

        $cng = 8800;
        $biofuel = 6500;

        $co2PerMile = 0;
        $co2CoEfficient = 0;

        switch($fuelType)
        {
            case "Gasoline":
                $co2CoEfficient = $gasoline;
                break;
            case "Premium_Gasoline":
                $co2CoEfficient = $premiumGasoline;
                break;
            case "Diesel":
                $co2CoEfficient = $diesel;
                break;
            case "CNG":
                $co2CoEfficient = $cng;
                break;
            case "Biofuel":
                $co2CoEfficient = $biofuel;
                break;
            case "Hydrogen":
                $co2CoEfficient = $hydrogen;
                break;
            case "Electric":
                $co2CoEfficient = $electric;
                break;
            case "Gas_Electric":
                $co2CoEfficient = $gasElec;
                break;
            case "Diesel_Electric":
                $co2CoEfficient = $dieselElec;
                break;
            case "Premium_Electric":
                $co2CoEfficient = $premElec;
                break;
        }

        $co2PerMile = $co2CoEfficient / $fuelMPG;

        if($_POST["vehicleClassSize"] === "HDV")
        {
            $co2PerMile = $co2PerMile * (137453 / 120080);
        }

        $carbonTax = $co2PerMile / 1000000 * $_POST["carbonEmission"];

        return $carbonTax;
    }

    function calculateTaxesModelYear($modelYear)
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

        $numYears = 5;
        $sum = 0;

        $powertrain = $_POST["powertrain"];
        $powertrainType = $powertrain;
        $vehicleBody = $_POST["vehicleBody"];
        $technology = $_POST["technology"];

        $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrainType' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
        $vehicleConnect = $connect->query($vehicleBodyCostQuery);
        $vehicleBodyCost = $vehicleConnect->fetch_assoc(); $vehicleBodyCost = $vehicleBodyCost["Body_Cost"];

        if($_POST["vehicleClassSize"] === "LDV")
        {
            $totalCost;
            $carbonTax = caluclateCarbonEmissionModelYear();
    
            $salesTax = $_POST["salesTax"] / 100;
            $initialVehicleRegistration = $_POST["annualRegistration"];
            $documentationFee = 300;
            $annualVehicleRegistration = 68;
            $otherCosts = 87;
    
            //$vehicleCost = $vehicleBodyCost * $_POST["markupFactor"];
            $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrainType' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
            $vehicleConnect = $connect->query($vehicleBodyCostQuery);
            $vehicleCost = $vehicleConnect->fetch_assoc(); $vehicleBodyCost = $vehicleCost["Body_Cost"];
    
            if($powertrain === "BEV")
            {
                $otherCosts = 81;
                $annualVehicleRegistration = 141;
            }
            else if($powertrain === "HEV")
            {
                $annualVehicleRegistration = 75;
            }
            else if($powertrain === "PHEV")
            {
                $annualVehicleRegistration = 104;
            }
            else if($powertrain === "FCEV")
            {
                $annualVehicleRegistration = 141;
            }
    
            for($i = 0; $i < $numYears; $i++)
            {
                $totalCost[$i] = 0;
    
                if($i === 0 )
                {
                    $totalCost[$i] += floatval($vehicleCost) * floatval($salesTax) + floatval($initialVehicleRegistration) + floatval($documentationFee);
                }
                
                $totalCost[$i] += $annualVehicleRegistration + $otherCosts + $carbonTax;
                $sum += $totalCost[$i];
            }
        }
        else
        {
            $totalCost;
            $carbonTax = caluclateCarbonEmission();
    
            $exciseTax = .12;
            $salesTax = $_POST["salesTax"] / 100;
            $highwayUseTax = 0;
            $tolls = .03054;
            $permitsAndLicenses = .024432;
    
            $tractorSleeper = 1723.53719686858;
            $tractorDayCab = 1723.53719686858;
            $class8Vocational = 902.429083749901;
            $class6Pickup = 902.429083749901;
            $class3Pickup = 902.429083749901;
            $class8Bus = 902.429083749901;
            $class8Refuse = 902.429083749901;
    
            $vehicleCost = $vehicleBodyCost * $_POST["markupFactor"];
    
            $vehicleBody = $_POST["vehicleBody"];
    
            $registration = 0;
    
            switch($vehicleBody)
            {
                case "Tractor Sleeper":
                    $registration = $tractorSleeper;
                break;
                case "Tractor Day Cab":
                    $registration = $tractorDayCab;
                break;
                case "Class 8 Vocational":
                    $registration = $class8Vocational;
                break;
                case "Class 6 Pickup Delivery":
                    $registration = $class6Pickup;
                break;
                case "Class 3 Pickup Delivery":
                    $registration = $class3Pickup;
                break;
                case "Class 8 Bus":
                    $registration = $class8Bus;
                break;
                case "Class 8 Refuse":
                    $registration = $class8Refuse;
                break;
            }
            for($i = 0; $i < $numYears; $i++)
            {
                $totalCost[$i] = 0;
    
                if($i === 0 AND ($vehicleBody === "Tractor Sleeper" OR $vehicleBody === "Tractor Day Cab" OR $vehicleBody === "Class 8 Vocational" OR $vehicleBody === "Class 8 Bus" OR $vehicleBody === "Class 8 Refuse"))
                {
                    $totalCost[$i] += $vehicleCost * $exciseTax;
                    $totalCost[$i] += $vehicleCost * $salesTax;   /// This should only happen if a vehicle is new
                }
                
                $totalCost[$i] += ($tolls + $permitsAndLicenses) * $annualVmtYears[$i] + $registration + $carbonTax;
                $sum += $totalCost[$i];
            }
        }
        return $sum;
    }

    function calculateMaintenanceModelYear($modelYear)
    {
        include "connectDatabase.php";
        $numYears = 5;
        $sum = 0;
        $powertrain = $_POST["powertrain"];

        if($_POST["vehicleClassSize"] === "LDV")
        {
            $totalMaintenance;
            $sumProduct;
    
            $maintenanceInfoQuery = "SELECT * FROM maintenance_updated";
            $powertrain = $_POST["powertrain"];
    
            $maintenanceInformationFetch = $connect->query($maintenanceInfoQuery);
    
            $maintenanceActivity;
            $cost;
            $firstService;
            $repeatVMT;
            $ice_si_cost;
            $ice_ci_cost;
            $hev_si_cost;
            $phev_cost;
            $fcev_cost;
            $bev_cost;
            $pricePerServiceForRevelantPowertrains;
            $powertrainScalingFactor;
    
            $i = 0;
    
            while($maintenanceInformation = $maintenanceInformationFetch->fetch_assoc())
            {
                $maintenanceActivity[$i] = $maintenanceInformation["Maintenance_Activity"];
                $cost[$i] = $maintenanceInformation["Cost"];
                $firstService[$i] = $maintenanceInformation["First_Service"];
                $repeatVMT[$i] = $maintenanceInformation["Repeat_VMT"];
                $ice_si_cost[$i] = $maintenanceInformation["ICE_SI"];
                $ice_ci_cost[$i] = $maintenanceInformation["ICE_CI"];
                $hev_si_cost[$i] = $maintenanceInformation["HEV_SI"];
                $phev_cost[$i] = $maintenanceInformation["PHEV"];
                $fcev_cost[$i] = $maintenanceInformation["FCEV"];
                $bev_cost[$i] = $maintenanceInformation["BEV"];
                $pricePerServiceForRevelantPowertrains[$i] = $maintenanceInformation["Price_Per_Service_For_Revelant_Powertrain"];
    
                $i++;
            }
    
            switch($powertrain)
            {
                case "ICE-SI":
                    $powertrainScalingFactor = $ice_si_cost;
                    break;
                case "ICE-CI":
                    $powertrainScalingFactor = $ice_ci_cost;
                    break;
                    case "HEV-SI":
                    $powertrainScalingFactor = $hev_si_cost;
                    break;
                case "PHEV":
                    $powertrainScalingFactor = $phev_cost;
                    break;
                case "FCEV":
                    $powertrainScalingFactor = $fcev_cost;
                    break;
                case "BEV":
                    $powertrainScalingFactor = $bev_cost;
                    break;
            }
    
            for($i = 0; $i < $numYears; $i++)
            {
                for($j = 0; $j < sizeof($maintenanceActivity); $j++)
                {
                    $sumProduct[$j] = ((floor((calculateCumulativeVmt($i) + $repeatVMT[$j] - $firstService[$j]) / $repeatVMT[$j])) - (floor((calculateCumulativeVmt($i - 1) + $repeatVMT[$j] - $firstService[$j]) / $repeatVMT[$j]))) * $powertrainScalingFactor[$j];
                }
                $totalMaintenance[$i] = array_sum($sumProduct);
            }
    
            for($i = 0; $i < $numYears; $i++)
            {
                if($i - 2 == -2)
                {
                    $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 3;
                }
                else if($i - 2 == -1)
                {
                    $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 4;
                }
                else if($i + 2 == $numYears)
                {
                    $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1]) / 4;
                }
                else if($i + 2 == $numYears + 1)
                {
                    $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i]) / 3;
                }
                else
                {
                    $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 5;
                }
                $sum += $smoothedMaintenanceCost[$i];
            }
        }
        else
        {
            $totalMaintenance;
            $smoothedMaintenanceCost;
    
            $vehicleBodyInfo = $_POST["vehicleBody"];
            $vehicleInfo;
            $i = 0;
    
            $getInfoQuery = "SELECT * FROM maintenance_updated_hdv";
    
            $c = $connect->query($getInfoQuery);
    
            while($h = $c->fetch_assoc())
            {
                $vehicleInfo[$i] = $h[$vehicleBodyInfo];
                $i++;
            }
    
            $vmtType = $_POST["vmt"];
            $vmtQuery = "SELECT $vmtType FROM annual_vmt";
    
            $i = 0;
            $h = $connect->query($vmtQuery);
            while($vmtYear = $h->fetch_assoc())
            {
                $annualVmtYears[$i] = $vmtYear[$vmtType];
                $i++;
            }
    
            for($i = 0; $i < $numYears; $i++)
            {
                $totalMaintenance[$i] = $vehicleInfo[$i] * $annualVmtYears[$i];
            }
    
            for($i = 0; $i < $numYears; $i++)
            {
                if($i - 2 == -2)
                {
                    $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 3;
                }
                else if($i - 2 == -1)
                {
                    $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 4;
                }
                else if($i + 2 == $numYears)
                {
                    $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1]) / 4;
                }
                else if($i + 2 == $numYears + 1)
                {
                    $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i]) / 3;
                }
                else
                {
                    $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 5;
                }
                $sum += $smoothedMaintenanceCost[$i];
            }
    
        }
        return $sum;
    }

    function calculateNewMajorRepairModelYear($numYears)
    {
        include "connectDatabase.php";

        $totalMaintenance;
        $sumProduct;

        $maintenanceInfoQuery = "SELECT * FROM major_repair_service_LDV";
        $powertrain = $_POST["powertrain"];

        $maintenanceInformationFetch = $connect->query($maintenanceInfoQuery);

        $maintenanceActivity;
        $cost;
        $firstService;
        $repeatVMT;
        $ice_si_cost;
        $ice_ci_cost;
        $hev_si_cost;
        $phev_cost;
        $fcev_cost;
        $bev_cost;
        $pricePerServiceForRevelantPowertrains;
        $powertrainScalingFactor;

        $i = 0;

        while($maintenanceInformation = $maintenanceInformationFetch->fetch_assoc())
        {
            $maintenanceActivity[$i] = $maintenanceInformation["Maintenance_Activity"];
            $cost[$i] = $maintenanceInformation["Cost"];
            $firstService[$i] = $maintenanceInformation["First_Service"];
            $repeatVMT[$i] = $maintenanceInformation["Repeat_VMT"];
            $ice_si_cost[$i] = $maintenanceInformation["ICE_SI"];
            $ice_ci_cost[$i] = $maintenanceInformation["ICE_CI"];
            $hev_si_cost[$i] = $maintenanceInformation["HEV_SI"];
            $phev_cost[$i] = $maintenanceInformation["PHEV"];
            $fcev_cost[$i] = $maintenanceInformation["FCEV"];
            $bev_cost[$i] = $maintenanceInformation["BEV"];
            $pricePerServiceForRevelantPowertrains[$i] = $maintenanceInformation["Price_Per_Service_For_Revelant_Powertrain"];

            $i++;
        }

        switch($powertrain)
        {
            case "ICE-SI":
                $powertrainScalingFactor = $ice_si_cost;
                break;
            case "ICE-CI":
                $powertrainScalingFactor = $ice_ci_cost;
                break;
                case "HEV-SI":
                $powertrainScalingFactor = $hev_si_cost;
                break;
            case "PHEV":
                $powertrainScalingFactor = $phev_cost;
                break;
            case "FCEV":
                $powertrainScalingFactor = $fcev_cost;
                break;
            case "BEV":
                $powertrainScalingFactor = $bev_cost;
                break;
        }

        for($i = 0; $i < $numYears; $i++)
        {
            for($j = 0; $j < sizeof($maintenanceActivity); $j++)
            {
                $sumProduct[$j] = ((floor((calculateCumulativeVmt($i) + $repeatVMT[$j] - $firstService[$j]) / $repeatVMT[$j])) - (floor((calculateCumulativeVmt($i - 1) + $repeatVMT[$j] - $firstService[$j]) / $repeatVMT[$j]))) * $powertrainScalingFactor[$j];
            }
            $totalMaintenance[$i] = array_sum($sumProduct);
        }

        for($i = 0; $i < $numYears; $i++)
        {
            if($i - 2 == -2)
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 3;
            }
            else if($i - 2 == -1)
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 4;
            }
            else if($i + 2 == $numYears)
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1]) / 4;
            }
            else if($i + 2 == $numYears + 1)
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i]) / 3;
            }
            else
            {
                $smoothedMaintenanceCost[$i] = ($totalMaintenance[$i - 2] + $totalMaintenance[$i - 1] + $totalMaintenance[$i] + $totalMaintenance[$i + 1] + $totalMaintenance[$i + 2]) / 5;
            }
        }

        return $smoothedMaintenanceCost;
    }

    function calculateRepairModelYear($modelYear)
    {
        $sum = 0;
        $numYears = 5;
        $powertrain = $_POST["powertrain"];

        if($_POST["vehicleClassSize"] === "LDV")
        {
            include "getID.php";

            $ldvRepairCurve;
    
            if($_POST["majorLDVCheck"] === "true")
            {
                $majorRepairCost = calculateNewMajorRepairModelYear($numYears);
            }
            else
            {
                for($i = 0; $i < $numYears; $i++)
                {
                    $majorRepairCost[$i] = 0;
                }
            }
    
            $repairAgingFactor = Array(0, 0, 0.00333333333333333, 0.01,	0.016666667, 0.02, 0.023333333, 0.026666667, 0.03, 0.033333333, 0.036666667, 0.04, 0.043333333, 0.046666667, 0.05, 0.053333333, 0.056666667, 0.06, 0.063333333, 0.066666667, 0.07, 0.073333333, 0.076666667, 0.08, 0.083333333, 0.086666667, 0.09, 0.093333333, 0.096666667, 0.1, 0.103333333, 0.106666667, 0.11, 0.113333333, 0.116666667);
    
            $vehicleBody = $_POST["vehicleBody"];
            $powertrain = $_POST["powertrain"];
            $sizeMultiplier = 0;
            $powertrainMultiplier = 0;
    
            // reminder remove the 8600 for the APU add in
            $vehicleCost = $vehicleBodyCost * $_POST["markupFactor"];
    
            $ldvRepair;
    
            switch($vehicleBody)
            {
                case "Compact Sedan":
                case "Midsize Sedan":
                case "Luxury Compact":
                case "Luxury Midsize Car":
                    $sizeMultiplier = 1;
                    break;
                
                case "Small SUV":
                case "Medium SUV":
                case "Luxury Small SUV":
                case "Luxury Medium SUV":
                    $sizeMultiplier = .95;
                    break;
    
                case "Pickup":
                case "Luxury Pickup":
                    $sizeMultiplier = .75;
                    break;
    
                default:
                    $sizeMultiplier = 0;
            }
    
            switch($powertrain)
            {
                case "ICE-SI":
                    $powertrainMultiplier = 1;
                    break;
                case "ICE-CI":
                    $powertrainMultiplier = 1;
                    break;
                case "HEV-SI":
                    $powertrainMultiplier = .89;
                    break;
                case "PHEV":
                    $powertrainMultiplier = .86;
                    break;
                case "FCEV":
                    $powertrainMultiplier = .67;
                    break;
                case "BEV":
                    $powertrainMultiplier = .67;
                    break;
    
                default:
                    $powertrainMultiplier = 0;
            }
    
            for($i = 0; $i < $numYears; $i++)
            {
                $ldvRepairCurve[$i] = $repairAgingFactor[$i] * $sizeMultiplier * $powertrainMultiplier * exp(0.00002 * $vehicleCost);
                //echo $vehicleCost . " ";
                //echo $ldvRepairCurve[$i] . " " . " ";
                $ldvRepair[$i] = $ldvRepairCurve[$i] * $annualVmtYears[$i];
                $ldvRepair[$i] = $ldvRepair[$i] + $majorRepairCost[$i];
                $sum += $ldvRepair[$i];
            }
        }
        else
        {
            $sum = 0;
        }
        return $sum;
    }

    function calculateExtraChargingTimeModelYear($numYears, $modelYear)
    {
        include "connectDatabase.php";
        $totalCost;

        $technology = $_POST["technology"];
        $vehicleSize = $_POST["vehicleBody"];
        $powertrain = $_POST["powertrain"];
        $vehicleBody = $vehicleSize;
        $vmtType = $_POST["vmt"];
        $vmtQuery = "SELECT $vmtType FROM annual_vmt";

        $i = 0;
        $h = $connect->query($vmtQuery);
        while($vmtYear = $h->fetch_assoc())
        {
            $annualVmtYears[$i] = $vmtYear[$vmtType];
            $i++;
        }

        $fuelMPGQuery = "SELECT MPG FROM vehicle_mpg WHERE Powertrain LIKE '$powertrain' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Size LIKE '$modelYear'";

        $fuelMPG = $connect->query($fuelMPGQuery); $fuelMPG = $fuelMPG->fetch_assoc(); $fuelMPG = $fuelMPG["MPG"];

        $utilityFactorQuery = "SELECT PHEV_Utility_Factor FROM hdv_phev_utility_factor WHERE Technology LIKE '$technology' AND Size LIKE '$vehicleSize' AND Model_Year LIKE '$modelYear'";
        $utilityFactor = $connect->query($utilityFactorQuery); $utilityFactor = $utilityFactor->fetch_assoc(); $utilityFactor = $utilityFactor["PHEV_Utility_Factor"];

        $costPerMile = ((37.95 / $fuelMPG) / 50) * 30;

        for($i = 0; $i < $numYears; $i++)
        {
            if($_POST["powertrain"] === "PHEV")
            {
                $totalCost[$i] = $costPerMile * $annualVmtYears[$i] * $utilityFactor;
            }
            else if($_POST["powertrain"] === "BEV")
            {
                $totalCost[$i] = $costPerMile * $annualVmtYears[$i];
            }
            else
            {
                $totalCost[$i] = 0;
            }
        }

        return $totalCost;
    }

    function calculateNewLaborCostModelYear($modelYear)
    {
        include "connectDatabase.php";
        $totalCost;
        $extraPayload;
        $downTime;
        $extraCharge;
        $numYears = 5;
        $sum = 0;
        $vmtType = $_POST["vmt"];

        $vmtQuery = "SELECT $vmtType FROM annual_vmt";
        $vmt = $connect->query($vmtQuery);

        $i = 0;
        while($vmtYear = $vmt->fetch_assoc())
        {
            $annualVmtYears[$i] = $vmtYear[$vmtType];
            $i++;
        }

        $laborCostPerMile = .789968;

        $chargingTime = calculateExtraChargingTimeModelYear($numYears, $modelYear);

        if($_POST["vehicleClassSize"] === "HDV")
        {
            for($i = 0; $i < $numYears; $i++)
            {
                $totalCost[$i] = $laborCostPerMile * $annualVmtYears[$i] + $chargingTime[$i];
                $sum += $totalCost[$i];
            }
        }
        else
        {
            for($i = 0; $i < $numYears; $i++)
            {
                $totalCost[$i] = 0;
                $sum += $totalCost[$i];
            }
        }

        return $sum;
    }

    function calculateExtraPayloadCostModelYear($numYears, $modelYear)
    {
        include "connectDatabase.php";

        $fuelType = $_POST["fuel"];
        $vehicleBody = $_POST["vehicleBody"];
        $powertrain = $_POST["powertrain"];
        $technology = $_POST["technology"];

        $payloadCost;

        $vehicleWeightQuery = "SELECT Vehicle_Weight FROM vehicle_weight WHERE Powertrain LIKE '$powertrain' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
        $vehicleWeight = $connect->query($vehicleWeightQuery); $vehicleWeight = $vehicleWeight->fetch_assoc(); $vehicleWeight = $vehicleWeight["Vehicle_Weight"];

        $cargoWeightQuery = "SELECT Cargo_Weight FROM cargo_weight WHERE Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
        $cargoWeight = $connect->query($cargoWeightQuery); $cargoWeight = $cargoWeight->fetch_assoc(); $cargoWeight = $cargoWeight["Cargo_Weight"];
    

        $vmtType = $_POST["vmt"];
        $vmtQuery = "SELECT $vmtType FROM annual_vmt";
        
        $i = 0;
        $h = $connect->query($vmtQuery);
        while($vmtYear = $h->fetch_assoc())
        {
            $annualVmtYears[$i] = $vmtYear[$vmtType];
            $i++;
        }

        $averageLostPayload = 0;

        $poundsLost;
        $densityFunction = [0.327337059, 0.021192767, 0.037993616, 0.012269246, 0.067911802, 0.003142159, 0.013569916, 0.011235652, 0.019413392, 0.001805398, 0.053941842, 0.002000789, 0.013165971, 0.003779177, 0.010442722, 0.001683131, 0.056760236, 0.001263924, 0.002451938, 0.000674786, 0.039785142, 0.001030453, 0.002501075, 0.000294086, 0.004987094, 0.0000632188166629377,	0.007146832, 0.000106059, 0.005407912, 0.004291872, 0.071360019, 0.000595126, 0.001951327, 0.000955503, 0.003204052, 0.000784919, 0.004421243, 0.005529566, 0.002671055, 0.000339753, 0.025899947, 0.003009626, 0.000852256, 0.00096624, 0.001846688, 0.000398568, 0.000901518, 0.000524504, 0.001511042,0.0000580685827293109];

        $maxWeight = 80000;
        $weightAllowence = 0;

        $iceciVehicleWeightQuery = "SELECT Vehicle_Weight FROM vehicle_weight WHERE Powertrain LIKE 'ICE-CI' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
        $iceciVehicleWeight = $connect->query($iceciVehicleWeightQuery); $iceciVehicleWeight = $iceciVehicleWeight->fetch_assoc(); $iceciVehicleWeight = $iceciVehicleWeight["Vehicle_Weight"];

        if($fuelType === "CNG" OR $powertrain === "BEV")
        {
            $weightAllowence = 2000;
        }

        for($i = 0; $i < 50; $i++)
        {
            if($i === 0)
            {
                $capacity = $vehicleWeight - $iceciVehicleWeight - $weightAllowence;
                if($capacity > 0)
                {
                    $poundsLost[$i] = $capacity;
                }
                else
                {
                    $poundsLost[$i] = 0;
                }
            }
            else
            {
                if($poundsLost[$i - 1] - 500 > 0)
                {
                    $poundsLost[$i] = $poundsLost[$i - 1] - 500;
                }
                else
                {
                    $poundsLost[$i] = 0;
                }
            }
            $averageLostPayload += $poundsLost[$i] * $densityFunction[$i];
        }

        $maxCargo = ($maxWeight + $weightAllowence) - $vehicleWeight + $cargoWeight;
        
        $fractionalLoss = $averageLostPayload / $maxCargo;

        for($i = 0; $i < $numYears; $i++)
        {
            $payloadCost[$i] = $fractionalLoss * $annualVmtYears[$i];
        }

        return $payloadCost;
    }

    function calculateDowntimeOppurtunityCostModelYear($numYears, $modelYear)
    {
        include "connectDatabase.php";

        $averageDowntime = $_POST["averageDowntime"] / 100; //.1048;
        $downtimeOppurtunityCost;

        $vmtType = $_POST["vmt"];
        $vmtQuery = "SELECT $vmtType FROM annual_vmt";

        
        $i = 0;
        $h = $connect->query($vmtQuery);
        while($vmtYear = $h->fetch_assoc())
        {
            $annualVmtYears[$i] = $vmtYear[$vmtType];
            $i++;
        }

        for($i = 0; $i < $numYears; $i++)
        {
            $downtimeOppurtunityCost[$i] = $averageDowntime * $annualVmtYears[$i];
        }

        return $downtimeOppurtunityCost;
    }

    function calculateOperationalCostModelYear($modelYear)
    {
        include "connectDatabase.php";

        $discountAnnualVmtYears = 0;
        $yearCostComponents = 0;
        $totalYearCostComponents = 0;
        $sum = 0;

        $analysisWindow = 5;
        $discountRate = $_POST["discountRate"];

        $vmtType = $_POST["vmt"];
        $vmtQuery = "SELECT $vmtType FROM annual_vmt";

        $vehicle = calculateBodyCostModelYear($modelYear);
        $financeCost = calculateFinancingCostModelYear($modelYear);
        $annualFuelCost = calculateFuelCostModelYear($modelYear);
        $insuranceCost = calculateInsuranceModelYear($modelYear);
        $taxesAndFees = calculateTaxesModelYear($modelYear);
        $maintenance = calculateMaintenanceModelYear($modelYear);
        $labor = calculateNewLaborCostModelYear($modelYear);

        for($i = 0; $i < sizeof($vehicle); $i++)
        {
            echo $vehicle[$i] . " " . " ";
        }

        $extraPayLoad = calculateExtraPayloadCostModelYear($analysisWindow, $modelYear);
        $downTimeOpprutunity = calculateDowntimeOppurtunityCostModelYear($analysisWindow, $modelYear);
        
        $i = 0;
        $h = $connect->query($vmtQuery);
        while($vmtYear = $h->fetch_assoc())
        {
            $annualVmtYears[$i] = $vmtYear[$vmtType];
            $i++;
        }

        for($i = 0; $i < $analysisWindow; $i++)
        {
            $discountAnnualVmtYears += $annualVmtYears[$i] / pow((1 + $discountRate), $i);
        }
        
        $yearCostComponents += $vehicle + $financeCost + $maintenance;

        $totalYearCostComponents += $vehicle + $financeCost + $annualFuelCost + $insuranceCost + $taxesAndFees + $maintenance + $labor;
        

        $finalYearCostComponents = $yearCostComponents / $discountAnnualVmtYears;
        $finalTotalYearCostComponents = $totalYearCostComponents / $discountAnnualVmtYears;

        for($i = 0; $i < $analysisWindow; $i++)
        {
            $downTimeOpprutunity[$i] = $downTimeOpprutunity[$i] * $finalYearCostComponents;
            $extraPayLoad[$i] = $extraPayLoad[$i] * $finalTotalYearCostComponents;

           // echo $extraPayLoad[$i] . " " . " " ;

            $operational[$i] = $downTimeOpprutunity[$i] + $extraPayLoad[$i];
            $sum += $operational[$i];

            if($_POST["additionalOperational"] === "false")
            {
                for($i = 0; $i < $analysisWindow; $i++)
                {
                    $operational[$i] = 0;
                }
                $sum = 0;
            }
        }

        return $sum;
    }
?>