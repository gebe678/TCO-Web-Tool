function main()
{
    let canvas = document.getElementById("acualVehicleGraph");
    //let ctx = canvas.getContext("2d");

    var years = [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050];
    // For drawing the lines
    var africa = [86,114,106,106,107,111,133,221,783,2478];
    var asia = [282,350,411,502,635,809,947,1402,3700,5267];
    var europe = [168,170,178,190,203,276,408,547,675,734];
    var latinAmerica = [40,20,10,16,24,38,74,167,508,784];
    var northAmerica = [6,3,2,2,7,26,82,172,312,433];

    var ctx = document.getElementById("acualVehicleGraph");
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: years,
    datasets: [
      { 
        data: africa
      }
    ]
  }
});

    let vehicleBodyCost = document.querySelectorAll(".costComponents.vehicleBody");
    let vehicleBodyCosts = [];

    let financeCost = document.querySelectorAll(".costComponents.financeCost");
    let financeCosts = [];

    let annualFuelCost = document.querySelectorAll(".costComponents.annualFuelCost");
    let annualFuelCosts = [];

    let insuranceCost = document.querySelectorAll(".costComponents.insuranceCost");
    let insuranceCosts = [];

    let taxesAndFees = document.querySelectorAll(".costComponents.taxesAndFees");
    let taxesAndFeesCost = [];

    let maintenance = document.querySelectorAll(".costComponents.maintenance");
    let maintenanceCosts = [];

    let repair = document.querySelectorAll(".costComponents.repair");
    let repairCosts = [];

    for(let i = 0; i < 30; i++)
    {
        vehicleBodyCosts[i] = parseInt(vehicleBodyCost[i].innerHTML);
        financeCosts[i] = parseInt(financeCost[i].innerHTML);
        annualFuelCosts[i] = parseInt(annualFuelCost[i].innerHTML);
        insuranceCosts[i] = parseInt(insuranceCost[i].innerHTML);
        taxesAndFeesCost[i] = parseInt(taxesAndFees[i].innerHTML);
        maintenanceCosts[i] = parseInt(maintenance[i].innerHTML);
        repairCosts[i] = parseInt(repair[i].innerHTML);

        console.log("vehicle body: " + vehicleBodyCosts[i] + " \nfinance " + financeCosts[i] + " \nannualfuel " + annualFuelCosts[i] + 
        " \ninsurance " + insuranceCosts[i] + " \ntaxes " + taxesAndFeesCost[i] + " \nmaintenance " + maintenanceCosts[i] + " \nrepair " + repairCosts[i]);
    }
   
}

main();