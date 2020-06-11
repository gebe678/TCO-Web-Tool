// script for making the dropdown menu work

// button variables for the drop down
const itemOne = document.querySelector(".item1");
const itemTwo = document.querySelector(".item2");
const itemThree = document.querySelector(".item3");

// elemets in the list for the drop down
const itemListOne = document.querySelector(".itemOneElements");
const itemListTwo = document.querySelector(".itemTwoElements");
const itemListThree = document.querySelector(".itemThreeElements");



function hideListElements()
{
    if(true)
    {
        itemListOne.style.visibility = "hidden";
        itemListTwo.style.visibility = "hidden";
        itemListThree.style.visibility = "hidden";
    }
}

function toggleItem1()
{    
    if(itemListOne.style.visibility === "hidden")
    {
        itemListOne.style.visibility = "visible";
    }
    else if(itemListOne.style.visibility === "visible")
    {
        itemListOne.style.visibility = "hidden";
    }
}

function toggleItem2()
{    
    if(itemListTwo.style.visibility === "hidden")
    {
        itemListTwo.style.visibility = "visible";
    }
    else if(itemListTwo.style.visibility === "visible")
    {
        itemListTwo.style.visibility = "hidden";
    }
}

function toggleItem3()
{    
    if(itemListThree.style.visibility === "hidden")
    {
        itemListThree.style.visibility = "visible";
    }
    else if(itemListThree.style.visibility === "visible")
    {
        itemListThree.style.visibility = "hidden";
    }
}

hideListElements();

itemOne.addEventListener("click", toggleItem1);
itemTwo.addEventListener("click", toggleItem2);
itemThree.addEventListener("click", toggleItem3);