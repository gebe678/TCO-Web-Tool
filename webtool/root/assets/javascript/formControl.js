let dataDownload = false;

function main()
{

    let downloadButton = document.getElementById("downloadData");
    let submitButton = document.getElementById("submitButton");
    let shownSubmitButton = document.getElementById("submitShownButton");

     resetToDefault();

    // this has been replaced with code in check for zero.
    //  let form = document.getElementById("vehicleInfoForm");

    // form.addEventListener("change", function(){
    //     checkForZero();
    //     let submitButton = document.getElementById("submitButton");
    //     submitButton.click();
    // });

    checkForZero();
    setPurchaseCost();
    submittedAjaxForm();

    downloadButton.addEventListener("click", function(){
        dataDownload = true;
        submitButton.click();
    });

    shownSubmitButton.addEventListener("click", function(){
        dataDownlaod = false;
        submitButton.click();
    });
}

function resetToDefault()
{
    let form = document.getElementById("vehicleInfoForm");
    let resetButton = document.getElementById("resetButton");

    resetButton.addEventListener("click", function(){
        form.reset();
    });
}

function setPurchaseCost()
{
    let form = document.getElementById("vehicleInfoForm");
    let markupFactor = document.getElementById("markupFactor");
    let purchaseCost = document.getElementById("customPurchaseCost");

    form.addEventListener("submit", function(){
        let dataForm = $(this).serialize();
    
        $.ajax({
            type: "POST",
            url: "assets/PHP/setPurchaseCost.php",
            data: dataForm
        }).done(function(data){
            purchaseCost.value = Math.round(data * markupFactor.value);
        });
    });
}

function checkForZero()
{
    let form = document.getElementById("vehicleInfoForm");
    let bodyCostPlugin = document.getElementById("bodyCostPlugin");
    let mpgPlugin = document.getElementById("mpgPlugin");
    let submitButton = document.getElementById("submitButton");

    form.addEventListener("submit", function(){
        let dataForm = $(this).serialize();
    
        $.ajax({
            type: "POST",
            url: "assets/PHP/checkForZero.php",
            data: dataForm
        }).done(function(data){
            if(data === "vehicle yes fuel no")
            {
                let value = prompt("No vehilce information for your selection. Please enter vehicle body price", "127030.29");
                if(isNaN(value))
                {
                    value = prompt("Input entered not a number", "127030.29");
                }
                bodyCostPlugin.value = value;
            }
            else if(data === "vehicle no fuel yes")
            {
                let value = prompt("No fuel information for your selection. Please enter a fuel price", "27.63");
                if(isNaN(value))
                {
                    value = prompt("Input entered not a number", "27.63");
                }
                mpgPlugin.value = value;
            }
            else if(data === "vehicle yes fuel yes")
            {
                let value = prompt("No vehilce information for your selection. Please enter vehicle body price", "127030.29");
                if(isNaN(value))
                {
                    value = prompt("Input entered not a number", "127030.29");
                }
                bodyCostPlugin.value = value;

                value = prompt("No fuel information for your selection. Please enter a fuel price", "27.63");
                if(isNaN(value))
                {
                    value = prompt("Input entered not a number", "27.63");
                }
                mpgPlugin.value = value;
            }
            
            //submitButton.click();
        });
    })
}

