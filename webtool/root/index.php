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
	<?php 
		$user_name = "root";
		$password = "usbw";
		$database = "tco_vehicle_information";
		$server = "127.0.0.1";

		$connection = new mysqli($server, $user_name, $password, $database);

		if($connection->connect_error)
		{
			echo("no connection");
		}

		$sql = "SELECT Vehicle_ID, Financing FROM cost_components WHERE Vehicle_ID = 1";
        $result = $connection->query($sql);
        if($result-> num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                echo "Financing: " . $row["Vehicle_ID"]. " " . $row["Financing"] . "<br>";
            }
        }
        
	?>

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
        <!--drop down menu for the vehicle body-->
        <div class="dropDownMenu bodyMenu">
                <p>Vehicle Size: </p>
                <div class="body vehicleBody">
                    <div class="box"><span class="boxText vehicleText">Compact Sedan</span><span class="arrow"></span></div>
                    <div class="elements bodyElements">
                        <a href="#">Compact Sedan</a>
                        <a href="#">Midsize Sedan</a>
                        <a href="#">Small SUV</a>
						<a href="#">Medium SUV</a>
						<a href="#">Pickup</a>
                    </div>
                </div>
        </div>

        <!--drop down menu for the powertrain-->
        <div class="dropDownMenu powerTrainMenu">
            <p>Powertrain: </p>
            <div class="body powerTrainBody">
                <div class="box"><span class = "boxText powerText">ICE-SI</span><span class="arrow"></span></div>
                <div class="elements powerTrainElements">
                    <a href="#">ICE-SI</a>
                    <a href="#">ICE-CI</a>
                    <a href="#">HEV-SI</a>
                    <a href="#">PHEV</a>
					<a href="#">FCEV</a>
					<a href="#">BEV</a>
                </div>
            </div>
        </div>
        
        <!--drop down menu for the regionality-->
        <div class="dropDownMenu regionalityMenu">
            <p>Regionality: </p>
            <div class="body regionalityBody">
                <div class="box"><span class="boxText regionalityText">California</span><span class="arrow"></span></div>
                <div class="elements regionalityElements">
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