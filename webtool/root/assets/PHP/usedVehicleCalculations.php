<?php 
    function calculateVmt()
    {
        include "connectDatabase.php";

        $vmtType = $_POST["vmt"];

        $vmtQuery = "SELECT $vmtType FROM annual_vmt";
        $vmtResult = $connect->query($vmtQuery);
        $vmt;
        $i = 0;

        while($vmtResults = $vmtResult->fetch_assoc())
        {
            $vmt[$i] = $vmtResults[$vmtType];
            $i++;
        }

        if(!empty($_POST["customVMT"]))
        {
            $customVmtValue = $_POST["customVMTValue"];
            $customVmtYear = $_POST["usedVehicleYear"] - 1;

            $oldVmtValue = $vmt[$customVmtYear];
            $vmt[$customVmtYear] = $customVmtValue;

            $vmtRatio = $vmt[$customVmtYear] / $oldVmtValue;

            for($i = $customVmtYear + 1; $i < sizeof($vmt); $i++)
            {
                $vmt[$i] = $vmt[$i] * $vmtRatio;
            }
        }

        return $vmt;
    }

    function calculateUsedCumulativeVmt($numYears)
    {
        include "connectDatabase.php";

        $annualVmtYears = calculateVmt();

        $totalVMT = 0;

        for($i = 0; $i < $numYears + 1; $i++)
        {
            $totalVMT = $totalVMT + $annualVmtYears[$i];
        }

        return $totalVMT;
    }

    function calculateUsedBodyCost()
    {
        include "connectDatabase.php";

        $depreciationType = $_POST["depreciation"];
        $powertrainType = $_POST["powertrain"];
        $vehicleBody = $_POST["vehicleBody"];
        $technology = $_POST["technology"];
        $modelYear = $_POST["modelYear"];
        $bevRange = $_POST["bevRange"];
        $markupFactor = $_POST["markupFactor"];
        $depreciationRate = $_POST["depreciationRate"];
        $writeOff = $_POST["writeOff"];
        $vehicleAge = $_POST["usedVehicleYear"];

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
    
            for($i = 0; $i < 30; $i++)
            {
                $bodyCost[$i] = $oldCost * $depreciationRate;
                $oldCost = $oldCost - $bodyCost[$i];
                if($i >= $vehicleAge && $i < $vehicleAge + 5)
                {
                    $sum += $bodyCost[$i];
                }
                
            }
        }

        else if($depreciationType == "advanced")
        {
            $bodyCost = $vehicleBodyCost * $markupFactor;

            $rate = $bodyCost / $writeOff;
            if($i >= $vehicleAge)
            {
                $sum += $rate;
            }
        }

        return $sum;
    }

    function calculateUsedFinancingCost()
    {
        include "connectDatabase.php";

        $depreciationType = $_POST["depreciation"];
        $vehicleBody = $_POST["vehicleBody"];
        $powertrainType = $_POST["powertrain"];
        $technology = $_POST["technology"];
        $modelYear = $_POST["modelYear"];
        $bevRange = $_POST["bevRange"];
        $markupFactor = $_POST["markupFactor"];
        $financeTerm = $_POST["financeTerm"];
        $vehicleAge = $_POST["usedVehicleYear"];
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
        for($i = 1; $i < 30; $i++)
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

        for($i = 0; $i < 30; $i++)
        {
            $financeCost[$i] = $financeRate * $loanPayment[$i];
            if($i >= $vehicleAge && $i < $vehicleAge + 5)
            {
                $sum += $financeCost[$i];
            }
        }

        return $sum;
    }

    function calculateUsedFuelCost()
    {
        include "connectDatabase.php";
        include_once "getFuelCostData.php";

        $mpgCostQuery;
        $fuelPriceQuery;
        $fuelPrice;
        $sum = 0;
        $technology = $_POST["technology"];
        $vehicleBody = $_POST["vehicleBody"];
        $modelYear = $_POST["modelYear"];
        $powertrainType = $_POST["powertrain"];
        $mpgYearDegradation = .001;
        $MPGCost = 0;
        $vehicleAge = $_POST["usedVehicleYear"];
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

        if($MPGCost == 0)
        {
            $MPGCost = 1;
        }

        $annualVmtYears = calculateVmt();

        for($i = 0; $i < 30; $i++)
        {
            if($i + $fuelModifier === 30)
            {
                $fuelModifier--;
            }

            $MPGCost = round($MPGCost * (1 - $mpgYearDegradation), 8);
            $fuelPricePerMile[$i] = $fuelPrice[$i + $fuelModifier + 1] / $MPGCost;
        }
        
        for($i = 0; $i < 30; $i++)
        {
            $annualFuelPrice[$i] = $fuelPricePerMile[$i] * $annualVmtYears[$i];
            if($i >= $vehicleAge && $i < $vehicleAge + 5)
            {
                $sum = $sum + $annualFuelPrice[$i];
            }
        }
        
        if($MPGCost <= 1)
        {
            $sum = 0;
        }

        return $sum;
    }

    function calculateUsedInsuranceCost()
    {
        include "connectDatabase.php";

        $markupFactor = $_POST["markupFactor"];
        $vehicleBody = $_POST["vehicleBody"];
        $technology = $_POST["technology"];
        $modelYear = $_POST["modelYear"];
        $depreciationRate = $_POST["depreciationRate"];
        $powertrainType = $_POST["powertrain"];
        $vehicleAge = $_POST["usedVehicleYear"];

        $sum = 0;
        $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrainType' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
        $vehicleConnect = $connect->query($vehicleBodyCostQuery);
        $vehicleValue = $vehicleConnect->fetch_assoc(); $vehicleBodyCost = $vehicleValue["Body_Cost"];
        
        $depreciation[0] = $vehicleBodyCost * $markupFactor;
        $oldCost = $depreciation[0];
        $previousCost = $vehicleBodyCost * $markupFactor;
        $bodyCost[0] = $previousCost;

        for($i = 0; $i < 30; $i++)
        {
            $depreciation[$i] = $oldCost * $depreciationRate;
            $oldCost = $oldCost - $depreciation[$i];
        }

        for($i = 1; $i < 30; $i++)
        {
            $bodyCost[$i] = $previousCost - $depreciation[$i - 1];
            $previousCost = $bodyCost[$i];
        }

        $insuranceProportional = $_POST["insuranceProportional"];
        $insuranceProportionalNumber = 0;
        $insuranceFixed = $_POST["insuranceFixed"];

        for($i = 0; $i < 30; $i++)
        {
            $insuranceProportionalNumber = $insuranceProportional * $bodyCost[$i];
            if($i >= $vehicleAge && $i < $vehicleAge + 5)
            {
                $sum += $insuranceProportionalNumber + $insuranceFixed;
            }          
        }
        return $sum;
    }

    function calculateUsedTaxesCost()
    {
        $bodyCost = $_POST["vehicleBody"];
        $markupFactor = $_POST["markupFactor"];
        $salesTaxAndTitle = $_POST["salesTax"];
        $annualRegistration = $_POST["annualRegistration"];
        $vehicleAge = $_POST["usedVehicleYear"];
        $purchaseCost = $bodyCost * $markupFactor;
        $totalCost = 0;

        for($i = 0; $i < 30; $i++)
        {
            if($i === 0)
            {
                if($i >= $vehicleAge && $i < $vehicleAge + 5)
                {
                    $totalCost += $purchaseCost * $salesTaxAndTitle + $annualRegistration;
                }  
            }
            else
            {
                if($i >= $vehicleAge && $i < $vehicleAge + 5)
                {
                    $totalCost += $annualRegistration;
                } 
            }
        }

        return $totalCost;
    }

    function calculateUsedMaintenanceComponents($component)
    {
        include "connectDatabase.php";
        $powertrainType = $_POST["powertrain"];

        $firstServiceQuery = "SELECT First_Service_VMT FROM maintenance_cost";
        $firstService = $connect->query($firstServiceQuery);
        $firstServiceResults;

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

        $totalVMT = calculateVmt();

        $previousNum = 0;
        $totalCost = 0;
        $flag;
        $componentCost;

        for($i = 0; $i < 30; $i++)
        {
            if($totalVMT[$i] < $firstServiceResults[$component] + $repeatServiceResults[$component] And $previousNum + 0 == 0)
            {
                $flag[$i] = floor(calculateUsedCumulativeVmt($i) / $firstServiceResults[$component]);
                $flag[$i] = round($flag[$i]);
                $previousNum += $flag[$i];
            }
            else
            {
                $flag[$i] = floor((calculateUsedCumulativeVmt($i) - $firstServiceResults[$component] - ($previousNum - 1) * $repeatServiceResults[$component]) / $repeatServiceResults[$component]);
                $previousNum += $flag[$i];
            }

            $componentCost[$i] = $flag[$i] * $costDataResults[$component] * $scalingFactorResults[$component];
        }

        return $componentCost;
    }

    function calculateUsedMaintenance()
    {
        $vehicleAge = $_POST["usedVehicleYear"];

        $maintenanceCost;
        $trueMaintenanceCost = 0;
        $oilCost = calculateUsedMaintenanceComponents(0);
        $tireCost = calculateUsedMaintenanceComponents(1);
        $airFilterCost = calculateUsedMaintenanceComponents(2);
        $batteryCost = calculateUsedMaintenanceComponents(3);
        $fluidCost = calculateUsedMaintenanceComponents(4);
        $brakes1Cost = calculateUsedMaintenanceComponents(5);
        $beltsAndHosesCost = calculateUsedMaintenanceComponents(6);
        $pumpsCost = calculateUsedMaintenanceComponents(7);

        for($i = 0; $i < 30; $i++)
        {
            $maintenanceCost[$i] = ($oilCost[$i] + $tireCost[$i] + $airFilterCost[$i]  + $batteryCost[$i] + $fluidCost[$i] + $brakes1Cost[$i] + $beltsAndHosesCost[$i] + $pumpsCost[$i]);
        }

        for($i = 0; $i < 30; $i++)
        {
            if($i - 2 == -2)
            {
                $smoothedMaintenanceCost[$i] = ($maintenanceCost[$i] + $maintenanceCost[$i + 1] + $maintenanceCost[$i + 2]) / 3;
            }
            else if($i - 2 == -1)
            {
                $smoothedMaintenanceCost[$i] = ($maintenanceCost[$i - 1] + $maintenanceCost[$i] + $maintenanceCost[$i + 1] + $maintenanceCost[$i + 2]) / 4;
            }
            else if($i + 2 == 30)
            {
                $smoothedMaintenanceCost[$i] = ($maintenanceCost[$i - 2] + $maintenanceCost[$i - 1] + $maintenanceCost[$i] + $maintenanceCost[$i + 1]) / 4;
            }
            else if($i + 2 == 30 + 1)
            {
                $smoothedMaintenanceCost[$i] = ($maintenanceCost[$i - 2] + $maintenanceCost[$i - 1] + $maintenanceCost[$i]) / 3;
            }
            else
            {
                $smoothedMaintenanceCost[$i] = ($maintenanceCost[$i - 2] + $maintenanceCost[$i - 1] + $maintenanceCost[$i] + $maintenanceCost[$i + 1] + $maintenanceCost[$i + 2]) / 5;
            }
            if($i >= $vehicleAge && $i < $vehicleAge + 5)
            {
                $trueMaintenanceCost += $smoothedMaintenanceCost[$i];
            } 
        }

        return $trueMaintenanceCost;
    }

    function calculateUsedReapirComponents($component)
    {
        include "connectDatabase.php";
        $powertrainType = $_POST["powertrain"];

        $firstServiceQuery = "SELECT First_Service_VMT FROM repair_activity";
        $firstService = $connect->query($firstServiceQuery);
        $firstServiceResults;

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

        $totalVMT = calculateVmt();

        $previousNum = 0;
        $totalCost = 0;
        $flag;
        $componentCost;

        for($i = 0; $i < 30; $i++)
        {
            if($totalVMT[$i] < $firstServiceResults[$component] + $repeatServiceResults[$component] And $previousNum + 0 == 0)
            {
                $flag[$i] = floor(calculateUsedCumulativeVmt($i) / $firstServiceResults[$component]);
                $flag[$i] = round($flag[$i]);
                $previousNum += $flag[$i];
            }
            else
            {
                $flag[$i] = floor((calculateUsedCumulativeVmt($i) - $firstServiceResults[$component] - ($previousNum - 1) * $repeatServiceResults[$component]) / $repeatServiceResults[$component]);
                $previousNum += $flag[$i];
            }

            $componentCost[$i] = $flag[$i] * $costDataResults[$component] * $scalingFactorResults[$component];        
        }

        return $componentCost;
    }

    function calculateUsedRepair()
    {
        $vehicleAge = $_POST["usedVehicleYear"];

        $repairCost;
        $trueRepairCost = 0;
        $brakes2Cost = calculateUsedReapirComponents(0);
        $transmissionCost = calculateUsedReapirComponents(1);
        $engineCost = calculateUsedReapirComponents(2);
        $hvBatteryCost = calculateUsedReapirComponents(3);
        $fcStack = calculateUsedReapirComponents(4);
        $bodyCost = calculateUsedReapirComponents(5);

        for($i = 0; $i < 30; $i++)
        {
            $repairCost[$i] = $brakes2Cost[$i] + $transmissionCost[$i] + $engineCost[$i] + $hvBatteryCost[$i] + $fcStack[$i] + $bodyCost[$i];  
        }

        for($i = 0; $i < 30; $i++)
        {
            if($i - 2 == -2)
            {
                $smoothedRepairCost[$i] = ($repairCost[$i] + $repairCost[$i + 1] + $repairCost[$i + 2]) / 3;
            }
            else if($i - 2 == -1)
            {
                $smoothedRepairCost[$i] = ($repairCost[$i - 1] + $repairCost[$i] + $repairCost[$i + 1] + $repairCost[$i + 2]) / 4;
            }
            else if($i + 2 == 30)
            {
                $smoothedRepairCost[$i] = ($repairCost[$i - 2] + $repairCost[$i - 1] + $repairCost[$i] + $repairCost[$i + 1]) / 4;
            }
            else if($i + 2 == 30 + 1)
            {
                $smoothedRepairCost[$i] = ($repairCost[$i - 2] + $repairCost[$i - 1] + $repairCost[$i]) / 3;
            }
            else
            {
                $smoothedRepairCost[$i] = ($repairCost[$i - 2] + $repairCost[$i - 1] + $repairCost[$i] + $repairCost[$i + 1] + $repairCost[$i + 2]) / 5;
            }

            if($i >= $vehicleAge && $i < $vehicleAge + 5)
            {
                $trueRepairCost += $smoothedRepairCost[$i];
            } 
        }

        return $trueRepairCost;
    }

    function calculateUsedPayloadCost($numYears)
    {
        include "getID.php";

        // add to detailed view
        $costPerMile = $_POST["payloadCost"];
        $vmt = $annualVmtYears;
        $totalCost;

        for($i = 0; $i < $numYears; $i++)
        {
            $totalCost[$i] = $costPerMile * $vmt[$i];
        }

        return $totalCost;
    }

    function calculateUsedChargingTime($numYears)
    {
        include "getID.php";

        // add to detailed view
        $costPerMile = $_POST["chargingTime"];
        $vmt = $annualVmtYears;
        $totalCost;

        for($i = 0; $i < $numYears; $i++)
        {
            $totalCost[$i] = $costPerMile * $vmt[$i];
        }

        return $totalCost;
    }

    function calculateUsedFuelInfrastructure($numYears)
    {
        // add to detailed view
        $costPerYearVehicle = $_POST["fuelInfrastructure"];
        $totalCost;

        for($i = 0; $i < $numYears; $i++)
        {
            $totalCost[$i] = $costPerYearVehicle;
        }

        return $totalCost;
    }

    function calculateUsedOperationalCost()
    {
        $totalCost = 0;
        $vehicleAge = $_POST["usedVehicleYear"];
        $payload = calculateUsedPayloadCost(30);
        $chargingTime = calculateUsedChargingTime(30);
        $fuelInfrastructure = calculateUsedChargingTime(30);

        for($i = 0; $i < 30; $i++)
        {
            if($i >= $vehicleAge && $i < $vehicleAge + 5)
            {
                $totalCost += $payload[$i] + $chargingTime[$i] + $fuelInfrastructure[$i];
            } 
        }

        return $totalCost;
    }
?>