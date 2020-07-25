// this script is for changing the iamge of the car on the canvas object for the web-tool

// variables that hold the starting place for a picutre
let st = 0;
let st2 = 0;
let st3 = 0;
let st4 = 0;
let st5 = 0;
let st6 = 0;
let st7 = 0;

// variables for the percentage of each cost component
let vehiclePercentage = 0;
let financePercentage = 0;
let fuelPercentage = 0;
let insurancePercentage = 0;
let taxPercentage = 0;
let maintenancePercentage = 0;
let repairPercentage = 0;

// variales for the true cost of each component
let vehicleCost = 0;
let financingCost = 0;
let annualFuelCost = 0;
let insurance = 0;
let taxes = 0;
let maintenance = 0;
let repairCost = 0;

// main function everything will be called from here
function imageOverlayMain(vehicle, financing, annualFuel, insuranceCost, taxesCost, maintenanceCost, repair, imageType)
{
    // set cost component data from user when the form is submitted
    setVehicleInformation(vehicle, financing, annualFuel, insuranceCost, taxesCost, maintenanceCost, repair);

    // variable that points to the canvas element in the index html
    let canvas = document.getElementById("imageOverlay");
    let ctx = canvas.getContext("2d");

    // image variable that is going to be added to the canvas
    let img = new Image();
    img.crossOrigin = "Anonymous";

    // code run after the image is loaded into the script
    img.onload = function(){

        //resize the canvas to the picture size
        resetCanvasSize(img.width, img.height, canvas);  
        
        ctx.drawImage(img, 0, 0);

        turnWhite(canvas, ctx);

        let startValue = totalAreaCovered(canvas, ctx);
        colorImage(canvas, ctx, startValue, img);

        let tempCanvas = document.createElement("canvas");
        let tempCtx = tempCanvas.getContext("2d");

        tempCanvas.width = canvas.width;
        tempCanvas.height = canvas.height;

        tempCtx.drawImage(canvas, 0, 0);

        let angle = 270 * Math.PI / 180;
        canvas.width = img.height;
        canvas.height = img.width;

        let imageWidth = img.width;
        let imageHeight = img.height;

        ctx.save();

        ctx.translate(Math.abs(imageWidth/2 * Math.cos(angle) + imageHeight/2 * Math.sin(angle)), Math.abs(imageHeight/2 * Math.cos(angle) + imageWidth/2 * Math.sin(angle)));
        ctx.rotate(angle);
        ctx.translate(-img.width / 2, -img.height / 2);
        ctx.drawImage(tempCanvas, 0, 0);

        tempCtx.clearRect(0, 0, canvas.width, canvas.height);

        ctx.font = "15px Arial";
        ctx.fillText("Vehicle Body", 80, (startValue[0] + st) / 2);
        ctx.fillText("Finance", 80, (st + st2) / 2);
        ctx.fillText("Annual Fuel Cost", 80, (st2 + st3) / 2);
        ctx.fillText("Insurance", 80, (st3 + st4) / 2);
        ctx.fillText("Taxes", 80, (st4 + st5) / 2);
        ctx.fillText("Maintenance", 80, (st5 + st6) / 2);
        ctx.fillText("Repair", 80, (st6 + st7) / 2);

        ctx.restore();

        ctx.beginPath();
        ctx.moveTo((startValue[0] + st) / 2, 150);
        ctx.lineTo((startValue[0] + st) / 2, 20);
        ctx.moveTo((st + st2) / 2, 150);
        ctx.lineTo((st + st2) / 2, 35);
        ctx.moveTo((st2 + st3) / 2, 150);
        ctx.lineTo((st2 + st3) / 2, 35);
        ctx.moveTo((st3 + st4) / 2, 150);
        ctx.lineTo((st3 + st4) / 2, 35);
        ctx.moveTo((st4 + st5) / 2, 150);
        ctx.lineTo((st4 + st5) / 2, 35);
        ctx.moveTo((st5 + st6) / 2, 150);
        ctx.lineTo((st5 + st6) / 2, 35);
        ctx.moveTo((st6 + st7) / 2, 150);
        ctx.lineTo((st6 + st7) / 2, 35);
        ctx.stroke();
        
        ctx.font = "15px Arial";
        vehiclePercentage = vehiclePercentage * 100;
        vehiclePercentage = vehiclePercentage.toFixed(0);
        ctx.fillText(vehiclePercentage + "%", (startValue[0] + st) / 2 - 7, 15);

        financePercentage = financePercentage * 100;
        financePercentage = financePercentage.toFixed(0);
        ctx.fillText(financePercentage + "%", (st + st2) / 2 - 7, 30);

        fuelPercentage = fuelPercentage * 100;
        fuelPercentage = fuelPercentage.toFixed(0);
        ctx.fillText(fuelPercentage + "%", (st2 + st3) / 2 - 7, 15);

        insurancePercentage = insurancePercentage * 100;
        insurancePercentage = insurancePercentage.toFixed(0);
        ctx.fillText(insurancePercentage + "%", (st3 + st4) / 2 - 7, 30);

        taxPercentage = taxPercentage * 100;
        taxPercentage = taxPercentage.toFixed(0);
        ctx.fillText(taxPercentage + "%", (st4 + st5) / 2 - 7, 15);

        maintenancePercentage = maintenancePercentage * 100;
        maintenancePercentage = maintenancePercentage.toFixed(0);
        ctx.fillText(maintenancePercentage + "%", (st5 + st6) / 2 - 7, 30);

        repairPercentage = repairPercentage * 100;
        repairPercentage = repairPercentage.toFixed(0);
        ctx.fillText(repairPercentage + "%", (st6 + st7) / 2 - 7, 15);
    };

    // source file for the image to be loaded
    let bodyType = document.querySelector(".bodyType");
    img.src = "assets/sillouette_pictures/" + imageType + ".jpg";
}

