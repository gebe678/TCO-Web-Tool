function vmtMenuModifier()
{
    let vehicleBody = document.getElementById("vehicleBodyMenu");
    let vmt = document.getElementById("vmtMenu");

    for(let i = 0; i < vmt.options.length; i++)
    {
        if(i == 0 || i == 2 || i == 6)
        {
            vmt.options[i].disabled = false;
        }
        else
        {
            vmt.options[i].disabled = true;
        }
    }

    vehicleBody.addEventListener("change", function(){
        event.preventDefault();
        switch(vehicleBody.selectedIndex)
        {
            case 0:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 0 || i == 2 || i == 6)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[0].selected = true;
                break;
            case 1:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 0 || i == 2 || i == 6)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[0].selected = true;
                break;
            case 2:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 1 || i == 3 || i == 6)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[1].selected = true;
                break;
            case 3:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 1 || i == 3 || i == 6)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[1].selected = true;
                break;
            case 4:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 1 || i == 3)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[1].selected = true;
                break;
            case 5:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 0 || i == 2 || i == 4 || i == 6)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[0].selected = true;
                break;
            case 6:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 0 || i == 2 || i == 4 || i == 6)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[0].selected = true;
                break;
            case 7:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 1 || i == 3 || i == 5 || i == 6)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[1].selected = true;
                break;
            case 8:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 1 || i == 3 || i == 5 || i == 6)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[1].selected = true;
                break;
            case 9:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 1 || i == 3 || i == 5)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[1].selected = true;
                break;
            case 10:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 10 || i == 12 || i == 13)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[13].selected = true;
                break;
            case 11:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 11 || i == 14)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[14].selected = true;
                break;
            case 12:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 8 || i == 9 || i == 13)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[8].selected = true;
                break;
            case 13:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 8)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[8].selected = true;
                break;
            case 14:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 8 || i == 13)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[8].selected = true;
                break;
            case 15:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 18)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[18].selected = true;
                break;
            case 16:
                for(let i = 0; i < vmt.options.length; i++)
                {
                    if(i == 8 || i == 9 || i == 16)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[8].selected = true;
                break;
                            
        }
    });

 
}

function incrementalAnnualFuelModifier()
{
    let incAnnualFuelSlider = document.getElementById("annualFuelPriceIncrease");
    let incAnnualFuelRange = document.getElementById("annualFuelPriceIncreaseRange");
    let fuelPriceMethodMenu = document.getElementById("fuelPriceMethod");

    incAnnualFuelSlider.disabled = true;
    incAnnualFuelRange.disabled = true;

    fuelPriceMethodMenu.addEventListener("change", function(){
        event.preventDefault();
        switch(fuelPriceMethodMenu.selectedIndex)
        {
            case 1:
                incAnnualFuelSlider.disabled = false;
                incAnnualFuelRange.disabled = false;
                break;
            case 0:
                incAnnualFuelSlider.value = 0;
                incAnnualFuelRange.value = 0;
                incAnnualFuelSlider.disabled = true;
                incAnnualFuelRange.disabled = true;
                break;
        }
    });
}

function bevMenuModifier()
{
    let powertrain = document.getElementById("powertrainMenu");
    let bevRange = document.getElementById("bevRangeMenu");

    bevRange.options[0].disabled = false;
    bevRange.options[1].disabled = true;
    bevRange.options[2].disabled = true;
    bevRange.options[3].disabled = true;

    powertrain.addEventListener("change", function(){
        event.preventDefault();
        switch(powertrain.selectedIndex)
        {
            case 5:
                bevRange.options[0].disabled = true;
                bevRange.options[1].disabled = false;
                bevRange.options[2].disabled = false;
                bevRange.options[3].disabled = false;
                bevRange.options[1].selected = true;
                break;
            default:
                bevRange.options[0].disabled = false;
                bevRange.options[1].disabled = true;
                bevRange.options[2].disabled = true;
                bevRange.options[3].disabled = true;
                bevRange.options[0].selected = true;
        }
    });
}

