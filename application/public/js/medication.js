/* 
Function checks the medication select and creates the elements accordingly
*/
function medicationCheck(){
    var x = document.getElementById("medicationState").value;
    if(x == "Yes"){
        var element = document.getElementById("medicationTypes");

        //Creates a table to hold all the input fields
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
        //Sets the innerHTML to the input field 
        medNameOne.innerHTML = "<input name='medicationOne' type='text' required>";
        dosageOne.innerHTML = "<input name='medicationOneDosage' type='number' min='0' required>";
        usageOne.innerHTML = "<input name='medicationOneUsage' type='number' min='0' required>";

        var medTwoRow = medTable.insertRow(2);
        var medNameTwo = medTwoRow.insertCell(0);
        var dosageTwo = medTwoRow.insertCell(1);
        var usageTwo = medTwoRow.insertCell(2);
        medNameTwo.innerHTML = "<input name='medicationTwo' type='text'>";
        dosageTwo.innerHTML = "<input name='medicationTwoDosage' type='number' min='0'>";
        usageTwo.innerHTML = "<input name='medicationTwoUsage' type='number' min='0'>";

        var medThreeRow = medTable.insertRow(3);
        var medNameThree = medThreeRow.insertCell(0);
        var dosageThree = medThreeRow.insertCell(1);
        var usageThree = medThreeRow.insertCell(2);
        medNameThree.innerHTML = "<input name='medicationThree' type='text'>";
        dosageThree.innerHTML = "<input name='medicationThreeDosage' type='number' min='0'>";
        usageThree.innerHTML = "<input name='medicationThreeUsage' type='number' min='0'>";

        element.appendChild(medTable);
    }
    else{
        if(document.getElementById("medTable") != null){
            document.getElementById("medTable").remove();
        }
    }
}