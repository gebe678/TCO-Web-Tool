function main()
{
    let slider = document.querySelectorAll(".slider");
    let text = document.querySelectorAll(".outputText");
    let textBlock = document.querySelectorAll(".textBlock");

    syncSliderAndText(slider, text);
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

main();