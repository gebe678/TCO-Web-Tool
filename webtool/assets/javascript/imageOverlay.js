// this script is for changing the iamge of the car on the canvas object for the web-tool

// main function everything will be called from here
function main()
{
    // variable that points to the canvas element in the index html
    let canvas = document.getElementById("vehicleGraph");
    let ctx = canvas.getContext("2d");

    // image variable that is going to be added to the canvas
    let img = new Image();   

    // code run after the image is loaded into the script
    img.onload = function(){
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        let startValue = totalAreaCovered(canvas, ctx);
        
        let st = partitionImage(canvas, ctx, startValue[0], .3, 0, 0, 255);
        let st2 = partitionImage(canvas, ctx, st, .3, 255, 0, 0);
        partitionImage(canvas, ctx, st2, .4, 0, 255, 0);
        
    }
    
    // srouce file for the image to be loaded
    img.src = "assets/pictures/pickup-truck.jpg";

    //resize the canvas to the picture size
    resetCanvasSize(img.width, img.height, canvas);
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

// run the canvas code after the window has loaded
window.onload = function(){
    main();
}