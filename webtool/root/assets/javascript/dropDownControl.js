function main()
{
    let powertrainMenu = document.getElementById("powertrainMenu");
    let fuelMenu = document.getElementById("fuelTypes");

    fuelMenu.options[0].disabled = false;
    fuelMenu.options[1].disabled = true;
    fuelMenu.options[2].disabled = false;
    fuelMenu.options[3].disabled = false;
    fuelMenu.options[4].disabled = true;
    fuelMenu.options[5].disabled = true;
    fuelMenu.options[0].selected = true;
    fuelMenu.options[6].disabled = true;

    powertrainMenu.addEventListener("click", function()
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
                fuelMenu.options[6].disabled = false;
                fuelMenu.options[6].selected = true;
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

main();