let bodyName = document.getElementById("vehicleBodyMenu");
let powertrainName = document.getElementById("powertrainMenu");

function costByYear(vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, labor)
{
    let canvas = document.getElementById("vehicleGraph");

    // let years = document.querySelectorAll(".costComponents.year");
    let year = [];

    // let vehicleBodyCost = document.querySelectorAll(".costComponents.vehicleBody");
    let vehicleBodyCosts = [];

    // let financeCost = document.querySelectorAll(".costComponents.financeCost");
    let financeCosts = [];

    // let annualFuelCost = document.querySelectorAll(".costComponents.annualFuelCost");
    let annualFuelCosts = [];

    // let insuranceCost = document.querySelectorAll(".costComponents.insuranceCost");
    let insuranceCosts = [];

    // let taxesAndFees = document.querySelectorAll(".costComponents.taxesAndFees");
    let taxesAndFeesCosts = [];

    // let maintenance = document.querySelectorAll(".costComponents.maintenance");
    let maintenanceCosts = [];

    // let repair = document.querySelectorAll(".costComponents.repair");
    let repairCosts = [];

    let laborCosts = [];

    let totalCostOwnership = [];

    for(let i = 0; i < 30; i++)
    {
        year[i] = i + 1;
        vehicleBodyCosts[i] = parseInt(vehicleBodyCost[i]); //parseInt(vehicleBodyCost[i].innerHTML);
        financeCosts[i] = parseInt(financeCost[i]); //parseInt(financeCost[i].innerHTML);
        annualFuelCosts[i] = parseInt(annualFuelCost[i]); //parseInt(annualFuelCost[i].innerHTML);
        insuranceCosts[i] = parseInt(insuranceCost[i]); //parseInt(insuranceCost[i].innerHTML);
        taxesAndFeesCosts[i] = parseInt(taxesAndFees[i]); //parseInt(taxesAndFees[i].innerHTML);
        maintenanceCosts[i] = parseInt(maintenance[i]); //parseInt(maintenance[i].innerHTML);
        repairCosts[i] = parseInt(repair[i]); //parseInt(repair[i].innerHTML);
        laborCosts[i] = parseInt(labor[i]);
        totalCostOwnership[i] = vehicleBodyCosts[i] + financeCosts[i] + annualFuelCosts[i] + insuranceCosts[i] + taxesAndFeesCosts[i] + maintenanceCosts[i] + repairCosts[i] + laborCosts[i];

        // console.log("vehicle body: " + vehicleBodyCosts[i] + " \nfinance " + financeCosts[i] + " \nannualfuel " + annualFuelCosts[i] + 
        // " \ninsurance " + insuranceCosts[i] + " \ntaxes " + taxesAndFeesCosts[i] + " \nmaintenance " + maintenanceCosts[i] + " \nrepair " + repairCosts[i] + 
        // " \nTCO " + totalCostOwnership[i]);
    }
      Chart.defaults.global.defaultFontSize = 15;
      vehicleGraph = new Chart(canvas, {
      type: "bar",
      data: 
      {
        labels: year,
        datasets:
        [
          {
            data: vehicleBodyCosts,
            label: "Vehicle Body",
            backgroundColor: "#994d00",
          },
          {
            data: financeCosts,
            label: "Finance Cost",
            backgroundColor: "#ff0000"
          },
          {
            data: annualFuelCosts,
            label: "Annual Fuel Cost",
            backgroundColor: "#ffaa00"
          },
          {
            data: insuranceCosts,
            label: "Insurance Cost",
            backgroundColor: "#9494b8"
          },
          {
            data: taxesAndFeesCosts,
            label: "Taxes And Fees",
            backgroundColor: "#e1e1ea"
          },
          {
            data: maintenanceCosts,
            label: "Maintenance Cost",
            backgroundColor: "#3333ff"
          },
          {
            data: repairCosts,
            label: "Repair Cost",
            backgroundColor: "#66a3ff"
          },
          {
            data: laborCosts,
            label: "Labor Cost",
            backgroundColor: "#03fc3d"
          }
        ]
      },

      options: 
      {
          title:
          {
            display: true,
            text: "Annual TCO Comparison Over Years Of Ownership " + powertrainName.options[powertrainName.selectedIndex].text + " " + bodyName.options[bodyName.selectedIndex].text,
            fontFamily: "sans-serif",
            fontColor: "black",
            fontSize: 20,
            position: 'top'
          },
          scales:
          {
            xAxes: [{stacked: true, scaleLabel:{display: true, labelString: "Year Of Ownership"}}],
            yAxes: [{stacked: true, scaleLabel:{display: true, labelString: "Annual Cost: ($)"}}]
          }
      }
    });
}

