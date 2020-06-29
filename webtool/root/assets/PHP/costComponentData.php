<?php 

    function getYearData($index)
    {
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";
    
        $costComponentQuery = "SELECT Year FROM cost_components WHERE Size_ID LIKE $sizeID AND powertrain_ID LIKE $powertrainID";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row["Year"];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
        return -1;
    }
    
    function getVehicleData($index)
    {
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";

        $costComponentQuery = "SELECT Vehicle FROM cost_components WHERE Size_ID LIKE $sizeID AND powertrain_ID LIKE $powertrainID";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row["Vehicle"];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
        return -1;
    }
    
    function getFinancingData($index)
    {
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";
    
        $costComponentQuery = "SELECT Financing FROM cost_components WHERE Size_ID LIKE $sizeID AND powertrain_ID LIKE $powertrainID";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row["Financing"];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
        return -1;
    }
    
    function getAnnualFuelCostData($index)
    {
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";
    
        $costComponentQuery = "SELECT Annual_Fuel_Cost FROM cost_components WHERE Size_ID LIKE $sizeID AND powertrain_ID LIKE $powertrainID";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row["Annual_Fuel_Cost"];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
        return -1;
    }
    
    function getInsuranceData($index)
    {
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";
    
        $costComponentQuery = "SELECT Insurance FROM cost_components WHERE Size_ID LIKE $sizeID AND powertrain_ID LIKE $powertrainID";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row["Insurance"];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
        return -1;
    }
    
    function getTaxesAndFeesData($index)
    {
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";
    
        $costComponentQuery = "SELECT Taxes_And_Fees FROM cost_components WHERE Size_ID LIKE $sizeID AND powertrain_ID LIKE $powertrainID";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row["Taxes_And_Fees"];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
        return -1;
    }
    
    function getMaintenanceData($index)
    {
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";
    
        $costComponentQuery = "SELECT Maintenance FROM cost_components WHERE Size_ID LIKE $sizeID AND powertrain_ID LIKE $powertrainID";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row["Maintenance"];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
            return -1;
    }
    
    function getRepairData($index)
    {
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";
    
        $costComponentQuery = "SELECT Repair FROM cost_components WHERE Size_ID LIKE $sizeID AND powertrain_ID LIKE $powertrainID";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row["Repair"];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
        return -1;
    }
?>