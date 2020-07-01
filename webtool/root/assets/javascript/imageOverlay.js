// this script is for changing the iamge of the car on the canvas object for the web-tool

// main function everything will be called from here
function main()
{
    // variable that points to the canvas element in the index html
    let canvas = document.getElementById("vehicleGraph");
    let ctx = canvas.getContext("2d");

    // image variable that is going to be added to the canvas
    let img = new Image();
    let secondImg = new Image();
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

        ctx.translate(Math.abs(imageWidth/2 * Math.cos(angle) + imageHeight/2 * Math.sin(angle)), Math.abs(imageHeight/2 * Math.cos(angle) + imageWidth/2 * Math.sin(angle)));
        ctx.rotate(angle);
        ctx.translate(-img.width / 2, -img.height / 2);
        ctx.drawImage(tempCanvas, 0, 0);

        tempCtx.clearRect(0, 0, canvas.width, canvas.height);
    };

    // source file for the image to be loaded
    let bodyType = document.querySelector(".bodyType");
    img.src = "assets/pictures/" + bodyType.innerHTML + ".jpg";
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

function colorImage(canvas, ctx, startRow, img)
{   
    let components = document.querySelectorAll(".costComponent");

    let vehicleCost = parseInt(components[0].innerHTML);
    let financingCost = parseInt(components[1].innerHTML);
    let annualFuelCost = parseInt(components[2].innerHTML);
    let insurance = parseInt(components[3].innerHTML);
    let taxes = parseInt(components[4].innerHTML);
    let maintenance = parseInt(components[5].innerHTML);
    let repairCost = parseInt(components[6].innerHTML);
    
    let total = vehicleCost + financingCost + annualFuelCost + insurance + taxes + maintenance + repairCost;

    console.log("total cost is: " + total);


    let st = partitionImage(canvas, ctx, startRow[0], vehicleCost / total, 16, 100, 210);
    let st2 = partitionImage(canvas, ctx, st, financingCost / total, 238, 99, 29);
    let st3 = partitionImage(canvas, ctx, st2, annualFuelCost / total, 36, 162, 17);
    let st4 = partitionImage(canvas, ctx, st3, insurance / total, 141, 32, 223);
    let st5 = partitionImage(canvas, ctx, st4, taxes / total, 250, 182, 65);
    let st6 = partitionImage(canvas, ctx, st5, maintenance / total, 40, 100, 50);
    let st7 = partitionImage(canvas, ctx, st6, repairCost / total, 255, 30 , 34);

    console.log("vehicle percentage: " + vehicleCost / total);
    console.log("finance percentage: " + financingCost / total);
    console.log("fuel percentage: " + annualFuelCost / total);
    console.log("insurance percentage: " + insurance / total);
    console.log("tax percentage: " + taxes / total);
    console.log("maintenance percentage: " + maintenance / total);
    console.log("repair percentage: " + repairCost / total);
}

// run the canvas code after the window has loaded
window.addEventListener("DOMContentLoaded", function(){
    main();
})