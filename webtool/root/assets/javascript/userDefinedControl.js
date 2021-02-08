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

function fuelMPGUserDefined()
{
    let mpgContainer = document.getElementById("userDefinedMPGContainer");
    let fuelEconomy = document.getElementById("fuelCostInput");

    fuelEconomy.addEventListener("change", function(){
        if(fuelEconomy.selectedIndex === 1)
        {
            mpgContainer.style.display = "block";
        }
        else
        {
            mpgContainer.style.display = "none";
        }
    });
}

function depreciationUserDefined()
{
    let depreciation = document.getElementById("depreciationMenu");
    let depreciationRate = document.getElementById("simpleDepreciationRate");

    depreciation.addEventListener("change", function(){
        if(depreciation.selectedIndex === 2)
        {
            depreciationRate.style.display = "block";
        }
        else
        {
            depreciationRate.style.display = "none";
        }
    });
}

function insuranceUserDefined()
{
    let insuranceType = document.getElementById("insuranceType");
    let insuranceLiability = document.getElementById("insuranceLiabilityContainer");
    let insuranceDeductable = document.getElementById("insuranceDeductableContainer");
    let fixedInsurance = document.getElementById("fixedInsuranceContainer");
    let vehicleSize = document.getElementById("vehicleClassSize");

    insuranceType.addEventListener("change", function(){
        if(vehicleSize.value === "HDV")
        {
            if(insuranceType.selectedIndex === 5)
            {
                fixedInsurance.style.display = "block";
            }
            else
            {
                fixedInsurance.style.display = "none";
            }
        }
        else if(vehicleSize.value === "LDV")
        {
            if(insuranceType.selectedIndex === 5)
            {
                insuranceLiability.style.display = "block";
                insuranceDeductable.style.display = "block";
            }
            else
            {
                insuranceLiability.style.display = "none";
                insuranceDeductable.style.display = "none";
            }
        }
    })
}

function operationalUserDefined()
{
    let additionalOperational = document.getElementById("additionalOperational");
    let avgDowntimePercent = document.getElementById("averageDowntimePercentContainer");

    avgDowntimePercent.style.display = "none";

    additionalOperational.addEventListener("change", function(){
        if(additionalOperational.selectedIndex === 0)
        {
            avgDowntimePercent.style.display = "block";
        }
        else
        {
            avgDowntimePercent.style.display = "none";
        }
    });
}

function laborUserDefined()
{
    let additionalLaborCosts = document.getElementById("additionalLaborCosts");
    let laborCostContainer = document.getElementById("laborCostContainer");
    let chargeRateContainer = document.getElementById("chargeRateContainer");

    laborCostContainer.style.display = "none";
    chargeRateContainer.style.display = "none";

    additionalLaborCosts.addEventListener("change", function(){
        if(additionalLaborCosts.selectedIndex === 0)
        {
            laborCostContainer.style.display = "block";
            chargeRateContainer.style.display = "block";
        }
        else
        {
            laborCostContainer.style.display = "none";
            chargeRateContainer.style.display = "none";
        }
    });
}

function userDefinedMain()
{
    vehicleUserDefined();
    fuelPriceUserDefined();
    fuelMPGUserDefined();
    depreciationUserDefined();
    insuranceUserDefined();
    laborUserDefined();
    operationalUserDefined();
}

userDefinedMain();