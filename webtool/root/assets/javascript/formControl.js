function main()
{
    imageOverlayMain();
    vehicleGraphMain();
}

function submittedForm()
{
    let form = document.getElementById("vehicleInfoForm");

    form.onsubmit = function()
    {
        event.preventDefault();
    
        let data = new FormData();
        data.append("vehicleBody", document.getElementById("vehicleBodyMenu").value);
        data.append("powertrain", document.getElementById("powertrainMenu").value);
        data.append("modelYear", document.getElementById("modelYearMenu").value);
        data.append("regionality", document.getElementById("regionalityMenu"));
        data.append("fuel", document.getElementById("fuelTypes").value);
        data.append("technology", document.getElementById("technologyMenu").value);
        data.append("bevRange", document.getElementById("bevRangeMenu").value);
        data.append("vmt", document.getElementById("vmtMenu").value);
        data.append("annualRegistration", document.getElementById("annualRegistration").value);
        data.append("salesTax", document.getElementById("salesTax").value);
        data.append("purchaseCost", document.getElementById("purchaseCost").value);
        data.append("insuranceFixed", document.getElementById("insuranceFixed").value);
        data.append("insuranceProportional", document.getElementById("insuranceProportional").value);
        data.append("markupFactor", document.getElementById("markupFactor").value);
        data.append("depreciationRate", document.getElementById("depreciationRate").value);
        data.append("writeOff", document.getElementById("writeOff").value);
        data.append("annualFuelPriceIncrease", document.getElementById("annualFuelPriceIncrease").value);
        data.append("biofuelCost", document.getElementById("biofuelCost").value);
        data.append("biofuelPremium", document.getElementById("biofuelPremium").value);
        data.append("hydrogenCost", document.getElementById("hydrogenCost").value);
        data.append("hydrogenPremium", document.getElementById("hydrogenPremium").value);
        data.append("mpgPlugin", document.getElementById("mpgPlugin").value);
        data.append("bodyCostPlugin", document.getElementById("bodyCostPlugin").value);

        let request = new XMLHttpRequest();
        request.open("POST", "index.php");
    
        request.onload = function()
        {
            console.log(this.responseText);
        };
    
        request.send(data);
    }
}

main();