<!DOCTYPE html>
<head>
    <title>TCO Web Tool</title>
    <meta name="author" content="Griffin Lehrer">
    <meta name="description" content="caluclate the total cost of operation for a vehicle">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/dropDownStyles.css">
    <link rel="stylesheet" href="assets/css/pageStyles.css">
    <script src="assets/javascript/dropDownControl.js" defer></script>
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
                <a href = "detailedView.html">DETAILED VIEW</a>
            </div>
        </nav>
    </header>
    <main>
        <!--drop down menu for the vehicle body-->
        <div class="dropDownMenu bodyMenu">
                <p>Vehicle Body: </p>
                <div class="body vehicleBody">
                    <div class="box"><span class="boxText vehicleText"></span><span class="arrow"></span></div>
                    <div class="elements bodyElements">
                        <a href="#">&nbsp</a>
                        <a href="#">compact LDV</a>
                        <a href="#">midsize HDV</a>
                        <a href="#">Long Haul Trucks</a>
                    </div>
                </div>
        </div>

        <!--drop down menu for the powertrain-->
        <div class="dropDownMenu powerTrainMenu">
            <p>Powertrain: </p>
            <div class="body powerTrainBody">
                <div class="box"><span class = "boxText powerText"></span><span class="arrow"></span></div>
                <div class="elements powerTrainElements">
                    <a href="#">&nbsp</a>
                    <a href="#">ICE</a>
                    <a href="#">HEV</a>
                    <a href="#">FCEV</a>
                    <a href="#">BEV</a>
                </div>
            </div>
        </div>
        
        <!--drop down menu for the regionality-->
        <div class="dropDownMenu regionalityMenu">
            <p>Regionality: </p>
            <div class="body regionalityBody">
                <div class="box"><span class="boxText regionalityText"></span><span class="arrow"></span></div>
                <div class="elements regionalityElements">
                    <a href="#">&nbsp</a>
                    <a href="#">California</a>
                    <a href="#">New Mexico</a>
                    <a href="#">Maine</a>
                    <a href="#">Florida</a>
                    <a href="#">Maryland</a>
                </div>
            </div>
        </div>
        <!--canvas id for overlaying the image uses the imageOverlay.js file-->
        <div class="canvasContainer">
            <canvas id="vehicleGraph">canvas is not supported in your browser</canvas>
        </div>

    </main>

    <footer>

    </footer>
</body>