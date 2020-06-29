<?php 

    function getFuelID($index)
    {
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";
    
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
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";
    
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
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";
    
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
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";
    
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
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";
    
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
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";
    
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
        include "assets/PHP/connectDatabase.php";
        include "assets/PHP/getID.php";
    
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

?>