<?php

    function main()
    {
        $serverName = "127.0.0.1";
        $userName = "root";
        $password = "usbw";
        $database = "tco_vehicle_information";

        $vehicleBody = $_GET["vehicleBody"];
        $powertrain = $_GET["powertrain"];
        $regionality = $_GET["regionality"];

        $connect = new mysqli($serverName, $userName, $password, $database);

        if($connect->connect_error)
        {
            die("Connection failed: " . $connect->connect_error);
        }
        
        $vehicleQuery = "SELECT Size_ID FROM vehicle_size WHERE Size LIKE '$vehicleBody'";
        $powertrainQuery = "SELECT Powertrain_ID FROM powertrain WHERE Powertrain LIKE '$powertrain'";

        $sizeID = $connect->query($vehicleQuery); $sizeID = $sizeID->fetch_assoc(); $sizeID = $sizeID["Size_ID"];
        $powertrainID = $connect->query($powertrainQuery); $powertrainID = $powertrainID->fetch_assoc(); $powertrainID = $powertrainID["Powertrain_ID"];

        $costComponentQuery = "SELECT * FROM cost_components WHERE Size_ID LIKE $sizeID AND powertrain_ID LIKE $powertrainID";
        $result = $connect->query($costComponentQuery);

        while($row = $result->fetch_assoc())
        {
            echo "Year " . $row["Year"] . "<br>" . " Vehicle " . $row["Vehicle"] . "<br>" . " Financing " . $row["Financing"] . "<br>" . " Annual Fuel Cost " . $row["Annual Fuel Cost"] . "<br>";
        }
    }

    main();
?>