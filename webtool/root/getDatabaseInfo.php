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

            <!--php code to get the informattion from the database-->
           <?php
                include "assets/PHP/costComponentData.php";

                for($i = 0; $i < 5; $i++)
                {
                    echo "Year: " . getYearData($i) . "<br>";
                    echo "Vehicle Cost: " . getVehicleData($i) . "<br>";
                    echo "Financing: " . getFinancingData($i) . "<br>";
                    echo "Annual Fuel Cost: " . getAnnualFuelCostData($i) . "<br>";
                    echo "Insurance: " . getInsuranceData($i) . "<br>";
                    echo "Taxes and Fees: " . getTaxesAndFeesData($i) . "<br>";
                    echo "Maintenance Cost: " . getMaintenanceData($i) . "<br>";
                    echo "Repair Cost: " . getRepairData($i) . "<br>";
                    echo "<br> <br>";
                }
            ?>

            <!--canvas id for overlaying the image uses the imageOverlay.js file-->
            <div class="canvasContainer">
                <canvas id="vehicleGraph">canvas is not supported in your browser</canvas>
            </div>
        </main>
    </body>
</html>