function costByYearMPG(vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, labor, vmt)
{
    let canvas = document.getElementById("perMileGraph");

        // let years = document.querySelectorAll(".costComponents.year");
        let year = [];

        // let vehicleBodyCost = document.querySelectorAll(".costComponents.vehicleBody");
        let vehicleBodyCosts = [];
    
        // let financeCost = document.querySelectorAll(".costComponents.financeCost");
        let financeCosts = [];
    
        // let annualFuelCost = document.querySelectorAll(".costComponents.annualFuelCost");
        let annualFuelCosts = [];
    
        // let insuranceCost = document.querySelectorAll(".costComponents.insuranceCost");
        let insuranceCosts = [];
    
        // let taxesAndFees = document.querySelectorAll(".costComponents.taxesAndFees");
        let taxesAndFeesCosts = [];
    
        // let maintenance = document.querySelectorAll(".costComponents.maintenance");
        let maintenanceCosts = [];
    
        // let repair = document.querySelectorAll(".costComponents.repair");
        let repairCosts = [];

        let laborCosts = [];

        // vmt data by year
        let vmtCost = [];
    
        let totalCostOwnership = [];
    
        for(let i = 0; i < 30; i++)
        {
            year[i] = i + 1;
            vmtCost[i] = vmt[i];
            vehicleBodyCosts[i] = parseInt(vehicleBodyCost[i]) / vmtCost[i]; //parseInt(vehicleBodyCost[i].innerHTML);
            financeCosts[i] = parseInt(financeCost[i]) / vmtCost[i]; //parseInt(financeCost[i].innerHTML);
            annualFuelCosts[i] = parseInt(annualFuelCost[i]) / vmtCost[i]; //parseInt(annualFuelCost[i].innerHTML);
            insuranceCosts[i] = parseInt(insuranceCost[i]) / vmtCost[i]; //parseInt(insuranceCost[i].innerHTML);
            taxesAndFeesCosts[i] = parseInt(taxesAndFees[i]) / vmtCost[i]; //parseInt(taxesAndFees[i].innerHTML);
            maintenanceCosts[i] = parseInt(maintenance[i]) / vmtCost[i]; //parseInt(maintenance[i].innerHTML);
            repairCosts[i] = parseInt(repair[i]) / vmtCost[i]; //parseInt(repair[i].innerHTML);
            laborCosts[i] = parseInt(labor[i]) / vmtCost[i];
            totalCostOwnership[i] = (vehicleBodyCosts[i] + financeCosts[i] + annualFuelCosts[i] + insuranceCosts[i] + taxesAndFeesCosts[i] + maintenanceCosts[i] + repairCosts[i]);
    
            // console.log("vehicle body: " + vehicleBodyCosts[i] + " \nfinance " + financeCosts[i] + " \nannualfuel " + annualFuelCosts[i] + 
            // " \ninsurance " + insuranceCosts[i] + " \ntaxes " + taxesAndFeesCosts[i] + " \nmaintenance " + maintenanceCosts[i] + " \nrepair " + repairCosts[i] + 
            // " \nTCO " + totalCostOwnership[i]);
        }
          Chart.defaults.global.defaultFontSize = 15;
          vehicleGraph = new Chart(canvas, {
          type: "bar",
          data: 
          {
            labels: year,
            datasets:
            [
              {
                data: vehicleBodyCosts,
                label: "Vehicle Body",
                backgroundColor: "#994d00",
              },
              {
                data: financeCosts,
                label: "Finance Cost",
                backgroundColor: "#ff0000"
              },
              {
                data: annualFuelCosts,
                label: "Annual Fuel Cost",
                backgroundColor: "#ffaa00"
              },
              {
                data: insuranceCosts,
                label: "Insurance Cost",
                backgroundColor: "#9494b8"
              },
              {
                data: taxesAndFeesCosts,
                label: "Taxes And Fees",
                backgroundColor: "#e1e1ea"
              },
              {
                data: maintenanceCosts,
                label: "Maintenance Cost",
                backgroundColor: "#3333ff"
              },
              {
                data: repairCosts,
                label: "Repair Cost",
                backgroundColor: "#66a3ff"
              },
              {
                data: laborCosts,
                label: "Labor Cost",
                backgroundColor: "#03fc3d"
              }
            ]
          },
    
          options: 
          {
            title:
            {
              display: true,
              text: "Annual TCO Costs Per Mile Over Years Of Ownership " + powertrainName.options[powertrainName.selectedIndex].text + " " + bodyName.options[bodyName.selectedIndex].text,
              fontFamily: "sans-serif",
              fontColor: "black",
              fontSize: 20,
              position: 'top'
            },
              scales:
              {
                xAxes: [{stacked: true, scaleLabel:{display: true, labelString: "Year Of Ownership"}}],
                yAxes: [{stacked: true, scaleLabel:{display: true, labelString: "Cost Per Mile: ($)"}}]
              }
          }
        });
}

