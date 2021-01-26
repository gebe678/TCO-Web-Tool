<?php
    include "fuelPriceCalculations.php";
    include "maintenancePriceCalculations.php";
    include "vehicleCalculations.php";
    include "insuranceCalculations.php";
    include "taxesAndFeesCalculations.php";
    #include "financeCalculations.php";
    include "laborCalculations.php";
    include "getID.php";
    include "database_cach.php";
    include "operationalCalculations.php";
    include "usedVehicleCalculations.php";
    include "newMaintenancePriceCalculations.php";
    include "calculateNewOperationalCost.php";

    $analysisWindow = $_POST["analysisWindow"];
    $discountRate = $_POST["discountRate"] / 100;
    $vehicleTco = $_POST["vehicleGraphControl"];

    $vehicleBodyCost;
    $financeCost;
    $annualFuelCost;
    $insuranceCost;
    $taxesAndFees;
    $maintenance;
    $repair;
    $operational;
    $infrastructure;
    $labor;
    $vehicleVmt;

    if(!checkDatabase())
    {
        if($vehicleTco === "depreciation")
        {
            $vehicle = calculateDepreciation($analysisWindow);
        }
        else if($vehicleTco === "vehiclePayment")
        {
            $vehicle = calculateVehiclePayments($analysisWindow);
        }
        
        $financeCost = calculateInterestPayment($analysisWindow);
        $annualFuelCost = calculateAnnualFuelCost($analysisWindow);
        $insuranceCost = calculateNewInsuranceCost($analysisWindow);
        $taxesAndFees = calculateNewTaxesAndFees($analysisWindow);
        $maintenance = newMaintenanceMain($analysisWindow);
        $repair = newRepairCalculations($analysisWindow);
        $infrastructure = 0;       
        $vehicleVmt = getVmtData();
        $labor = calculateNewLaborCost($analysisWindow);
        $operational;

        $extraPayLoad = calculateExtraPayloadCost($analysisWindow);
        $downTimeOpprutunity = calculateDowntimeOppurtunityCost($analysisWindow);

        $discountAnnualVmtYears = 0;
        $yearCostComponents = 0;
        $totalYearCostComponents = 0;

        for($i = 0; $i < $analysisWindow; $i++)
        {
            $discountAnnualVmtYears += $annualVmtYears[$i] / pow((1 + $discountRate), $i);
            $yearCostComponents += $vehicle[$i] + $financeCost[$i] + $maintenance[$i];

            $totalYearCostComponents += $vehicle[$i] + $financeCost[$i] + $annualFuelCost[$i] + $insuranceCost[$i] + $taxesAndFees[$i] + $maintenance[$i] + $labor[$i];
        }

        $finalYearCostComponents = $yearCostComponents / $discountAnnualVmtYears;
        $finalTotalYearCostComponents = $totalYearCostComponents / $discountAnnualVmtYears;

        for($i = 0; $i < $analysisWindow; $i++)
        {
            $downTimeOpprutunity[$i] = $downTimeOpprutunity[$i] * $finalYearCostComponents;
            $extraPayLoad[$i] = $extraPayLoad[$i] * $finalTotalYearCostComponents;

           // echo $extraPayLoad[$i] . " " . " " ;

            $operational[$i] = $downTimeOpprutunity[$i] + $extraPayLoad[$i];
        }

        for($i = 0; $i < $analysisWindow; $i++)
        {
           // writeData($i, $vehicle[$i], $financeCost[$i], $annualFuelCost[$i], $insuranceCost[$i], $taxesAndFees[$i], $maintenance[$i], $repair[$i], $operational[$i], $infrastructure, $labor[$i], $vehicleVmt[$i]);
        }
    }
    else
    {
        $info = searchForData();

        for($i = 0; $i < $analysisWindow; $i++)
        {
            $vehicle[$i] = $info[0][$i];
            $financeCost[$i] = $info[1][$i];
            $annualFuelCost[$i] = $info[2][$i];
            $insuranceCost[$i] = $info[3][$i];
            $taxesAndFees[$i] = $info[4][$i];
            $maintenance[$i] = $info[5][$i];
            $repair[$i] = $info[6][$i];
            $operational[$i] = $info[7][$i];
            $labor[$i] = $info[8][$i];
            $vehicleVmt[$i] = $info[9][$i];
        }
    }

    for($i = 0; $i < $analysisWindow; $i++)
    {
        $year = $i;
        //$vehicle[$i] = $vehicle[$i] / pow((1 + $discountRate), $year);
        $financeCost[$i] = $financeCost[$i] / pow((1 + $discountRate), $year);
        $annualFuelCost[$i] = $annualFuelCost[$i] / pow((1 + $discountRate), $year);
        $insuranceCost[$i] = $insuranceCost[$i] / pow((1 + $discountRate), $year);
        $taxesAndFees[$i] = $taxesAndFees[$i] / pow((1 + $discountRate), $year);
        $maintenance[$i] = $maintenance[$i] / pow((1 + $discountRate), $year);
        $repair[$i] = $repair[$i] / pow((1 + $discountRate), $year);
        $operational[$i] = $operational[$i] / pow((1 + $discountRate), $year);
        $labor[$i] = $labor[$i] / pow((1 + $discountRate), $year);
        $vehicleVmt[$i] = floatval($vehicleVmt[$i]);
    }

    if(empty($_POST["showPowertrainGraph"]) AND empty($_POST["showModelYearGraph"]) AND empty($_POST["usedVehicle"]))
    {
        $TCO_information = array($vehicle, $financeCost, $annualFuelCost, $insuranceCost, $taxesAndFees, $maintenance, $repair, $operational, $labor, $vehicleVmt);
    }
    
    else if(!empty($_POST["showPowertrainGraph"]))
    {
        $pBody = calculatePowertrainBody();
        $pFinance = calculatePowerTrainFinance();
        $pFuel = calculatePowertrainFUel();
        $pInsurance = calculatePowertrainInsurance();
        $pTaxes = calculatePowertrainTaxes();
        $pMaintenance = calculatePowertrainMaintenance();
        $pRepair = calculatePowertrainRepair();
        $pLabor = calculatePowertrainLabor();

        $TCO_information = array($vehicle, $financeCost, $annualFuelCost, $insuranceCost, $taxesAndFees, $maintenance, $repair, $operational, $labor, $vehicleVmt, $pBody, $pFinance, $pFuel, $pInsurance, $pTaxes, $pMaintenance, $pRepair, $pLabor);
    }
    else if(!empty($_POST["showModelYearGraph"]))
    {
        $mBody = calculateModelYearBody();
        $mFinance = calculateModelYearFinancing();
        $mFuel = calculateModelYearFuel();
        $mInsurance = calculateModelYearInsurance();
        $mTaxes = calculateModelYearTaxes();
        $mMaintenance = calculateModelYearMaintenance();
        $mRepair = calculateModelYearRepair();
        $mLabor = calculateModelYearLabor();

        $TCO_information = array($vehicle, $financeCost, $annualFuelCost, $insuranceCost, $taxesAndFees, $maintenance, $repair, $operational, $labor, $vehicleVmt, $mBody, $mFinance, $mFuel, $mInsurance, $mTaxes, $mMaintenance, $mRepair, $mLabor);
    }
    else if(!empty($_POST["usedVehicle"]))
    {
        $uBody = calculateUsedBodyCost();
        $uFinance = calculateUsedFinancingCost();
        $uFuel = calculateUsedFuelCost();
        $uInsurance = calculateUsedInsuranceCost();
        $uTaxes = calculateUsedTaxesCost();
        $uMaintenance = calculateUsedMaintenance();
        $uRepair = calculateUsedRepair();
        $uLabor = calculateNewLaborCostUsed();

        $TCO_information = array($vehicle, $financeCost, $annualFuelCost, $insuranceCost, $taxesAndFees, $maintenance, $repair, $operational, $labor, $vehicleVmt, $uBody, $uFinance, $uFuel, $uInsurance, $uTaxes, $uMaintenance, $uRepair, $uLabor);
    }

    echo json_encode($TCO_information);

    function getVmtData()
    {
        include "getID.php";

        return $annualVmtYears;
    }

    function calculatePowertrainBody()
    {
        include_once "powertrainData.php";

        if($_POST["vehicleClassSize"] === "LDV")
        {
            $powertrainBody[0] = calculateBodyCost("ICE-SI");
        }
        else
        {
            $powertrainBody[0] = 0;
        }
        $powertrainBody[1] = calculateBodyCost("ICE-CI");
        $powertrainBody[2] = calculateBodyCost("HEV-SI");
        $powertrainBody[3] = calculateBodyCost("PHEV");
        $powertrainBody[4] = calculateBodyCost("FCEV");
        $powertrainBody[5] = calculateBodyCost("BEV");

        return $powertrainBody;
    }

    function calculatePowerTrainFinance()
    {
        include_once "powertrainData.php";

        if($_POST["vehicleClassSize"] === "LDV")
        {
            $powertrainFinance[0] = calculateFinancingCost("ICE-SI");
        }
        else
        {
            $powertrainFinance[0] = 0;
        }
        $powertrainFinance[1] = calculateFinancingCost("ICE-CI");
        $powertrainFinance[2] = calculateFinancingCost("HEV-SI");
        $powertrainFinance[3] = calculateFinancingCost("PHEV");
        $powertrainFinance[4] = calculateFinancingCost("FCEV");
        $powertrainFinance[5] = calculateFinancingCost("BEV");

        return $powertrainFinance;
    }

    function calculatePowertrainFuel()
    {
        include_once "powertrainData.php";

        if($_POST["vehicleClassSize"] === "LDV")
        {
            $powertrainFuel[0] = calculateFuelCost("ICE-SI");
        }
        else
        {
            $powertrainFuel[0] = 0;
        }
        $powertrainFuel[1] = calculateFuelCost("ICE-CI");
        $powertrainFuel[2] = calculateFuelCost("HEV-SI");
        $powertrainFuel[3] = calculateFuelCost("PHEV");
        $powertrainFuel[4] = calculateFuelCost("FCEV");
        $powertrainFuel[5] = calculateFuelCost("BEV");

        return $powertrainFuel;
    }

    function calculatePowertrainInsurance()
    {
        include_once "powertrainData.php";

        if($_POST["vehicleClassSize"] === "LDV")
        {
            $powertrainInsurance[0] = calculateInsruance("ICE-SI");
        }
        else
        {
            $powertrainInsurance[0] = 0;
        }
        $powertrainInsurance[1] = calculateInsruance("ICE-CI");
        $powertrainInsurance[2] = calculateInsruance("HEV-SI");
        $powertrainInsurance[3] = calculateInsruance("PHEV");
        $powertrainInsurance[4] = calculateInsruance("FCEV");
        $powertrainInsurance[5] = calculateInsruance("BEV");

        return $powertrainInsurance;
    }

    function calculatePowertrainTaxes()
    {
        include_once "powertrainData.php";

        if($_POST["vehicleClassSize"] === "LDV")
        {
            $powertrainTaxes[0] = calculateTaxes("ICE-SI");
        }
        else
        {
            $powertrainTaxes[0] = 0;
        }
        $powertrainTaxes[1] = calculateTaxes();
        $powertrainTaxes[2] = calculateTaxes();
        $powertrainTaxes[3] = calculateTaxes();
        $powertrainTaxes[4] = calculateTaxes();
        $powertrainTaxes[5] = calculateTaxes();

        return $powertrainTaxes;
    }

    function calculatePowertrainMaintenance()
    {
        include_once "powertrainData.php";

        if($_POST["vehicleClassSize"] === "LDV")
        {
            $powertrainMaintenance[0] = calculateMaintenance("ICE-SI");
        }
        else
        {
            $powertrainMaintenance[0] = 0;
        }
        $powertrainMaintenance[1] = calculateMaintenance("ICE-CI");
        $powertrainMaintenance[2] = calculateMaintenance("HEV-SI");
        $powertrainMaintenance[3] = calculateMaintenance("PHEV");
        $powertrainMaintenance[4] = calculateMaintenance("FCEV");
        $powertrainMaintenance[5] = calculateMaintenance("BEV");

        return $powertrainMaintenance;
    }

    function calculatePowertrainRepair()
    {
        include_once "powertrainData.php";

        if($_POST["vehicleClassSize"] === "LDV")
        {
            $powertrainRepair[0] = calculateRepair("ICE-SI");
        }
        else
        {
            $powertrainRepair[0] = 0;
        }
        $powertrainRepair[1] = calculateRepair("ICE-CI");
        $powertrainRepair[2] = calculateRepair("HEV-SI");
        $powertrainRepair[3] = calculateRepair("PHEV");
        $powertrainRepair[4] = calculateRepair("FCEV");
        $powertrainRepair[5] = calculateRepair("BEV");

        return $powertrainRepair;
    }

    function calculatePowertrainLabor()
    {
        include_once "powertrainData.php";

        if($_POST["vehicleClassSize"] === "HDV")
        {
            $powertrainLabor[0] = 0;
            $powertrainLabor[1] = calculateNewLaborCostPowertrain("ICE-CI");
            $powertrainLabor[2] = calculateNewLaborCostPowertrain("HEV-SI");
            $powertrainLabor[3] = calculateNewLaborCostPowertrain("PHEV");
            $powertrainLabor[4] = calculateNewLaborCostPowertrain("FCEV");
            $powertrainLabor[5] = calculateNewLaborCostPowertrain("BEV");
        }
        else
        {
            for($i = 0; $i < 6; $i++)
            {
                $powertrainLabor[$i] = 0;
            }
        }
        return $powertrainLabor;
    }

    function calculateModelYearLabor()
    {
        include_once "modelYearData.php";

        if($_POST["vehicleClassSize"] === "HDV")
        {
            $powertrainLabor[0] = calculateNewLaborCostModelYear("2020");
            $powertrainLabor[1] = calculateNewLaborCostModelYear("2025");
            $powertrainLabor[2] = calculateNewLaborCostModelYear("2030");
            $powertrainLabor[3] = calculateNewLaborCostModelYear("2035");
            $powertrainLabor[4] = calculateNewLaborCostModelYear("2050");
        }
        else
        {
            for($i = 0; $i < 6; $i++)
            {
                $powertrainLabor[$i] = 0;
            }
        }
        return $powertrainLabor;
    }

    function calculateModelYearBody()
    {
        include_once "modelYearData.php";

        $modelYearBody[0] = calculateBodyCost("2020");
        $modelYearBody[1] = calculateBodyCost("2025");
        $modelYearBody[2] = calculateBodyCost("2030");
        $modelYearBody[3] = calculateBodyCost("2035");
        $modelYearBody[4] = calculateBodyCost("2050");

        return $modelYearBody;
    }

    function calculateModelYearFinancing()
    {
        include_once "modelYearData.php";

        $modelYearFinancing[0] = calculateFinancingCost("2020");
        $modelYearFinancing[1] = calculateFinancingCost("2025");
        $modelYearFinancing[2] = calculateFinancingCost("2030");
        $modelYearFinancing[3] = calculateFinancingCost("2035");
        $modelYearFinancing[4] = calculateFinancingCost("2050");

        return $modelYearFinancing;
    }
    function calculateModelYearFuel()
    {
        include_once "modelYearData.php";

        $modelYearFuel[0] = calculateFuelCost("2020");
        $modelYearFuel[1] = calculateFuelCost("2025");
        $modelYearFuel[2] = calculateFuelCost("2030");
        $modelYearFuel[3] = calculateFuelCost("2035");
        $modelYearFuel[4] = calculateFuelCost("2050");

        return $modelYearFuel;
    }

    function calculateModelYearInsurance()
    {
        include_once "modelYearData.php";

        $modelYearInsurance[0] = calculateInsruance("2020");
        $modelYearInsurance[1] = calculateInsruance("2025");
        $modelYearInsurance[2] = calculateInsruance("2030");
        $modelYearInsurance[3] = calculateInsruance("2035");
        $modelYearInsurance[4] = calculateInsruance("2050");

        return $modelYearInsurance;
    }

    function calculateModelYearTaxes()
    {
        include_once "modelYearData.php";

        $modelYearTaxes[0] = calculateTaxes("2020");
        $modelYearTaxes[1] = calculateTaxes("2025");
        $modelYearTaxes[2] = calculateTaxes("2030");
        $modelYearTaxes[3] = calculateTaxes("2035");
        $modelYearTaxes[4] = calculateTaxes("2050");

        return $modelYearTaxes;
    }

    function calculateModelYearMaintenance()
    {
        include_once "modelYearData.php";

        $modelYearMaintenance[0] = calculateMaintenance("2020");
        $modelYearMaintenance[1] = calculateMaintenance("2025");
        $modelYearMaintenance[2] = calculateMaintenance("2030");
        $modelYearMaintenance[3] = calculateMaintenance("2035");
        $modelYearMaintenance[4] = calculateMaintenance("2050");

        return $modelYearMaintenance;
    }

    function calculateModelYearRepair()
    {
        include_once "modelYearData.php";

        $modelYearRepair[0] = calculateRepair("2020");
        $modelYearRepair[1] = calculateRepair("2025");
        $modelYearRepair[2] = calculateRepair("2030");
        $modelYearRepair[3] = calculateRepair("2035");
        $modelYearRepair[4] = calculateRepair("2050");

        return $modelYearRepair;
    }
?>