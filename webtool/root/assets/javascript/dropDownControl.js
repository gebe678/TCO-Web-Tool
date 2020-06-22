// script to make the drop down lists appear and disappear
const vBody = document.querySelector(".vehicleBody");
const pTrain = document.querySelector(".powerTrainBody");
const region = document.querySelector(".regionalityBody");
const allBodies = document.querySelectorAll(".body");

// grab elements for the document selection
const vElements = document.querySelector(".bodyElements");
const pElements = document.querySelector(".powerTrainElements");
const rElements = document.querySelector(".regionalityElements");
const listElements = document.querySelectorAll(".elements");
const specificElements = [document.querySelector(".bodyElements"), document.querySelector(".powerTrainElements"), document.querySelector(".regionalityElements")];

// elements for the text displayed in the box
const vText = document.querySelector(".vehicleText");
const pText = document.querySelector(".powerText");
const rText = document.querySelector(".regionalityText");

// grab elements for all classes of the dropdown


function toggleElementView(toggle, target)
{
    try
    {
        removeLists(toggle);

        if(toggle.style.display === "none")
        {
            toggle.style.display = "initial";
           toggle.style.display = "block";
        }
        else
        {
            toggle.style.display = "none";
        }

        let links;
        let dropDown;
        for(let i = 0 ; i < listElements.length; i++)
        {
            if(listElements[i].style.display === "block")
            {
               links = listElements[i].getElementsByTagName("a");
            }
        }

        for(let i = 0; i < links.length; i++)
        {
             links[i].addEventListener("click", function(){changeText(target, links[i]);});
        }
    }
    catch(e)
    {   
    
    }
}

function changeText(boxText, elementText)
{
   let text = elementText.innerHTML;
   boxText.innerHTML = text;
}

function removeLists(target)
{
    for(let i = 0; i < specificElements.length; i++)
    {
        if(target !== specificElements[i])
        listElements[i].style.display = "none";
    }
}

removeLists();
vBody.addEventListener("click", function(){toggleElementView(vElements, vText);});
pTrain.addEventListener("click", function(){toggleElementView(pElements, pText);});
region.addEventListener("click", function(){toggleElementView(rElements, rText);});
