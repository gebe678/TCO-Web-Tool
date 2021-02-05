let bodyName = document.getElementById("vehicleBodyMenu");
let powertrainName = document.getElementById("powertrainMenu");


function fiveYearAverage(vehicleLabelOutput, vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, operational, labor)
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
      labels: [vehicleLabelOutput, "Financing", "Fuel", "Insurance", "Maintenance", "Repair", "Operational", "Labor", "Taxes"],
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

// function tornadoChart()
// {
//   let canvas = document.getElementById("tornadoChart");

//   tornado = new Chart(canvas, {
//     type: "horizontalBar",
//     data: 
//     {
//       labels: ["variable1", "variable2", "variable3", "variable4", "variable5"],
//       datasets:
//       [
//         {
//           backgroundColor: "red",
//           label: "Data 1",
//           data: [-100, -50, -35, -10, -5]
//         },
//         {
//           backgroundColor: "green",
//           label: "Data 2",
//           data: [100, 50, 35, 10, 5]
//         }
//       ]
//     },
//     options:
//     {
//       title: 
//       {
//         display: true,
//         text: "Example Tornado Chart",
//         fontFamily: "sans-serif",
//         fontColor: "black",
//         fontSize: 20,
//         position: 'top'
//       },
//       scales:
//       {
//         xAxes:
//         [
//           {
//             stacked: true
//           }
//         ],
//         yAxes: 
//         [
//           {
//             stacked: true
//           }
//         ]
//       },
//       plugins:
//       {
//         labels: false
//       }
//     }
//   })
// }

function usedVehicleGraph(vehicleLabelOutput, vehicle, finance, fuel, insurance, taxes, maintenance, repair, operational, labor, usedVehicle, usedFinance, usedFuel, usedInsurance, usedTaxes, usedMaintenance, usedRepair, usedLabor, usedOperational)
{
    $("#usedVehicleChart").remove();
    let first = document.querySelector(".first");
    let second = document.querySelector(".second");
    let third = document.querySelector(".third");

    // if(!first.hasChildNodes())
    // {
    //   $(".first").append("<canvas id='usedVehicleChart'>canvas is not supported in your browser</canvas>");
    // }
    // else if(!second.hasChildNodes())
    // {
    //   $(".second").append("<canvas id='usedVehicleChart'>canvas is not supported in your browser</canvas>");
    // }
    // else if(!third.hasChildNodes())
    // {
    //   $(".third").append("<canvas id='usedVehicleChart'>canvas is not supported in your browser</canvas>");
    // }

    if(!(first.classList.contains("powertrainGraphContainer") || first.classList.contains("modelYearGraphContainer")))
    {
      first.classList.add("usedVehicleGraphContainer");

      if(second.classList.contains("usedVehicleGraphContainer"))
      {
        second.classList.remove("usedVehicleGraphContainer");
      }

      if(third.classList.contains("usedVehicleGraphContainer"))
      {
        third.classList.remove("usedVehicleGraphContainer");
      }

    }
    else if(!(second.classList.contains("powertrainGraphContainer") || second.classList.contains("modelYearGraphContainer")))
    {
      second.classList.add("usedVehicleGraphContainer");

      if(first.classList.contains("usedVehicleGraphContainer"))
      {
        first.classList.remove("usedVehicleGraphContainer");
      }

      if(third.classList.contains("usedVehicleGraphContainer"))
      {
        third.classList.remove("usedVehicleGraphContainer");
      }
    }
    else
    {
      third.classList.add("usedVehicleGraphContainer");

      if(first.classList.contains("usedVehicleGraphContainer"))
      {
        first.classList.remove("usedVehicleGraphContainer");
      }

      if(second.classList.contains("usedVehicleGraphContainer"))
      {
        second.classList.remove("usedVehicleGraphContainer");
      }
    }

    $(".usedVehicleGraphContainer").append("<canvas id='usedVehicleChart'>canvas is not supported in your browser</canvas>");

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
              label: vehicleLabelOutput,
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
              label: "Operational",
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
              xAxes: [{stacked: true, scaledLabel:{display:true, labelString: ""}}],
              yAxes: [{stacked: true, scaleLabel:{display: true, labelString: "5-yr Average TCO: ($)"},
              ticks:
              {
                beginAtZero:true,
                userCallback: function(value, index, values)
                {
                    value = value.toString();
                    value = value.split(/(?=(?:...)*$)/);
                    value = value.join(',');
                    return value;
                }
            }}]
            },
            plugins:
            {
              labels: false
            }
        }
    });
}