// sets the global vehicle variables for the function
function setVehicleInformation(vehicle, financing, annualFuel, insuranceCost, taxesCost, maintenanceCost, repair)
{
    for(let i = 0; i < 5; i++)
    {
        vehicleCost = vehicleCost + vehicle[i];
        financingCost = financingCost + financing[i];
        annualFuelCost = annualFuelCost + annualFuel[i];
        insurance = insurance + insuranceCost[i];
        taxes = taxes + taxesCost[i];
        maintenance = maintenance + maintenanceCost[i];
        repairCost = repairCost + repair[i];

        
    }
}

// resets the size of the canvas
function resetCanvasSize(cWidth, cHeight, canvas)
{
    canvas.width = cWidth;
    canvas.height = cHeight;
}

// checks to see if a pixel is white
function isWhite(number)
{
    for(let i = 150; i < 256; i++)
    {
        if(number === i)
        {
            return true;
        }
    }
    return false;
}

function turnWhite(canvas, ctx)
{
    let imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    let pixels = imgData.data;

    for(let i = 0; i < pixels.length; i += 4)
    {
        if((isWhite(pixels[i]) && isWhite(pixels[i + 1]) && isWhite(pixels[i + 2])))
        {
            pixels[i] = 255;
            pixels[i + 1] = 255;
            pixels[i + 2] = 255;
        }
    }

    ctx.putImageData(imgData, 0, 0);
}

// finds and returns the first and last column with a pixel part of the car image
function totalAreaCovered(canvas, ctx)
{
    // number of pixels in the width of the canvas
    let pixelWidth = canvas.width * 4;

    let imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    let pixels = imgData.data;
    let rowNumber = [0, 0];
    let count = 0;

    for(let i = 0; i < pixels.length; i+=4)
    {
        if(i % pixelWidth === 0)
        {
            rowNumber[0]++
        }

        if(!(isWhite(pixels[i]) && isWhite(pixels[i + 1]) && isWhite(pixels[i + 2])))
        {
            break;
        }
    }

    for(let i = 0; i < pixels.length; i+=4)
    {
        if(i % pixelWidth === 0)
        {
            count++
        }

        if(!(isWhite(pixels[i]) && isWhite(pixels[i + 1]) && isWhite(pixels[i + 2])))
        {
            rowNumber[1] = count;
        }
    }

    return rowNumber;    
}