function submittedAjaxForm()
{
    let form = document.getElementById("vehicleInfoForm");
    let canvas = document.querySelector(".canvasContainer");

    let vehicleData = [];
    let financingData = [];
    let annualFuelData = [];
    let insuranceData = [];
    let taxData = [];
    let maintenanceData = [];
    let repairData = [];
    let operationalData = [];
    let laborData = [];
    let vmtData = [];

    let vehicleDataMiles = [];
    let financingDataMiles = [];
    let annualFuelDataMiles = [];
    let insuranceDataMiles = [];
    let taxDataMiles = [];
    let maintenanceDataMiles = [];
    let repairDataMiles = [];
    let operationalDataMiles = [];
    let laborDataMiles = [];
    let milesDrivenInt = [10000, 20000, 30000, 40000, 50000, 60000, 70000, 80000, 90000, 100000, 110000, 120000, 130000, 140000, 150000, 160000, 170000, 180000, 190000, 200000, 210000, 220000, 230000, 240000, 250000, 260000, 270000, 280000, 290000, 300000];

    let body = [];
    let finance = [];
    let fuel = [];
    let insurance = [];
    let tax = [];
    let maintenance = [];
    let repair = [];
    let operational = [];
    let labor = [];

    canvas.style.display = "none";

    
    form.addEventListener("submit", function()
    {
        event.preventDefault();

        let dataForm = $(this).serialize();
        let bodyType = document.getElementById("vehicleBodyMenu");
        let showPowertrainGraph = document.getElementById("powertrainComparison");
        let showModelYearGraph = document.getElementById("modelYearComparison");
        let showUsedVehicleGraph = document.getElementById("usedVehicle");
        
        $.ajax({
            type: 'POST',
            url: "assets/PHP/processForm.php",
            data: dataForm
        }).done(function(data)
        {
            console.log(data);
            let vehicleInformation = jQuery.parseJSON(data);

            
            let totalVmt = vehicleInformation[9][0];
            let counter = 0;

            for(let i = 0; i < 30; i++)
            {
                vehicleData[i] = vehicleInformation[0][i];
                financingData[i] = vehicleInformation[1][i];
                annualFuelData[i] = vehicleInformation[2][i];
                insuranceData[i] = vehicleInformation[3][i];
                taxData[i] = parseFloat(vehicleInformation[4][i]);
                maintenanceData[i] = vehicleInformation[5][i];
                repairData[i] = vehicleInformation[6][i];
                operationalData[i] = vehicleInformation[7][i];
                laborData[i] = vehicleInformation[8][i];
                vmtData[i] = vehicleInformation[9][i];

                if(milesDrivenInt[i] > totalVmt)
                {
                  counter++;
                  totalVmt += vmtData[counter];
                }

                vehicleDataMiles[i] = vehicleInformation[0][i] / vmtData[counter];
                financingDataMiles[i] = vehicleInformation[1][i] / vmtData[counter];
                annualFuelDataMiles[i] = vehicleInformation[2][i] / vmtData[counter];
                insuranceDataMiles[i] = vehicleInformation[3][i] / vmtData[counter];
                taxDataMiles[i] = parseFloat(vehicleInformation[4][i]) / vmtData[counter];
                maintenanceDataMiles[i] = vehicleInformation[5][i] / vmtData[counter];
                repairDataMiles[i] = vehicleInformation[6][i] / vmtData[counter];
                operationalDataMiles[i] = vehicleInformation[7][i] / vmtData[counter];
                laborDataMiles[i] = vehicleInformation[8][i] / vmtData[counter];
            }

            switch(bodyType.selectedIndex)
            {
                case 0:
                case 1:
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                    for(let i = 0; i < 30; i++)
                    {
                        laborData[i] = 0;
                        operationalData[i] = 0;
                    }
                    break;
            }

            let downloadData = [];
            let csvTitle = ["Vehicle Analysis Results"]
            let vehicleLabel = ["Depreciation"];
            let financeLabel = ["Financing"];
            let annualFuelLabel = ["Annual Fueling Cost"];
            let insuranceLabel = ["Insurance"];
            let taxesLabel = ["Taxes and Fees"];
            let maintenanceLabel = ["Maintenance"];
            let repairLabel = ["Repair"];
            let operationalLabel = ["operational"];
            let laborLabel = ["Labor"];
            let vmtLabel = ["Vehicle Miles Traveled"];

            let vehicleLabelMiles = ["Depreciation Miles"];
            let financeLabelMiles = ["Financing Miles"];
            let annualFuelLabelMiles = ["Annual Fueling Cost Miles"];
            let insuranceLabelMiles = ["Insurance Miles"];
            let taxesLabelMiles = ["Taxes and Fees Miles"];
            let maintenanceLabelMiles = ["Maintenance Miles"];
            let repairLabelMiles = ["Repair Miles"];
            let operationalLabelMiles = ["operational Miles"];
            let laborLabelMiles = ["Labor Miles"];

            let testFormArr = dataForm.split("&");
            
            downloadData.push(csvTitle);
            downloadData.push(vehicleLabel.concat(vehicleData));
            downloadData.push(financeLabel.concat(financingData));
            downloadData.push(annualFuelLabel.concat(annualFuelData));
            downloadData.push(insuranceLabel.concat(insuranceData));
            downloadData.push(taxesLabel.concat(taxData));
            downloadData.push(maintenanceLabel.concat(maintenanceData));
            downloadData.push(repairLabel.concat(repairData));
            downloadData.push(operationalLabel.concat(operationalData));
            downloadData.push(laborLabel.concat(laborData));
            downloadData.push(vmtLabel.concat(vmtData));

            downloadData.push([]);

            downloadData.push(vehicleLabelMiles.concat(vehicleDataMiles));
            downloadData.push(financeLabelMiles.concat(financingDataMiles));
            downloadData.push(annualFuelLabelMiles.concat(annualFuelDataMiles));
            downloadData.push(insuranceLabelMiles.concat(insuranceDataMiles));
            downloadData.push(taxesLabelMiles.concat(taxDataMiles));
            downloadData.push(maintenanceLabelMiles.concat(maintenanceDataMiles));
            downloadData.push(repairLabelMiles.concat(repairDataMiles));
            downloadData.push(operationalLabelMiles.concat(operationalDataMiles));
            downloadData.push(laborLabelMiles.concat(laborDataMiles));

            downloadData.push([]);

            for(let i = 0; i < testFormArr.length; i++)
            {
                let allData = testFormArr[i].split("=");
                let obj = document.getElementsByName(allData[0]);
                if(obj[0].style.display === "none")
                {
                    continue;
                }
                downloadData.push(allData);
            }

            let csvContent = "data:text/csv;charset=utf-8,";

            downloadData.forEach(function(rowArray) {
                let row = rowArray.join(",");
                csvContent += row + "\r\n";
            });

            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "TCO_Results.csv");
            document.body.appendChild(link); // Required for FF

            if(dataDownload === true)
            {
                link.click(); // This will download the data file named "my_data.csv".
            }

            for(let i = 0; i < 30; i++)
            {
                if(vmtData[i] === 0)
                {
                    vehicleData[i] = 0;
                    financingData[i] = 0;
                    annualFuelData[i] = 0;
                    insuranceData[i] = 0;
                    taxData[i] = 0;
                    maintenanceData[i] = 0;
                    repairData[i] = 0;
                    operationalData[i] = 0;
                    laborData[i] = 0;
                }
            }

            //imageOverlayMain(vehicleData, financingData, annualFuelData, insuranceData, taxData, maintenanceData, repairData, bodyType.value);
            fiveYearAverage(vehicleData, financingData, annualFuelData, insuranceData, taxData, maintenanceData, repairData, operationalData, laborData);

            if(showPowertrainGraph.checked)
            {
                $("#modelYearGraph").remove();

                for(let i = 0; i < 7; i++)
                {
                    body[i] = vehicleInformation[10][i];
                    finance[i] = vehicleInformation[11][i];
                    fuel[i] = vehicleInformation[12][i];
                    insurance[i] = vehicleInformation[13][i];
                    tax[i] = vehicleInformation[14][i];
                    maintenance[i] = vehicleInformation[15][i];
                    repair[i] = vehicleInformation[16][i];
                }
            }
            else if(showModelYearGraph.checked)
            {
                $("#powertrainGraph").remove();

                for(let i = 0; i < 7; i++)
                {
                    body[i] = vehicleInformation[10][i];
                    finance[i] = vehicleInformation[11][i];
                    fuel[i] = vehicleInformation[12][i];
                    insurance[i] = vehicleInformation[13][i];
                    tax[i] = vehicleInformation[14][i];
                    maintenance[i] = vehicleInformation[15][i];
                    repair[i] = vehicleInformation[16][i];
                }
            }
            else if(showUsedVehicleGraph.checked)
            {
                body[0] = vehicleInformation[10];
                finance[0] = vehicleInformation[11];
                fuel[0] = vehicleInformation[12];
                insurance[0] = vehicleInformation[13];
                tax[0] = vehicleInformation[14];
                maintenance[0] = vehicleInformation[15];
                repair[0] = vehicleInformation[16];
            }
            else
            {
                $("#powertrainGraph").remove();
                $("#modelYearGraph").remove();
                $("#usedVehicleChart").remove();
            }

            canvas.style.display = "block";

            if(showPowertrainGraph.checked)
            {
                powertrainGraph(body, finance, fuel, insurance, tax, maintenance, repair);
            }

            if(showModelYearGraph.checked)
            {
                modelYearGraph(body, finance, fuel, insurance, tax, maintenance, repair);
            }

            if(showUsedVehicleGraph.checked)
            {
                usedVehicleGraph(vehicleData, financingData, annualFuelData, insuranceData, taxData, maintenanceData, repairData, operationalData, laborData, body, finance, fuel, insurance, tax, maintenance, repair, 0, 0);
            }

            vehicleGraphMain(vehicleData, financingData, annualFuelData, insuranceData, taxData, maintenanceData, repairData, operationalData, laborData, vmtData);
        });
    });
}

main();