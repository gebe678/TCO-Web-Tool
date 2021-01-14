function main()
{
    let slider = document.querySelectorAll(".slider");
    let text = document.querySelectorAll(".outputText");
    let textBlock = document.querySelectorAll(".textBlock");

    syncSliderAndText(slider, text);
    changeNumberSize(text);
    discountSliderControl();
}

function syncSliderAndText(slider, text)
{
    for(let i = 0; i < slider.length; i++)
    {
         slider[i].value = text[i].value;

         text[i].oninput = function()
         {
             slider[i].value = text[i].value;
         }

         slider[i].oninput = function()
         {
             text[i].value = slider[i].value;
         }
    }
}

function changeNumberSize(text)
{
    for(let i = 0; i < text.length; i++)
    {
        text[i].style.width = "90px";
    }
}

function discountSliderControl()
{
    let discountRate = document.getElementById("discountRate");
    let discountRateNumber = document.getElementById("discountRateNumber");
    let vehicleBody = document.getElementById("vehicleBodyMenu");

    vehicleBody.addEventListener("change", function(){
        if(vehicleBody.selectedIndex > 9)
        {
            discountRate.value = 5;
            discountRateNumber.value = 5;
        }
        else
        {
            discountRate.value = 2;
            discountRateNumber.value = 2;
        }
    });
}

main();