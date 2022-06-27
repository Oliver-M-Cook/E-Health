/* 
A modified version of the smoking script that can handle an array being
entered and accessed by the script
*/
function smokeCheck(smokeArray){
    var smokingState = document.getElementById("smokingState").value;
    //if smokeArray is undefined then this will set the variable
    if(smokeArray == null){
        smokeArray = ["", "", ""];
    }
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

        var selectType = document.createElement("select");
        selectType.id = "smokeType";
        selectType.name = "smokeType";

        var optionOne = document.createElement("option");
        optionOne.text = "Cigarettes";
        optionOne.value = "cigarettes";
        if(smokeArray[0] == "cigarettes"){
            optionOne.selected = "selected";
        }
        selectType.add(optionOne);

        var optionTwo = document.createElement("option");
        optionTwo.text = "Cigars";
        optionTwo.value = "cigars";
        if(smokeArray[0] == "cigars"){
            optionTwo.selected = "selected";
        }
        selectType.add(optionTwo);

        var optionThree = document.createElement("option");
        optionThree.text = "E-Cigarettes";
        optionThree.value = "eCigarettes";
        if(smokeArray[0] == "eCigarettes"){
            optionThree.selected = "selected";
        }
        selectType.add(optionThree);

        var optionFour = document.createElement("option");
        optionFour.text = "Pipe";
        optionFour.value = "pipe";
        if(smokeArray[0] == "pipe"){
            optionFour.selected = "selected";
        }
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
        inputSmokeAge.value = smokeArray[1];
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
        if(smokeArray[2] == "yes"){
            optionOne.selected = "selected";
        }
        selectHelp.add(optionOne);

        var optionTwo = document.createElement("option");
        optionTwo.text = "No";
        optionTwo.value = "no";
        if(smokeArray[2] == "no"){
            optionTwo.selected = "selected";
        }
        selectHelp.add(optionTwo);

        element.appendChild(selectHelp);
    }
    else{
        //Removes the elements that don't need to be on the html
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