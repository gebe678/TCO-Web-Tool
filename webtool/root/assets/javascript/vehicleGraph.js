let bodyName = document.getElementById("vehicleBodyMenu");
let powertrainName = document.getElementById("powertrainMenu");

function fiveYearAverage(vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, operational, labor)
{
  let pTitleName = document.getElementById("vehicleBodyMenu");
  let bTitleName = document.getElementById("powertrainMenu");

  $("#piChartGraph").remove();
  $(".pieChartTitle").remove();
  $(".pieChartContainer").append("<p class='pieChartTitle' style='font-family: sans-serif; font-size: 20px; font-weight: bold;'> 5 Year TCO For "  + " " + bTitleName.options[bTitleName.selectedIndex].value + " " + pTitleName.options[pTitleName.selectedIndex].value + " <img src='assets/pi_graph_pictures/" + pTitleName.options[pTitleName.selectedIndex].value + ".jpg' alt='this is the picture'/></p>");
  $(".pieChartContainer").append("<canvas id='piChartGraph'>canvas is not supported in your browser</canvas>");

    let canvas = document.getElementById("piChartGraph");

    totalCost = [];

    let vehicleCost = 0;
    let financingCost = 0;
    let annualFuel = 0;
    let insurance = 0;
    let taxes = 0;
    let maintenanceCost = 0;
    let repairCost = 0;
    let operationalCost = 0;
    let laborCost = 0;

    for(let i = 0; i < 5; i++)
    {
      vehicleCost = vehicleCost + vehicleBodyCost[i];
      financingCost = financingCost + financeCost[i];
      annualFuel = annualFuel + annualFuelCost[i];
      insurance = insurance + insuranceCost[i];
      taxes = taxes + taxesAndFees[i];
      maintenanceCost = maintenanceCost + maintenance[i];
      repairCost = repairCost + repair[i];
      operationalCost = operationalCost + parseFloat(operational[i]);
      laborCost = laborCost + parseFloat(labor[i]);
    }

    vehicleCost = Math.round(100 * vehicleCost) / 100;
    financingCost = Math.round(100 * financingCost) / 100;
    annualFuel = Math.round(100 * annualFuel) / 100;
    insurance = Math.round(100 * insurance) / 100;
    taxes = Math.round(100 * taxes) / 100;
    maintenanceCost = Math.round(100 * maintenanceCost) / 100;
    repairCost = Math.round(100 * repairCost) / 100;
    operationalCost = Math.round(100 * operationalCost) / 100;
    laborCost = Math.round(100 * laborCost) / 100;

    let data = 
    {
      datasets: [{
        data: [vehicleCost, financingCost, annualFuel, insurance, maintenanceCost, repairCost, operationalCost, laborCost, taxes],
        backgroundColor: ["#994d00", "#ff0000", "#ffaa00", "#9494b8", "#3333ff", "#66a3ff", "#c267F5", "#03fc3d", "#e1e1ea"],
        borderWidth: 0
      }],
      labels: ["depreciation", "financing", "fuel", "insurance", "maintenance", "repair", "operational", "labor", "taxes"],
    };

    piGraph = new Chart(canvas, {
      type: "outlabeledPie",
      data: data,
      options:
      {
        layout:
        {
          padding:
          {
            left: 10,
            right: 10,
            top: 10,
            bottom: 10
          }
        },
        plugins: 
        {
          outlabels:
          {
            text: '%l %p',
            color: ['white', 'white', 'white', 'white', 'white', 'white', 'white', 'black', 'black'],
            stretch: 45,
            font: 
            {
                resizable: true,
                minSize: 12,
                maxSize: 18
            }
          },
          labels: false,
        },
        title:
        {
          display: false,
          text: "5 Year TCO For " + pTitleName.options[pTitleName.selectedIndex].text + " " +  bTitleName.options[bTitleName.selectedIndex].text,
          fontFamily: "sans-serif",
          fontColor: "black",
          fontSize: 20,
          position: 'top'
        },
        legend:
        {
          position: "right",
          align: "center",
        }
      }
    });
}

