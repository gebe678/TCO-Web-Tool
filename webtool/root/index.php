<!DOCTYPE html>
<html>
<head>
    <title>TCO Web Tool</title>
    <meta name="author" content="Griffin Lehrer">
    <meta name="description" content="caluclate the total cost of operation for a vehicle">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/dropDownStyles.css">
    <link rel="stylesheet" href="assets/css/pageStyles.css">
    <link rel="stylesheet" href="assets/css/sliderStyles.css">
    <link rel="stylesheet" href="assets/css/tabStyles.css">
    <script src="assets/javascript/tabControl.js" defer></script>
    <script src="assets/javascript/sliderControl.js" defer> </script>
    <script src="assets/javascript/dropDownControl.js" defer> </script>
    <script src="assets/javascript/formControl.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="assets/javascript/vehicleGraph.js" defer></script>
    <script src="assets/javascript/imageOverlay.js" defer></script>
</head>
<body>
    <header>
        <h1>This Is The Title Of The Webpage</h1>
        <nav>
            <!--navigation bar to go between the pages of the site easily-->
            <div class="navBar">
                <button class="simplifiedTab tabButton">Simplified View</button>
                <button class="detailedTab tabButton">Detailed View</button>
            </div>
        </nav>
    </header>
    <main>
        <form action="" method="GET" name="vehicleInfo">

            <div class="dropDownMenu">
                <div class="label">
                    <label for="vehicleBody">Vehicle Body:</label>
                </div>
                <div class="border">
                    <select name="vehicleBody" class="selectMenu" id="vehicleBodyMenu">
                        <option value="Compact Sedan">Compact Sedan</option>
                        <option value="Midsize Sedan">Midsize Sedan</option>
                        <option value="Small SUV">Small SUV</option>
                        <option value="Medium SUV">Medium SUV</option>
                        <option value="Pickup">Pickup</option>
                        <option value="Luxury Compact">Luxury Compact</option>
                        <option value="Luxury Midsize Car">Luxury Midsize Car</option>
                        <option value="Luxury Small SUV">Luxury Small SUV</option>
                        <option value="Luxury Medium SUV">Luxury Medium SUV</option>
                        <option value="Luxury Pickup">Luxury Pickup</option>
                        <option value="Tractor Sleeper">Tractor Sleeper</option>
                        <option value="Tractor Day Cab">Tractor Day Cab</option>
                        <option value="Class 8 Vocational">Class 8 Vocational</option>
                        <option value="Class 6 Pickup Delivery">Class 6 Pickup Delivery</option>
                        <option value="Class 3 Pickup Delivery">Class 3 Pickup Delivery</option>
                        <option value="Class 8 Bus">Class 8 Bus</option>
                        <option value="Class 8 Refuse">Class 8 Refuse</option>
                    </select>
                </div>
            </div>

            <div class="dropDownMenu">
                <div class="label">
                    <label for="powertrain">Powertrain:</label>
                </div>
                <div class="border">
                    <select name="powertrain" class="selectMenu" id="powertrainMenu">
                        <option value="ICE-SI">ICE-SI</option>
                        <option value="ICE-CI">ICE-CI</option>
                        <option value="HEV-SI">HEV-SI</option>
                        <option value="PHEV">PHEV</option>
                        <option value="FCEV">FCEV</option>
                        <option value="BEV">BEV</option>
                    </select>
                </div>
            </div>

            <div class="dropDownMenu">
                <div class="label">
                    <label name="modelYear">Model Year:</label>
                </div>
                <div class="border">
                    <select name="modelYear" class="selectMenu">
                        <option value="2020">2020</option>
                        <option value="2025">2025</option>
                        <option value="2030">2030</option>
                        <option value="2035">2035</option>
                        <option value="2050">2050</option>
                    </select>
                </div>
            </div>

            <div class="dropDownMenu">
                <div class="label">
                    <label for="regionality">Regionality:</label>
                </div>
                <div class="border">
                    <select name="regionality" class="selectMenu">
                        <option value="Alabama">Alabama</option>
                        <option value="Alaska">Alaska</option>
                        <option value="Arizona">Arizona</option>
                        <option value="Arkansas">Arkansas</option>
                        <option value="California">California</option>
                        <option value="Colorado">Colorado</option>
                        <option value="Connecticut">Connecticut</option>
                        <option value="Delaware">Delaware</option>
                        <option value="Florida">Florida</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="Idaho">Idaho</option>
                        <option value="Illinois">Illinois</option>
                        <option value="Indiana">Indiana</option>
                        <option value="Iowa">Iowa</option>
                        <option value="Kansas">Kansas</option>
                        <option value="Kentucy">Kentucy</option>
                        <option value="Louisiana">Louisiana</option>
                        <option value="Maine">Maine</option>
                        <option value="Maryland">Maryland</option>
                        <option value="Massachusetts">Massachusetts</option>
                        <option value="Michigan">Michigan</option>
                        <option value="Minnesota">Minnesota</option>
                        <option value="Mississippi">Mississippi</option>
                        <option value="Missouri">Missouri</option>
                        <option value="Montana">Montana</option>
                        <option value="Nebraska">Nebraska</option>
                        <option value="Nevada">Nevada</option>
                        <option value="New Hampshire">New Hampshire</option>
                        <option value="New Jersey">New Jersey</option>
                        <option value="New Mexico">New Mexico</option>
                        <option value="New York">New York</option>
                        <option value="North Carolina">North Carolina</option>
                        <option value="North Dakota">North Dakota</option>
                        <option value="Ohio">Ohio</option>
                        <option value="Oklahoma">Oklahoma</option>
                        <option value="Oregon">Oregon</option>
                        <option value="Pennsylvania">Pennsylvania</option>
                        <option value="Rhode Island">Rhode Island</option>
                        <option value="South Carolina">South Carolina</option>
                        <option value="South Dakota">South Dakota</option>
                        <option value="Tennessee">Tennessee</option>
                        <option value="Texas">Texas</option>
                        <option value="Utah">Utah</option>
                        <option value="Vermont">Vermont</option>
                        <option value="Virginia">Virginia</option>
                        <option value="Washington">Washington</option>
                        <option value="West Virginia">West Virginia</option>
                        <option value="Wisconsin">Wisconsin</option>
                        <option value="Wyoming">Wyoming</option>
                </select>
                </div>
            </div>

            <div class="detailedView">

                <div class="dropDownMenu">
                    <div class="label">
                        <label for="Fuel">Fuel:</label>
                    </div>
                    <div class="border">
                        <select name="fuel" class="selectMenu" id="fuelTypes">
                            <option value="Gasoline">Gasoline</option>
                            <option value="Diesel">Diesel</option>
                            <option value="CNG">CNG</option>
                            <option value="Biofuel">Biofuel</option>
                            <option value="Hydrogen">Hydrogen</option>
                            <option value="Electric">Electric</option>
                            <option value="Gas_Electric">Gas-Electric</option>
                        </select>
                    </div>
                </div>

                <div class="dropDownMenu">
                    <div class="label">
                        <label for="technology">Technology:</label>
                    </div>
                    <div class="border">
                        <select name="technology" class="selectMenu">
                            <option value="low">low</option>
                            <option value="high">high</option>
                        </select>
                    </div>
                </div>

                <div class="dropDownMenu">
                    <div class="label">
                        <label for="bevRange">Bev Range:</label>
                    </div>
                    <div class="border">
                        <select name="bevRange" class="selectMenu">
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="400">400</option>
                        </select>
                    </div>
                </div>

                <div class="dropDownMenu">
                    <div class="label">
                        <label for="vmt">VMT:</label>
                    </div>
                    <div class="border">
                        <select name="vmt" class="selectMenu">
                            <option value="EPA_TAR_2016_Car">EPA_TAR_2016_Car</option>
                            <option value="EPA_TAR_2016_Trucks">EPA_TAR_2016_Trucks</option>
                            <option value="NHTSA_2006_Cars">NHTSA_2006_Cars</option>
                            <option value="NHTSA_2006_Trucks">NHTSA_2006_Trucks</option>
                            <option value="Luxury_Car">Luxury_Car</option>
                            <option value="Luxury_Light_Truck">Luxury_Light_Truck</option>
                            <option value="Taxi">Taxi</option>
                            <option value="BEV_200_Car">BEV_200_Car</option>
                            <option value="Single_Unit_Service_Truck_General">Single_Unit_Service_Truck_General</option>
                            <option value="Single_Unit_Service_Truck_HHD">Single_Unit_Service_Truck_HHD</option>
                            <option value="Single_Unit_Service_Truck_MHD">Single_Unit_Service_Truck_MHD</option>
                            <option value="Single_Unit_Service_Truck_LHD">Single_Unit_Service_Truck_LHD</option>
                            <option value="Single_Unit_Multipurpose_Truck">Single_Unit_Multipurpose_Truck</option>
                            <option value="Tractor_Sleeper_Cab">Tractor_Sleeper_Cab</option>
                            <option value="Tractor_Day_Cab">Tractor_Day_Cab</option>
                            <option value="Tractor_Long_Haul">Tractor_Long_Haul</option>
                            <option value="Tractor_Regional">Tractor_Regional</option>
                            <option value="Tractor_Local">Tractor_Local</option>
                            <option value="Bus">Bus</option>
                        </select>
                    </div>
                </div>

                <div class="inputContainer">
                    <div class="textBlock">Annual Registration</div>
                    <input type="range" min="100" max="100" value="100" class="slider" name="annualRegistration">
                    <input type="number" min="100" max="100" value="100" class="outputText">
                </div>

                <div class="inputContainer">
                    <div class="textBlock">Sales Tax & Title</div>
                    <input type="range" min=".05" max=".05" step=".01" value=".05" class="slider" name="salesTax">
                    <input type="number" min=".05" max=".05" step=".01" value=".05" class="outputText">
                </div>

                <div class="inputContainer">
                    <div class="textBlock">Purchase Cost</div>
                    <input type="range" min="20000" max="100000" value="20000" class="slider" name="purchaseCost">
                    <input type="number" min="20000" max="100000" value="20000" class="outputText">
                </div>

                <div class="inputContainer">
                    <div class="textBlock">Insurance Fixed Rate</div>
                    <input type="range" min="100" max="500"  value="400" class="slider" name="insuranceFixed">
                    <input type="number" min="100" max="500" value="400" class="outputText">
                </div>

                <div class="inputContainer">
                    <div class="textBlock">Insurance Proportional Rate</div>
                    <input type="range" min="0" max="1" step=".01" value="0.04" class="slider" name="insuranceProportional">
                    <input type="number" min="0" max="1" step=".01" value="0.04" class="outputText">
                </div>

                <div class="inputContainer">
                    <div class="textBlock">Automotive LDV RPE Markup Factor</div>
                    <input type="range" min="1" max="2" step=".01" value="1.5" class="slider" name="markupFactor">
                    <input type="number" min="1" max="2" step=".01" value="1.5" class="outputText">
                </div>

                <div class="inputContainer">
                    <div class="textBlock">Simple Depreciation Rate</div>
                    <input type="range" min="0" max="1" step=".01" value="0.09" class="slider" name="depreciationRate">
                    <input type="number" min="0" max="1" step=".01" value="0.09" class="outputText">
                </div>

                <div class="inputContainer">
                    <div class="textBlock">Vehicle Write Off</div>
                    <input type="range" min="1" max="30" value="10" class="slider" name="writeOff">
                    <input type="number" min="1" max="30" value="10" class="outputText">
                </div>

                <div class="inputContainer">
                    <div class="textBlock">Annual Fuel Price Increase</div>
                    <input type="range" min="-100" max="100" value="0" class="slider" name="annualFuelPriceIncrease">
                    <input type="number" min="-100" max="100" value="0" class="outputText">
                </div>

                <div class="inputContainer">
                    <div class="textBlock">Biofuel Cost Parity</div>
                    <input type="range" min="1" max="30" value="15" class="slider" name="biofuelCost">
                    <input type="number" min="1" max="30" value="15" class="outputText">
                </div>

                <div class="inputContainer">
                    <div class="textBlock">Biofuel Premium Cost</div>
                    <input type="range" min="1" max="10" value="1" class="slider" name="biofuelPremium">
                    <input type="number" min="1" max="10" value="1" class="outputText">
                </div>

                <div class="inputContainer">
                    <div class="textBlock">Hydrogen to $5kg</div>
                    <input type="range" min="1" max="30" value="15" class="slider" name="hydrogenCost">
                    <input type="number" min="1" max="30" value="15" class="outputText">
                </div>

                <div class="inputContainer">
                <div class="textBlock">Hydrogen Premium Cost</div>
                <input type="range" min="1" max="10" value="5" class="slider" name="hydrogenPremium">
                <input type="number" min="1" max="10" value="5" class="outputText">
                </div>

                <div class="inputContainer">
                <div class="textBlock">Vehicle MPG Plugin</div>
                <input type="range" min="1" max="100" step=".00000001" value="16.12332967" class="slider" name="mpgPlugin">
                <input type="number" min="1" max="100" step=".00000001" value="16.12332967" class="outputText">
                </div>

                <div class="inputContainer">
                <div class="textBlock">Vehicle Body Cost Plugin</div>
                <input type="range" min="5000" max="100000" step=".0001" value="15000.4398" class="slider" name="bodyCostPlugin">
                <input type="number" min="5000" max="100000" step=".0001" value="15000.4398" class="outputText">
                </div> 
            </div>

            <input type="submit" class="submitButton" name="submit">
        </form>

        <?php
            if(isset($_GET["submit"]))
            {
                include "assets/PHP/getID.php";
                include "assets/PHP/getFuelCostData.php";
                include "assets/PHP/fuelPriceCalculations.php";
                include "assets/PHP/maintenancePriceCalculations.php";
                include "assets/PHP/vehicleCalculations.php";
                include "assets/PHP/insuranceCalculations.php";
                include "assets/PHP/taxesAndFeesCalculations.php";
                include "assets/PHP/financeCalculations.php";

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

                // This is where I will put the important vehicle information
                $vehicleBodyCost = calculateSimpleDepreciation(30);
                $financeCost = calculateInterestPayment(30);
                $annualFuelCost = calculateAnnualFuelcost(30);
                $insuranceCost = calculateInsurancecost(30);
                $taxesAndFees = calculateTaxesAndFees(30);
                $maintenance = calculateTotalMaintenance(30);
                $repair = calculateTotalRepair(30);

                $totalVehicleBodyCost = 0;
                $totalFinanceCost = 0;
                $totalAnnualFuelCost = 0;
                $totalInsuranceCost = 0;
                $totalTaxesCost = 0;
                $totalMaintenanceCost = 0;
                $totalRepairCost = 0;

                for($i = 0; $i < 10; $i++)
                {
                    $totalVehicleBodyCost = $vehicleBodyCost[$i] + $totalVehicleBodyCost;
                    $totalFinanceCost = $totalFinanceCost + $financeCost[$i];
                    $totalAnnualFuelCost = $totalAnnualFuelCost + $annualFuelCost[$i];
                    $totalInsuranceCost = $totalInsuranceCost + $insuranceCost[$i];
                    $totalTaxesCost = $totalTaxesCost + $taxesAndFees[$i];
                    $totalMaintenanceCost = $totalMaintenanceCost + $maintenance[$i];
                    $totalRepairCost = $totalRepairCost + $repair[$i];
                }

                //  $totalVehicleBodyCost = round($totalVehicleBodyCost / 5);
                //  $totalFinanceCost = round($totalFinanceCost / 5);
                //  $totalAnnualFuelCost = round($totalAnnualFuelCost / 5);
                //  $totalInsuranceCost = round($totalInsuranceCost / 5);
                //  $totalTaxesCost = round($totalTaxesCost / 5);
                //  $totalRepairCost = round($totalRepairCost / 5);

                echo "<p class='costComponent'>$totalVehicleBodyCost</p>";
                echo "<p class='costComponent'>$totalFinanceCost</p>";
                echo "<p class='costComponent'>$totalAnnualFuelCost</p>";
                echo "<p class='costComponent'>$totalInsuranceCost</p>";
                echo "<p class='costComponent'>$totalTaxesCost</p>";
                echo "<p class='costComponent'>$totalMaintenanceCost</p>";
                echo "<p class='costComponent'>$totalRepairCost</p>";
                echo "<p class='costComponent bodyType'>$vehicleBody</p>";

                for($i = 0; $i < 30; $i++)
                {
                    $year = $i + 1;
                    echo "<p class='costComponents year'>$year</p>";

                    $vehicleBodyCost[$i] = round($vehicleBodyCost[$i], 0);
                    echo "<p class='costComponents vehicleBody'>$vehicleBodyCost[$i]</p>"; 

                    $financeCost[$i] = round($financeCost[$i], 0);
                    echo "<p class='costComponents financeCost'>$financeCost[$i]</p>";

                    $annualFuelCost[$i] = round($annualFuelCost[$i], 0);
                    echo "<p class='costComponents annualFuelCost'>$annualFuelCost[$i]</p>";

                    $insuranceCost[$i] = round($insuranceCost[$i], 0);
                    echo "<p class='costComponents insuranceCost'>$insuranceCost[$i]</p>";

                    $taxesAndFees[$i] = round($taxesAndFees[$i], 0);
                    echo "<p class='costComponents taxesAndFees'>$taxesAndFees[$i]</p>";

                    $maintenance[$i] = round($maintenance[$i], 0);
                    echo "<p class='costComponents maintenance'>$maintenance[$i]</p>";

                    $repair[$i] = round($repair[$i], 0);
                    echo "<p class='costComponents repair'>$repair[$i]</p>";
                }

                // for($i = 0; $i < 30; $i++)
                // {
                //     echo "Year " . ($i + 1) . "<br>";
                //     echo "Body Cost is: ". round($vehicleBodyCost[$i], 0) . "<br>";
                //     echo "Finance Cost is: " . round($financeCost[$i], 0) . "<br>";
                //     echo "annual Fuel Cost Is: ". round($annualFuelCost[$i], 0) . "<br>";
                //     echo "Insurance Cost is : ". round($insuranceCost[$i], 0) . "<br>";
                //     echo "Taxes and Fees are: ". round($taxesAndFees[$i], 0) . "<br>";
                //     echo "Maintenance is: ". round($maintenance[$i], 0) . "<br>";
                //     echo "Repair cost is: ". round($repair[$i], 0) . "<br>";
                //     echo "<br><br>";
                // }  
            }             
        ?>

            <!--canvas id's for showing the data from the vehicle cost visually-->
            <div class="canvasContainer">
                <canvas id="vehicleGraph">canvas is not supported in your browser</canvas>
                <canvas id="acualVehicleGraph">canvas is not supported in you browser</canvas>
            </div>
    </main>

    <footer>
    </footer>
</body>
</html>