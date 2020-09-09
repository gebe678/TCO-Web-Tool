function main()
{
    let usedVehicle = document.getElementById("usedVehicle");
    let usedVehicleContainer = document.getElementById("usedVehicleContainer");
    let customVmt = document.getElementById("customVMTCheck");
    let customVmtValues = document.getElementById("customVMTValues");
    let newVmtCheck = document.getElementById("customNewVmt");
    let newVmtLabels = document.getElementById("customNewVMTValues");
    
    hideElements(usedVehicleContainer, customVmt, customVmtValues);
    controlDisplay(usedVehicle, usedVehicleContainer, customVmt, customVmtValues);
    controlNewElements(newVmtCheck, newVmtLabels);
}

function controlNewElements(check, labels)
{
    labels.style.display = "none";
    check.addEventListener("click", function(){
        if(!check.checked)
        {
            labels.style.display = "none";
        }
        else if(check.checked)
        {
            labels.style.display = "inline-block";
        }
    });
}

function hideElements(usedVehicleContainer, customVmt, customVmtValues)
{
    usedVehicleContainer.style.display = "none";
    customVmt.style.display = "none";
    customVmtValues.style.display = "none";
}

function controlDisplay(usedVehicle, usedVehicleContainer, customVmt, customVmtValues)
{
    usedVehicle.addEventListener("change", function(){
        if(usedVehicle.checked)
        {
            usedVehicleContainer.style.display = "block";
            customVmt.style.display = "block";
            customVmt.addEventListener("change", function(){
                let customVmtBox = document.getElementById("customVMT");
                if(customVmtBox.checked)
                {
                    customVmtValues.style.display = "block";
                }
                else if(!customVmtBox.checked)
                {
                    customVmtValues.style.display = "none";
                }
            });
        }
        else if(!usedVehicle.checked)
        {
            usedVehicleContainer.style.display = "none";
            customVmt.style.display = "none";
            customVmtValues.style.display = "none";
        }
    });
}

main();