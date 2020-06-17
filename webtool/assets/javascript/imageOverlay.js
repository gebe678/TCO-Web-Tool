// this script is going to create the values for when the colors will transition from one to another

// main function everything will be called from here
function run()
{
    // variable that points to the canvas element in the index html
    let canvas = document.getElementById("vehicleGraph");
    let ctx = canvas.getContext("2d");

    // image variable that is going to be added to the canvas
    let img = new Image();

    //resize the canvas to the picture size
    //resetCanvasSize(img.width, img.height, canvas);   

    // code run after the image is loaded into the script
    img.onload = function(){
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height); 

        let imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        let pixels = imageData.data;

        for(let i = 0; i < pixels.length; i += 4)
        {
            if(!(isWhite(pixels[i]) && isWhite(pixels[i + 1]) && isWhite(pixels[i + 2])))
            {
                pixels[i] = 0;
                pixels[i + 1] = 0;
                pixels[i + 2] = 155;
            }            
        }
        ctx.putImageData(imageData, 0, 0);
    }

    img.src = "assets/pictures/pickup-truck.jpg";
}

function resetCanvasSize(cWidth, cHeight, canvas)
{
    canvas.width = cWidth;
    canvas.height = cHeight;
}

function turnBackgroundAlpha(pixels)
{
    
}

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

function test()
{
    let canvas = document.getElementById("vehicleGraph");
    let ctx = canvas.getContext("2d");

    ctx.fillStyle = "orange";
    ctx.fillRect(0, 0, 50, 50);

    let imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    let pixels = imgData.data;

    for(let i = 0; i < pixels.length; i += 4)
    {
       // pixels[i] = 1;
        //pixels[i + 1] = 1;
        //pixels[i + 2] = 1;
        console.log("red: " + pixels[i] + " green: " + pixels[i + 1] + " blue: " + pixels[i + 2]);
    }

    imgData.data = pixels;
    ctx.putImageData(imgData, 0, 0);
}
// run the canvas code after the window has loaded
window.addEventListener("DOMContentLoaded", function(){
    run();
})