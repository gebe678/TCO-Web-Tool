function main()
{
    let simpleButton = document.querySelector(".simplifiedTab");
    let detailedButton = document.querySelector(".detailedTab");

    let detailedView = document.querySelector(".detailedView");

    simpleButton.addEventListener("click", function(){
        simpleButton.style.background_color = "red";
        detailedView.style.display = "none";
    });

    detailedButton.addEventListener("click", function(){
        detailedView.style.display = "block";
    })
}

main();