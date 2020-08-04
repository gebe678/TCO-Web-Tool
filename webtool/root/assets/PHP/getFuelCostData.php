<?php 

    function getFuelID($index)
    {
        include "getID.php";
    
        $costComponentQuery = "SELECT Fuel_ID FROM aeo_fuel_prices";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row["Fuel_ID"];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
        return -1;
    }

    function getFuelYearData($index)
    {
        include "getID.php";
    
        $costComponentQuery = "SELECT Year FROM aeo_fuel_prices";
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

    function getGasolineData($index)
    {
        include "getID.php";
    
        $costComponentQuery = "SELECT Gasoline FROM aeo_fuel_prices";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row["Gasoline"];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
        return -1;
    }

    function getDieselData($index)
    {
        include "getID.php";
    
        $costComponentQuery = "SELECT Diesel FROM aeo_fuel_prices";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row["Diesel"];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
        return -1;
    }

    function getCNGData($index)
    {
        include "getID.php";
    
        $costComponentQuery = "SELECT CNG FROM aeo_fuel_prices";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row["CNG"];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
        return -1;
    }

    function getElectricData($index)
    {
        include "getID.php";
    
        $costComponentQuery = "SELECT Electric FROM aeo_fuel_prices";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row["Electric"];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
        return -1;
    }

    function getGasElectricData($index)
    {
        include "getID.php";
    
        $costComponentQuery = "SELECT Gas_Electric FROM aeo_fuel_prices";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row["Gas_Electric"];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
        return -1;
    }

    function getFuelData($index)
    {
        include "getID.php";
    
        $costComponentQuery = "SELECT $fuelType FROM aeo_fuel_prices";
        $result = $connect->query($costComponentQuery);
        $output;
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            $output[$i] = $row[$fuelType];
            $i++;
        }
                        
        if($index < count($output) && $index >= 0)
        {
            return $output[$index];
        }
        return -1;
    }

    function getEnergyUseData()
    {
        include "getID.php";

        $costComponentQuery = "SELECT price FROM energy_use_task WHERE fuel LIKE '$fuelType' AND year LIKE $fuelYear";

        if($fuelType == "Hydrogen")
        {
            $hydrogenType = $fuelType . "_" . $hydrogenSuccess;
            $costComponentQuery = "SELECT price FROM energy_use_task WHERE fuel LIKE '$hydrogenType' AND year LIKE $fuelYear";
        }

        $result = $connect->query($costComponentQuery); $result = $result->fetch_assoc(); $result = $result["price"];

        return $result;
    }
?>