<?php 

    function checkDatabase()
    {
        // include "connectDatabase.php";
        // include "getID.php";
        // $year = 0;

        // $checkForSuccessQuery = "SELECT ID FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'";

        // $result = $connect->query($checkForSuccessQuery);

        // if(mysqli_num_rows($result) == 0)
        // {
        //     return false;
        // }

        // return true;

        return false;
    }

    function searchForData()
    {
        include "connectDatabase.php";
        include "getID.php";

        $vehicleQuery = "SELECT Vehicle FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'";
        $financingQuery = "SELECT Financing FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'";
        $fuelQuery = "SELECT Annual_Fuel FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'";
        $insuranceQuery = "SELECT Insurance FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'";
        $taxesQuery = "SELECT Taxes_And_Fees FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'";
        $maintenanceQuery = "SELECT Maintenance FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'";
        $repairQuery = "SELECT Repair FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'";
        $laborQuery = "SELECT Labor FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'";
        $vmtQuery = "SELECT VMT FROM simplified_view_cost_components WHERE Vehicle_Body LIKE '$vehicleBody' AND Powertrain LIKE '$powertrain' AND Model_Year LIKE '$modelYear'";

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
        // include "connectDatabase.php";

        // $vehicleBody = $_POST["vehicleBody"];
        // $powertrain = $_POST["powertrain"];
        // $modelYear = $_POST["modelYear"];

        // $insertData = "INSERT INTO simplified_view_cost_components(Year, Vehicle, Financing, Annual_Fuel, Insurance, Taxes_And_Fees, Maintenance, Repair, Operational, Infrastructure, Labor, VMT, Vehicle_Body, Powertrain, Model_Year)VALUES($year, $vehicle, $finance, $fuel, $insurance, $taxes, $maintenance, $repair, $operational, $infrastructure, $labor, $vmt, '$vehicleBody', '$powertrain', '$modelYear')";
        // $sqli = $connect->query($insertData);

    }
?>