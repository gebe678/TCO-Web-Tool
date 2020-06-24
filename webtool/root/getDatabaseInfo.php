<!DOCTYPE html>
<html>
    <head>
        <title>Information Results</title>
        <meta name="author" content="Griffin Lehrer">
        <meta name="description" content="caluclate the total cost of operation for a vehicle">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/dropDownStyles.css">
        <link rel="stylesheet" href="assets/css/pageStyles.css">
        <script src="assets/javascript/imageOverlay.js" defer></script>
    </head>
    <body>
        <header>
            <h1>This Is The Title Of The Webpage</h1>
            <nav>
                <!--navigation bar to go between the pages of the site easily-->
                <div class="navBar">
                    <a href = "../../index.php">Return To Main Page</a>
                </div>
            </nav>
        </header>

        <main>
            <!--canvas id for overlaying the image uses the imageOverlay.js file-->
            <div class="canvasContainer">
                <canvas id="vehicleGraph">canvas is not supported in your browser</canvas>
            </div>
        </main>
    </body>
</html>


<?php
    function main()
    {
        include "assets/PHP/connectDatabase.php";

        $vehicleBody = $_GET["vehicleBody"];
        $powertrain = $_GET["powertrain"];
        $regionality = $_GET["regionality"];
        
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