<?php     
    function calculateBodyCost($powertrainType)
    {
        include "connectDatabase.php";

        $depreciationType = $_POST["depreciation"];
        $vehicleBody = $_POST["vehicleBody"];
        $technology = $_POST["technology"];
        $modelYear = $_POST["modelYear"];
        $bevRange = $_POST["bevRange"];
        $markupFactor = $_POST["markupFactor"];
        $depreciationRate = $_POST["depreciationRate"];
        $writeOff = $_POST["writeOff"];

        $bevCost = "BEV_" . 200;

        $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrainType' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
        $vehicleBodyCost = $connect->query($vehicleBodyCostQuery); $vehicleBodyCost = $vehicleBodyCost->fetch_assoc(); $vehicleBodyCost = $vehicleBodyCost["Body_Cost"];

        $bevCostQuery = "SELECT $bevCost FROM bev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE $modelYear";
        $bevCostResult = $connect->query($bevCostQuery); $bevCostResult = $bevCostResult->fetch_assoc(); $bevCostResult = $bevCostResult[$bevCost];

        if($depreciationType == "simple")
        {
            $bodyType = $powertrainType;
            $bodyCost;
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

            $bodyCost = $vBodyCost * $markupFactor;
            $bodyCost = $bodyCost * $depreciationRate;

            return $bodyCost;
        }

        else if($depreciationType == "advanced")
        {
            $bodyCost = $vehicleBodyCost * $markupFactor;

            $rate = $bodyCost / $writeOff;
            return $rate;
        }
    }

    function calculateFinancingCost($powertrainType)
    {
        include "connectDatabase.php";

        $depreciationType = $_POST["depreciation"];
        $vehicleBody = $_POST["vehicleBody"];
        $technology = $_POST["technology"];
        $modelYear = $_POST["modelYear"];
        $bevRange = $_POST["bevRange"];
        $markupFactor = $_POST["markupFactor"];
        $financeTerm = $_POST["financeTerm"];

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
        $loanPayment = $vehicleCost * (1 - .15);
        $monthlyPayment = round($loanPayment[0] * ($financeRate / 12) * pow((1 + $financeRate / 12), $financeTerm * 12) / (pow((1 + $financeRate / 12), $financeTerm * 12) - 1), 7);
        $financeCost = $financeRate * $loanPayment;
        
        return $financeCost;
    }

    function calculateFuelCost($powertrainType)
    {
        include "connectDatabase.php";

        $fuelPrice;
        $MPGCost;
        $fuelPricePerMile;
        $annualFuelPrice;
        $mpgYearDegradation = .001;
        $fuelPriceType = $_POST["fuelPriceMethod"];
        $bevMPGRange = "BEV_" . 200 . "_MPG";
        $technology = $_POST["technology"];
        $modelYear = $_POST["modelYear"];
        $vehicleBody = $_POST["vehicleBody"];
        $fuelType = $_POST["fuel"];

        $bevMPGQuery = "SELECT $bevMPGRange FROM bev_costs WHERE Technology LIKE '$technology' AND Model_Year LIKE $modelYear";
        $bevMPG = $connect->query($bevMPGQuery); $bevMPG = $bevMPG->fetch_assoc(); $bevMPG = $bevMPG[$bevMPGRange];

        $fuelMPGQuery = "SELECT MPG FROM vehicle_mpg WHERE Powertrain LIKE '$powertrainType' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Size LIKE '$modelYear'";
        $fuelMPG = $connect->query($fuelMPGQuery); $fuelMPG = $fuelMPG->fetch_assoc(); $fuelMPG = $fuelMPG["MPG"];

        if($powertrainType == "BEV")
        {
            $MPGCost = $bevMPG;
        }
        else
        {
            $MPGCost = $fuelMPG;
        }

        if($MPGCost == 0)
        {
            $MPGCost = $_POST["mpgPlugin"];
        }

   
        if($fuelType == "Biofuel")
        {
            $costComponentQuery = "SELECT Gasoline FROM aeo_fuel_prices";
            $result = $connect->query($costComponentQuery); $result = $result->fetch_assoc(); $result = $result["Gasoline"];
                
            $biofuelPremium = $_POST["biofuelPremium"];
            $fuelData = $_POST["biofuelCost"];
            $yearInfo = 0;

            $fuelPrice = $result + 1 * $biofuelPremium * ($fuelData - 1) / $fuelData;
        }
        else if($fuelType == "Hydrogen")
        {
            $hydrogenCost = $_POST["hydrogenCost"];
            $hydrogenPremium = $_POST["hydrogenPremium"];
            $yearInfo = 0;

            $fuelPrice = 5 + $hydrogenPremium * ($hydrogenCost - $yearInfo) / $hydrogenCost;
        }
        else if($fuelType == "Diesel_Electric")
        {
            $costComponentQuery = "SELECT Diesel FROM aeo_fuel_prices";
            $result = $connect->query($costComponentQuery); $result = $result->fetch_assoc(); $result = $result["Diesel"];
            $electricQuery = "SELECT Electric FROM aeo_fuel_prices";
            $electric = $connect->query($electricQuery); $electric = $electric->fetch_assoc(); $electric = $electric["Electric"];

            $PHEVUtilityFactor = 0.3;

            $fuelPrice = $result * (1 - $PHEVUtilityFactor) + $electric * $PHEVUtilityFactor;  
        }
        else
        {
            $costComponentQuery = "SELECT $fuelType FROM aeo_fuel_prices";
            $result = $connect->query($costComponentQuery); $result = $result->fetch_assoc(); $result = $result[$fuelType];
            $fuelPrice = $result;
        }

        $MPGCost = round($MPGCost * (1 - $mpgYearDegradation), 8);
        $fuelPricePerMile = $fuelPrice / $MPGCost;

        $vmtType = $_POST["vmt"];
        $vmtQuery = "SELECT $vmtType FROM annual_vmt";
        $vmt = $connect->query($vmtQuery); $vmt = $vmt->fetch_assoc(); $vmt = $vmt[$vmtType];
        $annualFuelCost = $fuelPricePerMile * $vmt;

        return $annualFuelCost;
    }

    function calculateInsruance($powertrainType)
    {
        include "connectDatabase.php";

        $markupFactor = $_POST["markupFactor"];
        $vehicleBody = $_POST["vehicleBody"];
        $technology = $_POST["technology"];
        $modelYear = $_POST["modelYear"];
        $vehicleBodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrainType' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";
        $vehicleBodyCost = $connect->query($vehicleBodyCostQuery); $vehicleBodyCost = $vehicleBodyCost->fetch_assoc(); $vehicleBodyCost = $vehicleBodyCost["Body_Cost"];

        $insuranceCost;
        $insuranceProportional = $_POST["insuranceProportional"];
        $insuranceProportionalNumber = 0;
        $insuranceFixed = $_POST["insuranceFixed"];
        $bodyCost = $vehicleBodyCost * $markupFactor;

        $insuranceProportionalNumber = $insuranceProportional * $bodyCost;
        $insuranceCost = $insuranceProportionalNumber + $insuranceFixed;

        return $insuranceCost;
    }

    function calculateTaxes()
    {
        $purchaseCost = $_POST["purchaseCost"];
        $salesTaxAndTitle = $_POST["salesTax"];
        $annualRegistration = $_POST["annualRegistration"];
        $totalCost;

        $totalCost = $purchaseCost * $salesTaxAndTitle + $annualRegistration;

        return $totalCost;
    }

    function calculateMaintenance($powertrainType)
    {
        include "connectDatabase.php";

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

        $vmtType = $_POST["vmt"];
        $vmtQuery = "SELECT $vmtType FROM annual_vmt";

        $i = 0;
        $totalVMT = $connect->query($vmtQuery); $totalVMT = $totalVMT->fetch_assoc(); $totalVMT = $totalVMT[$vmtType];
        $previousNum = 0;
        $totalCost = 0;
        $flag;
        $componentCost;

        for($i = 0; $i < 8; $i++)
        {
            $flag[$i] = floor($totalVMT / $firstServiceResults[$i]);
            $flag[$i] = round($flag[$i]);
            $componentCost[$i] = $flag[$i] * $costDataResults[$i] * $scalingFactorResults[$i];
        }

        for($i = 0; $i < 8; $i++)
        {
            $totalCost = $componentCost[$i] + $totalCost;
        }

        return $totalCost;
    }

    function calculateRepair($powertrainType)
    {
        include "connectDatabase.php";

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

        $vmtType = $_POST["vmt"];
        $vmtQuery = "SELECT $vmtType FROM annual_vmt";

        $i = 0;
        $totalVMT = $connect->query($vmtQuery); $totalVMT = $totalVMT->fetch_assoc(); $totalVMT = $totalVMT[$vmtType];
        $previousNum = 0;
        $totalCost = 0;
        $flag;
        $componentCost;

        for($i = 0; $i < 8; $i++)
        {
            $flag[$i] = floor($totalVMT / $firstServiceResults[$i]);
            $flag[$i] = round($flag[$i]);
            $componentCost[$i] = $flag[$i] * $costDataResults[$i] * $scalingFactorResults[$i];
        }

        for($i = 0; $i < 8; $i++)
        {
            $totalCost = $componentCost[$i] + $totalCost;
        }

        return $totalCost;
    }
?>