function tornadoChart()
{
  let canvas = document.getElementById("tornadoChart");

  tornado = new Chart(canvas, {
    type: "horizontalBar",
    data: 
    {
      labels: ["variable1", "variable2", "variable3", "variable4", "variable5"],
      datasets:
      [
        {
          backgroundColor: "red",
          label: "Data 1",
          data: [-100, -50, -35, -10, -5]
        },
        {
          backgroundColor: "green",
          label: "Data 2",
          data: [100, 50, 35, 10, 5]
        }
      ]
    },
    options:
    {
      title: 
      {
        display: true,
        text: "Example Tornado Chart",
        fontFamily: "sans-serif",
        fontColor: "black",
        fontSize: 20,
        position: 'top'
      },
      scales:
      {
        xAxes:
        [
          {
            stacked: true
          }
        ],
        yAxes: 
        [
          {
            stacked: true
          }
        ]
      },
      plugins:
      {
        labels: false
      }
    }
  })
}

function usedVehicleGraph(vehicle, finance, fuel, insurance, taxes, maintenance, repair, operational, labor, usedVehicle, usedFinance, usedFuel, usedInsurance, usedTaxes, usedMaintenance, usedRepair, usedOperational, usedLabor)
{
    $("#usedVehicleChart").remove();
    $(".canvasContainer").append("<canvas id='usedVehicleChart'>canvas is not supported in your browser</canvas>");

    let canvas = document.getElementById("usedVehicleChart");

    let type = ["New Vehicle", "Used Vehicle"];
    let vehicleCost = [0, 0];
    let financeCost = [0, 0];
    let fuelCost = [0, 0];
    let insuranceCost = [0, 0];
    let taxesCost = [0, 0];
    let maintenanceCost = [0, 0];
    let repairCost = [0, 0];
    let operationalCost = [0, 0];
    let laborCost = [0, 0];

    for(let i = 0; i < 5; i++)
    {
      vehicleCost[0] += vehicle[i];
      financeCost[0] += finance[i];
      fuelCost[0] += fuel[i];
      insuranceCost[0] += insurance[i];
      taxesCost[0] += taxes[i];
      maintenanceCost[0] += maintenance[i];
      repairCost[0] += repair[i];
      operationalCost[0] += operational[i];
      laborCost[0] += labor[i];
    }

    Chart.defaults.global.defaultFontSize = 15;

    vehicleCost[1] = usedVehicle[0];
    financeCost[1] = usedFinance[0];
    fuelCost[1] = usedFuel[0];
    insuranceCost[1] = usedInsurance[0];
    taxesCost[1] = usedTaxes[0];
    maintenanceCost[1] = usedMaintenance[0];
    repairCost[1] = usedRepair[0];
    operationalCost[1] = usedOperational[0];
    laborCost[1] = usedLabor[0];

    usedVehicleChart = new Chart(canvas, {
        type: "bar",
        data: 
        {
          labels: type,
          datasets:
          [
            {
              data: vehicleCost,
              label: "Depreciation",
              backgroundColor: "#994d00",
            },
            {
              data: financeCost,
              label: "Financing",
              backgroundColor: "#ff0000"
            },
            {
              data: fuelCost,
              label: "Fuel",
              backgroundColor: "#ffaa00"
            },
            {
              data: insuranceCost,
              label: "Insurance",
              backgroundColor: "#9494b8"
            },
            {
              data: taxesCost,
              label: "Taxes",
              backgroundColor: "#e1e1ea"
            },
            {
              data: maintenanceCost,
              label: "Maintenance",
              backgroundColor: "#3333ff"
            },
            {
              data: repairCost,
              label: "Repair",
              backgroundColor: "#66a3ff"
            },
            {
              data: operationalCost,
              label: "operational",
              backgroundColor: " #c267f5"
            },
            {
              data: laborCost,
              label: "Labor",
              backgroundColor: "#03fc3d"
            }
          ]
        },
  
        options: 
        {
            title:
            {
              display: true,
              text: "New Vs Used Comparison For " + powertrainName.options[powertrainName.selectedIndex].text + " " + bodyName.options[bodyName.selectedIndex].text,
              fontFamily: "sans-serif",
              fontColor: "black",
              fontSize: 20,
              position: 'top'
            },
            scales:
            {
              xAxes: [{stacked: true, scaleLabel:{display: true, labelString: "Year Of Ownership"}}],
              yAxes: [{stacked: true, scaleLabel:{display: true, labelString: "Annual Cost: ($)"}}]
            },
            plugins:
            {
              labels: false
            }
        }
    });
}

