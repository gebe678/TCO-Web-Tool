<?php 

    $inactive = 7200;
    ini_set("session.gc_maxlifetime", $inactive);

    session_start();

    if(!isset($_SESSION["userid"]) || $_SESSION["userid"] != true)
    {
        header("Location: index.php");
        exit;
    }

//     if(isset($_SESSION["testing"]) and (time() - $_SESSION["testing"] > $inactive))
//     {
//         session_unset();
//         session_destroy();

//         header("Location: index.php");
//         exit;
//     }

//     $_SESSION["testing"] = time();
// ?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TCO Web Tool Bootstrap</title>


    <!-- imported bootstrap stylesheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- custom stylesheets -->
    <!-- <link rel="stylesheet" href="assets/css/dropDownStyles.css"> -->
    <link rel="stylesheet" href="assets/css/pageStyles.css">
    <!-- <link rel="stylesheet" href="assets/css/sliderStyles.css"> -->
    <link rel="stylesheet" href="assets/css/tabStyles.css">


    <!-- bootstrap javascript files -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- custom javascript files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-piechart-outlabels"></script>
    <script src="assets/javascript/tabControl.js" defer></script>
    <script src="assets/javascript/sliderControl.js" defer> </script>
    <script src="assets/javascript/dropDownControl.js" defer> </script>
    <script src="assets/javascript/vehicleGraph.js" defer></script>
    <script src="assets/javascript/usedVehicleControl.js" defer></script>
    <script src="assets/javascript/hiddenInputControl.js" defer></script>
    <!-- <script src="assets/javascript/createDatabaseEntries.js" defer></script> -->
    <!-- <script src="assets/javascript/imageOverlay.js" defer></script> -->
    <script src="assets/javascript/formControl.js" defer></script>

</head>

