function main()
{
    submittedAjaxForm();
}

function submittedAjaxForm()
{
    let form = document.getElementById("vehicleInfoForm");
    let canvas = document.querySelector(".canvasContainer");

    let vehicleData = [];
    let financingData = [];
    let annualFuelData = [];
    let insuranceData = [];
    let taxData = [];
    let maintenanceData = [];
    let repairData = [];
    let vmtData = [];

    let icesi = [];
    let iceci = [];
    let hevsi = [];
    let phev = [];
    let fcev = [];
    let bev = [];

    canvas.style.display = "none";

    form.onsubmit = function()
    {
        event.preventDefault();
        let dataForm = $(this).serialize();
        let bodyType = document.getElementById("vehicleBodyMenu");
        let showPowertrainGraph = document.getElementById("showPowertrainGraph");

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
                vmtData[i] = vehicleInformation[7][i];
            }

            if(showPowertrainGraph.value == "yes")
            {
                let body = [];
                let finance = [];
                let fuel = [];
                let insurance = [];
                let tax = [];
                let maintenance = [];
                let repair = [];

                for(let i = 0; i < 7; i++)
                {
                    icesi[i] = vehicleInformation[8][i];
                    iceci[i] = vehicleInformation[9][i];
                    hevsi[i] = vehicleInformation[10][i];
                    phev[i] = vehicleInformation[11][i];
                    fcev[i] = vehicleInformation[12][i];
                    bev[i] = vehicleInformation[13][i];
                }
            }
            else
            {
                $("#powertrainGraph").remove();
            }

            canvas.style.display = "block";

            imageOverlayMain(vehicleData, financingData, annualFuelData, insuranceData, taxData, maintenanceData, repairData, bodyType.value);
            vehicleGraphMain(vehicleData, financingData, annualFuelData, insuranceData, taxData, maintenanceData, repairData, vmtData);

            if(showPowertrainGraph.value == "yes")
            {
                powertrainGraph(icesi, iceci, hevsi, phev, fcev, bev);
            }
        });
    }
}

main();