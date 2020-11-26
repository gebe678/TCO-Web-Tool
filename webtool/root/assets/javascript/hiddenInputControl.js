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


function hiddenInputMain()
{
    //alert("this script works! Woo!");
}

hiddenInputMain();