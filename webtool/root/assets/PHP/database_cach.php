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
        $chargingTime = $_POST["chargingTime"];

        $checkForSuccessQuery = "SELECT ID FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Insurance_Proportional_Rate LIKE $insuranceProportional AND Purchase_Price_Markup_Factor LIKE $markupFactor
        AND Simple_Depreciation_Rate LIKE $depreciationRate AND Vehicle_Write_Off LIKE $writeOff AND Incremental_Annual_Fuel_Price_Change LIKE $annualFuelPriceIncrease
        AND Biofuel_Cost_Parity LIKE $biofuelCost AND Biofuel_Premium_Cost LIKE $biofuelPremium AND Hydrogen_To_5kg LIKE $hydrogenCost AND Hydrogen_Premium_Cost LIKE $hydrogenPremium
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fuel_Starting_Cost_Year LIKE $fuelYear AND Premium_Gasoline_Markup LIKE $premiumGasMarkup AND Hydrogen_Success LIKE '$hydrogenSuccess'
        AND Vehicle_Cost_Fuel_Input LIKE '$vehicleInput' AND Fueling_Infrastructure_Cost LIKE $fuelInfrastructure AND Purchase_Cost LIKE $purchaseCost AND Regionality LIKE '$regionality'
        AND Analysis_Window LIKE $analysisWindow AND Discount_Rate LIKE $discountRate AND Annual_Registration_Fee LIKE $annualRegistration AND Sales_Tax_And_Title LIKE $salesTaxAndTitle
        AND Insurance_Fixed_Rate LIKE $insuranceFixed AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE $financeTerm AND Bev_Range LIKE $bevRange
        AND Phev_Range LIKE $phevRange AND VMT_Type LIKE '$vmtType' AND Labor_Cost_Per_Mile LIKE $laborCost AND Payload_Cost LIKE $payloadCost AND Charging_Time_Cost LIKE $chargingTime";

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
        $financeTerm = $_POST["financeTerm"];
        $bevRange = $_POST["bevRange"];
        
        $vehicleQuery = "SELECT Vehicle FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
         AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Insurance_Proportional_Rate LIKE $insuranceProportional AND Purchase_Price_Markup_Factor LIKE $markupFactor
         AND Simple_Depreciation_Rate LIKE $depreciationRate AND Vehicle_Write_Off LIKE $writeOff AND Incremental_Annual_Fuel_Price_Change LIKE $annualFuelPriceIncrease
         AND Biofuel_Cost_Parity LIKE $biofuelCost AND Biofuel_Premium_Cost LIKE $biofuelPremium AND Hydrogen_To_5kg LIKE $hydrogenCost Hydrogen_Premium_Cost LIKE $hydrogenPremium
         AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fuel_Starting_Cost_Year LIKE $fuelYear AND Premium_Gasoline_Markup LIKE $premiumGasMarkup AND Hydrogen_Success LIKE '$hydrogenSuccess'
         AND Vehicle_Cost_Fuel_Input LIKE '$vehicleInput' AND Fueling_Infrastructure_Cost LIKE $fuelInfrastructure AND Purchase_Cost LIKE $purchaseCost AND Regionality LIKE '$regionality'
         AND Analysis_Window LIKE $analysisWindow AND Discount_Rate LIKE $discountRate AND Annual_Registration_Fee LIKE $annualRegistration AND Sales_Tax_And_Title LIKE $salesTaxAndTitle
         AND Insurance_Fixed_Rate LIKE $insuranceFixed AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE $financeTerm AND Bev_Range LIKE $bevRange
         AND Phev_Range LIKE $phevRange AND VMT_Type LIKE '$vmtType' AND Labor_Cost_Per_Mile LIKE $laborCost AND Payload_Cost LIKE $payloadCost AND Chargin_Time_Cost LIKE $chargingTime";

        $financingQuery = "SELECT Financing FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Insurance_Proportional_Rate LIKE $insuranceProportional AND Purchase_Price_Markup_Factor LIKE $markupFactor
        AND Simple_Depreciation_Rate LIKE $depreciationRate AND Vehicle_Write_Off LIKE $writeOff AND Incremental_Annual_Fuel_Price_Change LIKE $annualFuelPriceIncrease
        AND Biofuel_Cost_Parity LIKE $biofuelCost AND Biofuel_Premium_Cost LIKE $biofuelPremium AND Hydrogen_To_5kg LIKE $hydrogenCost Hydrogen_Premium_Cost LIKE $hydrogenPremium
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fuel_Starting_Cost_Year LIKE $fuelYear AND Premium_Gasoline_Markup LIKE $premiumGasMarkup AND Hydrogen_Success LIKE '$hydrogenSuccess'
        AND Vehicle_Cost_Fuel_Input LIKE '$vehicleInput' AND Fueling_Infrastructure_Cost LIKE $fuelInfrastructure AND Purchase_Cost LIKE $purchaseCost AND Regionality LIKE '$regionality'
        AND Analysis_Window LIKE $analysisWindow AND Discount_Rate LIKE $discountRate AND Annual_Registration_Fee LIKE $annualRegistration AND Sales_Tax_And_Title LIKE $salesTaxAndTitle
        AND Insurance_Fixed_Rate LIKE $insuranceFixed AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE $financeTerm AND Bev_Range LIKE $bevRange
        AND Phev_Range LIKE $phevRange AND VMT_Type LIKE '$vmtType' AND Labor_Cost_Per_Mile LIKE $laborCost AND Payload_Cost LIKE $payloadCost AND Chargin_Time_Cost LIKE $chargingTime";

        $fuelQuery = "SELECT Annual_Fuel FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Insurance_Proportional_Rate LIKE $insuranceProportional AND Purchase_Price_Markup_Factor LIKE $markupFactor
        AND Simple_Depreciation_Rate LIKE $depreciationRate AND Vehicle_Write_Off LIKE $writeOff AND Incremental_Annual_Fuel_Price_Change LIKE $annualFuelPriceIncrease
        AND Biofuel_Cost_Parity LIKE $biofuelCost AND Biofuel_Premium_Cost LIKE $biofuelPremium AND Hydrogen_To_5kg LIKE $hydrogenCost AND Hydrogen_Premium_Cost LIKE $hydrogenPremium
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fuel_Starting_Cost_Year LIKE $fuelYear AND Premium_Gasoline_Markup LIKE $premiumGasMarkup AND Hydrogen_Success LIKE '$hydrogenSuccess'
        AND Vehicle_Cost_Fuel_Input LIKE '$vehicleInput' AND Fueling_Infrastructure_Cost LIKE $fuelInfrastructure AND Purchase_Cost LIKE $purchaseCost AND Regionality LIKE '$regionality'
        AND Analysis_Window LIKE $analysisWindow AND Discount_Rate LIKE $discountRate AND Annual_Registration_Fee LIKE $annualRegistration AND Sales_Tax_And_Title LIKE $salesTaxAndTitle
        AND Insurance_Fixed_Rate LIKE $insuranceFixed AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE $financeTerm AND Bev_Range LIKE $bevRange
        AND Phev_Range LIKE $phevRange AND VMT_Type LIKE '$vmtType' AND Labor_Cost_Per_Mile LIKE $laborCost AND Payload_Cost LIKE $payloadCost AND Chargin_Time_Cost LIKE $chargingTime";

        $insuranceQuery = "SELECT Insurance FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Insurance_Proportional_Rate LIKE $insuranceProportional AND Purchase_Price_Markup_Factor LIKE $markupFactor
        AND Simple_Depreciation_Rate LIKE $depreciationRate AND Vehicle_Write_Off LIKE $writeOff AND Incremental_Annual_Fuel_Price_Change LIKE $annualFuelPriceIncrease
        AND Biofuel_Cost_Parity LIKE $biofuelCost AND Biofuel_Premium_Cost LIKE $biofuelPremium AND Hydrogen_To_5kg LIKE $hydrogenCost AND Hydrogen_Premium_Cost LIKE $hydrogenPremium
        AND Fuel_Price_Method LIKE '$fuelPriceTyp' AND Fuel_Starting_Cost_Year LIKE $fuelYear AND Premium_Gasoline_Markup LIKE $premiumGasMarkup AND Hydrogen_Success LIKE '$hydrogenSuccess'
        AND Vehicle_Cost_Fuel_Input LIKE '$vehicleInput' AND Fueling_Infrastructure_Cost LIKE $fuelInfrastructure AND Purchase_Cost LIKE $purchaseCost AND Regionality LIKE '$regionality'
        AND Analysis_Window LIKE $analysisWindow AND Discount_Rate LIKE $discountRate AND Annual_Registration_Fee LIKE $annualRegistration AND Sales_Tax_And_Title LIKE $salesTaxAndTitle
        AND Insurance_Fixed_Rate LIKE $insuranceFixed AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE $financeTerm AND Bev_Range LIKE $bevRange
        AND Phev_Range LIKE $phevRange AND VMT_Type LIKE '$vmtType' AND Labor_Cost_Per_Mile LIKE $laborCost AND Payload_Cost LIKE $payloadCost AND Chargin_Time_Cost LIKE $chargingTime";

        $taxesQuery = "SELECT Taxes_And_Fees FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Insurance_Proportional_Rate LIKE $insuranceProportional AND Purchase_Price_Markup_Factor LIKE $markupFactor
        AND Simple_Depreciation_Rate LIKE $depreciationRate AND Vehicle_Write_Off LIKE $writeOff AND Incremental_Annual_Fuel_Price_Change LIKE $annualFuelPriceIncrease
        AND Biofuel_Cost_Parity LIKE $biofuelCost AND Biofuel_Premium_Cost LIKE $biofuelPremium AND Hydrogen_To_5kg LIKE $hydrogenCost AND Hydrogen_Premium_Cost LIKE $hydrogenPremium
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fuel_Starting_Cost_Year LIKE $fuelYear AND Premium_Gasoline_Markup LIKE $premiumGasMarkup AND Hydrogen_Success LIKE '$hydrogenSuccess'
        AND Vehicle_Cost_Fuel_Input LIKE '$vehicleInput' AND Fueling_Infrastructure_Cost LIKE $fuelInfrastructure AND Purchase_Cost LIKE $purchaseCost AND Regionality LIKE '$regionality'
        AND Analysis_Window LIKE $analysisWindow AND Discount_Rate LIKE $discountRate AND Annual_Registration_Fee LIKE $annualRegistration AND Sales_Tax_And_Title LIKE $salesTaxAndTitle
        AND Insurance_Fixed_Rate LIKE $insuranceFixed AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE $financeTerm AND Bev_Range LIKE $bevRange
        AND Phev_Range LIKE $phevRange AND VMT_Type LIKE '$vmtType' AND Labor_Cost_Per_Mile LIKE $laborCost AND Payload_Cost LIKE $payloadCost AND Chargin_Time_Cost LIKE $chargingTime";

        $maintenanceQuery = "SELECT Maintenance FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Insurance_Proportional_Rate LIKE $insuranceProportional AND Purchase_Price_Markup_Factor LIKE $markupFactor
        AND Simple_Depreciation_Rate LIKE $depreciationRate AND Vehicle_Write_Off LIKE $writeOff AND Incremental_Annual_Fuel_Price_Change LIKE $annualFuelPriceIncrease
        AND Biofuel_Cost_Parity LIKE $biofuelCost AND Biofuel_Premium_Cost LIKE $biofuelPremium AND Hydrogen_To_5kg LIKE $hydrogenCost AND Hydrogen_Premium_Cost LIKE $hydrogenPremium
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fuel_Starting_Cost_Year LIKE $fuelYear AND Premium_Gasoline_Markup LIKE $premiumGasMarkup AND Hydrogen_Success LIKE '$hydrogenSuccess'
        AND Vehicle_Cost_Fuel_Input LIKE '$vehicleInput' AND Fueling_Infrastructure_Cost LIKE $fuelInfrastructure AND Purchase_Cost LIKE $purchaseCost AND Regionality LIKE '$regionality'
        AND Analysis_Window LIKE $analysisWindow AND Discount_Rate LIKE $discountRate AND Annual_Registration_Fee LIKE $annualRegistration AND Sales_Tax_And_Title LIKE $salesTaxAndTitle
        AND Insurance_Fixed_Rate LIKE $insuranceFixed AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE $financeTerm AND Bev_Range LIKE $bevRange
        AND Phev_Range LIKE $phevRange AND VMT_Type LIKE '$vmtType' AND Labor_Cost_Per_Mile LIKE $laborCost AND Payload_Cost LIKE $payloadCost AND Chargin_Time_Cost LIKE $chargingTime";

        $repairQuery = "SELECT Repair FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Insurance_Proportional_Rate LIKE $insuranceProportional AND Purchase_Price_Markup_Factor LIKE $markupFactor
        AND Simple_Depreciation_Rate LIKE $depreciationRate AND Vehicle_Write_Off LIKE $writeOff AND Incremental_Annual_Fuel_Price_Change LIKE $annualFuelPriceIncrease
        AND Biofuel_Cost_Parity LIKE $biofuelCost AND Biofuel_Premium_Cost LIKE $biofuelPremium AND Hydrogen_To_5kg LIKE $hydrogenCost AND Hydrogen_Premium_Cost LIKE $hydrogenPremium
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fuel_Starting_Cost_Year LIKE $fuelYear AND Premium_Gasoline_Markup LIKE $premiumGasMarkup AND Hydrogen_Success LIKE '$hydrogenSuccess'
        AND Vehicle_Cost_Fuel_Input LIKE '$vehicleInput' AND Fueling_Infrastructure_Cost LIKE $fuelInfrastructure AND Purchase_Cost LIKE $purchaseCost AND Regionality LIKE '$regionality'
        AND Analysis_Window LIKE $analysisWindow AND Discount_Rate LIKE $discountRate AND Annual_Registration_Fee LIKE $annualRegistration AND Sales_Tax_And_Title LIKE $salesTaxAndTitle
        AND Insurance_Fixed_Rate LIKE $insuranceFixed AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE $financeTerm AND Bev_Range LIKE $bevRange
        AND Phev_Range LIKE $phevRange AND VMT_Type LIKE '$vmtType' AND Labor_Cost_Per_Mile LIKE $laborCost AND Payload_Cost LIKE $payloadCost AND Chargin_Time_Cost LIKE $chargingTime";

        $laborQuery = "SELECT Labor FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Insurance_Proportional_Rate LIKE $insuranceProportional AND Purchase_Price_Markup_Factor LIKE $markupFactor
        AND Simple_Depreciation_Rate LIKE $depreciationRate AND Vehicle_Write_Off LIKE $writeOff AND Incremental_Annual_Fuel_Price_Change LIKE $annualFuelPriceIncrease
        AND Biofuel_Cost_Parity LIKE $biofuelCost AND Biofuel_Premium_Cost LIKE $biofuelPremium AND Hydrogen_To_5kg LIKE $hydrogenCost AND Hydrogen_Premium_Cost LIKE $hydrogenPremium
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fuel_Starting_Cost_Year LIKE $fuelYear AND Premium_Gasoline_Markup LIKE $premiumGasMarkup AND Hydrogen_Success LIKE '$hydrogenSuccess'
        AND Vehicle_Cost_Fuel_Input LIKE '$vehicleInput' AND Fueling_Infrastructure_Cost LIKE $fuelInfrastructure AND Purchase_Cost LIKE $purchaseCost AND Regionality LIKE '$regionality'
        AND Analysis_Window LIKE $analysisWindow AND Discount_Rate LIKE $discountRate AND Annual_Registration_Fee LIKE $annualRegistration AND Sales_Tax_And_Title LIKE $salesTaxAndTitle
        AND Insurance_Fixed_Rate LIKE $insuranceFixed AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE $financeTerm AND Bev_Range LIKE $bevRange
        AND Phev_Range LIKE $phevRange AND VMT_Type LIKE '$vmtType' AND Labor_Cost_Per_Mile LIKE $laborCost AND Payload_Cost LIKE $payloadCost AND Chargin_Time_Cost LIKE $chargingTime";

        $vmtQuery = "SELECT VMT FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'
        AND Fuel LIKE '$fuelType' AND Technology_Progress LIKE '$technology' AND Insurance_Proportional_Rate LIKE $insuranceProportional AND Purchase_Price_Markup_Factor LIKE $markupFactor
        AND Simple_Depreciation_Rate LIKE $depreciationRate AND Vehicle_Write_Off LIKE $writeOff AND Incremental_Annual_Fuel_Price_Change LIKE $annualFuelPriceIncrease
        AND Biofuel_Cost_Parity LIKE $biofuelCost AND Biofuel_Premium_Cost LIKE $biofuelPremium AND Hydrogen_To_5kg LIKE $hydrogenCost AND Hydrogen_Premium_Cost LIKE $hydrogenPremium
        AND Fuel_Price_Method LIKE '$fuelPriceType' AND Fuel_Starting_Cost_Year LIKE $fuelYear AND Premium_Gasoline_Markup LIKE $premiumGasMarkup AND Hydrogen_Success LIKE '$hydrogenSuccess'
        AND Vehicle_Cost_Fuel_Input LIKE '$vehicleInput' AND Fueling_Infrastructure_Cost LIKE $fuelInfrastructure AND Purchase_Cost LIKE $purchaseCost AND Regionality LIKE '$regionality'
        AND Analysis_Window LIKE $analysisWindow AND Discount_Rate LIKE $discountRate AND Annual_Registration_Fee LIKE $annualRegistration AND Sales_Tax_And_Title LIKE $salesTaxAndTitle
        AND Insurance_Fixed_Rate LIKE $insuranceFixed AND Depreciation LIKE '$depreciation' AND Salvage_Value LIKE '$salvageValue' AND Finance_Term LIKE $financeTerm AND Bev_Range LIKE $bevRange
        AND Phev_Range LIKE $phevRange AND VMT_Type LIKE '$vmtType' AND Labor_Cost_Per_Mile LIKE $laborCost AND Payload_Cost LIKE $payloadCost AND Chargin_Time_Cost LIKE $chargingTime";

        $vehicleResult = $connect->query($vehicleQuery);
        $financingResult = $connect->query($financingQuery);
        $fuelResult = $connect->query($fuelQuery);
        $insuranceResult = $connect->query($insuranceQuery);
        $taxesResult = $connect->query($taxesQuery);
        $maintenanceResult = $connect->query($maintenanceQuery);
        $repairResult = $connect->query($repairQuery);
        $laborResult = $connect->query($laborQuery);
        $vmtResult = $connect->query($vmtQuery);

        $vehicle;
        $financing;
        $fuel;
        $insurance;
        $taxes;
        $maintenance;
        $repair;
        $labor;
        $vmt;

        $analysisWindow = $_POST["analysisWindow"];
        $discoundRate = $_POST["discountRate"];

        for($i = 0; $i < $analysisWindow; $i++)
        {
            $vehicleResults = $vehicleResult->fetch_assoc(); $vehicle[$i] = $vehicleResults["Vehicle"];
            $financingResults = $financingResult->fetch_assoc(); $financing[$i] = $financingResults["Financing"];
            $fuelResults = $fuelResult->fetch_assoc(); $fuel[$i] = $fuelResults["Annual_Fuel"];
            $insuranceResults = $insuranceResult->fetch_assoc(); $insurance[$i] = $insuranceResults["Insurance"];
            $taxesResults = $taxesResult->fetch_assoc(); $taxes[$i] = $taxesResults["Taxes_And_Fees"];
            $maintenanceResults = $maintenanceResult->fetch_assoc(); $maintenance[$i] = $maintenanceResults["Maintenance"];
            $repairResults = $repairResult->fetch_assoc(); $repair[$i] = $repairResults["Repair"];
            $laborResults = $laborResult->fetch_assoc(); $labor[$i] = $laborResults["Labor"];
            $vmtResults = $vmtResult->fetch_assoc(); $vmt[$i] = $vmtResults["VMT"];
        }

        $TCO_information = array($vehicle, $financing, $fuel, $insurance, $taxes, $maintenance, $repair, $labor, $vmt);

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
        $chargingTime = $_POST["chargingTime"];

        $insertData = "INSERT INTO simplified_view_cost_components(Year, Vehicle, Financing, Annual_Fuel, Insurance, Taxes_And_Fees, Maintenance, Repair, Operational, Infrastructure, Labor, 
        VMT, Vehicle_Body, Powertrain, Model_Year, Fuel, Technology_Progress, Insurance_Proportional_Rate, Purchase_Price_Markup_Factor, Simple_Depreciation_Rate, Vehicle_Write_Off,
        Incremental_Annual_Fuel_Price_Change, Biofuel_Cost_Parity, Biofuel_Premium_Cost, Hydrogen_To_5kg, Hydrogen_Premium_Cost, Fuel_Price_Method, Fuel_Starting_Cost_Year,
        Premium_Gasoline_Markup, Hydrogen_Success, Vehicle_Cost_Fuel_Input, Fueling_Infrastructure_Cost, Purchase_Cost, Regionality, Analysis_Window, Discount_Rate, Annual_Registration_Fee,
        Sales_Tax_And_Title, Insurance_Fixed_Rate, Depreciation, Salvage_Value, Finance_Term, Bev_Range, Phev_Range, VMT_Type, Labor_Cost_Per_Mile, Payload_Cost, Charging_Time_Cost)

        VALUES($year, $vehicle, $finance, $fuel, $insurance, $taxes, $maintenance, $repair, $operational, $infrastructure, $labor, 
        $vmt, '$vehicleBody', '$powertrain', '$modelYear', '$fuelType', '$technology', $insuranceProportional, $markupFactor, $depreciationRate, $writeOff,
        $annualFuelPriceIncrease, $biofuelCost, $biofuelPremium, $hydrogenCost, $hydrogenPremium, '$fuelPriceType', $fuelYear,
        $premiumGasMarkup, '$hydrogenSuccess', '$vehicleInput', $fuelInfrastructure, $purchaseCost, '$regionality', $analysisWindow, $discountRate, $annualRegistration,
        $salesTaxAndTitle, $insuranceFixed, '$depreciation', '$salvageValue', $financeTerm, $bevRange, $phevRange, '$vmtType', $laborCost, $payloadCost, $chargingTime)";


        $sqli = $connect->query($insertData);
    }
?>