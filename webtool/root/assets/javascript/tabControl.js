function main()
{
    toggleControl();
}

function toggleControl()
{
    let toggle = document.getElementById("toggleButton");
    let detailedView = document.querySelector(".detailedView");
    let labelText = document.querySelector(".labelText");
    let technologyGroup = document.querySelector(".technologyGroup");
    let detailedTechnologyGroup = document.querySelector(".detailedView .technologyGroup");

    toggle.addEventListener("click", function(){
        if(toggle.checked)
        {
            detailedView.style.display = "block";
            labelText.innerHTML = "Detailed View";
            labelText.style.float = "left";
            labelText.style.marginLeft = "20px";
            technologyGroup.style.backgroundColor = "#46caf1";
            detailedTechnologyGroup.style.backgroundColor = "#46caf1";
        }
    
        if(!toggle.checked)
        {
            detailedView.style.display = "none";
            labelText.innerHTML = "Simplified View";
            labelText.style.float = "right";
            labelText.style.marginRight = "20px";
            technologyGroup.style.backgroundColor = "white";
            detailedTechnologyGroup.style.backgroundColor = "white";
        }
    
    });
}

main();