function costByYear(vehicleLabelOutput, vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, operational, labor)
{
    let canvas = document.getElementById("vehicleGraph");
    let age = document.getElementById("usedVehicle");
    let viewAge = "";

    if(!age.checked)
    {
      viewAge = "New";
    }
    else
    {
      viewAge = "Used";
    }

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
            label: vehicleLabelOutput,
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
            label: "Operational",
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
            text: "Annual TCO For " + viewAge + " " + powertrainName.options[powertrainName.selectedIndex].text + " " + bodyName.options[bodyName.selectedIndex].text,
            fontFamily: "sans-serif",
            fontColor: "black",
            fontSize: 20,
            position: 'top'
          },
          scales:
          {
            xAxes: [{stacked: true, scaleLabel:{display: true, labelString: "Year Of Ownership"}}],
            yAxes: [{stacked: true, scaleLabel:{display: true, labelString: "Annual Cost: ($)"}, 
          
            ticks:
            {
              beginAtZero:true,
              userCallback: function(value, index, values)
              {
                  value = value.toString();
                  value = value.split(/(?=(?:...)*$)/);
                  value = value.join(',');
                  return value;
              }
            }}]
          },
          plugins:
          {
            labels: false
          }
      }
    });
}

function costByYearMPG(vehicleLabelOutput, vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, operational, labor, vmt)
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

        let age = document.getElementById("usedVehicle");
        let viewAge = "";
    
        if(!age.checked)
        {
          viewAge = "New";
        }
        else
        {
          viewAge = "Used";
        }

        let milesDriven = ["10k", "20k", "30k", "40k", "50k", "60k", "70k", "80k", "90k", "100k", "110k", "120k", "130k", "140k", "150k", "160k", "170k", "180k", "190k", "200k", "210k", "220k", "230k", "240k", "250k", "260k", "270k", "280k", "290k", "300k"];
        let milesDrivenInt = [10000, 20000, 30000, 40000, 50000, 60000, 70000, 80000, 90000, 100000, 110000, 120000, 130000, 140000, 150000, 160000, 170000, 180000, 190000, 200000, 210000, 220000, 230000, 240000, 250000, 260000, 270000, 280000, 290000, 300000];
    
        let totalCostOwnership = [];

        let totalVmt = vmt[0];
        let counter = 0;

        for(let i = 0; i < 30; i++)
        {
            // year[i] = i + 1;
            // vmtCost[i] = vmt[i];
            // vehicleBodyCosts[i] = parseInt(vehicleBodyCost[i]) / vmtCost[i]; //parseInt(vehicleBodyCost[i].innerHTML);
            // financeCosts[i] = parseInt(financeCost[i]) / vmtCost[i]; //parseInt(financeCost[i].innerHTML);
            // annualFuelCosts[i] = parseInt(annualFuelCost[i]) / vmtCost[i]; //parseInt(annualFuelCost[i].innerHTML);
            // insuranceCosts[i] = parseInt(insuranceCost[i]) / vmtCost[i]; //parseInt(insuranceCost[i].innerHTML);
            // taxesAndFeesCosts[i] = parseInt(taxesAndFees[i]) / vmtCost[i]; //parseInt(taxesAndFees[i].innerHTML);
            // maintenanceCosts[i] = parseInt(maintenance[i]) / vmtCost[i]; //parseInt(maintenance[i].innerHTML);
            // repairCosts[i] = parseInt(repair[i]) / vmtCost[i]; //parseInt(repair[i].innerHTML);
            // operationalCosts[i] = parseInt(operational[i]) / vmtCost[i];
            // laborCosts[i] = parseInt(labor[i]) / vmtCost[i];
            // totalCostOwnership[i] = (vehicleBodyCosts[i] + financeCosts[i] + annualFuelCosts[i] + insuranceCosts[i] + taxesAndFeesCosts[i] + maintenanceCosts[i] + repairCosts[i]);
            
            if(milesDrivenInt[i] > totalVmt)
            {
              counter++;
              totalVmt += vmt[counter];
            }

            vehicleBodyCosts[i] = parseInt(vehicleBodyCost[counter]) / vmt[counter];
            financeCosts[i] = parseInt(financeCost[counter]) / vmt[counter]; //parseInt(financeCost[i].innerHTML);
            annualFuelCosts[i] = parseInt(annualFuelCost[counter]) / vmt[counter]; //parseInt(annualFuelCost[i].innerHTML);
            insuranceCosts[i] = parseInt(insuranceCost[counter]) / vmt[counter]; //parseInt(insuranceCost[i].innerHTML);
            taxesAndFeesCosts[i] = parseInt(taxesAndFees[counter]) / vmt[counter]; //parseInt(taxesAndFees[i].innerHTML);
            maintenanceCosts[i] = parseInt(maintenance[counter]) / vmt[counter]; //parseInt(maintenance[i].innerHTML);
            repairCosts[i] = parseInt(repair[i]) / vmt[counter]; //parseInt(repair[i].innerHTML);
            operationalCosts[i] = parseInt(operational[counter]) / vmt[counter];
            laborCosts[i] = parseInt(labor[counter]) / vmt[counter];        

            // console.log("vehicle body: " + vehicleBodyCosts[i] + " \nfinance " + financeCosts[i] + " \nannualfuel " + annualFuelCosts[i] + 
            // " \ninsurance " + insuranceCosts[i] + " \ntaxes " + taxesAndFeesCosts[i] + " \nmaintenance " + maintenanceCosts[i] + " \nrepair " + repairCosts[i] + 
            // " \nTCO " + totalCostOwnership[i]);
        }
          Chart.defaults.global.defaultFontSize = 15;
          perMileGrpah = new Chart(canvas, {
          type: "bar",
          data: 
          {
            labels: milesDriven,
            datasets:
            [
              {
                data: vehicleBodyCosts,
                label: vehicleLabelOutput,
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
                label: "Operational",
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
              text: "Per Mile TCO For " + viewAge + " " + powertrainName.options[powertrainName.selectedIndex].text + " " + bodyName.options[bodyName.selectedIndex].text,
              fontFamily: "sans-serif",
              fontColor: "black",
              fontSize: 20,
              position: 'top'
            },
              scales:
              {
                xAxes: [{stacked: true, scaleLabel:{display: true, labelString: "Miles Driven"}}],
                yAxes: [{stacked: true, scaleLabel:{display: true, labelString: "Cost Per Mile: ($)"},

                ticks:
                {
                  beginAtZero:true,
                  userCallback: function(value, index, values)
                  {
                      value = value.toString();
                      value = value.split(/(?=(?:...)*$)/);
                      value = value.join(',');
                      return value;
                  }
                }}]
              },
              plugins:
              {
                labels: false
              }
          }
        });
}

