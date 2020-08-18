<?php     
    function calculateBodyCost($modelYear)
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
        $sum = 0;

        $bevCost = "BEV_" . 200;

        $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrainType' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
        $vehicleBodyCost = $connect->query($vehicleBodyCostQuery); $vehicleBodyCost = $vehicleBodyCost->fetch_assoc(); $vehicleBodyCost = $vehicleBodyCost["Body_Cost"];

        $bevCostQuery = "SELECT $bevCost FROM bev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE $modelYear";
        $bevCostResult = $connect->query($bevCostQuery); $bevCostResult = $bevCostResult->fetch_assoc(); $bevCostResult = $bevCostResult[$bevCost];

        if($depreciationType == "simple")
        {
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
    
            $bodyCost[0] = $vBodyCost * $markupFactor;
            $oldCost = $bodyCost[0];
    
            for($i = 0; $i < 5; $i++)
            {
                $bodyCost[$i] = $oldCost * $depreciationRate;
                $oldCost = $oldCost - $bodyCost[$i];
                $sum += $bodyCost[$i];
            }
    
            return $sum;
        }

        else if($depreciationType == "advanced")
        {
            $bodyCost = $vehicleBodyCost * $markupFactor;

            $rate = $bodyCost / $writeOff;
            $sum += $rate;

            return $sum;
        }
    }

    function calculateFinancingCost($modelYear)
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
    function calculateFuelCost($modelYear)
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
                $fuelPriceQuery = "SELECT Gas_Electric FROM aeo_fuel_prices";
                $fuelConnect = $connect->query($fuelPriceQuery);
                for($i = 0; $i < 31; $i++)
                {
                    $tempFuel = $fuelConnect->fetch_assoc(); $fuelPrice[$i] = $tempFuel["Gas_Electric"];
                }
                break;
            case "FCEV":
                 include_once "fuelPriceCalculations.php";

                 $mpgCostQuery = "SELECT MPG FROM vehicle_mpg WHERE powertrain LIKE 'FCEV' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Size LIKE '$modelYear'";
                 $fuelPrice = calculateHydrogenCost(30);
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

        return $sum;
    }

    function calculateInsruance($modelYear)
    {
        include "connectDatabase.php";

        $markupFactor = $_POST["markupFactor"];
        $vehicleBody = $_POST["vehicleBody"];
        $technology = $_POST["technology"];
        $powertrainType = $_POST["powertrain"];
        $depreciationRate = $_POST["depreciationRate"];

        $sum = 0;
        $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrainType' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
        $vehicleConnect = $connect->query($vehicleBodyCostQuery);
        $vehicleValue = $vehicleConnect->fetch_assoc(); $vehicleBodyCost = $vehicleValue["Body_Cost"];
        
        $depreciation[0] = $vehicleBodyCost * $markupFactor;
        $oldCost = $depreciation[0];
        $previousCost = $vehicleBodyCost * $markupFactor;
        $bodyCost[0] = $previousCost;

        for($i = 0; $i < 5; $i++)
        {
            $depreciation[$i] = $oldCost * $depreciationRate;
            $oldCost = $oldCost - $depreciation[$i];
        }

        for($i = 1; $i < 5; $i++)
        {
            $bodyCost[$i] = $previousCost - $depreciation[$i - 1];
            $previousCost = $bodyCost[$i];
        }

        $insuranceProportional = $_POST["insuranceProportional"];
        $insuranceProportionalNumber = 0;
        $insuranceFixed = $_POST["insuranceFixed"];

        for($i = 0; $i < 5; $i++)
        {
            $insuranceProportionalNumber = $insuranceProportional * $bodyCost[$i];
            $sum = $insuranceProportionalNumber + $insuranceFixed;            
        }
        return $sum;
    }

    function calculateTaxes()
    {
        $markupFactor = $_POST["markupFactor"];
        $vehicleBody = $_POST["vehicleBody"];
        $salesTaxAndTitle = $_POST["salesTax"];
        $annualRegistration = $_POST["annualRegistration"];
        $totalCost = 0;
        $purchaseCost = $markupFactor * $vehicleBody;

        for($i = 0; $i < 5; $i++)
        {
            if($i == 0)
            {
                $totalCost += $purchaseCost * $salesTaxAndTitle + $annualRegistration;
            }
            else
            {
                $totalCost += $annualRegistration;
            }
        }


        return $totalCost;
    }

    function calculateMaintenanceComponent($component)
    {
        include "connectDatabase.php";

        $firstServiceQuery = "SELECT First_Service_VMT FROM maintenance_cost";
        $firstService = $connect->query($firstServiceQuery);
        $firstServiceResults;
        $powertrainType = $_POST["powertrain"];

        $i = 0;
        while($firstServiceResult = $firstService->fetch_assoc())
        {
            $firstServiceResults[$i] = $firstServiceResult["First_Service_VMT"];
            $i++;
        } 

        $repeatServiceQuery = "SELECT Repeat_VMT FROM maintenance_cost";
        $repeatService = $connect->query($repeatServiceQuery);
        $repeatServiceResults;

        $i = 0;
        while($repeatServiceResult = $repeatService->fetch_assoc())
        {
            $repeatServiceResults[$i] = $repeatServiceResult["Repeat_VMT"];
            $i++;
        }
        
        $costDataQuery = "SELECT Cost FROM maintenance_cost";
        $costData = $connect->query($costDataQuery);
        $costDataResults;

        $i = 0;
        while($costDataResult = $costData->fetch_assoc())
        {
            $costDataResults[$i] = $costDataResult["Cost"];
            $i++;
        }

        $scalingFactorPowertrain = $powertrainType . "_Scaling_Factor";
        $scalingFactorPowertrain = str_replace("-", "_", $scalingFactorPowertrain);

        $scalingFactorQuery = "SELECT $scalingFactorPowertrain FROM maintenance_cost";
        $scalingFactor = $connect->query($scalingFactorQuery);
        $scalingFactorResults;

        $i = 0;
        while($scalingFactorResult = $scalingFactor->fetch_assoc())
        {
            $scalingFactorResults[$i] = $scalingFactorResult[$scalingFactorPowertrain];
            $i++;
        }

        $vmtType = $_POST["vmt"];
        $vmtQuery = "SELECT $vmtType FROM annual_vmt";

        $i = 0;
        $connectVmt = $connect->query($vmtQuery); 
        for($i = 0; $i < 5; $i++)
        {
            $vmtData = $connectVmt->fetch_assoc(); $totalVMT[$i] = $vmtData[$vmtType];
        }

        $previousNum = 0;
        $totalCost = 0;
        $flag;
        $componentCost;

        for($i = 0; $i < 5; $i++)
        {
            if($totalVMT[$i] < $firstServiceResults[$component] + $repeatServiceResults[$component] And $previousNum + 0 == 0)
            {
                $flag[$i] = floor(calculateCumulativeVmt($i) / $firstServiceResults[$component]);
                $flag[$i] = round($flag[$i]);
                $previousNum += $flag[$i];
            }
            else
            {
                $flag[$i] = floor((calculateCumulativeVmt($i) - $firstServiceResults[$component] - ($previousNum - 1) * $repeatServiceResults[$component]) / $repeatServiceResults[$component]);
                $previousNum += $flag[$i];
            }

            $componentCost[$i] = $flag[$i] * $costDataResults[$component] * $scalingFactorResults[$component];
        }

        return $componentCost;
    }

    function calculateMaintenance()
    {
        $maintenanceCost = 0;
        $oilCost = calculateMaintenanceComponent(0);
        $tireCost = calculateMaintenanceComponent(1);
        $airFilterCost = calculateMaintenanceComponent(2);
        $batteryCost = calculateMaintenanceComponent(3);
        $fluidCost = calculateMaintenanceComponent(4);
        $brakes1Cost = calculateMaintenanceComponent(5);
        $beltsAndHosesCost = calculateMaintenanceComponent(6);
        $pumpsCost = calculateMaintenanceComponent(7);

        for($i = 0; $i < 5; $i++)
        {
            $maintenanceCost += $oilCost[$i] + $tireCost[$i] + $airFilterCost[$i]  + $batteryCost[$i] + $fluidCost[$i] + $brakes1Cost[$i] + $beltsAndHosesCost[$i] + $pumpsCost[$i];
        }

        return $maintenanceCost;
    }

    function calculateRepairComponent($component)
    {
        include "connectDatabase.php";

        $firstServiceQuery = "SELECT First_Service_VMT FROM repair_activity";
        $firstService = $connect->query($firstServiceQuery);
        $firstServiceResults;
        $powertrainType = $_POST["powertrain"];

        $i = 0;
        while($firstServiceResult = $firstService->fetch_assoc())
        {
            $firstServiceResults[$i] = $firstServiceResult["First_Service_VMT"];
            $i++;
        } 

        $repeatServiceQuery = "SELECT Repeat_VMT FROM repair_activity";
        $repeatService = $connect->query($repeatServiceQuery);
        $repeatServiceResults;

        $i = 0;
        while($repeatServiceResult = $repeatService->fetch_assoc())
        {
            $repeatServiceResults[$i] = $repeatServiceResult["Repeat_VMT"];
            $i++;
        }
        
        $costDataQuery = "SELECT Cost FROM repair_activity";
        $costData = $connect->query($costDataQuery);
        $costDataResults;

        $i = 0;
        while($costDataResult = $costData->fetch_assoc())
        {
            $costDataResults[$i] = $costDataResult["Cost"];
            $i++;
        }

        $scalingFactorPowertrain = $powertrainType . "_Scaling_Factor";
        $scalingFactorPowertrain = str_replace("-", "_", $scalingFactorPowertrain);

        $scalingFactorQuery = "SELECT $scalingFactorPowertrain FROM repair_activity";
        $scalingFactor = $connect->query($scalingFactorQuery);
        $scalingFactorResults;

        $i = 0;
        while($scalingFactorResult = $scalingFactor->fetch_assoc())
        {
            $scalingFactorResults[$i] = $scalingFactorResult[$scalingFactorPowertrain];
            $i++;
        }

        $vmtType = $_POST["vmt"];
        $vmtQuery = "SELECT $vmtType FROM annual_vmt";

        $i = 0;
        $connectVmt = $connect->query($vmtQuery); 
        for($i = 0; $i < 5; $i++)
        {
            $vmtData = $connectVmt->fetch_assoc(); $totalVMT[$i] = $vmtData[$vmtType];
        }

        $previousNum = 0;
        $totalCost = 0;
        $flag;
        $componentCost;

        for($i = 0; $i < 5; $i++)
        {
            if($totalVMT[$i] < $firstServiceResults[$component] + $repeatServiceResults[$component] And $previousNum + 0 == 0)
            {
                $flag[$i] = floor(calculateCumulativeVmt($i) / $firstServiceResults[$component]);
                $flag[$i] = round($flag[$i]);
                $previousNum += $flag[$i];
            }
            else
            {
                $flag[$i] = floor((calculateCumulativeVmt($i) - $firstServiceResults[$component] - ($previousNum - 1) * $repeatServiceResults[$component]) / $repeatServiceResults[$component]);
                $previousNum += $flag[$i];
            }

            $componentCost[$i] = $flag[$i] * $costDataResults[$component] * $scalingFactorResults[$component];
        }

        return $componentCost;
    }

    function calculateRepair()
    {
        $repairCost = 0;
        $brakes2Cost = calculateRepairComponent(0);
        $transmissionCost = calculateRepairComponent(1);
        $engineCost = calculateRepairComponent(2);
        $hvBatteryCost = calculateRepairComponent(3);
        $fcStack = calculateRepairComponent(4);
        $bodyCost = calculateRepairComponent(5);

        for($i = 0; $i < 5; $i++)
        {
            $repairCost += $brakes2Cost[$i] + $transmissionCost[$i] + $engineCost[$i] + $hvBatteryCost[$i] + $fcStack[$i] + $bodyCost[$i];
        }

        return $repairCost;
    }
?>