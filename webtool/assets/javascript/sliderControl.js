// main function called after window content is loaded
// All other functions are called from here
function main()
{
    let slider = document.querySelectorAll(".slider");
    let text = document.querySelectorAll(".outputText");

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

window.addEventListener("DOMContentLoaded", function(){
    main();
});