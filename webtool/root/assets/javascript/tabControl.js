function main()
{
    toggleControl();
}

function toggleControl()
{
    let toggle = document.getElementById("toggleButton");
    let detailedView = document.querySelector(".detailedView");
    let labelText = document.querySelector(".labelText");
    let toggleLabel = document.querySelector(".toggleLabel");

    toggle.addEventListener("click", function(){
        if(toggle.checked)
        {
            detailedView.style.display = "block";
            labelText.innerHTML = "Detailed View";
            labelText.style.float = "left";
            labelText.style.marginLeft = "20px";
        }
    
        if(!toggle.checked)
        {
            detailedView.style.display = "none";
            labelText.innerHTML = "Simplified View";
            labelText.style.float = "right";
            labelText.style.marginRight = "20px";
        }
    
    });
}

main();