function phevMenuModifier()
{
    let powertrain = document.getElementById("powertrainMenu");
    let phevRange = document.getElementById("phevRangeMenu");

    phevRange.options[0].disabled = false;
    phevRange.options[1].disabled = true;
    phevRange.options[2].disabled = true;

    powertrain.addEventListener("click", function(){
        switch(powertrain.selectedIndex)
        {
            case 3:
                phevRange.options[0].disabled = true;
                phevRange.options[1].disabled = false;
                phevRange.options[2].disabled = false;
                phevRange.options[1].selected = true;
                break;
            default:
                phevRange.options[0].disabled = false;
                phevRange.options[1].disabled = true;
                phevRange.options[2].disabled = true;
                phevRange.options[0].selected = true;
        }
    });
}

function vehicleFinanceModifier()
{
    let financeCheck = document.getElementById("vehicleFinanced");
    let interestRate = document.getElementById("interestRate");
    let downPayment = document.getElementById("downPayment");
    let financeTerm = document.getElementById("financeTerm");

    let financeTermLabel = document.getElementById("financeTermLabel");
    let downPaymentLabel = document.getElementById("downPaymentLabel");
    let interestRateLabel = document.getElementById("interestRateLabel");

    let financeTermNumber = document.getElementById("financeTermNumber");
    let downPaymentNumber = document.getElementById("downPaymentNumber");
    let interestRateNumber = document.getElementById("interestRateNumber");

    financeCheck.addEventListener("click", function(){
        if(financeCheck.checked)
        {
            interestRate.style.display = "inline-block";
            interestRateLabel.style.display = "inline-block";
            downPayment.style.display = "inline-block";

            downPaymentLabel.style.display = "block";
            financeTerm.style.display = "block";
            financeTermLabel.style.display = "block";
            
            financeTermNumber.style.display = "inline-block";
            downPaymentNumber.style.display = "inline-block";
            interestRateNumber.style.display = "inline-block";
        }
        else
        {
            interestRate.style.display = "none";
            interestRateLabel.style.display = "none";
            downPayment.style.display = "none";

            downPaymentLabel.style.display = "none";
            financeTerm.style.display = "none";
            financeTermLabel.style.display = "none";

            financeTermNumber.style.display = "none";
            downPaymentNumber.style.display = "none";
            interestRateNumber.style.display = "none";
        }
    });
}

function powertrainMenuModifier()
{
    let powertrainMenu = document.getElementById("powertrainMenu");
    let vehicleBodyMenu = document.getElementById("vehicleBodyMenu");

    vehicleBodyMenu.addEventListener("change", function(){
        event.preventDefault();
        switch(vehicleBodyMenu.selectedIndex)
        {
            case 10:
                powertrainMenu.options[0].disabled = true;
                powertrainMenu.options[1].selected = true;
                break;
            case 11:
                powertrainMenu.options[0].disabled = true;
                powertrainMenu.options[1].selected = true;
                break;
            case 12:
                powertrainMenu.options[0].disabled = true;
                powertrainMenu.options[1].selected = true;
                break;
            case 13:
                powertrainMenu.options[0].disabled = true;
                powertrainMenu.options[1].selected = true;
                break;
            case 14:
                powertrainMenu.options[0].disabled = true;
                powertrainMenu.options[1].selected = true;
                break;
            case 15:
                powertrainMenu.options[0].disabled = true;
                powertrainMenu.options[1].selected = true;
                break;
            case 16:
                powertrainMenu.options[0].disabled = true;
                powertrainMenu.options[1].selected = true;
                break;
            default:
                powertrainMenu.options[0].disabled = false;
                powertrainMenu.options[0].selected = true;
        }
    });

    // vehicleBodyMenu.addEventListener("change", function()
    // {
    //     fuelMenuModifier();
    //     bevMenuModifier();
    // });
}

