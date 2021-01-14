function main()
{
    toggleControl();
    elementControl(".technologyGroup", "#technologyGroup");
    elementControl(".economicGroup", "#economicGroup");
    elementControl(".behaviorGroup", "#behaviorGroup");
    //depreciationView();
    // financingView();
    // fuelView();
    // insuranceView();
    // taxesView();
    // laborView();
}

function elementControl(groupID, toggleID)
{
    let depreciationGroup = document.querySelectorAll(groupID);
    let depreciationToggle = document.querySelector(toggleID);

    depreciationToggle.addEventListener("click", function(){
        if(depreciationToggle.checked)
        {
            for(let i = 0; i < depreciationGroup.length; i++)
            {
                depreciationGroup[i].style.display = "block";
            }
        }
        
        if(!depreciationToggle.checked)
        {
            for(let i = 0; i < depreciationGroup.length; i++)
            {
                depreciationGroup[i].style.display = "none";
            }
        }
    });
}

function toggleControl()
{
    let toggle = document.getElementById("toggleButton");
    let detailedView = document.querySelectorAll(".detailedView");
    let labelText = document.querySelector(".labelTextDetailedView");
    let technologyGroup = document.querySelector(".technologyGroup");
    let detailedTechnologyGroup = document.querySelector(".detailedView .technologyGroup");
    let detailedOptions = document.querySelector(".detailedOptions");
    let form = document.getElementById("vehicleInfoForm");

    toggle.addEventListener("click", function(){
        if(toggle.checked)
        {
            for(let i = 0;  i < detailedView.length; i++)
            {
                detailedView[i].style.display = "block";
            }
            
            detailedOptions.style.display = "inline-block";
            labelText.innerHTML = "Detailed View";
            labelText.title = "Hide detailed input selectors for TCO calculations";
            //labelText.style.float = "left";
            //labelText.style.marginLeft = "20px";
            technologyGroup.style.backgroundColor = "#e4d1d1";
            detailedTechnologyGroup.style.backgroundColor = "#e4d1d1";
        }
    
        if(!toggle.checked)
        {
            for(let i = 0;  i < detailedView.length; i++)
            {
                detailedView[i].style.display = "none";
            }
            detailedOptions.style.display = "none";
            labelText.innerHTML = "Simplified View";
            labelText.title = "Reveal detailed input selectors for TCO calculations";
           // labelText.style.float = "right";
            //labelText.style.marginRight = "20px";
            technologyGroup.style.backgroundColor = "white";
            detailedTechnologyGroup.style.backgroundColor = "white";
            form.reset();
        }
    });
}

function depreciationView()
{
    let depreciationGroup = document.querySelectorAll(".detailedView .depreciation");
    let depreciationToggle = document.querySelector("#depreciationButton");

    depreciationToggle.addEventListener("click", function(){
        if(depreciationToggle.checked)
        {
            for(let i = 0; i < depreciationGroup.length; i++)
            {
                depreciationGroup[i].style.display = "block";
            }
        }
        
        if(!depreciationToggle.checked)
        {
            for(let i = 0; i < depreciationGroup.length; i++)
            {
                depreciationGroup[i].style.display = "none";
            }
        }
    });
}

function financingView()
{
    let financingToggle = document.querySelector("#financingView");
    let financingGroup = document.querySelectorAll(".detailedView .finance");

    financingToggle.addEventListener("click", function(){
        if(financingToggle.checked)
        {
            for(let i = 0; i < financingGroup.length; i++)
            {
                financingGroup[i].style.display = "block";
            }
        }
        
        if(!financingToggle.checked)
        {
            for(let i = 0; i < financingGroup.length; i++)
            {
                financingGroup[i].style.display = "none";
            }
        }
    });
}

function fuelView()
{
    let fuelToggle = document.querySelector("#fuelView");
    let fuelGroup = document.querySelectorAll(".detailedView .fuel");

    fuelToggle.addEventListener("click", function(){
        if(fuelToggle.checked)
        {
            for(let i = 0; i < fuelGroup.length; i++)
            {
                fuelGroup[i].style.display = "block";
            }
        }

        if(!fuelToggle.checked)
        {
            for(let i = 0; i < fuelGroup.length; i++)
            {
                fuelGroup[i].style.display = "none";
            }
        }
    });
}

function insuranceView()
{
    let insuranceToggle = document.querySelector("#insuranceView");
    let insuranceGroup = document.querySelectorAll(".detailedView .insurance");

    insuranceToggle.addEventListener("click", function(){
        if(insuranceToggle.checked)
        {
            for(let i = 0; i < insuranceGroup.length; i++)
            {
                insuranceGroup[i].style.display = "block";
            }
        }

        if(!insuranceToggle.checked)
        {
            for(let i = 0; i < insuranceGroup.length; i++)
            {
                insuranceGroup[i].style.display = "none";
            }
        }
    });
}

function taxesView()
{
    let taxesToggle = document.querySelector("#taxesView");
    let taxesGroup = document.querySelectorAll(".detailedView .taxes");

    taxesToggle.addEventListener("click", function(){
        if(taxesToggle.checked)
        {
            for(let i = 0; i < taxesGroup.length; i++)
            {
                taxesGroup[i].style.display = "block";
            }
        }

        if(!taxesToggle.checked)
        {
            for(let i = 0; i < taxesGroup.length; i++)
            {
                taxesGroup[i].style.display = "none";
            }
        }
    });
}

function laborView()
{
    let laborToggle = document.querySelector("#laborView");
    let laborGroup = document.querySelectorAll(".detailedView .labor");

    laborToggle.addEventListener("click", function(){
        if(laborToggle.checked)
        {
            for(let i = 0; i < laborGroup.length; i++)
            {
                laborGroup[i].style.display = "block";
            }
        }

        if(!laborToggle.checked)
        {
            for(let i = 0; i < laborGroup.length; i++)
            {
                laborGroup[i].style.display = "none";
            }
        }
    });
}

main();