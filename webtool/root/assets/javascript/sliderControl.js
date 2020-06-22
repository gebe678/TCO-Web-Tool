// main function called after window content is loaded
// All other functions are called from here
function main()
{
    let slider = document.querySelectorAll(".slider");
    let text = document.querySelectorAll(".outputText");
    let textBlock = document.querySelectorAll(".textBlock");

    syncSliderAndText(slider, text);
    lineElements(textBlock);
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

function lineElements(textBlock)
{
    let cDifference = longestBlock(textBlock);

    for(let i = 0; i < textBlock.length; i++)
    {
        let diff = cDifference - textBlock[i].innerHTML.length;

        for(let j = 0; j < diff; j++)
        {
            textBlock[i].innerHTML = textBlock[i].innerHTML + "";
        }
    }
}   

function longestBlock(textBlock)
{
    let characterDifference = textBlock[0].innerHTML.length;

    for(let i = 0; i < textBlock.length; i++)
    {
        if(textBlock[i].innerHTML.length > characterDifference)
        {
            characterDifference = textBlock[i].innerHTML.length;
        }
    }

    return characterDifference;
}

window.addEventListener("DOMContentLoaded", function(){
    main();
});