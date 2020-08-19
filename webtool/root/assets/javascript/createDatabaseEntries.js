function main()
{
    let databaseButton = document.querySelector("#databaseAdder");
    let submitButton = document.getElementById("submitButton");

    databaseButton.addEventListener("click", function(){
        submitButton.click();
    });

    queryDatabase();
    resetToDefault();
}

function resetToDefault()
{
    let form = document.getElementById("vehicleInfoForm");
    let resetButton = document.getElementById("resetButton");

    resetButton.addEventListener("click", function(){
        form.reset();
    });
}

function changeDropdownFormElement(formID, done)
{
    let dropdownMenu = document.getElementById(formID);
    let submitButton = document.getElementById("submitButton");

    if(dropdownMenu.selectedIndex < dropdownMenu.length)// && dropdownMenu.selectedIndex !== 0)
    {
        if(!done)
        {
            submitButton.click();
        }

        if(dropdownMenu.selectedIndex < dropdownMenu.length - 1)
        {
            dropdownMenu.options[dropdownMenu.selectedIndex + 1].selected = true;
        }
        else
        {
            return false;
        }
        
        console.log(dropdownMenu.value);
             
        return true;
    }

    return false;
}

function resetMenu(formID)
{
    let dropdownMenu = document.getElementById(formID);

    dropdownMenu.selectedIndex = 0;
}

function getIndex(formID)
{
    let dropdownMenu = document.getElementById(formID);

    return dropdownMenu.options.selectedIndex;
}

function getLength(formID)
{
    let dropdownMenu = document.getElementById(formID);

    return dropdownMenu.length;
}

function queryDatabase()
{
    let form = document.getElementById("vehicleInfoForm");
    let dropDownMenus = ["vehicleBodyMenu", "powertrainMenu", "modelYearMenu"];
    let index = 0;
    let done = false;

    form.addEventListener("submit", function()
    {
        event.preventDefault();

        let dataForm = $(this).serialize();
        
        $.ajax({
            type: 'POST',
            url: "assets/PHP/processForm.php",
            data: dataForm
        }).done(function(data)
        {
            if(changeDropdownFormElement(dropDownMenus[index], done) === false)
            {
                if(index === 0 && getIndex(dropDownMenus[index]) === getLength(dropDownMenus[index]) - 1)
                {
                    console.log("switching forward to powertrain");
                    resetMenu(dropDownMenus[index]);
                    index++;
                }
                else if(index === 1 && getIndex(dropDownMenus[index]) === getLength(dropDownMenus[index]) - 1)
                {
                    console.log("switching forward to Model Year");
                    resetMenu(dropDownMenus[index]);
                    index++;
                }
                else if(index === 2 && getIndex(dropDownMenus[index]) === getLength(dropDownMenus[index]) - 1)
                {
                    console.log("done");
                    done = true;
                }
            }
            else
            {
                if(index === 1 && getIndex(dropDownMenus[index]) < getLength(dropDownMenus[index]))
                {
                    console.log("switching back to vehicle body");
                    index--;
                }
                else if(index === 2 && getIndex(dropDownMenus[index]) < getLength(dropDownMenus[index]))
                {
                    console.log("switching back to powertrain");
                    index--;
                }
            }
        });
    });
}

main();