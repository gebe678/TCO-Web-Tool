<!DOCTYPE html>
<head>
    <title>TCO Web Tool</title>
    <meta name="author" content="Griffin Lehrer">
    <meta name="description" content="caluclate the total cost of operation for a vehicle">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/dropDownStyles.css">
    <link rel="stylesheet" href="assets/css/pageStyles.css">
    <script src="assets/javascript/imageOverlay.js" defer></script>
        
    <style>
        p{
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <header>
        <h1>This Is The Title Of The Webpage</h1>
        <nav>
            <!--navigation bar to go between the pages of the site easily-->
            <div class="navBar">
                <a href = "detailedView.php">DETAILED VIEW</a>
            </div>
        </nav>
    </header>
    <main>

        <form action="http://localhost:8080/assets/PHP/getDataBaseInfo.php" method="GET">
            <label for="vehicleBody">Vehicle Body:</label>
            <select name="vehicleBody">
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

            <label for="powertrain">Powertrain:</label>
            <select name="powertrain">
                <option value="ICE-SI">ICE-SI</option>
                <option value="ICE-CI">ICE-CI</option>
                <option value="HEV-SI">HEV-SI</option>
                <option value="PHEV">PHEV</option>
                <option value="FCEV">FCEV</option>
                <option value="BEV">BEV</option>
            </select>

            <label for="regionality">Regionality:</label>
            <select name="regionality">
                <option value="California">California</option>
                <option value="New Mexico">New Mexico</option>
                <option value="Maine">Maine</option>
                <option value="Florida">Florida</option>
            </select>

            <input type="submit">
        </form>
        
        <!--canvas id for overlaying the image uses the imageOverlay.js file-->
        <div class="canvasContainer">
            <canvas id="vehicleGraph">canvas is not supported in your browser</canvas>
        </div>
    </main>

    <footer>
    </footer>
</body>