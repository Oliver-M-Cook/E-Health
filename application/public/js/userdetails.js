/* 
Function checks the gender the user has selected
and if it matches the script, the script will create an input element
for extra info
*/
function genderCheck(otherValue){
    var x = document.getElementById("gender").value;
    //if value is null then assign an empty variable
    if(otherValue == null){
        otherValue = "";
    }
    if(x == "Other"){
        var element = document.getElementById("genderBox");

        var labelSpecify = document.createElement("label");
        labelSpecify.id = "otherLabel";
        var labelText = document.createTextNode("Please Specify:");
        labelSpecify.appendChild(labelText);
        element.appendChild(labelSpecify);

        var inputSpecify = document.createElement("input");
        inputSpecify.id = "otherInput";
        inputSpecify.name = "otherSpec";
        inputSpecify.value = otherValue;
        element.appendChild(inputSpecify);
    }
    else{
        //removes the elements that are no longer needed by the script
        if(document.getElementById("otherLabel") != null){
            document.getElementById("otherLabel").remove();
            document.getElementById("otherInput").remove();
        }
    }
}