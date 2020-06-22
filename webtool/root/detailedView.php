<!DOCTYPE html>
<html>
    <head>
        <title>TCO Detailed View</title>
        <meta name="author" content="Griffin Lehrer">
        <meta name="description" content="caluclate the total cost of operation for a vehicle">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/pageStyles.css">
        <link rel="stylesheet" href="assets/css/dropDownStyles.css">
        <link rel="stylesheet" href="assets/css/sliderStyles.css">
        <script src="assets/javascript/dropDownControl.js" defer></script>
        <script src="assets/javascript/sliderControl.js"></script>
    </head>
    <body>
        <header>
            <h1>this is the title of the webpage</h1>
            <nav>
               <!--Navigation bar to move between the pages of the site easily-->
               <div class="navBar">
                   <a href="index.php">Main Page</a>
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

    <!--range slider for additional modification to the initial options-->
    <div class="sliderContainer">

        <div class="inputContainer">
            <span class="textBlock">Analysis Window:</span>
            <input type="range" min="1" max="100" value="1" class="slider">
            <input type="number" class="outputText" value="1" min="1" max="100">
        </div>

        <div class="inputContainer">
            <span class="textBlock">Annual Maintenance:</span>
            <input type="range" min="1" max="100" value="1" class="slider">
            <input type="number" class="outputText" value="1" min="1" max="100">
        </div>

        <div class="inputContainer">
            <span class="textBlock">Annual VMT:</span>
            <input type="range" min="1" max="100" value="1" class="slider">
            <input type="number" class="outputText" value="1" min="1" max="100">
        </div>

        <div class="inputContainer">
            <span class="textBlock">Purchase Price:</span>
            <input type="range" min="1" max="100" value="1" class="slider">
            <input type="number" class="outputText" value="1" min="1" max="100">
        </div>

        <div class="inputContainer">
            <span class="textBlock">Discount Rate:</span>
            <input type="range" min="1" max="100" value="1" class="slider">
            <input type="number" class="outputText" value="1" min="1" max="100">
        </div>

        <div class="inputContainer">
            <span class="textBlock">Taxes & Fees:</span>
            <input type="range" min="1" max="100" value="1" class="slider">
            <input type="number" class="outputText" value="1" min="1" max="100">
        </div>
         
    </div>
        </main>

        <footer>

        </footer>
    </body>
</html>