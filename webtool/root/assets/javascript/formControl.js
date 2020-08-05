function main()
{
    let form = document.getElementById("vehicleInfoForm");
    form.addEventListener("change", function(){
        submittedAjaxForm();
    });
}

function submittedAjaxForm()
{
    let form = document.getElementById("vehicleInfoForm");
    let canvas = document.querySelector(".canvasContainer");
    let submitButton = document.getElementById("submitButton");

    let vehicleData = [];
    let financingData = [];
    let annualFuelData = [];
    let insuranceData = [];
    let taxData = [];
    let maintenanceData = [];
    let repairData = [];
    let laborData = [];
    let vmtData = [];

    let body = [];
    let finance = [];
    let fuel = [];
    let insurance = [];
    let tax = [];
    let maintenance = [];
    let repair = [];

    canvas.style.display = "none";

    
    form.addEventListener("submit", function()
    {
        event.preventDefault();

        let dataForm = $(this).serialize();
        let bodyType = document.getElementById("vehicleBodyMenu");
        let showPowertrainGraph = document.getElementById("powertrainComparison");
        
        $.ajax({
            type: 'POST',
            url: "assets/PHP/processForm.php",
            data: dataForm
        }).done(function(data)
        {
            let vehicleInformation = jQuery.parseJSON(data);

            for(let i = 0; i < 30; i++)
            {
                vehicleData[i] = vehicleInformation[0][i];
                financingData[i] = vehicleInformation[1][i];
                annualFuelData[i] = vehicleInformation[2][i];
                insuranceData[i] = vehicleInformation[3][i];
                taxData[i] = parseFloat(vehicleInformation[4][i]);
                maintenanceData[i] = vehicleInformation[5][i];
                repairData[i] = vehicleInformation[6][i];
                laborData[i] = vehicleInformation[7][i];
                vmtData[i] = vehicleInformation[8][i];
            }

            if(showPowertrainGraph.checked)
            {
                for(let i = 0; i < 7; i++)
                {
                    body[i] = vehicleInformation[8][i];
                    finance[i] = vehicleInformation[9][i];
                    fuel[i] = vehicleInformation[10][i];
                    insurance[i] = vehicleInformation[11][i];
                    tax[i] = vehicleInformation[12][i];
                    maintenance[i] = vehicleInformation[13][i];
                    repair[i] = vehicleInformation[14][i];
                }
            }
            else
            {
                $("#powertrainGraph").remove();
            }

            canvas.style.display = "block";

            if(showPowertrainGraph.checked)
            {
                powertrainGraph(body, finance, fuel, insurance, tax, maintenance, repair);
            }

            switch(bodyType.selectedIndex)
            {
                case 0:
                case 1:
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                    for(let i = 0; i < 30; i++)
                    {
                        laborData[i] = 0;
                    }
                    break;
            }

            imageOverlayMain(vehicleData, financingData, annualFuelData, insuranceData, taxData, maintenanceData, repairData, bodyType.value);
            vehicleGraphMain(vehicleData, financingData, annualFuelData, insuranceData, taxData, maintenanceData, repairData, laborData, vmtData);
        });
    });

    submitButton.click();
}

main();