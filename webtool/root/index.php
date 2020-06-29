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
                    <select name="powertrain" class="selectMenu">
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