function costByYear(vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, operational, labor)
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

    let operationalCosts = [];

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
        operationalCosts[i] = parseInt(operational[i]);
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
            label: "Depreciation",
            backgroundColor: "#994d00",
          },
          {
            data: financeCosts,
            label: "Financing",
            backgroundColor: "#ff0000"
          },
          {
            data: annualFuelCosts,
            label: "Fuel",
            backgroundColor: "#ffaa00"
          },
          {
            data: insuranceCosts,
            label: "Insurance",
            backgroundColor: "#9494b8"
          },
          {
            data: taxesAndFeesCosts,
            label: "Taxes",
            backgroundColor: "#e1e1ea"
          },
          {
            data: maintenanceCosts,
            label: "Maintenance",
            backgroundColor: "#3333ff"
          },
          {
            data: repairCosts,
            label: "Repair",
            backgroundColor: "#66a3ff"
          },
          {
            data: operationalCosts,
            label: "operational",
            backgroundColor: " #c267f5"
          },
          {
            data: laborCosts,
            label: "Labor",
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
          },
          plugins:
          {
            labels: false
          }
      }
    });
}

function costByYearMPG(vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, operational, labor, vmt)
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

        let operationalCosts = [];

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
            operationalCosts[i] = parseInt(operational[i]) / vmtCost[i];
            laborCosts[i] = parseInt(labor[i]) / vmtCost[i];
            totalCostOwnership[i] = (vehicleBodyCosts[i] + financeCosts[i] + annualFuelCosts[i] + insuranceCosts[i] + taxesAndFeesCosts[i] + maintenanceCosts[i] + repairCosts[i]);
    
            // console.log("vehicle body: " + vehicleBodyCosts[i] + " \nfinance " + financeCosts[i] + " \nannualfuel " + annualFuelCosts[i] + 
            // " \ninsurance " + insuranceCosts[i] + " \ntaxes " + taxesAndFeesCosts[i] + " \nmaintenance " + maintenanceCosts[i] + " \nrepair " + repairCosts[i] + 
            // " \nTCO " + totalCostOwnership[i]);
        }
          Chart.defaults.global.defaultFontSize = 15;
          perMileGrpah = new Chart(canvas, {
          type: "bar",
          data: 
          {
            labels: year,
            datasets:
            [
              {
                data: vehicleBodyCosts,
                label: "Depreciation",
                backgroundColor: "#994d00",
              },
              {
                data: financeCosts,
                label: "Financing",
                backgroundColor: "#ff0000"
              },
              {
                data: annualFuelCosts,
                label: "Fuel",
                backgroundColor: "#ffaa00"
              },
              {
                data: insuranceCosts,
                label: "Insurance",
                backgroundColor: "#9494b8"
              },
              {
                data: taxesAndFeesCosts,
                label: "Taxes",
                backgroundColor: "#e1e1ea"
              },
              {
                data: maintenanceCosts,
                label: "Maintenance",
                backgroundColor: "#3333ff"
              },
              {
                data: repairCosts,
                label: "Repair",
                backgroundColor: "#66a3ff"
              },
              {
                data: operationalCosts,
                label: "operational",
                backgroundColor: " #c267f5"
              },
              {
                data: laborCosts,
                label: "Labor",
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
              },
              plugins:
              {
                labels: false
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

    for(let i = 0; i < 6; i++)
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
              label: "Depreciation",
              backgroundColor: "#994d00",
          },
          {
            data: financeCosts,
            label: "Financing",
            backgroundColor: "#ff0000"
          },
          {
            data: fuelCosts,
            label: "Fuel",
            backgroundColor: "#ffaa00"
          },
          {
            data: insuranceCosts,
            label: "Insurance",
            backgroundColor: "#9494b8"
          },
          {
            data: taxCosts,
            label: "Taxes",
            backgroundColor: "#e1e1ea"
          },
          {
            data: maintenanceCosts,
            label: "Maintenance",
            backgroundColor: "#3333ff"
          },
          {
            data: repairCosts,
            label: "Repair",
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
          },
          plugins:
          {
            labels:
            [
             
            ]
          }
      }
    });
}