function fuelMenuModifier()
{
    let powertrainMenu = document.getElementById("powertrainMenu");
    let fuelMenu = document.getElementById("fuelTypes");
    let vehicleBodyMenu = document.getElementById("vehicleBodyMenu");

    fuelMenu.options[0].disabled = false;
    fuelMenu.options[1].disabled = true;
    fuelMenu.options[2].disabled = true;
    fuelMenu.options[3].disabled = false;
    fuelMenu.options[4].disabled = false;
    fuelMenu.options[5].disabled = true;
    fuelMenu.options[0].selected = true;
    fuelMenu.options[6].disabled = true;
    fuelMenu.options[7].disabled = true;
    fuelMenu.options[8].disabled = true;
    fuelMenu.options[9].disabled = true;

    powertrainMenu.addEventListener("change", function()
    {
        event.preventDefault();
        switch(powertrainMenu.selectedIndex)
        {
            case 0:
                fuelMenu.options[0].disabled = false;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = false;
                fuelMenu.options[4].disabled = false;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[0].selected = true;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[7].disabled = true;
                fuelMenu.options[8].disabled = true;
                fuelMenu.options[9].disabled = true;
                fuelMenu.options[0].selected = true;
                break;
            case 1:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = false;
                fuelMenu.options[3].disabled = false;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[0].selected = true;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[7].disabled = true;
                fuelMenu.options[8].disabled = true;
                fuelMenu.options[9].disabled = true;
                fuelMenu.options[2].selected = true;
                break;
            case 2:
                if(vehicleBodyMenu.selectedIndex > 9)
                {
                    fuelMenu.options[0].disabled = true;
                    fuelMenu.options[1].disabled = true;
                    fuelMenu.options[2].disabled = false;
                    fuelMenu.options[3].disabled = false;
                    fuelMenu.options[4].disabled = false;
                    fuelMenu.options[5].disabled = true;
                    fuelMenu.options[0].selected = true;
                    fuelMenu.options[6].disabled = true;
                    fuelMenu.options[7].disabled = true;
                    fuelMenu.options[8].disabled = true;
                    fuelMenu.options[9].disabled = true;
                    fuelMenu.options[2].selected = true;
                }
                else
                {
                    fuelMenu.options[0].disabled = false;
                    fuelMenu.options[1].disabled = true;
                    fuelMenu.options[2].disabled = true;
                    fuelMenu.options[3].disabled = false;
                    fuelMenu.options[4].disabled = false;
                    fuelMenu.options[5].disabled = true;
                    fuelMenu.options[0].selected = true;
                    fuelMenu.options[6].disabled = true;
                    fuelMenu.options[7].disabled = true;
                    fuelMenu.options[8].disabled = true;
                    fuelMenu.options[9].disabled = true;
                    fuelMenu.options[0].selected = true;
                }
                break;
            case 3:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = true;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[6].disabled = true;
                
                if(vehicleBodyMenu.selectedIndex <= 4)
                {
                    fuelMenu.options[7].disabled = false;
                    fuelMenu.options[8].disabled = true;
                    fuelMenu.options[7].selected = true;
                    fuelMenu.options[9].disabled = true;
                }
                else if(vehicleBodyMenu.selectedIndex >= 5 && vehicleBodyMenu.selectedIndex <= 9)
                {
                    fuelMenu.options[7].disabled = true;
                    fuelMenu.options[8].disabled = true;
                    fuelMenu.options[9].disabled = false;
                    fuelMenu.options[9].selected = true;
                }
                else
                {
                    fuelMenu.options[7].disabled = true;
                    fuelMenu.options[8].disabled = false;
                    fuelMenu.options[8].selected = true;
                    fuelMenu.options[9].disabled = true;
                }
 
                break;
            case 4:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = true;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = false;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[7].disabled = true;
                fuelMenu.options[8].disabled = true;
                fuelMenu.options[9].disabled = true;
                fuelMenu.options[5].selected = true;
                break;
            case 5:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = true;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[6].disabled = false;
                fuelMenu.options[7].disabled = true;
                fuelMenu.options[8].disabled = true;
                fuelMenu.options[9].disabled = true;
                fuelMenu.options[6].selected = true;
                break;
        }
    });

    vehicleBodyMenu.addEventListener("change", function(){
        event.preventDefault();
        switch(powertrainMenu.selectedIndex)
        {
            case 0:
                fuelMenu.options[0].disabled = false;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = false;
                fuelMenu.options[4].disabled = false;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[0].selected = true;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[7].disabled = true;
                fuelMenu.options[8].disabled = true;
                fuelMenu.options[0].selected = true;
                break;
            case 1:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = false;
                fuelMenu.options[3].disabled = false;
                fuelMenu.options[4].disabled = false;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[0].selected = true;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[7].disabled = true;
                fuelMenu.options[8].disabled = true;
                fuelMenu.options[2].selected = true;
                break;
            case 2:
                fuelMenu.options[0].disabled = false;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = false;
                fuelMenu.options[4].disabled = false;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[0].selected = true;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[7].disabled = true;
                fuelMenu.options[8].disabled = true;
                fuelMenu.options[0].selected = true;
                break;
            case 3:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = true;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[6].disabled = true;
                
                if(vehicleBodyMenu.selectedIndex <= 9)
                {
                    fuelMenu.options[7].disabled = false;
                    fuelMenu.options[8].disabled = true;
                    fuelMenu.options[7].selected = true;
                }
                else
                {
                    fuelMenu.options[7].disabled = true;
                    fuelMenu.options[8].disabled = false;
                    fuelMenu.options[8].selected = true;
                }
 
                break;
            case 4:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = true;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = false;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[7].disabled = true;
                fuelMenu.options[8].disabled = true;
                fuelMenu.options[5].selected = true;
                break;
            case 5:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = true;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[6].disabled = false;
                fuelMenu.options[7].disabled = true;
                fuelMenu.options[8].disabled = true;
                fuelMenu.options[6].selected = true;
                break;
        }

        switch(vehicleBodyMenu.selectedIndex)
        {
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = false;
                fuelMenu.options[1].selected = true;
                break;
        }
    });
}

