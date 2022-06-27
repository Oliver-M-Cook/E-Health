/* 
A modified version of the lifestye script, this is built to handle an array being entered 
into it
*/
function checkExercise(exerciseArray){
    //If the array is null, then we fill it with empty slots
    if(exerciseArray == null){
        exerciseArray = ["", ""];
    }
    var selectExercise = document.getElementById("exerciseCheck").value;
    if(selectExercise == "yes"){
        var element = document.getElementById("exerciseInfo");

        var labelExerSess = document.createElement("label");
        labelExerSess.id = "exerciseSessLabel";
        var labelExerSessText = document.createTextNode("How long do you exercise for in one session:");
        labelExerSess.appendChild(labelExerSessText);
        element.appendChild(labelExerSess);

        var inputExerSess = document.createElement("input");
        inputExerSess.id = "inputExerSess";
        inputExerSess.name = "inputExerSess"
        inputExerSess.type = "number";
        inputExerSess.min = "0";
        inputExerSess.placeholder = "minutes";
        inputExerSess.value = exerciseArray[0];
        inputExerSess.required = "required";
        element.appendChild(inputExerSess);

        var branch = document.createElement("br");
        branch.id = "branch";
        element.appendChild(branch);

        var labelWeeklyExer = document.createElement("label");
        labelWeeklyExer.id = "exerciseWeeklyLabel";
        var labelWeeklyExerText = document.createTextNode("How often do you exercise in a typical week:");
        labelWeeklyExer.appendChild(labelWeeklyExerText);
        element.appendChild(labelWeeklyExer);

        var inputWeeklyExer = document.createElement("input");
        inputWeeklyExer.id = "inputWeeklyExer";
        inputWeeklyExer.name = "inputWeeklyExer"
        inputWeeklyExer.type = "number";
        inputWeeklyExer.min = "0";
        inputWeeklyExer.max = "7";
        inputWeeklyExer.placeholder = "days";
        inputWeeklyExer.value = exerciseArray[1];
        inputWeeklyExer.required = "required";
        element.appendChild(inputWeeklyExer);
    }
    else{
        //Removes the elements created by the script if they are no longer needed
        if(document.getElementById("exerciseSessLabel") != null){
            document.getElementById("exerciseSessLabel").remove();
            document.getElementById("inputExerSess").remove();
            document.getElementById("exerciseWeeklyLabel").remove();
            document.getElementById("branch").remove();
            document.getElementById("inputWeeklyExer").remove();
        }
    }
}