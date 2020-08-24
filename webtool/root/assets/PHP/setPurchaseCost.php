<?php 
    include "connectDatabase.php";

    $powertrain = $_POST["powertrain"];
    $vehicleBody = $_POST["vehicleBody"];
    $technology = $_POST["technology"];
    $modelYear = $_POST["modelYear"];

    $bodyCostQuery = "SELECT Body_Cost FROM vehicle_body_cost WHERE Powertrain LIKE '$powertrain' AND Size LIKE '$vehicleBody' AND Technology LIKE '$technology' AND Model_Year LIKE '$modelYear'";

    $cost = $connect->query($bodyCostQuery); $cost = $cost->fetch_assoc(); $cost = $cost["Body_Cost"];

    echo $cost;
?>