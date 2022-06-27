/* 
Function checks the smoke select and creates and removes input fields
depending on what the user has selected
*/
function smokeCheck(){
    var smokingState = document.getElementById("smokingState").value;
    if(smokingState == "currentSmoker"){
        var element = document.getElementById("smokeBox");
        var branchOne = document.createElement("br");
        var branchTwo = document.createElement("br");
        branchOne.id = "branchOne";
        branchTwo.id = "branchTwo";

        var labelSmokeType = document.createElement("label");
        labelSmokeType.id = "smokeTypeLabel";
        var labelSmokeText = document.createTextNode("What do you smoke:");
        labelSmokeType.appendChild(labelSmokeText);
        element.appendChild(labelSmokeType);

        //Creates a select element
        var selectType = document.createElement("select");
        selectType.id = "smokeType";
        selectType.name = "smokeType";

        //Creates an option that goes into the select element
        var optionOne = document.createElement("option");
        optionOne.text = "Cigarettes";
        optionOne.value = "cigarettes";
        selectType.add(optionOne);

        var optionTwo = document.createElement("option");
        optionTwo.text = "Cigars";
        optionTwo.value = "cigars";
        selectType.add(optionTwo);

        var optionThree = document.createElement("option");
        optionThree.text = "E-Cigarettes";
        optionThree.value = "eCigarettes";
        selectType.add(optionThree);

        var optionFour = document.createElement("option");
        optionFour.text = "Pipe";
        optionFour.value = "pipe";
        selectType.add(optionFour);

        element.appendChild(selectType);
        element.appendChild(branchOne);

        var labelSmokeAge = document.createElement("label");
        labelSmokeAge.id = "smokeAgeLabel";
        var labelSmokeAgeText = document.createTextNode("What age did you start to smoke:");
        labelSmokeAge.appendChild(labelSmokeAgeText);

        element.appendChild(labelSmokeAge);

        var inputSmokeAge = document.createElement("input");
        inputSmokeAge.id = "inputSmokeAge";
        inputSmokeAge.name = "inputSmokeAge";
        inputSmokeAge.required = "required";

        element.appendChild(inputSmokeAge);
        element.appendChild(branchTwo);

        var labelSmokeHelp = document.createElement("label");
        labelSmokeHelp.id = "smokeHelpLabel";
        var labelSmokeHelpText = document.createTextNode("Do you want support to help you quit:");
        labelSmokeHelp.appendChild(labelSmokeHelpText);

        element.appendChild(labelSmokeHelp);

        var selectHelp = document.createElement("select");
        selectHelp.id = "smokeHelp";
        selectHelp.name = "smokeHelp";

        var optionOne = document.createElement("option");
        optionOne.text = "Yes";
        optionOne.value = "yes";
        selectHelp.add(optionOne);

        var optionTwo = document.createElement("option");
        optionTwo.text = "No";
        optionTwo.value = "no";
        selectHelp.add(optionTwo);

        element.appendChild(selectHelp);
    }
    else{
        //Removes the elements that were added by the script
        if(document.getElementById("smokeTypeLabel") != null){
            document.getElementById("smokeTypeLabel").remove();
            document.getElementById("smokeType").remove();
            document.getElementById("branchOne").remove();

            document.getElementById("smokeAgeLabel").remove();
            document.getElementById("inputSmokeAge").remove();
            document.getElementById("branchTwo").remove();

            document.getElementById("smokeHelpLabel").remove();
            document.getElementById("smokeHelp").remove();
        }
    }
}