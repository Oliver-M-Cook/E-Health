/* 
Function checks the select and adds the corresponding
elements to the html file
*/
function checkExercise(){
    //Gets value in select element
    var selectExercise = document.getElementById("exerciseCheck").value;
    if(selectExercise == "yes"){
        //Gets the place to store the created elements
        var element = document.getElementById("exerciseInfo");

        //Creates the label and input field for exercise session
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
        inputExerSess.required = "required";
        element.appendChild(inputExerSess);

        //Creates a branch into the html document
        var branch = document.createElement("br");
        branch.id = "branch";
        element.appendChild(branch);


        //Creates the label and input element for the weekly exercise
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
        inputWeeklyExer.required = "required";
        element.appendChild(inputWeeklyExer);
    }
    else{
        //Removes the elements if the select changes
        if(document.getElementById("exerciseSessLabel") != null){
            document.getElementById("exerciseSessLabel").remove();
            document.getElementById("inputExerSess").remove();
            document.getElementById("exerciseWeeklyLabel").remove();
            document.getElementById("branch").remove();
            document.getElementById("inputWeeklyExer").remove();
        }
    }
}