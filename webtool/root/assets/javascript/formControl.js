function main()
{
    submittedAjaxForm();
}

function submittedAjaxForm()
{
    let form = document.getElementById("vehicleInfoForm");
    let vehicleData = [];
    let financingData = [];
    let annualFuelData = [];
    let insuranceData = [];
    let taxData = [];
    let maintenanceData = [];
    let repairData = [];

    form.onsubmit = function()
    {
        event.preventDefault();
        let dataForm = $(this).serialize();
        let bodyType = document.getElementById("vehicleBodyMenu");

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
            }

            imageOverlayMain(vehicleData, financingData, annualFuelData, insuranceData, taxData, maintenanceData, repairData, bodyType.value);
            vehicleGraphMain(vehicleData, financingData, annualFuelData, insuranceData, taxData, maintenanceData, repairData);
        });
    }
}

main();