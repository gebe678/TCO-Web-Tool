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

                $totalVehicleCost = 0;
                $totalFinancingCost = 0;
                $totalAnnualFuelCost = 0;
                $totalInsuranceCost = 0;
                $totalTaxesCost = 0;
                $totalMaintenanceCost = 0;
                $totalRepairCost = 0;

                for($i = 0; $i < 5; $i++)
                {
                    $totalVehicleCost = $totalVehicleCost + getVehicleData($i);
                    $totalFinancingCost = $totalFinancingCost + getFinancingData($i);
                    $totalAnnualFuelCost = $totalAnnualFuelCost + getAnnualFuelCostData($i);
                    $totalInsuranceCost = $totalInsuranceCost + getInsuranceData($i);
                    $totalTaxesCost = $totalTaxesCost + getTaxesAndFeesData($i);
                    $totalMaintenanceCost = $totalMaintenanceCost + getMaintenanceData($i);
                    $totalRepairCost = $totalRepairCost + getRepairData($i);
                }

                $totalVehicleCost = floor($totalVehicleCost / 5);
                $totalFinancingCost = floor($totalFinancingCost / 5);
                $totalAnnualFuelCost = floor($totalAnnualFuelCost / 5);
                $totalInsuranceCost = floor($totalInsuranceCost / 5);
                $totalTaxesCost = floor($totalTaxesCost / 5);
                $totalMaintenanceCost = floor($totalMaintenanceCost / 5);
                $totalRepairCost = floor($totalRepairCost / 5);
                
                echo "<p class='costComponent'>$totalVehicleCost</p>";
                echo "<p class='costComponent'>$totalFinancingCost</p>";
                echo "<p class='costComponent'>$totalAnnualFuelCost</p>";
                echo "<p class='costComponent'>$totalInsuranceCost</p>";
                echo "<p class='costComponent'>$totalTaxesCost</p>";
                echo "<p class='costComponent'>$totalMaintenanceCost</p>";
                echo "<p class='costComponent'>$totalRepairCost</p>";

            ?>

            <!--canvas id for overlaying the image uses the imageOverlay.js file-->
            <div class="canvasContainer">
                <canvas id="vehicleGraph">canvas is not supported in your browser</canvas>
            </div>
        </main>
    </body>
</html>