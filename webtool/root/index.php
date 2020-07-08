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
        <form action="getDataBaseInfo.php" method="GET">

            <div class="dropDownMenu">
                <div class="label">
                    <label for="vehicleBody">Vehicle Body:</label>
                </div>
                <div class="border">
                    <select name="vehicleBody" class="selectMenu">
                        <option value="Compact Sedan">Compact Sedan</option>
                        <option value="Midsize Sedan">Midsize Sedan</option>
                        <option value="Small SUV">Small SUV</option>
                        <option value="Medium SUV">Medium SUV</option>
                        <option value="Pickup">Pickup</option>
                        <option value="Luxury Compact">Luxury Compact</option>
                        <option value="Luxury Midsize">Luxury Midsize</option>
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
                        <option value="2030" selected>2030</option>
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
                        <option value="California">California</option>
                        <option value="New Mexico">New Mexico</option>
                        <option value="Maine">Maine</option>
                        <option value="Florida">Florida</option>
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
            </div>

            <input type="submit" class="submitButton">
        </form>
    </main>

    <footer>
    </footer>
</body>
</html>