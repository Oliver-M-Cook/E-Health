/* 
Function gets the value in the select when it is changed
and it creates the buttons accordingly
*/
function displayStatus(){
    var selectPatient = document.getElementById("patientSelect").value;
    //splits the value because it contains two seperate values in a single string
    var patientArray = selectPatient.split("|");
    var element = document.getElementById("statusOutput");
    element.innerHTML ="This Questionaire is currently " + patientArray[1];

    var buttonBox = document.getElementById("buttonBox");

    var buttonBox = document.getElementById("buttonBox");
    var viewQuest = document.createElement("button");
    viewQuest.type = "submit";
    viewQuest.name = "action";
    viewQuest.id = "viewQ";
    viewQuest.value = "viewQuestionaire";
    viewQuest.innerHTML = "View Questionaire";

    var updateQuest = document.createElement("button");
    updateQuest.type = "submit";
    updateQuest.name = "action";
    updateQuest.id = "updateQ";
    updateQuest.value = "updateQuestionaire";
    updateQuest.innerHTML = "Update Questionaire";
    

    if(patientArray[1] == "Accepted"){
        //checks if the button already exists, if it does not then create the button
        if(document.getElementById("updateQ") == null){
            buttonBox.appendChild(updateQuest);
        }
    }
    else{
        //removes the button if it already exists and it needs to go
        if(document.getElementById("updateQ") != null){
            document.getElementById("updateQ").remove();
        }
    }
}