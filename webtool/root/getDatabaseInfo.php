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
        <link rel="stylesheet" href="assets/css/tabStyles.css">
        <script src="assets/javascript/imageOverlay.js" defer></script>
    </head>
    <body>
        <header>
            <h1>This Is The Title Of The Webpage</h1>
            <nav>
                <!--navigation bar to go between the pages of the site easily-->
                <div class="navBar">
                    <a href = "../../index.php"><button class="tabButton">Return To Main Page</button></a>
                </div>
            </nav>
        </header>

        <main>

            <!--php code to get the informattion from the database-->
           <?php
                include "assets/PHP/getID.php";
                include "assets/PHP/costComponentData.php";
                include "assets/PHP/getFuelCostData.php";
                include "assets/PHP/fuelPriceCalculations.php";

                $totalVehicleCost = 0;
                $totalFinancingCost = 0;
                $totalAnnualFuelCost = 0;
                $totalInsuranceCost = 0;
                $totalTaxesCost = 0;
                $totalMaintenanceCost = 0;
                $totalRepairCost = 0;

                function numberOfDigits($number)
                {
                    $numDigits = 0;
                    while($number != 0)
                    {
                        $number = round($number / 10);
                        $numDigits++;
                    }

                    return $numDigits - 1;
                }

                function roundNumber($number)
                {
                    $numDigits = numberOfDigits($number);
                    $returnNumber = 1;

                    if($numDigits > 2)
                    {
                        for($i = 0; $i < $numDigits - 2; $i++)
                        {
                            $returnNumber = $returnNumber * 10;
                        }
                    }

                    return $returnNumber;
                }

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

                $totalVehicleCost = round(($totalVehicleCost / 5) / roundNumber($totalVehicleCost)) * roundNumber($totalVehicleCost);
                $totalFinancingCost = round(($totalFinancingCost / 5) / roundNumber($totalFinancingCost)) * roundNumber($totalFinancingCost);
                $totalAnnualFuelCost = round(($totalAnnualFuelCost / 5) / roundNumber($totalAnnualFuelCost)) * roundNumber($totalAnnualFuelCost);
                $totalInsuranceCost = round(($totalInsuranceCost / 5) / roundNumber($totalInsuranceCost)) * roundNumber($totalInsuranceCost);
                $totalTaxesCost = round(($totalTaxesCost / 5) / roundNumber($totalTaxesCost)) * roundNumber($totalTaxesCost);
                $totalMaintenanceCost = round(($totalMaintenanceCost / 5) / roundNumber($totalMaintenanceCost)) * roundNumber($totalMaintenanceCost);
                $totalRepairCost = round(($totalRepairCost / 5) / roundNumber($totalRepairCost)) * roundNumber($totalRepairCost);
                
                echo "<p class='costComponent'>$totalVehicleCost</p>";
                echo "<p class='costComponent'>$totalFinancingCost</p>";
                echo "<p class='costComponent'>$totalAnnualFuelCost</p>";
                echo "<p class='costComponent'>$totalInsuranceCost</p>";
                echo "<p class='costComponent'>$totalTaxesCost</p>";
                echo "<p class='costComponent'>$totalMaintenanceCost</p>";
                echo "<p class='costComponent'>$totalRepairCost</p>";
                echo "<p class='costComponent bodyType'>$vehicleBody</p>";
                

                echo '<div class="costComponentInfo">' .
                '<p style="color: rgb(16, 100, 210);">Vehicle Cost:$'. $totalVehicleCost.'</p>'.
                '<p style="color: rgb(238, 99, 29);">Finance Cost: $'.$totalFinancingCost.'</p>'.
               '<p style="color: rgb(36, 162, 17);">Annual Fuel Cost: $'.$totalAnnualFuelCost.'</p>'.
                '<p style="color: rgb(141, 32, 223);">Insurance Cost: $' .$totalInsuranceCost.'</p>'.
                '<p style="color: rgb(250, 182, 65);">Taxes: $'. $totalTaxesCost.'</p>'.
                '<p style="color: rgb(40, 100, 50);">Total Maintenance Cost: $'.$totalMaintenanceCost.'</p>'.
                '<p style="color: rgb(255, 30, 34);">Repair Cost: $'.$totalRepairCost.'</p>'.
                '</div>';


                $biofuel = calculateBiofuelCost();
                $hydrogen = calculateHydrogenCost();
                $annualFuel = caluclatePercentageIncrease();

                for($i = 0; $i < 30; $i++)
                {
                    echo "Biofuel Cost: " . $biofuel[$i] . " &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Hydrogen Cost: " . $hydrogen[$i] . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Variable Fuel Costs: ". round($annualFuel[$i], 2) . "<br>";
                }
            ?>

            <!--canvas id for overlaying the image uses the imageOverlay.js file-->
            <div class="canvasContainer">
                <canvas id="vehicleGraph">canvas is not supported in your browser</canvas>
            </div>
        </main>
    </body>
</html>