function modelYearGraph(body, finance, fuel, insurance, tax, maintenance, repair)
{
    $("#modelYearGraph").remove();
    $(".canvasContainer").append("<canvas id='modelYearGraph'>canvas is not supported in your browser</canvas>");

    canvas = document.getElementById("modelYearGraph");

    modelYear = [];
    bodyCosts = [];
    financeCosts = [];
    fuelCosts = [];
    insuranceCosts = [];
    taxCosts = [];
    maintenanceCosts = [];
    repairCosts = [];
    totalCost = [];

    for(let i = 0; i < 5; i++)
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

    modelYear[0] = "2020";
    modelYear[1] = "2025";
    modelYear[2] = "2030";
    modelYear[3] = "2035";
    modelYear[4] = "2050";

    let ctx = canvas.getContext("2d");
    ctx.canvas.width = 10;

    Chart.defaults.global.defaultFontSize = 15;
    modelYear = new Chart(canvas, {
      type: "bar",
      data:
      {
        labels: modelYear,
        datasets:
        [
          {
              data: bodyCosts,
              label: "Depreciation",
              backgroundColor: "#994d00",
          },
          {
            data: financeCosts,
            label: "Financing",
            backgroundColor: "#ff0000"
          },
          {
            data: fuelCosts,
            label: "Fuel",
            backgroundColor: "#ffaa00"
          },
          {
            data: insuranceCosts,
            label: "Insurance",
            backgroundColor: "#9494b8"
          },
          {
            data: taxCosts,
            label: "Taxes",
            backgroundColor: "#e1e1ea"
          },
          {
            data: maintenanceCosts,
            label: "Maintenance",
            backgroundColor: "#3333ff"
          },
          {
            data: repairCosts,
            label: "Repair",
            backgroundColor: "#66a3ff"
          }
        ]
      },
      options: 
      {
        title:
        {
          display: true,
          text: "TCO Comparison Across " + bodyName.options[bodyName.selectedIndex].text + " Model Years",
          fontFamily: "sans-serif",
          fontColor: "black",
          fontSize: 20,
          position: 'top'
        },
          scales:
          {
            xAxes: [{stacked: true, scaleLabel:{display: true, labelString: "Model Year"}}],
            yAxes: [{stacked: true, scaleLabel:{display: true, labelString: "5-yr Average TCO: ($)"}}]
          },
          plugins:
          {
            labels:
            [
             
            ]
          }
      }
    });
}

function vehicleGraphMain(vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, operational, labor, vmt)
{
    $("#vehicleGraph").remove();
    $(".canvasContainer").append('<canvas id="vehicleGraph">canvas is not supported in your browser</canvas>');

    $("#perMileGraph").remove();
    $(".canvasContainer").append("<canvas id='perMileGraph'>canvas is not supported in your browser</canvas>");

    costByYear(vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, operational, labor);
    costByYearMPG(vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, operational, labor, vmt);
    tornadoChart();
}