function powertrainGraph(vehicleLabelOutput, body, finance, fuel, insurance, tax, maintenance, repair, labor, operational)
{
    $("#powertrainGraph").remove();
  
    let first = document.querySelector(".first");
    let second = document.querySelector(".second");
    let third = document.querySelector(".third");

    // console.log(second.hasChildNodes());
    // if(!first.hasAttributes())
    // {
    //   console.log("first is empty");
    //   //$("#first").append("<canvas id='powertrainGraph'>canvas is not supported in your browser</canvas>");
    // }
    // else if(!second.hasAttributes())
    // {
    //   console.log("second is empty");
    //   //$("#second").append("<canvas id='powertrainGraph'>canvas is not supported in your browser</canvas>");
    // }
    // else if(!third.hasAttributes())
    // {
    //   console.log("third is empty");
    //   //$("#third").append("<canvas id='powertrainGraph'>canvas is not supported in your browser</canvas>");
    // }
    // else
    // {
    //   console.log("this is not what I expected");
    // }

    if(!(first.classList.contains("usedVehicleGraphContainer") || first.classList.contains("modelYearGraphContainer")))
    {
      first.classList.add("powertrainGraphContainer");

      if(second.classList.contains("powertrainGraphContainer"))
      {
        second.classList.remove("powertrainGraphContainer");
      }

      if(third.classList.contains("powertrainGraphContainer"))
      {
        third.classList.remove("powertrainGraphContainer");
      }
    }
    else if(!(second.classList.contains("usedVehicleGraphContainer") || second.classList.contains("modelYearGraphContainer")))
    {
      second.classList.add("powertrainGraphContainer");

      if(first.classList.contains("powertrainGraphContainer"))
      {
        first.classList.remove("powertrainGraphContainer");
      }

      if(third.classList.contains("powertrainGraphContainer"))
      {
        third.classList.remove("powertrainGraphContainer");
      }
    }
    else
    {
      third.classList.add("powertrainGraphContainer");

      if(second.classList.contains("powertrainGraphContainer"))
      {
        second.classList.remove("powertrainGraphContainer");
      }

      if(first.classList.contains("powertrainGraphContainer"))
      {
        first.classList.remove("powertrainGraphContainer");
      }
    }

    $(".powertrainGraphContainer").append("<canvas id='powertrainGraph'>canvas is not supported in your browser</canvas>");

    canvas = document.getElementById("powertrainGraph");

    powertrain = [];
    bodyCosts = [];
    financeCosts = [];
    fuelCosts = [];
    insuranceCosts = [];
    taxCosts = [];
    maintenanceCosts = [];
    repairCosts = [];
    laborCosts = [];
    operationalCosts = [];
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
      laborCosts[i] = parseInt(labor[i]);
      operationalCosts[i] = parseInt(operational[i]);

      totalCost[i] = bodyCosts[i] + financeCosts[i] + fuelCosts[i] + insuranceCosts[i] + taxCosts[i] + maintenanceCosts[i] + repairCosts[i] + laborCosts[i] + operationalCosts[i];
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
              label: vehicleLabelOutput,
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
          },
          {
            data: laborCosts,
            label: "Labor",
            backgroundColor: "#03fc3d"
          },
          {
            data: operationalCosts,
            label: "Operational",
            backgroundColor: "#c267f5"
          }
        ]
      },
      options: 
      {
        title:
        {
          display: true,
          text: "Comparison Across " + bodyName.options[bodyName.selectedIndex].text + " Powertrains",
          fontFamily: "sans-serif",
          fontColor: "black",
          fontSize: 20,
          position: 'top'
        },
          scales:
          {
            xAxes: [{stacked: true, scaleLabel:{display: true, labelString: "Powertrain Type"}}],
            yAxes: [{stacked: true, scaleLabel:{display: true, labelString: "5-yr Cost: ($)"},
            ticks:
            {
              beginAtZero:true,
              userCallback: function(value, index, values)
              {
                  value = value.toString();
                  value = value.split(/(?=(?:...)*$)/);
                  value = value.join(',');
                  return value;
              }
          }}]
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

function modelYearGraph(vehicleLabelOutput, body, finance, fuel, insurance, tax, maintenance, repair, labor, operational)
{
    $("#modelYearGraph").remove();

    let first = document.querySelector(".first");
    let second = document.querySelector(".second");
    let third = document.querySelector(".third");

    if(!(first.classList.contains("usedVehicleGraphContainer") || first.classList.contains("powertrainGraphContainer")))
    {
      first.classList.add("modelYearGraphContainer");

      if(second.classList.contains("modelYearGraphContainer"))
      {
        second.classList.remove("modelYearGraphContainer");
      }

      if(third.classList.contains("modelYearGraphContainer"))
      {
        third.classList.remove("modelYearGraphContainer");
      }
    }
    else if(!(second.classList.contains("usedVehicleGraphContainer") || second.classList.contains("powertrainGraphContainer")))
    {
      second.classList.add("modelYearGraphContainer");

      if(first.classList.contains("modelYearGraphContainer"))
      {
        first.classList.remove("modelYearGraphContainer");
      }

      if(third.classList.contains("modelYearGraphContainer"))
      {
        third.classList.remove("modelYearGraphContainer");
      }
    }
    else
    {
      third.classList.add("modelYearGraphContainer");

      if(second.classList.contains("modelYearGraphContainer"))
      {
        second.classList.remove("modelYearGraphContainer");
      }

      if(first.classList.contains("modelYearGraphContainer"))
      {
        first.classList.remove("modelYearGraphContainer");
      }
    }

    $(".modelYearGraphContainer").append("<canvas id='modelYearGraph'>canvas is not supported in your browser</canvas>");

    // if(!first.hasChildNodes())
    // {
    //   $(".first").append("<canvas id='modelYearGraph'>canvas is not supported in your browser</canvas>");
    // }
    // else if(!second.hasChildNodes())
    // {
    //   $(".second").append("<canvas id='modelYearGraph'>canvas is not supported in your browser</canvas>");
    // }
    // else if(!third.hasChildNodes())
    // {
    //   $(".third").append("<canvas id='modelYearGraph'>canvas is not supported in your browser</canvas>");
    // }

    canvas = document.getElementById("modelYearGraph");

    modelYear = [];
    bodyCosts = [];
    financeCosts = [];
    fuelCosts = [];
    insuranceCosts = [];
    taxCosts = [];
    maintenanceCosts = [];
    repairCosts = [];
    laborCosts = [];
    operationalCosts = [];
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
      laborCosts[i] = parseInt(labor[i]);
      operationalCosts[i] = parseInt(operational[i]);

      totalCost[i] = bodyCosts[i] + financeCosts[i] + fuelCosts[i] + insuranceCosts[i] + taxCosts[i] + maintenanceCosts[i] + repairCosts[i] + laborCosts[i] + operationalCosts[i];
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
              label: vehicleLabelOutput,
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
          },
          {
            data: laborCosts,
            label: "Labor",
            backgroundColor: "#03fc3d"
          },
          {
            data: operationalCosts,
            label: "Operational",
            backgroundColor: "#c267f5"
          }
        ]
      },
      options: 
      {
        title:
        {
          display: true,
          text: "Comparison Across " + bodyName.options[bodyName.selectedIndex].text + " Model Years",
          fontFamily: "sans-serif",
          fontColor: "black",
          fontSize: 20,
          position: 'top'
        },
          scales:
          {
            xAxes: [{stacked: true, scaleLabel:{display: true, labelString: "Model Year"}}],
            yAxes: [{stacked: true, scaleLabel:{display: true, labelString: "5-yr Cost: ($)"},
            ticks:
            {
              beginAtZero:true,
              userCallback: function(value, index, values)
              {
                  value = value.toString();
                  value = value.split(/(?=(?:...)*$)/);
                  value = value.join(',');
                  return value;
              }
          }}]
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

function vehicleGraphMain(vehicleLabelOutput, vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, operational, labor, vmt)
{
    $("#vehicleGraph").remove();
    $(".canvasContainer").append('<canvas id="vehicleGraph">canvas is not supported in your browser</canvas>');

    $("#perMileGraph").remove();
    $(".canvasContainer").append("<canvas id='perMileGraph'>canvas is not supported in your browser</canvas>");

    costByYear(vehicleLabelOutput, vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, operational, labor);
    costByYearMPG(vehicleLabelOutput, vehicleBodyCost, financeCost, annualFuelCost, insuranceCost, taxesAndFees, maintenance, repair, operational, labor, vmt);
    //tornadoChart();
}