function apuModifier()
{
    vehicleMenu = document.getElementById("vehicleBodyMenu");
    powewrtrainMenu = document.getElementById("powertrainMenu");
    apuMenu = document.getElementById("APU");

    apuMenu.options[0].disabled = true;

    powertrainMenu.addEventListener("change", function(){
        if(vehicleMenu.selectedIndex > 9)
        {
            if(powertrainMenu.selectedIndex > 2)
            {
                apuMenu.options[0].disabled = true;
            }
            else
            {
                apuMenu.options[0].disabled = false;
            }
        }
        else
        {
            apuMenu.options[0].disabled = true;
        }
    });

    vehicleBodyMenu.addEventListener("change", function(){
        if(vehicleMenu.selectedIndex > 9)
        {
            apuMenu.options[0].disabled = false;
        }
    });
}

function definedFuel()
{
    let userDefinedFuel = document.getElementById("userDefinedFuel");
    let fuelPriceMethod = document.getElementById("fuelPriceMethod");

    fuelPriceMethod.addEventListener("change", function(){
        event.preventDefault();
        if(fuelPriceMethod.selectedIndex == 2)
        {
            let value = prompt("please enter a starting fuel value", "2.50");

            if(isNaN(value))
            {
                value = prompt("Input entered not a number", "2.50");
            }

            userDefinedFuel.value = value;
        }
    });
}

function definedPurchaseCost()
{
    let customPurchaseCost = document.getElementById("purchaseCost");
    let purchaseNumber = document.getElementById("purchaseNumber");
    let purchaseLabel = document.getElementById("purchaseLabel");
    let customMPGCost = document.getElementById("userDefinedMPG");
    let customMPGNumber = document.getElementById("userDefinedMPGNumber");
    let customMPGLabel = document.getElementById("userDefinedMPGLabel");
    let simulation = document.getElementById("vehicleCostInput");

    simulation.addEventListener("change", function(){
        if(simulation.selectedIndex === 3)
        {   
            customPurchaseCost.style.display = "inline-block";
            purchaseNumber.style.display = "inline-block";
            purchaseLabel.style.display = "block";

            customMPGCost.style.display = "inline-block";
            customMPGNumber.style.display = "inline-block";
            customMPGLabel.style.display = "block";
        }
        else
        {
            customPurchaseCost.style.display = "none";
            purchaseNumber.style.display = "none";
            purchaseLabel.style.display = "none";

            customMPGCost.style.display = "none";
            customMPGNumber.style.display = "none";
            customMPGLabel.style.display = "none";
        }
    });
}

