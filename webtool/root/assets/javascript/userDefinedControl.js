function vehicleUserDefined()
{
    let vehicleUser = document.getElementById("vehicleCostInput");
    let purchaseSlider = document.getElementById("purchaseCost");
    let purchaseSliderLabel = document.getElementById("purchaseLabel");
    let purchaseSliderNumber = document.getElementById("purchaseNumber");

    vehicleUser.addEventListener("change", function(){
        if(vehicleUser.selectedIndex === 1)
        {
            purchaseSlider.style.display = "inline-block";
            purchaseSliderLabel.style.display = "inline-block";
            purchaseSliderNumber.style.display = "inline-block";
        }
        else
        {
            purchaseSlider.style.display = "none";
            purchaseSliderLabel.style.display = "none";
            purchaseSliderNumber.style.display = "none";
        }
    });
}

function fuelPriceUserDefined()
{
    let fuelReference = document.getElementById("fuelReference");
    let userDefinedFuel = document.getElementById("userDefinedFuelBlock");

    fuelReference.addEventListener("change", function(){
        if(fuelReference.selectedIndex === 3)
        {
            userDefinedFuel.style.display = "block";
        }
        else
        {
            userDefinedFuel.style.display = "none";
        }
    });
}

function userDefinedMain()
{
    vehicleUserDefined();
    fuelPriceUserDefined();
}

userDefinedMain();