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
                    if(i == 13 || i == 15 || i == 16)
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
                    if(i == 14 || i == 16 || i == 17)
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
                    if(i == 8 || i == 9 || i == 12 || i == 13 || i == 17)
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
                    if(i == 8 || i == 11 || i == 17)
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
                    if(i == 8 || i == 11 || i == 16)
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
                    if(i == 22)
                    {
                        vmt.options[i].disabled = false;
                    }
                    else
                    {
                        vmt.options[i].disabled = true;
                    }
                }
                vmt.options[22].selected = true;
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

function powertrainMenuModifier()
{
    let powertrainMenu = document.getElementById("powertrainMenu");
    let vehicleBodyMenu = document.getElementById("vehicleBodyMenu");

    vehicleBodyMenu.addEventListener("change", function(){
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
    fuelMenu.options[2].disabled = false;
    fuelMenu.options[3].disabled = false;
    fuelMenu.options[4].disabled = true;
    fuelMenu.options[5].disabled = true;
    fuelMenu.options[0].selected = true;
    fuelMenu.options[6].disabled = true;
    fuelMenu.options[7].disabled = true;

    powertrainMenu.addEventListener("change", function()
    {
        switch(powertrainMenu.selectedIndex)
        {
            case 0:
                fuelMenu.options[0].disabled = false;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = false;
                fuelMenu.options[3].disabled = false;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[0].selected = true;
                break;
            case 1:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = false;
                fuelMenu.options[2].disabled = false;
                fuelMenu.options[3].disabled = false;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[1].selected = true;
                break;
            case 2:
                fuelMenu.options[0].disabled = false;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = false;
                fuelMenu.options[3].disabled = false;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[0].selected = true;
                break;
            case 3:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = true;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = true;
                
                if(vehicleBodyMenu.selectedIndex <= 9)
                {
                    fuelMenu.options[6].disabled = false;
                    fuelMenu.options[7].disabled = true;
                    fuelMenu.options[6].selected = true;
                }
                else
                {
                    fuelMenu.options[6].disabled = true;
                    fuelMenu.options[7].disabled = false;
                    fuelMenu.options[7].selected = true;
                }
 
                break;
            case 4:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = true;
                fuelMenu.options[4].disabled = false;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[4].selected = true;
                break;
            case 5:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = true;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = false;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[5].selected = true;
                break;
        }
    });

    vehicleBodyMenu.addEventListener("change", function(){
        switch(powertrainMenu.selectedIndex)
        {
            case 0:
                fuelMenu.options[0].disabled = false;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = false;
                fuelMenu.options[3].disabled = false;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[0].selected = true;
                break;
            case 1:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = false;
                fuelMenu.options[2].disabled = false;
                fuelMenu.options[3].disabled = false;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[1].selected = true;
                break;
            case 2:
                fuelMenu.options[0].disabled = false;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = false;
                fuelMenu.options[3].disabled = false;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[0].selected = true;
                break;
            case 3:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = true;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = true;
                
                if(vehicleBodyMenu.selectedIndex <= 9)
                {
                    fuelMenu.options[6].disabled = false;
                    fuelMenu.options[7].disabled = true;
                    fuelMenu.options[6].selected = true;
                }
                else
                {
                    fuelMenu.options[6].disabled = true;
                    fuelMenu.options[7].disabled = false;
                    fuelMenu.options[7].selected = true;
                }
 
                break;
            case 4:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = true;
                fuelMenu.options[4].disabled = false;
                fuelMenu.options[5].disabled = true;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[4].selected = true;
                break;
            case 5:
                fuelMenu.options[0].disabled = true;
                fuelMenu.options[1].disabled = true;
                fuelMenu.options[2].disabled = true;
                fuelMenu.options[3].disabled = true;
                fuelMenu.options[4].disabled = true;
                fuelMenu.options[5].disabled = false;
                fuelMenu.options[6].disabled = true;
                fuelMenu.options[5].selected = true;
                break;
        }
    });

}

function dropDownControlMain()
{
    powertrainMenuModifier();
    fuelMenuModifier();
    vmtMenuModifier();
    bevMenuModifier();
    //incrementalAnnualFuelModifier();
}

dropDownControlMain();