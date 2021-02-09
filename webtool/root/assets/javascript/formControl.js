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

    downloadButton.addEventListener("click", function(){
        dataDownload = true;
        submittedAjaxForm();
        submitButton.click();
    });

    shownSubmitButton.addEventListener("click", function(){
        dataDownlaod = false;
        submittedAjaxForm();
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
                //let value = prompt("No vehicle information for your selection. Please enter vehicle body price", "127030.29");
                let value  = 1;
                alert("There is no vehicle information for your selection");
                if(isNaN(value))
                {
                   // value = prompt("Input entered not a number", "127030.29");
                }
                bodyCostPlugin.value = value;
            }
            else if(data === "vehicle no fuel yes")
            {
                // let value = prompt("No fuel information for your selection. Please enter a fuel price", "27.63");
                let value = 1;
                alert("There is no fuel information availiable for your selection");
                if(isNaN(value))
                {
                    value = prompt("Input entered not a number", "27.63");
                }
                mpgPlugin.value = value;
            }
            else if(data === "vehicle yes fuel yes")
            {
                //let value = prompt("No vehilce information for your selection. Please enter vehicle body price", "127030.29");
                let value = 1;
                alert("There is no vehicle information availiable for your selection");
                if(isNaN(value))
                {
                    value = prompt("Input entered not a number", "127030.29");
                }
                bodyCostPlugin.value = value;

                //value = prompt("No fuel information for your selection. Please enter a fuel price", "27.63");
                alert("There is no fuel information availiable for your selection");
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
    let age = document.getElementById("usedVehicle");
    let usedYear = document.getElementById("usedVehicleYear");

    let first = document.querySelector(".first");
    let second = document.querySelector(".second");
    let third = document.querySelector(".third");

    let year = [];
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

    let pBody = [];
    let pFinance = [];
    let pFuel = [];
    let pInsurance = [];
    let pTax = [];
    let pMaintenance = [];
    let pRepair = [];
    let pOperational = [];
    let pLabor = [];

    let mBody = [];
    let mFinance = [];
    let mFuel = [];
    let mInsurance = [];
    let mTax = [];
    let mMaintenance = [];
    let mRepair = [];
    let mOperational = [];
    let mLabor = [];

    let uBody = [];
    let uFinance = [];
    let uFuel = [];
    let uInsurance = [];
    let uTax = [];
    let uMaintenance = [];
    let uRepair = [];
    let uOperational = [];
    let uLabor = [];

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

            let vehicleLabelType = document.getElementById("vehicleGraphControl");
            let vehicleLabelOutput = "";

            if(vehicleLabelType.value === "depreciation")
            {
                vehicleLabelOutput = "Depreciation";
            }
            else if(vehicleLabelType.value === "vehiclePayment")
            {
                vehicleLabelOutput = "Payments";
            }

            let totalVmt = vehicleInformation[9][0];
            let counter = 0;
            let startYear = 0;
            let tcoOutputOption = document.getElementById("vehicleGraphControl");
            if(age.checked)
            {
                startYear = parseFloat(usedYear.value);
            }

            for(let i = 0; i < 30; i++)
            {
                year[i] = i + 1;
                if(tcoOutputOption.selectedIndex === 0)
                {
                    vehicleData[i] = vehicleInformation[0][i + startYear];
                }
                else
                {
                    vehicleData[i] = vehicleInformation[0][i];
                }
                
                financingData[i] = vehicleInformation[1][i];
                annualFuelData[i] = vehicleInformation[2][i + startYear];
                insuranceData[i] = vehicleInformation[3][i + startYear];
                taxData[i] = parseFloat(vehicleInformation[4][i + startYear]);
                maintenanceData[i] = vehicleInformation[5][i + startYear];
                repairData[i] = vehicleInformation[6][i + startYear];
                operationalData[i] = vehicleInformation[7][i + startYear];
                laborData[i] = vehicleInformation[8][i + startYear];
                vmtData[i] = vehicleInformation[9][i + startYear];

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

            if(!age.checked)
            {
              viewAge = "New";
            }
            else
            {
              viewAge = "Used";
            }

            let bodyName = document.getElementById("vehicleBodyMenu");
            let powertrainName = document.getElementById("powertrainMenu");

            let downloadData = [];
            let csvTitle = ["Vehicle Analysis Results"]
            let costTitle = ["Annual TCO For " + viewAge + " " + powertrainName.options[powertrainName.selectedIndex].text + " " + bodyName.options[bodyName.selectedIndex].text];
            let yearLabel = ["Year"];
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

            let costMilesTitle = ["Per Mile TCO For " + viewAge + " " + powertrainName.options[powertrainName.selectedIndex].text + " " + bodyName.options[bodyName.selectedIndex].text];
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
            downloadData.push(costTitle);
            downloadData.push(yearLabel.concat(year));
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

            downloadData.push(costMilesTitle);
            downloadData.push(["Miles Driven", "10k", "20k", "30k", "40k", "50k", "60k", "70k", "80k", "90k", "100k", "110k", "120k", "130k", "140k", "150k", "160k", "170k", "180k", "190k", "200k", "210k", "220k", "230k", "240k", "250k", "260k", "270k", "280k", "290k", "300k"]);
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

            downloadData.push(["Input Selections"]);
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
                dataDownload = false;
            }

            for(let i = startYear; i < 30; i++)
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
            fiveYearAverage(vehicleLabelOutput, vehicleData, financingData, annualFuelData, insuranceData, taxData, maintenanceData, repairData, operationalData, laborData);

            
            if(!showPowertrainGraph.checked)
            {
                $("#powertrainGraph").remove();
                first.classList.remove("powertrainGraphContainer");
                second.classList.remove("powertrainGraphContainer");
                third.classList.remove("powertrainGraphContainer");
    
            }

            if(!showModelYearGraph.checked)
            {
                $("#modelYearGraph").remove();
                first.classList.remove("modelYearGraphContainer");
                second.classList.remove("modelYearGraphContainer");
                third.classList.remove("modelYearGraphContainer");
            }

            if(!showUsedVehicleGraph.checked)
            {
                $("#usedVehicleChart").remove();
                first.classList.remove("usedVehicleGraphContainer");
                second.classList.remove("usedVehicleGraphContainer");
                third.classList.remove("usedVehicleGraphContainer");
            }

            if(showPowertrainGraph.checked && !showModelYearGraph.checked && !showUsedVehicleGraph.checked)
            {
                
                for(let i = 0; i < 7; i++)
                {
                    pBody[i] = vehicleInformation[10][i];
                    pFinance[i] = vehicleInformation[11][i];
                    pFuel[i] = vehicleInformation[12][i];
                    pInsurance[i] = vehicleInformation[13][i];
                    pTax[i] = vehicleInformation[14][i];
                    pMaintenance[i] = vehicleInformation[15][i];
                    pRepair[i] = vehicleInformation[16][i];
                    pLabor[i] = vehicleInformation[17][i];
                    pOperational[i] = vehicleInformation[18][i];
                }
            }
            else if(!showPowertrainGraph.checked && showModelYearGraph.checked && !showUsedVehicleGraph.checked)
            {
                for(let i = 0; i < 7; i++)
                {
                    mBody[i] = vehicleInformation[10][i];
                    mFinance[i] = vehicleInformation[11][i];
                    mFuel[i] = vehicleInformation[12][i];
                    mInsurance[i] = vehicleInformation[13][i];
                    mTax[i] = vehicleInformation[14][i];
                    mMaintenance[i] = vehicleInformation[15][i];
                    mRepair[i] = vehicleInformation[16][i];
                    mLabor[i] = vehicleInformation[17][i];
                    mOperational[i] = vehicleInformation[18][i];
                }
            }
            else if(!showPowertrainGraph.checked && !showModelYearGraph.checked && showUsedVehicleGraph.checked)
            {
                uBody[0] = vehicleInformation[10];
                uFinance[0] = vehicleInformation[11];
                uFuel[0] = vehicleInformation[12];
                uInsurance[0] = vehicleInformation[13];
                uTax[0] = vehicleInformation[14];
                uMaintenance[0] = vehicleInformation[15];
                uRepair[0] = vehicleInformation[16];
                uLabor[0] = vehicleInformation[17];
                uOperational[0] = vehicleInformation[18];
            }
            else if(showPowertrainGraph.checked && showModelYearGraph.checked && !showUsedVehicleGraph.checked)
            {
                
                for(let i = 0; i < 7; i++)
                {
                    pBody[i] = vehicleInformation[10][i];
                    pFinance[i] = vehicleInformation[11][i];
                    pFuel[i] = vehicleInformation[12][i];
                    pInsurance[i] = vehicleInformation[13][i];
                    pTax[i] = vehicleInformation[14][i];
                    pMaintenance[i] = vehicleInformation[15][i];
                    pRepair[i] = vehicleInformation[16][i];
                    pLabor[i] = vehicleInformation[17][i];
                    pOperational[i] = vehicleInformation[18][i];

                    mBody[i] = vehicleInformation[19][i];
                    mFinance[i] = vehicleInformation[20][i];
                    mFuel[i] = vehicleInformation[21][i];
                    mInsurance[i] = vehicleInformation[22][i];
                    mTax[i] = vehicleInformation[23][i];
                    mMaintenance[i] = vehicleInformation[24][i];
                    mRepair[i] = vehicleInformation[25][i];
                    mLabor[i] = vehicleInformation[26][i];
                    mOperational[i] = vehicleInformation[27][i];
                }
            }
            else if(showPowertrainGraph.checked && !showModelYearGraph.checked && showUsedVehicleGraph.checked)
            {
                
                for(let i = 0; i < 7; i++)
                {
                    pBody[i] = vehicleInformation[10][i];
                    pFinance[i] = vehicleInformation[11][i];
                    pFuel[i] = vehicleInformation[12][i];
                    pInsurance[i] = vehicleInformation[13][i];
                    pTax[i] = vehicleInformation[14][i];
                    pMaintenance[i] = vehicleInformation[15][i];
                    pRepair[i] = vehicleInformation[16][i];
                    pLabor[i] = vehicleInformation[17][i];
                    pOperational[i] = vehicleInformation[18][i];

                    uBody[0] = vehicleInformation[19];
                    uFinance[0] = vehicleInformation[20];
                    uFuel[0] = vehicleInformation[21];
                    uInsurance[0] = vehicleInformation[22];
                    uTax[0] = vehicleInformation[23];
                    uMaintenance[0] = vehicleInformation[24];
                    uRepair[0] = vehicleInformation[25];
                    uLabor[0] = vehicleInformation[26];
                    uOperational[0] = vehicleInformation[27];
                }
            }
            else if(!showPowertrainGraph.checked && showModelYearGraph.checked && showUsedVehicleGraph.checked)
            {
                
                for(let i = 0; i < 7; i++)
                {
                    mBody[i] = vehicleInformation[10][i];
                    mFinance[i] = vehicleInformation[11][i];
                    mFuel[i] = vehicleInformation[12][i];
                    mInsurance[i] = vehicleInformation[13][i];
                    mTax[i] = vehicleInformation[14][i];
                    mMaintenance[i] = vehicleInformation[15][i];
                    mRepair[i] = vehicleInformation[16][i];
                    mLabor[i] = vehicleInformation[17][i];
                    mOperational[i] = vehicleInformation[18][i];

                    uBody[0] = vehicleInformation[19];
                    uFinance[0] = vehicleInformation[20];
                    uFuel[0] = vehicleInformation[21];
                    uInsurance[0] = vehicleInformation[22];
                    uTax[0] = vehicleInformation[23];
                    uMaintenance[0] = vehicleInformation[24];
                    uRepair[0] = vehicleInformation[25];
                    uLabor[0] = vehicleInformation[26];
                    uOperational[0] = vehicleInformation[27];
                }
            }
            else if(showPowertrainGraph.checked && showModelYearGraph.checked && showUsedVehicleGraph.checked)
            {
                
                for(let i = 0; i < 7; i++)
                {
                    pBody[i] = vehicleInformation[10][i];
                    pFinance[i] = vehicleInformation[11][i];
                    pFuel[i] = vehicleInformation[12][i];
                    pInsurance[i] = vehicleInformation[13][i];
                    pTax[i] = vehicleInformation[14][i];
                    pMaintenance[i] = vehicleInformation[15][i];
                    pRepair[i] = vehicleInformation[16][i];
                    pLabor[i] = vehicleInformation[17][i];
                    pOperational[i] = vehicleInformation[18][i];

                    mBody[i] = vehicleInformation[19][i];
                    mFinance[i] = vehicleInformation[20][i];
                    mFuel[i] = vehicleInformation[21][i];
                    mInsurance[i] = vehicleInformation[22][i];
                    mTax[i] = vehicleInformation[23][i];
                    mMaintenance[i] = vehicleInformation[24][i];
                    mRepair[i] = vehicleInformation[25][i];
                    mLabor[i] = vehicleInformation[26][i];
                    mOperational[i] = vehicleInformation[27][i];

                    uBody[0] = vehicleInformation[28];
                    uFinance[0] = vehicleInformation[29];
                    uFuel[0] = vehicleInformation[30];
                    uInsurance[0] = vehicleInformation[31];
                    uTax[0] = vehicleInformation[32];
                    uMaintenance[0] = vehicleInformation[33];
                    uRepair[0] = vehicleInformation[34];
                    uLabor[0] = vehicleInformation[35];
                    uOperational[0] = vehicleInformation[36];
                }
            }
            // else
            // {
            //     $("#powertrainGraph").remove();
            //     $("#modelYearGraph").remove();
            //     $("#usedVehicleChart").remove();
            // }

            canvas.style.display = "block";

            if(showPowertrainGraph.checked)
            {
                powertrainGraph(vehicleLabelOutput, pBody, pFinance, pFuel, pInsurance, pTax, pMaintenance, pRepair, pLabor, pOperational);
            }

            if(showModelYearGraph.checked)
            {
                modelYearGraph(vehicleLabelOutput, mBody, mFinance, mFuel, mInsurance, mTax, mMaintenance, mRepair, mLabor, mOperational);
            }

            if(showUsedVehicleGraph.checked)
            {
                usedVehicleGraph(vehicleLabelOutput, vehicleInformation[0], vehicleInformation[1], vehicleInformation[2], vehicleInformation[3], vehicleInformation[4], vehicleInformation[5], vehicleInformation[6], vehicleInformation[7], vehicleInformation[8], uBody, uFinance, uFuel, uInsurance, uTax, uMaintenance, uRepair, uLabor, uOperational);
            }

            vehicleGraphMain(vehicleLabelOutput, vehicleData, financingData, annualFuelData, insuranceData, taxData, maintenanceData, repairData, operationalData, laborData, vmtData);
        });
    });
}

main();