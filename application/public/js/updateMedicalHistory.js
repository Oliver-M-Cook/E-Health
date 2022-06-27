/* 
A modified script of the medical history that can handle a variable being put into it.
*/
function checkHD(family){
    //If the variable is null or no it fills the variable with an empty slot
    if(family == "no" || family == null){
        family = "";
    }
    var selectHD = document.getElementById("hDCheck").value;
    if(selectHD == "yes"){
        var element = document.getElementById("hDFamily");
        var inputHDFamily = document.createElement("input");
        inputHDFamily.id = "inputHDFamily";
        inputHDFamily.name = "inputHDFamily";
        inputHDFamily.value = family;
        inputHDFamily.required = "required";

        element.appendChild(inputHDFamily);
    }
    else{
        if(document.getElementById("inputHDFamily") != null){
            document.getElementById("inputHDFamily").remove();
        }
    }
}

function checkCan(family){
    if(family == "no" || family == null){
        family = "";
    }
    var selectCan = document.getElementById("canCheck").value;
    if(selectCan == "yes"){
        var element = document.getElementById("canFamily");
        var inputCanFamily = document.createElement("input");
        inputCanFamily.id = "inputCanFamily";
        inputCanFamily.name = "inputCanFamily";
        inputCanFamily.value = family;
        inputCanFamily.required = "required";

        element.appendChild(inputCanFamily);
    }
    else{
        if(document.getElementById("inputCanFamily") != null){
            document.getElementById("inputCanFamily").remove();
        }
    }
}

function checkStro(family){
    if(family == "no" || family == null){
        family = "";
    }
    var selectStro = document.getElementById("stroCheck").value;
    if(selectStro == "yes"){
        var element = document.getElementById("stroFamily");
        var inputStroFamily = document.createElement("input");
        inputStroFamily.id = "inputStroFamily";
        inputStroFamily.name = "inputStroFamily";
        inputStroFamily.value = family;
        inputStroFamily.required = "required";

        element.appendChild(inputStroFamily);
    }
    else{
        if(document.getElementById("inputStroFamily") != null){
            document.getElementById("inputStroFamily").remove();
        }
    }
}

function checkOther(family){
    if(family == "no" || family == null){
        family = "";
    }
    var selectOther = document.getElementById("otherCheck").value;
    if(selectOther == "yes"){
        var element = document.getElementById("otherFamily");
        var inputOtherFamily = document.createElement("input");
        inputOtherFamily.id = "inputOtherFamily";
        inputOtherFamily.name = "inputOtherFamily";
        inputOtherFamily.value = family;
        inputOtherFamily.required = "required";

        element.appendChild(inputOtherFamily);
    }
    else{
        if(document.getElementById("inputOtherFamily") != null){
            document.getElementById("inputOtherFamily").remove();
        }
    }
}