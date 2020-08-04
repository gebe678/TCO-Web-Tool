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
    function calculateFuelCost($powertrainType)
    {
        include "connectDatabase.php";

        switch($powertrainType)
        {
            case "ICE-SI":
                return 0;
                break;
            case "ICE-CI":
                return 0;
                break;
            case "HEV-SI":
                return 0;
                break;
            case "PHEV":
                return 0;
                break;
            case "FCEV":
                return 0;
                break;
            case "BEV":
                return 0;
                break;
            default:
                echo "invalid powertrain selected";
        }

        return 0;
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