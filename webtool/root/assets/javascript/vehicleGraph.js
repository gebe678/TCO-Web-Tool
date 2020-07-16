function vehicleGraphMain()
{
    let canvas = document.getElementById("acualVehicleGraph");

    let years = document.querySelectorAll(".costComponents.year");
    let year = [];

    let vehicleBodyCost = document.querySelectorAll(".costComponents.vehicleBody");
    let vehicleBodyCosts = [];

    let financeCost = document.querySelectorAll(".costComponents.financeCost");
    let financeCosts = [];

    let annualFuelCost = document.querySelectorAll(".costComponents.annualFuelCost");
    let annualFuelCosts = [];

    let insuranceCost = document.querySelectorAll(".costComponents.insuranceCost");
    let insuranceCosts = [];

    let taxesAndFees = document.querySelectorAll(".costComponents.taxesAndFees");
    let taxesAndFeesCosts = [];

    let maintenance = document.querySelectorAll(".costComponents.maintenance");
    let maintenanceCosts = [];

    let repair = document.querySelectorAll(".costComponents.repair");
    let repairCosts = [];

    let totalCostOwnership = [];

    for(let i = 0; i < 30; i++)
    {
        year[i] = parseInt(years[i].innerHTML);
        vehicleBodyCosts[i] = parseInt(vehicleBodyCost[i].innerHTML);
        financeCosts[i] = parseInt(financeCost[i].innerHTML);
        annualFuelCosts[i] = parseInt(annualFuelCost[i].innerHTML);
        insuranceCosts[i] = parseInt(insuranceCost[i].innerHTML);
        taxesAndFeesCosts[i] = parseInt(taxesAndFees[i].innerHTML);
        maintenanceCosts[i] = parseInt(maintenance[i].innerHTML);
        repairCosts[i] = parseInt(repair[i].innerHTML);
        totalCostOwnership[i] = vehicleBodyCosts[i] + financeCosts[i] + annualFuelCosts[i] + insuranceCosts[i] + taxesAndFeesCosts[i] + maintenanceCosts[i] + repairCosts[i];

        // console.log("vehicle body: " + vehicleBodyCosts[i] + " \nfinance " + financeCosts[i] + " \nannualfuel " + annualFuelCosts[i] + 
        // " \ninsurance " + insuranceCosts[i] + " \ntaxes " + taxesAndFeesCosts[i] + " \nmaintenance " + maintenanceCosts[i] + " \nrepair " + repairCosts[i] + 
        // " \nTCO " + totalCostOwnership[i]);
    }

    let vehicleGraph = new Chart(canvas, {
      type: "bar",
      data: 
      {
        labels: year,
        datasets:
        [
          {
            data: vehicleBodyCosts,
            label: "Vehicle Body",
            backgroundColor: "#1064D2"

          },
          {
            data: financeCosts,
            label: "Finance Cost",
            backgroundColor: "#EE631D"
          },
          {
            data: annualFuelCosts,
            label: "Annual Fuel Cost",
            backgroundColor: "#24A211"
          },
          {
            data: insuranceCosts,
            label: "Insurance Cost",
            backgroundColor: "#8D20DF"
          },
          {
            data: taxesAndFeesCosts,
            label: "Taxes And Fees",
            backgroundColor: "#FAB641"
          },
          {
            data: maintenanceCosts,
            label: "Maintenance Cost",
            backgroundColor: "#286432"
          },
          {
            data: repairCosts,
            label: "Repair Cost",
            backgroundColor: "#FF1E22"
          }
        ]
      },

      options: 
      {
          scales:
          {
            xAxes: [{stacked: true}],
            yAxes: [{stacked: true}]
          }
      }
    });
   
}