<body>

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <header>
                    <div class="banner">
                        <img src="assets/page_pictures/banner_final_fullsize.jpg" class="bannerPicture">
                    </div>

                    <nav>
                        <!--navigation bar to go between the pages of the site easily-->
                        <div class="navBar">
                            <input type="checkbox" id="toggleButton" class="toggleSwitch" name="detailedView">
                            <label for="toggleButton" class="toggleLabel"><span class="labelTextDetailedView">Simplified
                                    View</span></label>

                            <span class="detailedOptions">
                                <!-- <input type="checkbox" id="depreciationButton" class="toggleSwitch" name="depreciation">
                    <label for="depreciationButton" class="toggleLabel"><span class="labelText">Depreciation</span></label>

                    <input type="checkbox" id="financingView" class="toggleSwitch" name="financingView">
                    <label for="financingView" class="toggleLabel"><span class="labelText">Financing</span></label>

                    <input type="checkbox" id="fuelView" class="toggleSwitch" name="fuelView">
                    <label for="fuelView" class="toggleLabel"><span class="labelText">Fuel</span></label>

                    <input type="checkbox" id="insuranceView" class="toggleSwitch" name="insuranceView">
                    <label for="insuranceView" class="toggleLabel"><span class="labelText">Insurance</span></label>

                    <input type="checkbox" id="taxesView" class="toggleSwitch" name="taxesView">
                    <label for="taxesView" class="toggleLabel"><span class="labelText">Taxes</span></label> -->

                                <!-- <input type="checkbox" id="maintenanceView" class="toggleSwitch" name="maintenanceView">
                    <label for="maintenanceView" class="toggleLabel"><span class="labelText">Maintenance</span></label>

                    <input type="checkbox" id="repairView" class="toggleSwitch" name="repairView">
                    <label for="repairView" class="toggleLabel"><span class="labelText">Repair</span></label> -->

                                <!-- <input type="checkbox" id="laborView" class="toggleSwitch" name="laborView">
                    <label for="laborView" class="toggleLabel"><span class="labelText">Labor</span></label> -->

                                <input type="checkbox" id="technologyGroup" class="toggleSwitch" name="technologyGroup"
                                    checked>
                                <label for="technologyGroup" class="toggleLabel"><span
                                        class="labelText">Technology</span></label>

                                <input type="checkbox" id="economicGroup" class="toggleSwitch" name="economicGroup"
                                    checked>
                                <label for="economicGroup" class="toggleLabel"><span
                                        class="labelText">Economic</span></label>

                                <input type="checkbox" id="behaviorGroup" class="toggleSwitch" name="behaviorGroup"
                                    checked>
                                <label for="behaviorGroup" class="toggleLabel"><span
                                        class="labelText">Behavior</span></label>
                            </span> <!-- </detailedOptions> -->

                            <button id="resetButton">Reset to default</button>
                            <!-- <button id="databaseAdder">Add Values To Database</button> -->

                            <!-- <a href="getDatabaseInfo.php">Tableau Example</a> -->
                            <a href="logout.php" style="float:right;"> Log Out </a>
                        </div><!-- </navBar> -->
                    </nav>
                </header>

            </div><!-- </col-lg-12> -->

        </div><!-- </row> -->

        <div class="row">
            <div class="col-lg-12">

                <form action="assets/PHP/processForm.php" method="POST" name="vehicleInfo" id="vehicleInfoForm">
                    <div class="row">

                        <div class="col-lg-4">

                            <div class="technologyGroup">
                                <div class="dropDownMenu form-group">
                                    <div class="label">
                                        <label for="vehicleBody">Vehicle Size:</label>
                                    </div>
                                    <div class="border">
                                        <select name="vehicleBody" class="selectMenu form-control" id="vehicleBodyMenu">
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
                                </div> <!-- </dropDownMenu> -->

                                <div class="dropDownMenu form-group">
                                    <div class="label">
                                        <label for="powertrain">Powertrain:</label>
                                    </div>
                                    <div class="border">
                                        <select name="powertrain" class="selectMenu form-control" id="powertrainMenu">
                                            <option value="ICE-SI">ICE-SI</option>
                                            <option value="ICE-CI">ICE-CI</option>
                                            <option value="HEV-SI">HEV-SI</option>
                                            <option value="PHEV">PHEV</option>
                                            <option value="FCEV">FCEV</option>
                                            <option value="BEV">BEV</option>
                                        </select>
                                    </div>
                                </div> <!-- </dropdownMenu> -->

                                <div class="dropDownMenu form-group">
                                    <div class="label">
                                        <label name="modelYear">Model Year:</label>
                                    </div>
                                    <div class="border">
                                        <select name="modelYear" class="selectMenu form-control" id="modelYearMenu">
                                            <option value="2020">2020</option>
                                            <option value="2025">2025</option>
                                            <option value="2030">2030</option>
                                            <option value="2035">2035</option>
                                            <option value="2050">2050</option>
                                        </select>
                                    </div>
                                </div><!-- </dropDownMenu -->

                            </div><!-- </technologyGroup -->

                            <div class="detailedView">

                                <div class="technologyGroup">

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="Fuel">Fuel type:</label>
                                        </div>
                                        <div class="border">
                                            <select name="fuel" class="selectMenu form-control" id="fuelTypes">
                                                <option value="Gasoline">Gasoline</option>
                                                <option value="Premium_Gasoline">Premium Gasoline</option>
                                                <option value="Diesel">Diesel</option>
                                                <option value="CNG">CNG</option>
                                                <option value="Biofuel">Biofuel</option>
                                                <option value="Hydrogen">Hydrogen</option>
                                                <option value="Electric">Electric</option>
                                                <option value="Gas_Electric">Gas Electric</option>
                                                <option value="Diesel_Electric">Diesel Electric</option>
                                                <option value="Premium_Electric">Premium Gasoline Electric</option>
                                            </select>
                                        </div>
                                    </div><!-- </dropDownMenu> -->

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="technology">Technology Progress:</label>
                                        </div>
                                        <div class="border">
                                            <select name="technology" class="selectMenu form-control"
                                                id="technologyMenu">
                                                <option value="low">low</option>
                                                <option value="high">high</option>
                                            </select>
                                        </div>
                                    </div> <!-- </dropDownMenu> -->

                                    <div class="inputContainer form-group" style="display: none;">
                                        <label for="insuranceProportional" class="sliderLabel">Insurance Proportional
                                            Rate</label>
                                        <input type="range" min="0" max="1" step=".01" value="0.04" class="slider"
                                            name="insuranceProportional" id="insuranceProportional">
                                        <input type="number" min="0" max="1" step=".01" value="0.04" class="outputText">
                                    </div> <!-- </inputContainer -->

                                    <div class="inputContainer form-group" style="display: none;">
                                        <label for="markupFactor" class="sliderLabel">Purchase Price Markup
                                            Factor</label>
                                        <input type="range" min="1" max="2" step=".01" value="1.5" class="slider"
                                            name="markupFactor" id="markupFactor">
                                        <input type="number" min="1" max="2" step=".01" value="1.5" class="outputText"
                                            id="markupFactorNumber">
                                    </div> <!-- </inputContainer> -->

                                    <div class="inputContainer form-group">
                                        <label for="depreciationRate" class="sliderLabel">Simple Depreciation
                                            Rate</label>
                                        <input type="range" min="0" max="1" step=".01" value="0.09" class="slider"
                                            name="depreciationRate" id="depreciationRate">
                                        <input type="number" min="0" max="1" step=".01" value="0.09" class="outputText">
                                    </div> <!-- </inputContainer> -->

                                    <div class="inputContainer form-group">
                                        <label for="writeOff" class="sliderLabel">Vehicle Write Off</label>
                                        <input type="range" min="1" max="30" value="10" class="slider" name="writeOff"
                                            id="writeOff">
                                        <input type="number" min="1" max="30" value="10" class="outputText">
                                    </div><!-- </inputContainer> -->

                                    <div class="inputContainer form-group">
                                        <label for="annualFuelPriceIncrease" class="sliderLabel">Annual Fuel Price
                                            Change %</label>
                                        <input type="range" min="-100" max="100" value="0" class="slider"
                                            name="annualFuelPriceIncrease" id="annualFuelPriceIncrease">
                                        <input type="number" min="-100" max="100" value="0" class="outputText"
                                            id="annualFuelPriceIncreaseRange">
                                    </div><!-- </inputContainer> -->

                                    <div class="inputContainer form-group" style="display: none;">
                                        <label for="biofuelCost" class="sliderLabel">Biofuel Cost Parity</label>
                                        <input type="range" min="1" max="30" value="15" class="slider"
                                            name="biofuelCost" id="biofuelCost">
                                        <input type="number" min="1" max="30" value="15" class="outputText">
                                    </div><!-- </inputContainer> -->

                                    <div class="inputContainer form-group" style="display: none;">
                                        <label for="biofuelPremium" class="sliderLabel">Biofuel Premium Cost</label>
                                        <input type="range" min="1" max="10" value="1" class="slider"
                                            name="biofuelPremium" id="biofuelPremium">
                                        <input type="number" min="1" max="10" value="1" class="outputText">
                                    </div><!-- </inputContainer> -->

                                    <div class="inputContainer form-group" style="display: none;">
                                        <label for="hydrogenCost" class="sliderLabel">Hydrogen to $5kg</label>
                                        <input type="range" min="1" max="30" value="15" class="slider"
                                            name="hydrogenCost" id="hydrogenCost">
                                        <input type="number" min="1" max="30" value="15" class="outputText">
                                    </div><!-- </inputContainer -->

                                    <div class="inputContainer form-group" style="display: none;">
                                        <label for="hydrogenPremium" class="sliderLabel">Hydrogen Premium Cost</label>
                                        <input type="range" min="1" max="10" value="5" class="slider"
                                            name="hydrogenPremium" id="hydrogenPremium">
                                        <input type="number" min="1" max="10" value="5" class="outputText">
                                    </div><!-- </inputContainer -->

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="fuelPriceMethod">Fuel Price:</label>
                                        </div>
                                        <div class="border">
                                            <select name="fuelPriceMethod" class="selectMenu form-control"
                                                id="fuelPriceMethod">
                                                <option value="defined">Thrid Party Prices</option>
                                                <option value="increase">Annual Incremental Change</option>
                                                <option value="userDefined">User Defined Increase</option>
                                            </select>
                                        </div>
                                    </div><!-- </dropDownContainer> -->

                                    <div class="inputContainer form-group">
                                        <label for="fuelInfrastructure" class="sliderLabel">Fueling Infrastructure
                                            Cost</label>
                                        <input type="range" min="0" max="1000" value="1000" class="slider"
                                            name="fuelInfrastructure" id="fuelInfrastructure">
                                        <input type="number" min="0" max="1000" value="1000" class="outputText">
                                    </div><!-- </inputContainer> -->

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="years">Fuel Starting Cost Year:</label>
                                        </div>
                                        <div class="border">
                                            <select name="fuelYear" class="selectMenu form-control" id="fuelStartYear">
                                                <option value="2020">2020</option>
                                                <option value="2025">2025</option>
                                                <option value="2025">2025</option>
                                                <option value="2030">2030</option>
                                                <option value="2035">2035</option>
                                                <option value="2040">2040</option>
                                                <option value="2045">2045</option>
                                                <option value="2050">2050</option>
                                            </select>
                                        </div>
                                    </div><!-- </dropDownMenu> -->

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="fuelReference">Fuel Reference</label>
                                        </div>
                                        <div class="border">
                                            <select name="fuelReference" class="selectMenu form-control"
                                                id="fuelReference">
                                                <option value="ref">AEO Reference Case</option>
                                                <!--AEO 2020 Values-->
                                                <option value="low_oil">AEO Low Oil Case</option>
                                                <option value="high_oil">AEO High Oil Case</option>
                                            </select>
                                        </div>
                                    </div><!-- </dropDownMenu> -->

                                    <div class="inputContainer form-group">
                                        <label for="premiumGasModifier" class="sliderLabel">Premium Gasoline
                                            Markup</label>
                                        <input type="range" min="0" max="1" step=".01" value=".40" class="slider"
                                            name="premiumGasModifier" id="premiumGasModifier">
                                        <input type="number" min="0" max="1" step=".01" value=".40" class="outputText">
                                    </div><!-- </inputContainer -->

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="hydrogenSuccessFactor">Hydrogen Success:</label>
                                        </div>
                                        <div class="border">
                                            <select name="hydrogenSuccessFactor" class="selectMenu form-control"
                                                id="hydrogenSuccessFactor">
                                                <option value="Success">Hydrogen Success</option>
                                                <option value="Failure">Hydrogen Failure</option>
                                            </select>
                                        </div>
                                    </div><!-- </dropDownMenu> -->

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="vehicleCostInput">Vehicle Cost</label>
                                        </div>
                                        <div class="border">
                                            <select name="vehicleCostInput" class="selectMenu form-control"
                                                id="vehicleCostInput">
                                                <option value="autonomie">Autonomie Simulations</option>
                                                <!-- <option value="aeo">AEO 2020</option> -->
                                                <!--<option value="real_world_today">Real-World Today (LDV)</option> -->
                                                <option value="userDefined">User Defined</option>
                                            </select>
                                        </div>
                                    </div><!-- </dropDownMenu> -->

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="fuelCostInput">Fuel-Economy Input</label>
                                        </div>
                                        <div class="border">
                                            <select name="fuelCostInput" class="selectMenu form-control"
                                                id="fuelCostInput">
                                                <option value="autonomie">Autonomie Simulations</option>
                                                <!-- <option value="aeo">AEO 2020</option> -->
                                                <!--<option value="real_world_today">Real-World Today (LDV)</option> -->
                                                <option value="userDefined">User Defined</option>
                                            </select>
                                        </div>
                                    </div><!-- </dropDownMenu> -->

                                    <div class="checkboxContainer form-group">
                                        <label class="sliderLabel" for="idling">Idling Costs</label>
                                        <input type="checkbox" id="idling" class="togglePowertrain" name="idling">
                                        <label for="idling" class="togglePowertrainLabel"></label>
                                    </div><!-- </checkboxContainer -->

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="APU">APU</label>
                                        </div>
                                        <div class="border">
                                            <select name="APU" class="selectMenu form-control" id="APU">
                                                <option value="true">True</option>
                                                <option value="false" selected>False</option>
                                            </select>
                                        </div>
                                    </div><!-- </dropDownMenu> -->

                                    <div class="inputContainer form-group">
                                        <label for="vehicleIncentive" class="sliderLabel">Vehicle Incentive</label>
                                        <input type="range" min="0" max="1000000000" value="0" class="slider"
                                            name="vehicleIncentive" id="vehicleIncentive">
                                        <input type="number" min="0" max="1000000000" value="0" class="outputText">
                                    </div><!-- </inputContainer> -->

                                    <div class="inputContainer form-group">
                                        <label for="interestRate" class="sliderLabel" id="interestRateLabel">Interest
                                            Rate %</label>
                                        <input type="range" min="0" max="1" value=".046" step=".001" class="slider"
                                            name="interestRate" id="interestRate">
                                        <input type="number" min="0" max="1" value=".046" step=".001" class="outputText"
                                            id="interestRateNumber">
                                    </div><!-- </inputContainer> -->

                                    <div class="inputContainer form-group">
                                        <label for="downPayment" class="sliderLabel" id="downPaymentLabel">Down
                                            Payment %</label>
                                        <input type="range" min="0" max="1" value=".12" step=".001" class="slider"
                                            name="downPayment" id="downPayment">
                                        <input type="number" min="0" max="1" value=".12" step=".001" class="outputText"
                                            id="downPaymentNumber">
                                    </div><!-- </inputContainer> -->

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="insuranceType">Insurance Type:</label>
                                        </div>
                                        <div class="border">
                                            <select name="insuranceType" class="selectMenu form-control"
                                                id="insuranceType">
                                                <option value="average">Average (Light Duty)</option>
                                                <option value="hi">Hi (Light Duty)</option>
                                                <option value="low">Low (Light Duty)</option>
                                                <option value="variable">Variable (Heavy Duty)</option>
                                                <option value="fixed">Fixed (Heavy Duty)</option>
                                                <option value="userDefined" disabled>User Defined</option>
                                                <option value="min" style="display:none;">Minimum</option>
                                                <option value="max" style="display:none;">Maximum</option>
                                                <option value="SD1+" style="display:none;">SD1+</option>
                                                <option value="SD1-" style="display:none;">SD1-</option>
                                            </select>
                                        </div>
                                    </div><!-- </dropDownMenu> -->

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="busOccupancy">Bus Occupancy:</label>
                                        </div>
                                        <div class="border">
                                            <select name="busOccupancy" class="selectMenu form-control"
                                                id="busOccupancy">
                                                <option value="lessThan15">Less than 15</option>
                                                <option value="greaterThan15">Greater than 15</option>
                                            </select>
                                        </div>
                                    </div><!-- </dropDownMenu> -->

                                    <div class="inputContainer form-group">
                                        <label for="fuelEfficiencyDegradation" class="sliderLabel">Annual MPG
                                            Degradation %</label>
                                        <input type="range" min="0" max="1" value="0" step=".001" class="slider"
                                            name="fuelEfficiencyDegradation" id="fuelEfficiencyDegradation">
                                        <input type="number" min="0" max="1" value="0" step=".001" class="outputText">
                                    </div><!-- </inputContainer> -->

                                    <div class="inputContainer form-group" style="display:none;">
                                        <label for="purchaseCost" class="sliderLabel" id="purchaseLabel">Purchase
                                            Cost</label>
                                        <input type="range" min="0" max="10000000" value="19095" class="slider"
                                            name="purchaseCost" id="purchaseCost">
                                        <input type="number" min="0" max="10000000" value="19095" class="outputText"
                                            id="purchaseNumber">
                                    </div> <!-- </inputContainer -->

                                    <div class="inputContainer" style="display:none;">
                                        <label for="userDefinedMPG" class="sliderLabel" id="userDefinedMPGLabel">MPG per
                                            Gallon</label>
                                        <input type="range" min="0" max="10000000" value=".5" step=".1" class="slider"
                                            name="userDefinedMPG" id="userDefinedMPG">
                                        <input type="number" min="0" max="10000000" value=".5" step=".1"
                                            class="outputText" id="userDefinedMPGNumber">
                                    </div> <!-- </inputContainer -->

                                </div><!-- </technologyGroup> -->

                            </div> <!-- </detailedView> -->

                        </div><!-- </col-lg-4> -->

                        <div class="col-lg-4">

                            <div class="detailedView">

                                <div class="economicGroup">

                                    <div class="dropDownMenu form-group" style="display:none;">
                                        <div class="label">
                                            <label for="regionality">Regionality:</label>
                                        </div>
                                        <div class="border">
                                            <select name="regionality" class="selectMenu form-control"
                                                id="regionalityMenu">
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
                                    </div><!-- </dropDownMenu> -->

                                    <div class="inputContainer form-group">
                                        <label for="analysisWindow" class="sliderLabel">Analysis Window</label>
                                        <input type="range" min="5" max="30" value="30" class="slider"
                                            name="analysisWindow" id="analysisWindow">
                                        <input type="number" min="5" max="30" value="30" class="outputText"
                                            id="analysisNumber">
                                    </div><!-- </inputContainer> -->

                                    <div class="inputContainer form-group">
                                        <label for="discountRate" class="sliderLabel">Discount Rate %</label>
                                        <input type="range" min=".0" max="1" step=".00001" value="0" class="slider"
                                            name="discountRate" id="discountRate">
                                        <input type="number" min=".0" max="1" step=".00001" value="0"
                                            class="outputText">
                                    </div><!-- </inputContainer -->

                                    <div class="inputContainer form-group">
                                        <label for="annualRegistration" class="sliderLabel">Annual Registration
                                            Fee</label>
                                        <input type="range" min="100" max="100" value="100" class="slider"
                                            name="annualRegistration" id="annualRegistration">
                                        <input type="number" min="100" max="100" value="100" class="outputText">
                                    </div><!-- </inputContainer> -->

                                    <div class="inputContainer form-group">
                                        <label for="salesTax" class="sliderLabel">Sales Tax & Title</label>
                                        <input type="range" min=".05" max=".05" step=".01" value=".05" class="slider"
                                            name="salesTax" id="salesTax">
                                        <input type="number" min=".05" max=".05" step=".01" value=".05"
                                            class="outputText">
                                    </div><!-- </inputContainer> -->

                                    <div class="inputContainer">
                                        <label for="insuranceFixed" class="sliderLabel">Insurance Fixed Rate</label>
                                        <input type="range" min="100" max="500" value="400" class="slider"
                                            name="insuranceFixed" id="insuranceFixed">
                                        <input type="number" min="100" max="500" value="400" class="outputText">
                                    </div><!-- </inputContainer> -->

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="depreciation">Depreciation:</label>
                                        </div>
                                        <div class="border">
                                            <select name="depreciation" class="selectMenu form-control"
                                                id="depreciationMenu">
                                                <option value="simple">Simple</option>
                                                <option value="advanced" selected>Advanced Exponential</option>
                                                <option value="userDefined" disabled>User Defined</option>
                                                <option value="upper" style="display: none;">High Confidence</option>
                                                <option value="lower" style="display:none;">Low Confidence</option>
                                            </select>
                                        </div>
                                    </div><!-- </dropDownMenu> -->

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="salvageValue">Salvage Value</label>
                                        </div>
                                        <div class="border">
                                            <select name="salvageValue" class="selectMenu form-control"
                                                id="salvageValue">
                                                <option value="none">None</option>
                                                <!--old value is incurred-->
                                                <option value="vehicle" selected>Vehicle Only</option>
                                                <!--old value is averaged-->
                                                <option value="battery">Battery Only</option>
                                                <!--old value is none-->
                                                <option value="both">Vehicle and Battery</option>
                                                <!--old value is final-->
                                            </select>
                                        </div>
                                    </div><!-- </dropDownMenu> -->

                                    <div class="inputContainer">
                                        <label for="financeTerm" class="sliderLabel" id="financeTermLabel">Finance
                                            Term</label>
                                        <input type="range" min="1" max="30" value="5" class="slider" name="financeTerm"
                                            id="financeTerm">
                                        <input type="number" min="1" max="30" value="5" class="outputText"
                                            id="financeTermNumber">
                                    </div><!-- </inputContainer> -->

                                    <div class="usedVehicleInputs form-group">
                                        <div class="checkboxContainer">
                                            <label class="sliderLabel" for="usedVehicle">Analyze Used Car</label>
                                            <input type="checkbox" id="usedVehicle" class="togglePowertrain"
                                                name="usedVehicle">
                                            <label for="usedVehicle" class="togglePowertrainLabel"></label>
                                        </div>
                                    </div><!-- </usedVehicleInputs> -->

                                    <div class="checkboxContainer form-group">
                                        <label class="sliderLabel" for="majorLDVCheck">Major Repairs</label>
                                        <input type="checkbox" id="majorLDVCheck" class="togglePowertrain"
                                            name="majorLDVCheck">
                                        <label for="majorLDVCheck" class="togglePowertrainLabel"></label>
                                    </div><!-- </checkBoxContainer> -->

                                    <div class="inputContainer form-group" id="usedVehicleContainer">
                                        <label for="usedVehicleYear" class="sliderLabel">Age of used car</label>
                                        <input type="range" min="0" max="15" value="0" class="slider"
                                            name="usedVehicleYear" id="usedVehicleYear">
                                        <input type="number" min="0" max="15" value="0" class="outputText">
                                    </div><!-- </inputContainer> -->

                                    <div class="checkboxContainer form-group">
                                        <label class="sliderLabel" for="vehicleFinanced">Is Vehicle Financed</label>
                                        <input type="checkbox" id="vehicleFinanced" class="togglePowertrain"
                                            name="vehicleFinanced">
                                        <label for="vehicleFinanced" class="togglePowertrainLabel"></label>
                                    </div><!-- </checkboxContainer> -->

                                </div><!-- </economicGroup> -->

                            </div><!-- </detailedView> -->

                        </div><!-- </col-lg-4> -->

                        <div class="col-lg-4">

                            <div class="detailedView">

                                <div class="behaviorGroup">

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="bevRange">Bev Range:</label>
                                        </div>
                                        <div class="border">
                                            <select name="bevRange" class="selectMenu form-control" id="bevRangeMenu">
                                                <option value="200" selected>BEV Powertrain Not Selected</option>
                                                <option value="200">200</option>
                                                <option value="300">300</option>
                                                <option value="400">400</option>
                                            </select>
                                        </div>
                                    </div><!-- </dropDownMenu> -->

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="phevRange">(LDV only) PHEV Range:</label>
                                        </div>
                                        <div class="border">
                                            <select name="phevRange" class="selectMenu form-control" id="phevRangeMenu">
                                                <option value="20">PHEV Powertrain Not Selected</option>
                                                <option value="20">Short</option>
                                                <option value="50">Long</option>
                                            </select>
                                        </div>
                                    </div><!-- </dropDownMenu> -->

                                    <div class="dropDownMenu form-group">
                                        <div class="label">
                                            <label for="vmt">VMT:</label>
                                        </div>
                                        <div class="border">
                                            <select name="vmt" class="selectMenu form-control" id="vmtMenu">
                                                <option value="EPA_TAR_2016_Car">EPA_TAR_2016_Car</option>
                                                <option value="EPA_TAR_2016_Trucks">EPA_TAR_2016_Trucks</option>
                                                <option value="NHTSA_2006_Cars">NHTSA_2006_Cars</option>
                                                <option value="NHTSA_2006_Trucks">NHTSA_2006_Trucks</option>
                                                <option value="Luxury_Car">Luxury_Car</option>
                                                <option value="Luxury_Light_Truck">Luxury_Light_Truck</option>
                                                <option value="Taxi">Taxi</option>
                                                <option value="BEV_200_Car">BEV_200_Car</option>
                                                <option value="Single_Unit_Service_Truck_General">
                                                    Single_Unit_Service_Truck_General</option>
                                                <option value="Single_Unit_Freight_Truck_General">
                                                    Single_Unit_Freight_Truck_General</option>
                                                <option value="Single_Unit_Freight_Truck_HHD">
                                                    Single_Unit_Freight_Truck_HHD</option>
                                                <option value="Single_Unit_Freight_Truck_MHD">
                                                    Single_Unit_Freight_Truck_MHD</option>
                                                <option value="Single_Unit_Freight_Truck_LHD">
                                                    Single_Unit_Freight_Truck_LHD</option>
                                                <option value="Tractor_Sleeper_Cab">Tractor_Sleeper_Cab</option>
                                                <option value="Tractor_Day_Cab">Tractor_Day_Cab</option>
                                                <option value="Tractor_Long_Haul">Tractor_Long_Haul</option>
                                                <option value="Tractor_Regional">Tractor_Regional</option>
                                                <option value="Tractor_Local">Tractor_Local</option>
                                                <option value="Bus">Bus</option>
                                            </select>
                                        </div>
                                    </div><!-- </dropDownMenu> -->

                                    <div class="checkboxContainer form-group" id="customNewVmtCheck">
                                        <label class="sliderLabel" for="customNewVmt">Use Custom VMT New Vehicle</label>
                                        <input type="checkbox" id="customNewVmt" class="togglePowertrain"
                                            name="customNewVmt">
                                        <label for="customNewVmt" class="togglePowertrainLabel"></label>
                                    </div><!-- </checkBoxContainer> -->

                                    <div class="customNewVMTValues form-group" id="customNewVMTValues">
                                        <label for="customNewVMTValue" class="usedVehicleLabel">Custom VMT Value</label>
                                        <input type="text" name="customNewVMTValue" id="customNewVMTValue" value="1">
                                        <label for="customNewVMTYear" class="usedVehicleLabel">Custom VMT Year</label>
                                        <input type="text" name="customNewVMTYear" id="customNewVMTYear" value="1">
                                    </div><!-- </customNewVMTValues> -->

                                    <div class="checkboxContainer form-group" id="customVMTCheck">
                                        <label class="sliderLabel" for="customVMT">Use Custom VMT Used Vehicle</label>
                                        <input type="checkbox" id="customVMT" class="togglePowertrain" name="customVMT">
                                        <label for="customVMT" class="togglePowertrainLabel"></label>
                                    </div><!-- </checkboxContainer> -->

                                    <div class="customVMTValues form-group" id="customVMTValues">
                                        <label for="customVMTValue" class="usedVehicleLabel">Custom VMT Value</label>
                                        <input type="text" name="customVMTValue" id="customVMTValue" value="1">
                                    </div><!-- </customVMTValues> -->

                                    <div class="inputContainer form-group" style="display: none;">
                                        <label for="laborCost" class="sliderLabel">Labor Cost Per Mile</label>
                                        <input type="range" min="0" max="1" value=".6" step="0.01" class="slider"
                                            name="laborCost" id="laborCost">
                                        <input type="number" min="0" max="1" value=".6" step="0.01" class="outputText">
                                    </div><!-- </inputContainer> -->

                                    <div class="inputContainer form-group" style="display: none;">
                                        <label for="payloadCost" class="sliderLabel">Payload Cost</label>
                                        <input type="range" min="0" max="1" step=".01" value=".05" class="slider"
                                            name="payloadCost" id="payloadCost">
                                        <input type="number" min="0" max="1" step=".01" value=".05" class="outputText">
                                    </div><!-- </inputContainer> -->

                                    <div class="inputContainer form-group" style="display: none;">
                                        <label for="chargingTime" class="sliderLabel">Charging Time Cost</label>
                                        <input type="range" min="0" max="1" step=".01" value=".02" class="slider"
                                            name="chargingTime" id="chargingTime">
                                        <input type="number" min="0" max="1" step=".01" value=".02" class="outputText">
                                    </div><!-- </inputContainer> -->

                                </div><!-- </behaviorGroup> -->

                            </div><!-- </detailedView> -->

                        </div><!-- </col-lg-4> -->

                    </div><!-- </row> -->

                    <div class="row">

                        <div class="col-lg-12">

                            <input type="text" name="userDefinedFuel" id="userDefinedFuel" style="display: none;"
                                value="0">
                            <input type="text" name="mpgPlugin" id="mpgPlugin" style="display: none" value="0">
                            <input type="text" name="bodyCostPlugin" id="bodyCostPlugin" style="display:none" value="0">
                            <input type="text" name="customPurchaseCost" id="customPurchaseCost" style="display:none;"
                                value="19095">
                            <input type="text" name="vehicleClassSize" id="vehicleClassSize" style="display:none;"
                                value="LDV">

                            <div class="checkboxContainer form-group">
                                <label class="sliderLabel" for="powertrainComparison">Show Powertrain Comparison</label>
                                <input type="checkbox" id="powertrainComparison" class="togglePowertrain"
                                    name="showPowertrainGraph">
                                <label for="powertrainComparison" class="togglePowertrainLabel"></label>
                            </div>

                            <div class="checkboxContainer form-group">
                                <label class="sliderLabel" for="modelYearComparison">Show Model Year Comparison</label>
                                <input type="checkbox" id="modelYearComparison" class="togglePowertrain"
                                    name="showModelYearGraph">
                                <label for="modelYearComparison" class="togglePowertrainLabel"></label>
                            </div>

                            <input type="submit" class="submitButton form-group btn btn-primary" id="submitButton">

                        </div><!-- </col-lg-12> -->

                    </div><!-- </row> -->

                </form>
            </div><!-- </col-lg-12> -->
        </div><!-- </row> -->

        <div class="row">

            <div class="col-lg-12">

                <!--canvas id's for showing the data from the vehicle cost visually-->
                <div class="pieChartContainer">
                    <canvas id="piChartGraph">canvas is not supported in your browser</canvas>
                </div><!-- </pieChartContainer> -->

                <div class="canvasContainer">
                    <canvas id="tornadoChart">canvas is not supported in your browser</canvas>
                    <canvas id="usedVehicleChart">canvas is not supported in your browser</canvas>
                    <canvas id="powertrainGraph">canvas is not supported in your browser</canvas>
                    <canvas id="modelYearGraph">canvas is not supported in your browser</canvas>
                    <canvas id="vehicleGraph">canvas is not supported in your browser</canvas>
                    <canvas id="perMileGraph">canvas is not supported in your browser</canvas>
                </div>

            </div><!-- </col-lg-12> -->

        </div><!--</row>-->

        <div class="row">

            <div class="col-lg-12">

                <p>© 2020 National Technology and Engineering Solutions of Sandia, LLC. | <a href="#">Link to documentation for calculations</a> | <a href="#">Link to analysis results</a> | <button>Download Data</button></p>
                <img src="assets/page_pictures/tcoToolContributers.jpg" alt="Web Tool Contributers" style="width: 100%;">

            </div><!-- </col-lg-12> -->

        </div><!-- </row> -->

    </div><!-- </container> -->

</body>

</html>