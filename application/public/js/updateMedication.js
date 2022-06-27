/* 
A modified version of the medication script which can handle an array 
that holds the data the user entered previously
*/
function medicationCheck(medArray){
    var x = document.getElementById("medicationState").value;
    //if the array is undefined then it creates a ray with equal size
    if(medArray == null){
        medArray = ["", "", "", "", "", "", "", "", ""];
    }
    else{
        for(i = 0; i < medArray.length; i++){
            if(medArray[i] == 0){
                medArray[i] = "";
            }
        }
    }
    if(x == "Yes"){
        var element = document.getElementById("medicationTypes");

        var medTable = document.createElement("table");
        medTable.id = "medTable";
        var headingRow = medTable.insertRow(0);
        var medNameHead = headingRow.insertCell(0);
        var dosageHead = headingRow.insertCell(1);
        var usageHead = headingRow.insertCell(2);
        medNameHead.innerHTML = "Name of Medication";
        dosageHead.innerHTML = "Dosage";
        usageHead.innerHTML = "How often do you take it";

        var medOneRow = medTable.insertRow(1);
        var medNameOne = medOneRow.insertCell(0);
        var dosageOne = medOneRow.insertCell(1);
        var usageOne = medOneRow.insertCell(2);
        medNameOne.innerHTML = "<input name='medicationOne' type='text' value="+medArray[0]+" required>";
        dosageOne.innerHTML = "<input name='medicationOneDosage' type='number' min='0' value="+medArray[1]+" required>";
        usageOne.innerHTML = "<input name='medicationOneUsage' type='number' min='0' value="+medArray[2]+" required>";

        var medTwoRow = medTable.insertRow(2);
        var medNameTwo = medTwoRow.insertCell(0);
        var dosageTwo = medTwoRow.insertCell(1);
        var usageTwo = medTwoRow.insertCell(2);
        medNameTwo.innerHTML = "<input name='medicationTwo' type='text' value="+medArray[3]+">";
        dosageTwo.innerHTML = "<input name='medicationTwoDosage' type='number' min='0' value="+medArray[4]+">";
        usageTwo.innerHTML = "<input name='medicationTwoUsage' type='number' min='0' value="+medArray[5]+">";

        var medThreeRow = medTable.insertRow(3);
        var medNameThree = medThreeRow.insertCell(0);
        var dosageThree = medThreeRow.insertCell(1);
        var usageThree = medThreeRow.insertCell(2);
        medNameThree.innerHTML = "<input name='medicationThree' type='text' value="+medArray[6]+">";
        dosageThree.innerHTML = "<input name='medicationThreeDosage' type='number' min='0' value="+medArray[7]+">";
        usageThree.innerHTML = "<input name='medicationThreeUsage' type='number' min='0' value="+medArray[8]+">";

        element.appendChild(medTable);
    }
    else{
        if(document.getElementById("medTable") != null){
            document.getElementById("medTable").remove();
        }
    }
}