function powertrainGraph(body, finance, fuel, insurance, tax, maintenance, repair)
{
    $("#powertrainGraph").remove();
    $(".canvasContainer").append("<canvas id='powertrainGraph'>canvas is not supported in your browser</canvas>");

    canvas = document.getElementById("powertrainGraph");

    powertrain = [];
    bodyCosts = [];
    financeCosts = [];
    fuelCosts = [];
    insuranceCosts = [];
    taxCosts = [];
    maintenanceCosts = [];
    repairCosts = [];
    totalCost = [];

    for(let i = 0; i < 7; i++)
    {
      bodyCosts[i] = parseInt(body[i]);
      financeCosts[i] = parseInt(finance[i]);
      fuelCosts[i] = parseInt(fuel[i]);
      insuranceCosts[i] = parseInt(insurance[i]);
      taxCosts[i] = parseInt(tax[i]);
      maintenanceCosts[i] = parseInt(maintenance[i]);
      repairCosts[i] = parseInt(repair[i]);

      totalCost[i] = bodyCosts[i] + financeCosts[i] + fuelCosts[i] + insuranceCosts[i] + taxCosts[i] + maintenanceCosts[i] + repairCosts[i];
    }

    powertrain[0] = "ICE-SI";
    powertrain[1] = "ICE-CI";
    powertrain[2] = "HEV-SI";
    powertrain[3] = "PHEV";
    powertrain[4] = "FCEV";
    powertrain[5] = "BEV";

    let ctx = canvas.getContext("2d");
    ctx.canvas.width = 10;

    Chart.defaults.global.defaultFontSize = 15;
    powertrain = new Chart(canvas, {
      type: "bar",
      data:
      {
        labels: powertrain,
        datasets:
        [
          {
              data: bodyCosts,
              label: "Vehicle Body",
              backgroundColor: "#994d00",
          },
          {
            data: financeCosts,
            label: "Finance Cost",
            backgroundColor: "#ff0000"
          },
          {
            data: fuelCosts,
            label: "Annual Fuel Cost",
            backgroundColor: "#ffaa00"
          },
          {
            data: insuranceCosts,
            label: "Insurance Cost",
            backgroundColor: "#9494b8"
          },
          {
            data: taxCosts,
            label: "Taxes And Fees",
            backgroundColor: "#e1e1ea"
          },
          {
            data: maintenanceCosts,
            label: "Maintenance Cost",
            backgroundColor: "#3333ff"
          },
          {
            data: repairCosts,
            label: "Repair Cost",
            backgroundColor: "#66a3ff"
          }
        ]
      },
      options: 
      {
        title:
        {
          display: true,
          text: "TCO Comparison Across " + bodyName.options[bodyName.selectedIndex].text + " Powertrains",
          fontFamily: "sans-serif",
          fontColor: "black",
          fontSize: 20,
          position: 'top'
        },
          scales:
          {
            xAxes: [{stacked: true, scaleLabel:{display: true, labelString: "Powertrain Type"}}],
            yAxes: [{stacked: true, scaleLabel:{display: true, labelString: "5-yr Average TCO: ($)"}}]
          }
      }
    });
}

function vehicleGraphMain(vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, labor, vmt)
{
    $("#vehicleGraph").remove();
    $(".canvasContainer").append('<canvas id="vehicleGraph">canvas is not supported in your browser</canvas>');

    $("#perMileGraph").remove();
    $(".canvasContainer").append("<canvas id='perMileGraph'>canvas is not supported in your browser</canvas>");

    costByYear(vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, labor);
    costByYearMPG(vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, labor, vmt);
}