function maxYear()
{
    let vehicleMenu = document.getElementById("vehicleBodyMenu");
    let analysisWindow = document.getElementById("analysisWindow");
    let analysisNumber = document.getElementById("analysisNumber");
    let markupFactor = document.getElementById("markupFactor");
    let markupFactorNumber = document.getElementById("markupFactorNumber");

    vehicleMenu.addEventListener("change", function(){
        event.preventDefault();
        if(vehicleMenu.selectedIndex > 9)
        {
            analysisWindow.max = 30;
            analysisWindow.value = 30;
            analysisNumber.max = 30;
            analysisNumber.value = 30;

            markupFactor.value = 1;
            markupFactorNumber.value = 1;
        }
        else
        {
            analysisWindow.max = 30;
            analysisWindow.value = 30;
            analysisNumber.max = 30;
            analysisNumber.value = 30;

            markupFactor.value = 1.5;
            markupFactorNumber.value = 1.5;
        }
    });
}

function resetFormOnPageRefresh()
{
    let form = document.getElementById("vehicleInfoForm");

    if (performance.navigation.type == performance.navigation.TYPE_RELOAD) 
    {
        form.reset();
    }
}

function getVehicleClassSize()
{
    let vehicleMenu = document.getElementById("vehicleBodyMenu");
    let vehicleClass = document.getElementById("vehicleClassSize");

    vehicleMenu.addEventListener("click", function(){
        if(vehicleMenu.selectedIndex > 9)
        {
            vehicleClass.value = "HDV";
        }
        else if(vehicleMenu.selectedIndex <= 9)
        {
            vehicleClass.value = "LDV";
        }
    });
}

function insuranceMenuModifier()
{
    let vehicleBodyMenu = document.getElementById("vehicleBodyMenu");
    let insuranceMenu = document.getElementById("insuranceType");

    insuranceMenu.options[3].disabled = true;
    insuranceMenu.options[4].disabled = true;

    vehicleBodyMenu.addEventListener("change", function() {
        if(vehicleBodyMenu.selectedIndex < 10)
        {
            insuranceMenu.options[0].disabled = false;
            insuranceMenu.options[1].disabled = false;
            insuranceMenu.options[2].disabled = false;

            insuranceMenu.options[0].selected = true;

            for(let i = 3; i < 5; i++)
            {
                insuranceMenu.options[i].disabled = false;
            }
        }
        else if(vehicleBodyMenu.selectedIndex > 9)
        {
            insuranceMenu.options[0].disabled = true;
            insuranceMenu.options[1].disabled = true;
            insuranceMenu.options[2].disabled = true;

            for(let i = 3; i < insuranceMenu.options.length; i++)
            {
                insuranceMenu.options[i].disabled = false;
            }
            insuranceMenu.options[3].selected = true;
        }
    });
}

function linkFuelStartYearToModelYear()
{
    let fuelStart = document.getElementById("fuelStartYear");
    let modelYear = document.getElementById("modelYearMenu");

    modelYear.addEventListener("change", function(){
        if(modelYear.selectedIndex < 4)
        {
            fuelStart.selectedIndex = modelYear.selectedIndex;
        }
        else
        {
            fuelStart.selectedIndex = modelYear.selectedIndex + 2;
        }
    });
}

function downlaodAnalysisResults()
{
    let button = document.getElementById("downlaodAnalysisResults");

    button.addEventListener("click", function(){
        window.location.href = "assets/CSV Tables.zip";
    });
}

function dropDownControlMain()
{
    powertrainMenuModifier();
    fuelMenuModifier();
    vmtMenuModifier();
    bevMenuModifier();
    phevMenuModifier();
    definedFuel();
    definedPurchaseCost();
    maxYear();
    resetFormOnPageRefresh();
    vehicleFinanceModifier();
    getVehicleClassSize();
    insuranceMenuModifier();
    apuModifier();
    linkFuelStartYearToModelYear();
   // incrementalAnnualFuelModifier();
}

dropDownControlMain();