// change the color of the picture
function changeColor(canvas, ctx, startValue, endValue, red, green, blue)
{
    let imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    let pixels = imgData.data;

    for(let i = startValue; i < endValue; i += 4)
    {
        if(!(isWhite(pixels[i]) && isWhite(pixels[i + 1]) && isWhite(pixels[i + 2])))
        {
            pixels[i] = red;
            pixels[i + 1] = green;
            pixels[i + 2] = blue;
        }
    }

    ctx.putImageData(imgData, 0, 0);
}

// create the start and end value for the changeColor function
function partitionImage(canvas, ctx, startRow, percentage, red, green, blue)
{
    let imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    let w = canvas.width * 4;

    let seRows = totalAreaCovered(canvas, ctx);
    // total number of rows in the image with color
    let totalRows = seRows[1] - seRows[0];

    // startValue for the changeColor
    let start = ((startRow - 1) * w) + 4;
  
    // last row to cover in the percentage
    let endRow = Math.ceil(percentage * totalRows) + startRow;
    let end = endRow * w;

    changeColor(canvas, ctx, start, end, red, green, blue);

    return endRow;
}

function calculateYearCost(numYears)
{
    for(let i = 0; i < numYears; i++)
    {

    }
}

function colorImage(canvas, ctx, startRow, img)
{   
    // let components = document.querySelectorAll(".costComponent");

    // let vehicleCost = parseInt(components[0].innerHTML);
    // let financingCost = parseInt(components[1].innerHTML);
    // let annualFuelCost = parseInt(components[2].innerHTML);
    // let insurance = parseInt(components[3].innerHTML);
    // let taxes = parseInt(components[4].innerHTML);
    // let maintenance = parseInt(components[5].innerHTML);
    // let repairCost = parseInt(components[6].innerHTML);

    let total = vehicleCost + financingCost + annualFuelCost + insurance + taxes + maintenance + repairCost;

    vehiclePercentage = Math.round((vehicleCost / total) * 100) / 100;
    financePercentage = Math.round((financingCost / total) * 100) / 100;
    fuelPercentage = Math.round((annualFuelCost / total) * 100) / 100;
    insurancePercentage = Math.round((insurance / total) * 100) / 100;
    taxPercentage = Math.round((taxes / total) * 100) / 100;
    maintenancePercentage = Math.round((maintenance / total) * 100 ) / 100;
    repairPercentage = Math.round((repairCost / total) * 100) / 100;

    st = partitionImage(canvas, ctx, startRow[0], vehiclePercentage, 153, 77, 0);
    st2 = partitionImage(canvas, ctx, st, financePercentage, 255, 0, 0);
    st3 = partitionImage(canvas, ctx, st2, fuelPercentage, 255, 170, 0);
    st4 = partitionImage(canvas, ctx, st3, insurancePercentage, 148, 148, 184);
    st5 = partitionImage(canvas, ctx, st4, taxPercentage, 194, 194, 214);
    st6 = partitionImage(canvas, ctx, st5, maintenancePercentage, 51, 51, 255);
    st7 = partitionImage(canvas, ctx, st6, repairPercentage, 102, 163 , 255);

    // console.log("vehicle percentage: " + Math.round((vehicleCost / total) * 100) / 100);
    // console.log("finance percentage: " + Math.round((financingCost / total) * 100) / 100);
    // console.log("fuel percentage: " + Math.round((annualFuelCost / total) * 100) / 100);
    // console.log("insurance percentage: " + Math.round((insurance / total) * 100) / 100);
    // console.log("tax percentage: " + Math.round((taxes / total) * 100) / 100);
    // console.log("maintenance percentage: " + Math.round((maintenance / total) * 100 ) / 100);
    // console.log("repair percentage: " + Math.round((repairCost / total) * 100) / 100);
}