<?php 

    function checkDatabase()
    {
        include "connectDatabase.php";
        include "getID.php";
        $year = 0;

        $fuelPriceType = $_POST["fuelPriceMethod"];
        $fuelInfrastructure = $_POST["fuelInfrastructure"];
        $purchaseCost = $_POST["purchaseCost"];
        $analysisWindow = $_POST["analysisWindow"];
        $discountRate = $_POST["discountRate"];
        $annualRegistration = $_POST["annualRegistration"];
        $salesTaxAndTitle = $_POST["salesTax"];
        $depreciation = $_POST["depreciation"];
        $salvageValue = $_POST["salvageValue"];
        $financeTerm = $_POST["financeTerm"];
        $payloadCost = $_POST["payloadCost"];
        //$chargingTime = $_POST["chargingTime"];
        $fuelReference = $_POST["fuelReference"];
        $fuelCostInput = $_POST["fuelCostInput"];
        $apu = $_POST["APU"];
        $vehicleIncentive = $_POST["vehicleIncentive"];
        $interestRate = $_POST["interestRate"];
        $downPayment = $_POST["downPayment"];
        $insuranceType = $_POST["insuranceType"];
        $busOccupancy = $_POST["busOccupancy"];
        $fuelEfficiencyDegradation = $_POST["fuelEfficiencyDegradation"];
        $usedVehicleYear = $_POST["usedVehicleYear"];
        $customVmtValue = $_POST["customNewVMTValue"];
        $customVmtYear = $_POST["customNewVMTYear"] - 1;
        $customVmtValueUsed = $_POST["customVMTValue"];
        $idling = $_POST["idling"];
        $majorRepair = $_POST["majorLDVCheck"];
        $vehicleFinanced = $_POST["vehicleFinanced"];
        $userDefinedFuel = $_POST["userDefinedFuel"];
        $userDefinedPurchaseCost = $_POST["purchaseCost"];
        $userDefinedMPG = $_POST["userDefinedMPG"];
        $userDefinedInsuranceLiability = $_POST["insuranceLiability"];
        $userDefinedInsuranceDeductable = $_POST["insuranceDeductable"];
        $userDefinedFixedInsurance = $_POST["fixedInsurance"];
        $carbonEmission = $_POST["carbonEmission"];
        $vehicleTCOType = $_POST["vehicleGraphControl"];
        $additionalLaborCosts = $_POST["additionalLaborCosts"];
        $miscLaborCost = $_POST["miscLaborCost"];
        $chargeRate = $_POST["chargeRate"];
        $additionalOperational = $_POST["additionalOperational"];
        $averageDowntime = $_POST["averageDowntime"];

        if(!empty($_POST["usedVehicle"]))
        {
            $usedVehicle = "true";
        }
        else
        {
            $usedVehicle = "false";
        }

        if(!empty($_POST["customNewVmt"]))
        {
            $customNewVMT = "true";
        }
        else
        {
            $customNewVMT = "false";
        }

        if(!empty($_POST["customVMT"]))
        {
            $customVMT = "true";
        }
        else
        {
            $customVMT = "false";
        }

        $checkForSuccessQuery = "SELECT ID FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Vehicle_Write_Off LIKE '$writeOff' AND Incremental_Annual_Fuel_Price_Change LIKE '$annualFuelPriceIncrease'
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fueling_Infrastructure_Cost LIKE '$fuelInfrastructure' AND Fuel_Reference LIKE '$fuelReference' AND Premium_Gasoline_Markup LIKE '$premiumGasMarkup'
        AND Hydrogen_Success LIKE '$hydrogenSuccess' AND Vehicle_Cost_Input LIKE '$vehicleInput' AND Fuel_Economy_Input LIKE '$fuelCostInput' AND Idling_Cost_Toggle LIKE '$idling' AND APU LIKE '$apu'
        AND Vehicle_Incentive LIKE '$vehicleIncentive' AND Interest_Rate_Percent LIKE '$interestRate' AND Down_Payment_Percent LIKE '$downPayment' AND Insurance_Type LIKE '$insuranceType'
        AND Bus_Occupancy LIKE '$busOccupancy' AND Annual_MPG_Degradation LIKE '$fuelEfficiencyDegradation' AND Analysis_Window LIKE '$analysisWindow' AND Discount_Rate LIKE '$discountRate'
        AND Annual_Registration_Fee LIKE '$annualRegistration' AND Sales_Tax_And_Title LIKE '$salesTaxAndTitle' AND Insurance_Fixed_Rate LIKE '$insuranceFixed' AND Simple_Depreciation_Rate LIKE '$depreciationRate'
        AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE '$financeTerm' AND Used_Vehicle_Toggle LIKE '$usedVehicle' AND Major_Repair_Toggle LIKE '$majorRepair'
        AND Age_Of_Used_Car LIKE '$usedVehicleYear' AND Vehicle_Financed_Toggle LIKE '$vehicleFinanced' AND Bev_Range LIKE '$bevRange' AND Phev_Range LIKE '$phevRange' AND VMT_Type LIKE '$vmtType'
        AND Custom_New_Vmt_Toggle LIKE '$customNewVMT' AND Custom_New_Vmt_Value LIKE '$customVmtValue' AND Custom_New_Vmt_Year LIKE '$customVmtYear' AND Custom_Vmt LIKE '$customVMT' AND Custom_Vmt_Value LIKE '$customVmtValueUsed'
        AND User_Defined_Fuel LIKE '$userDefinedFuel' AND User_Defined_Purchase_Cost LIKE '$userDefinedPurchaseCost' AND User_Defined_MPG LIKE '$userDefinedMPG' AND User_Defined_Insurance_Liability LIKE '$userDefinedInsuranceLiability'
        AND User_Defined_Insurance_Deductable LIKE '$userDefinedInsuranceDeductable' AND User_Defined_Fixed_Insurance LIKE '$userDefinedFixedInsurance' AND Carbon_Emission LIKE '$carbonEmission' AND Vehicle_TCO_Type LIKE '$vehicleTCOType'
        AND Additional_Labor_Costs LIKE '$additionalLaborCosts' AND Misc_Labor_Cost LIKE '$miscLaborCost' AND Charging_Rate LIKE '$chargeRate' AND Additional_Operational_Costs LIKE '$additionalOperational'
        AND Average_Down_Time LIKE '$averageDowntime'";

        $result = $connect->query($checkForSuccessQuery);

        if(mysqli_num_rows($result) === 0)
        {
            return false;
        }

        return true;
    }

    function searchForData()
    {
        include "connectDatabase.php";
        include "getID.php";

        $fuelPriceType = $_POST["fuelPriceMethod"];
        $fuelInfrastructure = $_POST["fuelInfrastructure"];
        $purchaseCost = $_POST["purchaseCost"];
        $analysisWindow = $_POST["analysisWindow"];
        $depreciation = $_POST["depreciation"];
        $salvageValue = $_POST["salvageValue"];
        $financeTerm = $_POST["financeTerm"];
        $bevRange = $_POST["bevRange"];
        $discountRate = $_POST["discountRate"];
        $annualRegistration = $_POST["annualRegistration"];
        $salesTaxAndTitle = $_POST["salesTax"];
        $fuelReference = $_POST["fuelReference"];
        $fuelCostInput = $_POST["fuelCostInput"];
        $apu = $_POST["APU"];
        $vehicleIncentive = $_POST["vehicleIncentive"];
        $interestRate = $_POST["interestRate"];
        $downPayment = $_POST["downPayment"];
        $insuranceType = $_POST["insuranceType"];
        $busOccupancy = $_POST["busOccupancy"];
        $fuelEfficiencyDegradation = $_POST["fuelEfficiencyDegradation"];
        $usedVehicleYear = $_POST["usedVehicleYear"];
        $customVmtValue = $_POST["customNewVMTValue"];
        $customVmtYear = $_POST["customNewVMTYear"] - 1;
        $customVmtValueUsed = $_POST["customVMTValue"];
        $idling = $_POST["idling"];
        $majorRepair = $_POST["majorLDVCheck"];
        $vehicleFinanced = $_POST["vehicleFinanced"];
        $userDefinedFuel = $_POST["userDefinedFuel"];
        $userDefinedPurchaseCost = $_POST["purchaseCost"];
        $userDefinedMPG = $_POST["userDefinedMPG"];
        $userDefinedInsuranceLiability = $_POST["insuranceLiability"];
        $userDefinedInsuranceDeductable = $_POST["insuranceDeductable"];
        $userDefinedFixedInsurance = $_POST["fixedInsurance"];
        $carbonEmission = $_POST["carbonEmission"];
        $vehicleTCOType = $_POST["vehicleGraphControl"];
        $additionalLaborCosts = $_POST["additionalLaborCosts"];
        $miscLaborCost = $_POST["miscLaborCost"];
        $chargeRate = $_POST["chargeRate"];
        $additionalOperational = $_POST["additionalOperational"];
        $averageDowntime = $_POST["averageDowntime"];

        if(!empty($_POST["usedVehicle"]))
        {
            $usedVehicle = "true";
        }
        else
        {
            $usedVehicle = "false";
        }

        if(!empty($_POST["customNewVmt"]))
        {
            $customNewVMT = "true";
        }
        else
        {
            $customNewVMT = "false";
        }

        if(!empty($_POST["customVMT"]))
        {
            $customVMT = "true";
        }
        else
        {
            $customVMT = "false";
        }
        
        $vehicleQuery = "SELECT Vehicle FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Vehicle_Write_Off LIKE '$writeOff' AND Incremental_Annual_Fuel_Price_Change LIKE '$annualFuelPriceIncrease'
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fueling_Infrastructure_Cost LIKE '$fuelInfrastructure' AND Fuel_Reference LIKE '$fuelReference' AND Premium_Gasoline_Markup LIKE '$premiumGasMarkup'
        AND Hydrogen_Success LIKE '$hydrogenSuccess' AND Vehicle_Cost_Input LIKE '$vehicleInput' AND Fuel_Economy_Input LIKE '$fuelCostInput' AND Idling_Cost_Toggle LIKE '$idling' AND APU LIKE '$apu'
        AND Vehicle_Incentive LIKE '$vehicleIncentive' AND Interest_Rate_Percent LIKE '$interestRate' AND Down_Payment_Percent LIKE '$downPayment' AND Insurance_Type LIKE '$insuranceType'
        AND Bus_Occupancy LIKE '$busOccupancy' AND Annual_MPG_Degradation LIKE '$fuelEfficiencyDegradation' AND Analysis_Window LIKE '$analysisWindow' AND Discount_Rate LIKE '$discountRate'
        AND Annual_Registration_Fee LIKE '$annualRegistration' AND Sales_Tax_And_Title LIKE '$salesTaxAndTitle' AND Insurance_Fixed_Rate LIKE '$insuranceFixed' AND Simple_Depreciation_Rate LIKE '$depreciationRate'
        AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE '$financeTerm' AND Used_Vehicle_Toggle LIKE '$usedVehicle' AND Major_Repair_Toggle LIKE '$majorRepair'
        AND Age_Of_Used_Car LIKE '$usedVehicleYear' AND Vehicle_Financed_Toggle LIKE '$vehicleFinanced' AND Bev_Range LIKE '$bevRange' AND Phev_Range LIKE '$phevRange' AND VMT_Type LIKE '$vmtType'
        AND Custom_New_Vmt_Toggle LIKE '$customNewVMT' AND Custom_New_Vmt_Value LIKE '$customVmtValue' AND Custom_New_Vmt_Year LIKE '$customVmtYear' AND Custom_Vmt LIKE '$customVMT' AND Custom_Vmt_Value LIKE '$customVmtValueUsed'
        AND User_Defined_Fuel LIKE '$userDefinedFuel' AND User_Defined_Purchase_Cost LIKE '$userDefinedPurchaseCost' AND User_Defined_MPG LIKE '$userDefinedMPG' AND User_Defined_Insurance_Liability LIKE '$userDefinedInsuranceLiability'
        AND User_Defined_Insurance_Deductable LIKE '$userDefinedInsuranceDeductable' AND User_Defined_Fixed_Insurance LIKE '$userDefinedFixedInsurance' AND Carbon_Emission LIKE '$carbonEmission' AND Vehicle_TCO_Type LIKE '$vehicleTCOType'
        AND Additional_Labor_Costs LIKE '$additionalLaborCosts' AND Misc_Labor_Cost LIKE '$miscLaborCost' AND Charging_Rate LIKE '$chargeRate' AND Additional_Operational_Costs LIKE '$additionalOperational'
        AND Average_Down_Time LIKE '$averageDowntime'";

        $financingQuery = "SELECT Financing FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Vehicle_Write_Off LIKE '$writeOff' AND Incremental_Annual_Fuel_Price_Change LIKE '$annualFuelPriceIncrease'
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fueling_Infrastructure_Cost LIKE '$fuelInfrastructure' AND Fuel_Reference LIKE '$fuelReference' AND Premium_Gasoline_Markup LIKE '$premiumGasMarkup'
        AND Hydrogen_Success LIKE '$hydrogenSuccess' AND Vehicle_Cost_Input LIKE '$vehicleInput' AND Fuel_Economy_Input LIKE '$fuelCostInput' AND Idling_Cost_Toggle LIKE '$idling' AND APU LIKE '$apu'
        AND Vehicle_Incentive LIKE '$vehicleIncentive' AND Interest_Rate_Percent LIKE '$interestRate' AND Down_Payment_Percent LIKE '$downPayment' AND Insurance_Type LIKE '$insuranceType'
        AND Bus_Occupancy LIKE '$busOccupancy' AND Annual_MPG_Degradation LIKE '$fuelEfficiencyDegradation' AND Analysis_Window LIKE '$analysisWindow' AND Discount_Rate LIKE '$discountRate'
        AND Annual_Registration_Fee LIKE '$annualRegistration' AND Sales_Tax_And_Title LIKE '$salesTaxAndTitle' AND Insurance_Fixed_Rate LIKE '$insuranceFixed' AND Simple_Depreciation_Rate LIKE '$depreciationRate'
        AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE '$financeTerm' AND Used_Vehicle_Toggle LIKE '$usedVehicle' AND Major_Repair_Toggle LIKE '$majorRepair'
        AND Age_Of_Used_Car LIKE '$usedVehicleYear' AND Vehicle_Financed_Toggle LIKE '$vehicleFinanced' AND Bev_Range LIKE '$bevRange' AND Phev_Range LIKE '$phevRange' AND VMT_Type LIKE '$vmtType'
        AND Custom_New_Vmt_Toggle LIKE '$customNewVMT' AND Custom_New_Vmt_Value LIKE '$customVmtValue' AND Custom_New_Vmt_Year LIKE '$customVmtYear' AND Custom_Vmt LIKE '$customVMT' AND Custom_Vmt_Value LIKE '$customVmtValueUsed'
        AND User_Defined_Fuel LIKE '$userDefinedFuel' AND User_Defined_Purchase_Cost LIKE '$userDefinedPurchaseCost' AND User_Defined_MPG LIKE '$userDefinedMPG' AND User_Defined_Insurance_Liability LIKE '$userDefinedInsuranceLiability'
        AND User_Defined_Insurance_Deductable LIKE '$userDefinedInsuranceDeductable' AND User_Defined_Fixed_Insurance LIKE '$userDefinedFixedInsurance' AND Carbon_Emission LIKE '$carbonEmission' AND Vehicle_TCO_Type LIKE '$vehicleTCOType'
        AND Additional_Labor_Costs LIKE '$additionalLaborCosts' AND Misc_Labor_Cost LIKE '$miscLaborCost' AND Charging_Rate LIKE '$chargeRate' AND Additional_Operational_Costs LIKE '$additionalOperational'
        AND Average_Down_Time LIKE '$averageDowntime'";

        $fuelQuery = "SELECT Annual_Fuel FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Vehicle_Write_Off LIKE '$writeOff' AND Incremental_Annual_Fuel_Price_Change LIKE '$annualFuelPriceIncrease'
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fueling_Infrastructure_Cost LIKE '$fuelInfrastructure' AND Fuel_Reference LIKE '$fuelReference' AND Premium_Gasoline_Markup LIKE '$premiumGasMarkup'
        AND Hydrogen_Success LIKE '$hydrogenSuccess' AND Vehicle_Cost_Input LIKE '$vehicleInput' AND Fuel_Economy_Input LIKE '$fuelCostInput' AND Idling_Cost_Toggle LIKE '$idling' AND APU LIKE '$apu'
        AND Vehicle_Incentive LIKE '$vehicleIncentive' AND Interest_Rate_Percent LIKE '$interestRate' AND Down_Payment_Percent LIKE '$downPayment' AND Insurance_Type LIKE '$insuranceType'
        AND Bus_Occupancy LIKE '$busOccupancy' AND Annual_MPG_Degradation LIKE '$fuelEfficiencyDegradation' AND Analysis_Window LIKE '$analysisWindow' AND Discount_Rate LIKE '$discountRate'
        AND Annual_Registration_Fee LIKE '$annualRegistration' AND Sales_Tax_And_Title LIKE '$salesTaxAndTitle' AND Insurance_Fixed_Rate LIKE '$insuranceFixed' AND Simple_Depreciation_Rate LIKE '$depreciationRate'
        AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE '$financeTerm' AND Used_Vehicle_Toggle LIKE '$usedVehicle' AND Major_Repair_Toggle LIKE '$majorRepair'
        AND Age_Of_Used_Car LIKE '$usedVehicleYear' AND Vehicle_Financed_Toggle LIKE '$vehicleFinanced' AND Bev_Range LIKE '$bevRange' AND Phev_Range LIKE '$phevRange' AND VMT_Type LIKE '$vmtType'
        AND Custom_New_Vmt_Toggle LIKE '$customNewVMT' AND Custom_New_Vmt_Value LIKE '$customVmtValue' AND Custom_New_Vmt_Year LIKE '$customVmtYear' AND Custom_Vmt LIKE '$customVMT' AND Custom_Vmt_Value LIKE '$customVmtValueUsed'
        AND User_Defined_Fuel LIKE '$userDefinedFuel' AND User_Defined_Purchase_Cost LIKE '$userDefinedPurchaseCost' AND User_Defined_MPG LIKE '$userDefinedMPG' AND User_Defined_Insurance_Liability LIKE '$userDefinedInsuranceLiability'
        AND User_Defined_Insurance_Deductable LIKE '$userDefinedInsuranceDeductable' AND User_Defined_Fixed_Insurance LIKE '$userDefinedFixedInsurance' AND Carbon_Emission LIKE '$carbonEmission' AND Vehicle_TCO_Type LIKE '$vehicleTCOType'
        AND Additional_Labor_Costs LIKE '$additionalLaborCosts' AND Misc_Labor_Cost LIKE '$miscLaborCost' AND Charging_Rate LIKE '$chargeRate' AND Additional_Operational_Costs LIKE '$additionalOperational'
        AND Average_Down_Time LIKE '$averageDowntime'";

        $insuranceQuery = "SELECT Insurance FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Vehicle_Write_Off LIKE '$writeOff' AND Incremental_Annual_Fuel_Price_Change LIKE '$annualFuelPriceIncrease'
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fueling_Infrastructure_Cost LIKE '$fuelInfrastructure' AND Fuel_Reference LIKE '$fuelReference' AND Premium_Gasoline_Markup LIKE '$premiumGasMarkup'
        AND Hydrogen_Success LIKE '$hydrogenSuccess' AND Vehicle_Cost_Input LIKE '$vehicleInput' AND Fuel_Economy_Input LIKE '$fuelCostInput' AND Idling_Cost_Toggle LIKE '$idling' AND APU LIKE '$apu'
        AND Vehicle_Incentive LIKE '$vehicleIncentive' AND Interest_Rate_Percent LIKE '$interestRate' AND Down_Payment_Percent LIKE '$downPayment' AND Insurance_Type LIKE '$insuranceType'
        AND Bus_Occupancy LIKE '$busOccupancy' AND Annual_MPG_Degradation LIKE '$fuelEfficiencyDegradation' AND Analysis_Window LIKE '$analysisWindow' AND Discount_Rate LIKE '$discountRate'
        AND Annual_Registration_Fee LIKE '$annualRegistration' AND Sales_Tax_And_Title LIKE '$salesTaxAndTitle' AND Insurance_Fixed_Rate LIKE '$insuranceFixed' AND Simple_Depreciation_Rate LIKE '$depreciationRate'
        AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE '$financeTerm' AND Used_Vehicle_Toggle LIKE '$usedVehicle' AND Major_Repair_Toggle LIKE '$majorRepair'
        AND Age_Of_Used_Car LIKE '$usedVehicleYear' AND Vehicle_Financed_Toggle LIKE '$vehicleFinanced' AND Bev_Range LIKE '$bevRange' AND Phev_Range LIKE '$phevRange' AND VMT_Type LIKE '$vmtType'
        AND Custom_New_Vmt_Toggle LIKE '$customNewVMT' AND Custom_New_Vmt_Value LIKE '$customVmtValue' AND Custom_New_Vmt_Year LIKE '$customVmtYear' AND Custom_Vmt LIKE '$customVMT' AND Custom_Vmt_Value LIKE '$customVmtValueUsed'
        AND User_Defined_Fuel LIKE '$userDefinedFuel' AND User_Defined_Purchase_Cost LIKE '$userDefinedPurchaseCost' AND User_Defined_MPG LIKE '$userDefinedMPG' AND User_Defined_Insurance_Liability LIKE '$userDefinedInsuranceLiability'
        AND User_Defined_Insurance_Deductable LIKE '$userDefinedInsuranceDeductable' AND User_Defined_Fixed_Insurance LIKE '$userDefinedFixedInsurance' AND Carbon_Emission LIKE '$carbonEmission' AND Vehicle_TCO_Type LIKE '$vehicleTCOType'
        AND Additional_Labor_Costs LIKE '$additionalLaborCosts' AND Misc_Labor_Cost LIKE '$miscLaborCost' AND Charging_Rate LIKE '$chargeRate' AND Additional_Operational_Costs LIKE '$additionalOperational'
        AND Average_Down_Time LIKE '$averageDowntime'";

        $taxesQuery = "SELECT Taxes_And_Fees FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Vehicle_Write_Off LIKE '$writeOff' AND Incremental_Annual_Fuel_Price_Change LIKE '$annualFuelPriceIncrease'
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fueling_Infrastructure_Cost LIKE '$fuelInfrastructure' AND Fuel_Reference LIKE '$fuelReference' AND Premium_Gasoline_Markup LIKE '$premiumGasMarkup'
        AND Hydrogen_Success LIKE '$hydrogenSuccess' AND Vehicle_Cost_Input LIKE '$vehicleInput' AND Fuel_Economy_Input LIKE '$fuelCostInput' AND Idling_Cost_Toggle LIKE '$idling' AND APU LIKE '$apu'
        AND Vehicle_Incentive LIKE '$vehicleIncentive' AND Interest_Rate_Percent LIKE '$interestRate' AND Down_Payment_Percent LIKE '$downPayment' AND Insurance_Type LIKE '$insuranceType'
        AND Bus_Occupancy LIKE '$busOccupancy' AND Annual_MPG_Degradation LIKE '$fuelEfficiencyDegradation' AND Analysis_Window LIKE '$analysisWindow' AND Discount_Rate LIKE '$discountRate'
        AND Annual_Registration_Fee LIKE '$annualRegistration' AND Sales_Tax_And_Title LIKE '$salesTaxAndTitle' AND Insurance_Fixed_Rate LIKE '$insuranceFixed' AND Simple_Depreciation_Rate LIKE '$depreciationRate'
        AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE '$financeTerm' AND Used_Vehicle_Toggle LIKE '$usedVehicle' AND Major_Repair_Toggle LIKE '$majorRepair'
        AND Age_Of_Used_Car LIKE '$usedVehicleYear' AND Vehicle_Financed_Toggle LIKE '$vehicleFinanced' AND Bev_Range LIKE '$bevRange' AND Phev_Range LIKE '$phevRange' AND VMT_Type LIKE '$vmtType'
        AND Custom_New_Vmt_Toggle LIKE '$customNewVMT' AND Custom_New_Vmt_Value LIKE '$customVmtValue' AND Custom_New_Vmt_Year LIKE '$customVmtYear' AND Custom_Vmt LIKE '$customVMT' AND Custom_Vmt_Value LIKE '$customVmtValueUsed'
        AND User_Defined_Fuel LIKE '$userDefinedFuel' AND User_Defined_Purchase_Cost LIKE '$userDefinedPurchaseCost' AND User_Defined_MPG LIKE '$userDefinedMPG' AND User_Defined_Insurance_Liability LIKE '$userDefinedInsuranceLiability'
        AND User_Defined_Insurance_Deductable LIKE '$userDefinedInsuranceDeductable' AND User_Defined_Fixed_Insurance LIKE '$userDefinedFixedInsurance' AND Carbon_Emission LIKE '$carbonEmission' AND Vehicle_TCO_Type LIKE '$vehicleTCOType'
        AND Additional_Labor_Costs LIKE '$additionalLaborCosts' AND Misc_Labor_Cost LIKE '$miscLaborCost' AND Charging_Rate LIKE '$chargeRate' AND Additional_Operational_Costs LIKE '$additionalOperational'
        AND Average_Down_Time LIKE '$averageDowntime'";

        $maintenanceQuery = "SELECT Maintenance FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Vehicle_Write_Off LIKE '$writeOff' AND Incremental_Annual_Fuel_Price_Change LIKE '$annualFuelPriceIncrease'
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fueling_Infrastructure_Cost LIKE '$fuelInfrastructure' AND Fuel_Reference LIKE '$fuelReference' AND Premium_Gasoline_Markup LIKE '$premiumGasMarkup'
        AND Hydrogen_Success LIKE '$hydrogenSuccess' AND Vehicle_Cost_Input LIKE '$vehicleInput' AND Fuel_Economy_Input LIKE '$fuelCostInput' AND Idling_Cost_Toggle LIKE '$idling' AND APU LIKE '$apu'
        AND Vehicle_Incentive LIKE '$vehicleIncentive' AND Interest_Rate_Percent LIKE '$interestRate' AND Down_Payment_Percent LIKE '$downPayment' AND Insurance_Type LIKE '$insuranceType'
        AND Bus_Occupancy LIKE '$busOccupancy' AND Annual_MPG_Degradation LIKE '$fuelEfficiencyDegradation' AND Analysis_Window LIKE '$analysisWindow' AND Discount_Rate LIKE '$discountRate'
        AND Annual_Registration_Fee LIKE '$annualRegistration' AND Sales_Tax_And_Title LIKE '$salesTaxAndTitle' AND Insurance_Fixed_Rate LIKE '$insuranceFixed' AND Simple_Depreciation_Rate LIKE '$depreciationRate'
        AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE '$financeTerm' AND Used_Vehicle_Toggle LIKE '$usedVehicle' AND Major_Repair_Toggle LIKE '$majorRepair'
        AND Age_Of_Used_Car LIKE '$usedVehicleYear' AND Vehicle_Financed_Toggle LIKE '$vehicleFinanced' AND Bev_Range LIKE '$bevRange' AND Phev_Range LIKE '$phevRange' AND VMT_Type LIKE '$vmtType'
        AND Custom_New_Vmt_Toggle LIKE '$customNewVMT' AND Custom_New_Vmt_Value LIKE '$customVmtValue' AND Custom_New_Vmt_Year LIKE '$customVmtYear' AND Custom_Vmt LIKE '$customVMT' AND Custom_Vmt_Value LIKE '$customVmtValueUsed'
        AND User_Defined_Fuel LIKE '$userDefinedFuel' AND User_Defined_Purchase_Cost LIKE '$userDefinedPurchaseCost' AND User_Defined_MPG LIKE '$userDefinedMPG' AND User_Defined_Insurance_Liability LIKE '$userDefinedInsuranceLiability'
        AND User_Defined_Insurance_Deductable LIKE '$userDefinedInsuranceDeductable' AND User_Defined_Fixed_Insurance LIKE '$userDefinedFixedInsurance' AND Carbon_Emission LIKE '$carbonEmission' AND Vehicle_TCO_Type LIKE '$vehicleTCOType'
        AND Additional_Labor_Costs LIKE '$additionalLaborCosts' AND Misc_Labor_Cost LIKE '$miscLaborCost' AND Charging_Rate LIKE '$chargeRate' AND Additional_Operational_Costs LIKE '$additionalOperational'
        AND Average_Down_Time LIKE '$averageDowntime'";

        $repairQuery = "SELECT Repair FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Vehicle_Write_Off LIKE '$writeOff' AND Incremental_Annual_Fuel_Price_Change LIKE '$annualFuelPriceIncrease'
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fueling_Infrastructure_Cost LIKE '$fuelInfrastructure' AND Fuel_Reference LIKE '$fuelReference' AND Premium_Gasoline_Markup LIKE '$premiumGasMarkup'
        AND Hydrogen_Success LIKE '$hydrogenSuccess' AND Vehicle_Cost_Input LIKE '$vehicleInput' AND Fuel_Economy_Input LIKE '$fuelCostInput' AND Idling_Cost_Toggle LIKE '$idling' AND APU LIKE '$apu'
        AND Vehicle_Incentive LIKE '$vehicleIncentive' AND Interest_Rate_Percent LIKE '$interestRate' AND Down_Payment_Percent LIKE '$downPayment' AND Insurance_Type LIKE '$insuranceType'
        AND Bus_Occupancy LIKE '$busOccupancy' AND Annual_MPG_Degradation LIKE '$fuelEfficiencyDegradation' AND Analysis_Window LIKE '$analysisWindow' AND Discount_Rate LIKE '$discountRate'
        AND Annual_Registration_Fee LIKE '$annualRegistration' AND Sales_Tax_And_Title LIKE '$salesTaxAndTitle' AND Insurance_Fixed_Rate LIKE '$insuranceFixed' AND Simple_Depreciation_Rate LIKE '$depreciationRate'
        AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE '$financeTerm' AND Used_Vehicle_Toggle LIKE '$usedVehicle' AND Major_Repair_Toggle LIKE '$majorRepair'
        AND Age_Of_Used_Car LIKE '$usedVehicleYear' AND Vehicle_Financed_Toggle LIKE '$vehicleFinanced' AND Bev_Range LIKE '$bevRange' AND Phev_Range LIKE '$phevRange' AND VMT_Type LIKE '$vmtType'
        AND Custom_New_Vmt_Toggle LIKE '$customNewVMT' AND Custom_New_Vmt_Value LIKE '$customVmtValue' AND Custom_New_Vmt_Year LIKE '$customVmtYear' AND Custom_Vmt LIKE '$customVMT' AND Custom_Vmt_Value LIKE '$customVmtValueUsed'
        AND User_Defined_Fuel LIKE '$userDefinedFuel' AND User_Defined_Purchase_Cost LIKE '$userDefinedPurchaseCost' AND User_Defined_MPG LIKE '$userDefinedMPG' AND User_Defined_Insurance_Liability LIKE '$userDefinedInsuranceLiability'
        AND User_Defined_Insurance_Deductable LIKE '$userDefinedInsuranceDeductable' AND User_Defined_Fixed_Insurance LIKE '$userDefinedFixedInsurance' AND Carbon_Emission LIKE '$carbonEmission' AND Vehicle_TCO_Type LIKE '$vehicleTCOType'
        AND Additional_Labor_Costs LIKE '$additionalLaborCosts' AND Misc_Labor_Cost LIKE '$miscLaborCost' AND Charging_Rate LIKE '$chargeRate' AND Additional_Operational_Costs LIKE '$additionalOperational'
        AND Average_Down_Time LIKE '$averageDowntime'";

        $operationalQuery = "SELECT Operational FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Vehicle_Write_Off LIKE '$writeOff' AND Incremental_Annual_Fuel_Price_Change LIKE '$annualFuelPriceIncrease'
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fueling_Infrastructure_Cost LIKE '$fuelInfrastructure' AND Fuel_Reference LIKE '$fuelReference' AND Premium_Gasoline_Markup LIKE '$premiumGasMarkup'
        AND Hydrogen_Success LIKE '$hydrogenSuccess' AND Vehicle_Cost_Input LIKE '$vehicleInput' AND Fuel_Economy_Input LIKE '$fuelCostInput' AND Idling_Cost_Toggle LIKE '$idling' AND APU LIKE '$apu'
        AND Vehicle_Incentive LIKE '$vehicleIncentive' AND Interest_Rate_Percent LIKE '$interestRate' AND Down_Payment_Percent LIKE '$downPayment' AND Insurance_Type LIKE '$insuranceType'
        AND Bus_Occupancy LIKE '$busOccupancy' AND Annual_MPG_Degradation LIKE '$fuelEfficiencyDegradation' AND Analysis_Window LIKE '$analysisWindow' AND Discount_Rate LIKE '$discountRate'
        AND Annual_Registration_Fee LIKE '$annualRegistration' AND Sales_Tax_And_Title LIKE '$salesTaxAndTitle' AND Insurance_Fixed_Rate LIKE '$insuranceFixed' AND Simple_Depreciation_Rate LIKE '$depreciationRate'
        AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE '$financeTerm' AND Used_Vehicle_Toggle LIKE '$usedVehicle' AND Major_Repair_Toggle LIKE '$majorRepair'
        AND Age_Of_Used_Car LIKE '$usedVehicleYear' AND Vehicle_Financed_Toggle LIKE '$vehicleFinanced' AND Bev_Range LIKE '$bevRange' AND Phev_Range LIKE '$phevRange' AND VMT_Type LIKE '$vmtType'
        AND Custom_New_Vmt_Toggle LIKE '$customNewVMT' AND Custom_New_Vmt_Value LIKE '$customVmtValue' AND Custom_New_Vmt_Year LIKE '$customVmtYear' AND Custom_Vmt LIKE '$customVMT' AND Custom_Vmt_Value LIKE '$customVmtValueUsed'
        AND User_Defined_Fuel LIKE '$userDefinedFuel' AND User_Defined_Purchase_Cost LIKE '$userDefinedPurchaseCost' AND User_Defined_MPG LIKE '$userDefinedMPG' AND User_Defined_Insurance_Liability LIKE '$userDefinedInsuranceLiability'
        AND User_Defined_Insurance_Deductable LIKE '$userDefinedInsuranceDeductable' AND User_Defined_Fixed_Insurance LIKE '$userDefinedFixedInsurance' AND Carbon_Emission LIKE '$carbonEmission' AND Vehicle_TCO_Type LIKE '$vehicleTCOType'
        AND Additional_Labor_Costs LIKE '$additionalLaborCosts' AND Misc_Labor_Cost LIKE '$miscLaborCost' AND Charging_Rate LIKE '$chargeRate' AND Additional_Operational_Costs LIKE '$additionalOperational'
        AND Average_Down_Time LIKE '$averageDowntime'";

        $laborQuery = "SELECT Labor FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Vehicle_Write_Off LIKE '$writeOff' AND Incremental_Annual_Fuel_Price_Change LIKE '$annualFuelPriceIncrease'
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fueling_Infrastructure_Cost LIKE '$fuelInfrastructure' AND Fuel_Reference LIKE '$fuelReference' AND Premium_Gasoline_Markup LIKE '$premiumGasMarkup'
        AND Hydrogen_Success LIKE '$hydrogenSuccess' AND Vehicle_Cost_Input LIKE '$vehicleInput' AND Fuel_Economy_Input LIKE '$fuelCostInput' AND Idling_Cost_Toggle LIKE '$idling' AND APU LIKE '$apu'
        AND Vehicle_Incentive LIKE '$vehicleIncentive' AND Interest_Rate_Percent LIKE '$interestRate' AND Down_Payment_Percent LIKE '$downPayment' AND Insurance_Type LIKE '$insuranceType'
        AND Bus_Occupancy LIKE '$busOccupancy' AND Annual_MPG_Degradation LIKE '$fuelEfficiencyDegradation' AND Analysis_Window LIKE '$analysisWindow' AND Discount_Rate LIKE '$discountRate'
        AND Annual_Registration_Fee LIKE '$annualRegistration' AND Sales_Tax_And_Title LIKE '$salesTaxAndTitle' AND Insurance_Fixed_Rate LIKE '$insuranceFixed' AND Simple_Depreciation_Rate LIKE '$depreciationRate'
        AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE '$financeTerm' AND Used_Vehicle_Toggle LIKE '$usedVehicle' AND Major_Repair_Toggle LIKE '$majorRepair'
        AND Age_Of_Used_Car LIKE '$usedVehicleYear' AND Vehicle_Financed_Toggle LIKE '$vehicleFinanced' AND Bev_Range LIKE '$bevRange' AND Phev_Range LIKE '$phevRange' AND VMT_Type LIKE '$vmtType'
        AND Custom_New_Vmt_Toggle LIKE '$customNewVMT' AND Custom_New_Vmt_Value LIKE '$customVmtValue' AND Custom_New_Vmt_Year LIKE '$customVmtYear' AND Custom_Vmt LIKE '$customVMT' AND Custom_Vmt_Value LIKE '$customVmtValueUsed'
        AND User_Defined_Fuel LIKE '$userDefinedFuel' AND User_Defined_Purchase_Cost LIKE '$userDefinedPurchaseCost' AND User_Defined_MPG LIKE '$userDefinedMPG' AND User_Defined_Insurance_Liability LIKE '$userDefinedInsuranceLiability'
        AND User_Defined_Insurance_Deductable LIKE '$userDefinedInsuranceDeductable' AND User_Defined_Fixed_Insurance LIKE '$userDefinedFixedInsurance' AND Carbon_Emission LIKE '$carbonEmission' AND Vehicle_TCO_Type LIKE '$vehicleTCOType'
        AND Additional_Labor_Costs LIKE '$additionalLaborCosts' AND Misc_Labor_Cost LIKE '$miscLaborCost' AND Charging_Rate LIKE '$chargeRate' AND Additional_Operational_Costs LIKE '$additionalOperational'
        AND Average_Down_Time LIKE '$averageDowntime'";

        $vmtQuery = "SELECT VMT FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Vehicle_Write_Off LIKE '$writeOff' AND Incremental_Annual_Fuel_Price_Change LIKE '$annualFuelPriceIncrease'
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fueling_Infrastructure_Cost LIKE '$fuelInfrastructure' AND Fuel_Reference LIKE '$fuelReference' AND Premium_Gasoline_Markup LIKE '$premiumGasMarkup'
        AND Hydrogen_Success LIKE '$hydrogenSuccess' AND Vehicle_Cost_Input LIKE '$vehicleInput' AND Fuel_Economy_Input LIKE '$fuelCostInput' AND Idling_Cost_Toggle LIKE '$idling' AND APU LIKE '$apu'
        AND Vehicle_Incentive LIKE '$vehicleIncentive' AND Interest_Rate_Percent LIKE '$interestRate' AND Down_Payment_Percent LIKE '$downPayment' AND Insurance_Type LIKE '$insuranceType'
        AND Bus_Occupancy LIKE '$busOccupancy' AND Annual_MPG_Degradation LIKE '$fuelEfficiencyDegradation' AND Analysis_Window LIKE '$analysisWindow' AND Discount_Rate LIKE '$discountRate'
        AND Annual_Registration_Fee LIKE '$annualRegistration' AND Sales_Tax_And_Title LIKE '$salesTaxAndTitle' AND Insurance_Fixed_Rate LIKE '$insuranceFixed' AND Simple_Depreciation_Rate LIKE '$depreciationRate'
        AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE '$financeTerm' AND Used_Vehicle_Toggle LIKE '$usedVehicle' AND Major_Repair_Toggle LIKE '$majorRepair'
        AND Age_Of_Used_Car LIKE '$usedVehicleYear' AND Vehicle_Financed_Toggle LIKE '$vehicleFinanced' AND Bev_Range LIKE '$bevRange' AND Phev_Range LIKE '$phevRange' AND VMT_Type LIKE '$vmtType'
        AND Custom_New_Vmt_Toggle LIKE '$customNewVMT' AND Custom_New_Vmt_Value LIKE '$customVmtValue' AND Custom_New_Vmt_Year LIKE '$customVmtYear' AND Custom_Vmt LIKE '$customVMT' AND Custom_Vmt_Value LIKE '$customVmtValueUsed'
        AND User_Defined_Fuel LIKE '$userDefinedFuel' AND User_Defined_Purchase_Cost LIKE '$userDefinedPurchaseCost' AND User_Defined_MPG LIKE '$userDefinedMPG' AND User_Defined_Insurance_Liability LIKE '$userDefinedInsuranceLiability'
        AND User_Defined_Insurance_Deductable LIKE '$userDefinedInsuranceDeductable' AND User_Defined_Fixed_Insurance LIKE '$userDefinedFixedInsurance' AND Carbon_Emission LIKE '$carbonEmission' AND Vehicle_TCO_Type LIKE '$vehicleTCOType'
        AND Additional_Labor_Costs LIKE '$additionalLaborCosts' AND Misc_Labor_Cost LIKE '$miscLaborCost' AND Charging_Rate LIKE '$chargeRate' AND Additional_Operational_Costs LIKE '$additionalOperational'
        AND Average_Down_Time LIKE '$averageDowntime'";

        $vehicleResult = $connect->query($vehicleQuery);
        $financingResult = $connect->query($financingQuery);
        $fuelResult = $connect->query($fuelQuery);
        $insuranceResult = $connect->query($insuranceQuery);
        $taxesResult = $connect->query($taxesQuery);
        $maintenanceResult = $connect->query($maintenanceQuery);
        $repairResult = $connect->query($repairQuery);
        $operationalResult = $connect->query($operationalQuery);
        $laborResult = $connect->query($laborQuery);
        $vmtResult = $connect->query($vmtQuery);

        $vehicle;
        $financing;
        $fuel;
        $insurance;
        $taxes;
        $maintenance;
        $repair;
        $operational;
        $labor;
        $vmt;

        $analysisWindow = $_POST["analysisWindow"];
        $discoundRate = $_POST["discountRate"];

        for($i = 0; $i < $analysisWindow; $i++)
        {
            $vehicleResults = $vehicleResult->fetch_assoc(); $vehicle[$i] = floatval($vehicleResults["Vehicle"]);
            $financingResults = $financingResult->fetch_assoc(); $financing[$i] = $financingResults["Financing"];
            $fuelResults = $fuelResult->fetch_assoc(); $fuel[$i] = $fuelResults["Annual_Fuel"];
            $insuranceResults = $insuranceResult->fetch_assoc(); $insurance[$i] = $insuranceResults["Insurance"];
            $taxesResults = $taxesResult->fetch_assoc(); $taxes[$i] = $taxesResults["Taxes_And_Fees"];
            $maintenanceResults = $maintenanceResult->fetch_assoc(); $maintenance[$i] = $maintenanceResults["Maintenance"];
            $repairResults = $repairResult->fetch_assoc(); $repair[$i] = $repairResults["Repair"];
            $operationalResults = $operationalResult->fetch_assoc(); $operational[$i] = $operationalResults["Operational"];
            $laborResults = $laborResult->fetch_assoc(); $labor[$i] = $laborResults["Labor"];
            $vmtResults = $vmtResult->fetch_assoc(); $vmt[$i] = $vmtResults["VMT"];
        }

        $TCO_information = array($vehicle, $financing, $fuel, $insurance, $taxes, $maintenance, $repair, $operational, $labor, $vmt);

        return $TCO_information;
    }

    function writeData($year, $vehicle, $finance, $fuel, $insurance, $taxes, $maintenance, $repair, $operational, $infrastructure, $labor, $vmt)
    {
        include "connectDatabase.php";

        $vehicleBody = $_POST["vehicleBody"];
        $powertrain = $_POST["powertrain"];
        $modelYear = $_POST["modelYear"];
        $fuelType = $_POST["fuel"];
        $technology = $_POST["technology"];
        $insuranceProportional = $_POST["insuranceProportional"];
        $markupFactor = $_POST["markupFactor"];
        $depreciationRate = $_POST["depreciationRate"];
        $writeOff = $_POST["writeOff"];
        $annualFuelPriceIncrease = $_POST["annualFuelPriceIncrease"];
        $biofuelCost = $_POST["biofuelCost"];
        $biofuelPremium = $_POST["biofuelPremium"];
        $hydrogenCost = $_POST["hydrogenCost"];
        $hydrogenPremium = $_POST["hydrogenPremium"];
        $fuelPriceType = $_POST["fuelPriceMethod"];
        $fuelYear = $_POST["fuelYear"];
        $premiumGasMarkup = $_POST["premiumGasModifier"];
        $hydrogenSuccess = $_POST["hydrogenSuccessFactor"];
        $vehicleInput = $_POST["vehicleCostInput"];
        $fuelInfrastructure = $_POST["fuelInfrastructure"];
        $purchaseCost = $_POST["purchaseCost"];
        $regionality = $_POST["regionality"];
        $analysisWindow = $_POST["analysisWindow"];
        $discountRate = $_POST["discountRate"];
        $annualRegistration = $_POST["annualRegistration"];
        $salesTaxAndTitle = $_POST["salesTax"];
        $insuranceFixed = $_POST["insuranceFixed"];
        $depreciation = $_POST["depreciation"];
        $salvageValue = $_POST["salvageValue"];
        $financeTerm = $_POST["financeTerm"];
        $bevRange = $_POST["bevRange"];
        $phevRange = $_POST["phevRange"];
        $vmtType = $_POST["vmt"];
        $laborCost = $_POST["laborCost"];
        $payloadCost = $_POST["payloadCost"];
        //$chargingTime = $_POST["chargingTime"];
        $fuelReference = $_POST["fuelReference"];
        $fuelCostInput = $_POST["fuelCostInput"];
        $apu = $_POST["APU"];
        $vehicleIncentive = $_POST["vehicleIncentive"];
        $interestRate = $_POST["interestRate"];
        $downPayment = $_POST["downPayment"];
        $insuranceType = $_POST["insuranceType"];
        $busOccupancy = $_POST["busOccupancy"];
        $fuelEfficiencyDegradation = $_POST["fuelEfficiencyDegradation"];
        $usedVehicleYear = $_POST["usedVehicleYear"];
        $customVmtValue = $_POST["customNewVMTValue"];
        $customVmtYear = $_POST["customNewVMTYear"] - 1;
        $customVmtValueUsed = $_POST["customVMTValue"];
        $idling = $_POST["idling"];
        $majorRepair = $_POST["majorLDVCheck"];
        $vehicleFinanced = $_POST["vehicleFinanced"];
        $userDefinedFuel = $_POST["userDefinedFuel"];
        $userDefinedPurchaseCost = $_POST["purchaseCost"];
        $userDefinedMPG = $_POST["userDefinedMPG"];
        $userDefinedInsuranceLiability = $_POST["insuranceLiability"];
        $userDefinedInsuranceDeductable = $_POST["insuranceDeductable"];
        $userDefinedFixedInsurance = $_POST["fixedInsurance"];
        $carbonEmission = $_POST["carbonEmission"];
        $vehicleTCOType = $_POST["vehicleGraphControl"];
        $additionalLaborCosts = $_POST["additionalLaborCosts"];
        $miscLaborCost = $_POST["miscLaborCost"];
        $chargeRate = $_POST["chargeRate"];
        $additionalOperational = $_POST["additionalOperational"];
        $averageDowntime = $_POST["averageDowntime"];

        if(!empty($_POST["usedVehicle"]))
        {
            $usedVehicle = "true";
        }
        else
        {
            $usedVehicle = "false";
        }

        if(!empty($_POST["customNewVmt"]))
        {
            $customNewVMT = "true";
        }
        else
        {
            $customNewVMT = "false";
        }

        if(!empty($_POST["customVMT"]))
        {
            $customVMT = "true";
        }
        else
        {
            $customVMT = "false";
        }

       $insertData = "INSERT INTO simplified_view_cost_components(Year, Vehicle, Financing, Annual_Fuel, Insurance, Taxes_And_Fees, Maintenance, Repair, Operational, Infrastructure, Labor, 
        VMT, Vehicle_Body, Powertrain, Model_Year, Fuel, Technology_Progress, Vehicle_Write_Off, Incremental_Annual_Fuel_Price_Change, Fuel_Price_Method, Fueling_Infrastructure_Cost,
        Fuel_Reference, Premium_Gasoline_Markup, Hydrogen_Success, Vehicle_Cost_Input, Fuel_Economy_Input, Idling_Cost_Toggle, APU, Vehicle_Incentive, Interest_Rate_Percent, Down_Payment_Percent,
        Insurance_Type, Bus_Occupancy, Annual_MPG_Degradation, Analysis_Window, Discount_Rate, Annual_Registration_Fee, Sales_Tax_And_Title, Insurance_Fixed_Rate, Simple_Depreciation_Rate,
        Depreciation, Salvage_Value, Finance_Term, Used_Vehicle_Toggle, Major_Repair_Toggle, Age_Of_Used_Car, Vehicle_Financed_Toggle, Bev_Range, Phev_Range, VMT_Type, Custom_New_Vmt_Toggle,
        Custom_New_Vmt_Value, Custom_New_Vmt_Year, Custom_Vmt, Custom_Vmt_Value, User_Defined_Fuel, User_Defined_Purchase_Cost, User_Defined_MPG, User_Defined_Insurance_Liability,
        User_Defined_Insurance_Deductable, User_Defined_Fixed_Insurance, Carbon_Emission, Vehicle_TCO_Type, Additional_Labor_Costs, Misc_Labor_Cost, Charging_Rate, Additional_Operational_Costs,
        Average_Down_Time)

        VALUES($year, $vehicle, $finance, $fuel, $insurance, $taxes, $maintenance, $repair, $operational, $infrastructure, $labor, 
        $vmt, '$vehicleBody', '$powertrain', '$modelYear', '$fuelType', '$technology', '$writeOff', '$annualFuelPriceIncrease', '$fuelPriceType', '$fuelInfrastructure',
        '$fuelReference', '$premiumGasMarkup', '$hydrogenSuccess', '$vehicleInput', '$fuelCostInput', '$idling', '$apu', '$vehicleIncentive', '$interestRate', '$downPayment',
        '$insuranceType', '$busOccupancy', '$fuelEfficiencyDegradation', '$analysisWindow', '$discountRate', '$annualRegistration', '$salesTaxAndTitle', '$insuranceFixed', '$depreciationRate',
        '$depreciation', '$salvageValue', '$financeTerm', '$usedVehicle', '$majorRepair', '$usedVehicleYear', '$vehicleFinanced', '$bevRange', '$phevRange', '$vmtType', '$customNewVMT',
        '$customVmtValue', '$customVmtYear', '$customVMT', '$customVmtValueUsed', '$userDefinedFuel', '$userDefinedPurchaseCost', '$userDefinedMPG', '$userDefinedInsuranceLiability',
        '$userDefinedInsuranceDeductable', '$userDefinedFixedInsurance', '$carbonEmission', '$vehicleTCOType', '$additionalLaborCosts', '$miscLaborCost', '$chargeRate', '$additionalOperational',
        '$averageDowntime')";


        $sqli = $connect->query($insertData);
    }
?>