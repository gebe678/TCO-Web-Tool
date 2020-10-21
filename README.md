# TCO-Web-Tool
A web tool to calculate the total cost of operating of a vehicle

I have included a folder with templates I will continue to add more until we pick a template for the web-tool. So far I have updated the web-tool with the styled drop down menu. I have also updated the dropdown so that it says whatever the user selects from the list in the box. I can update the colors I used for the list and add new elements to them as needed. 

I have found 2 issues with the tool currently. Firstly all of the BEV calculations are taking their BEV data from the compact sedan BEV range. So a midsize sedan will have the same bev calculation as a compact sedan for the same BEV range. The reason for this issue is in the database there is no distiction between different vehicle body BEV data. I have noticed that there is no BEV data for the heavy duty trucks in the excel sheet and will update the database with the new information as soon as that is updated.

I have also found that the fuel data does not update when a new vehicle body is chosen. The powertrain is automatically updated based on the vehicle body type but the fuel type which is dependent on the powertrain is not updated with the change to the vehicle body. I will work on getting this fixed so the correct fuel type is selected with the powertrain.

Link for tableau wordpress issue: https://community.tableau.com/s/question/0D54T00000C64d3/how-should-i-get-rid-of-play-sign-on-my-tableau-viz-in-wordpress