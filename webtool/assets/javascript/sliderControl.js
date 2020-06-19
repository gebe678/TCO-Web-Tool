function main()
{
    let slider = document.querySelector(".slider");
    let text = document.querySelector(".outputText");

    text.innerHTML = slider.value;

    slider.oninput = function()
    {
        text.innerHTML = this.value;
    }
}

window.addEventListener("DOMContentLoaded", function(){
    main();
});