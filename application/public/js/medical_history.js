/* 
Function checks the heart disease select and creates the elements
accordingly
*/
function checkHD(){
    var selectHD = document.getElementById("hDCheck").value;
    if(selectHD == "yes"){
        var element = document.getElementById("hDFamily");
        var inputHDFamily = document.createElement("input");
        inputHDFamily.id = "inputHDFamily";
        inputHDFamily.name = "inputHDFamily";
        inputHDFamily.required = "required";

        element.appendChild(inputHDFamily);
    }
    else{
        if(document.getElementById("inputHDFamily") != null){
            document.getElementById("inputHDFamily").remove();
        }
    }
}

/* 
Function checks the cancer select and creates the elements 
accordingly
*/
function checkCan(){
    var selectCan = document.getElementById("canCheck").value;
    if(selectCan == "yes"){
        var element = document.getElementById("canFamily");
        var inputCanFamily = document.createElement("input");
        inputCanFamily.id = "inputCanFamily";
        inputCanFamily.name = "inputCanFamily";
        inputCanFamily.required = "required";

        element.appendChild(inputCanFamily);
    }
    else{
        if(document.getElementById("inputCanFamily") != null){
            document.getElementById("inputCanFamily").remove();
        }
    }
}

/* 
Function checks the stroke select and creates the elements 
accordingly
*/
function checkStro(){
    var selectStro = document.getElementById("stroCheck").value;
    if(selectStro == "yes"){
        var element = document.getElementById("stroFamily");
        var inputStroFamily = document.createElement("input");
        inputStroFamily.id = "inputStroFamily";
        inputStroFamily.name = "inputStroFamily";
        inputStroFamily.required = "required";

        element.appendChild(inputStroFamily);
    }
    else{
        if(document.getElementById("inputStroFamily") != null){
            document.getElementById("inputStroFamily").remove();
        }
    }
}

/* 
Function checks the other select and creates the elements 
accordingly
*/
function checkOther(){
    var selectOther = document.getElementById("otherCheck").value;
    if(selectOther == "yes"){
        var element = document.getElementById("otherFamily");
        var inputOtherFamily = document.createElement("input");
        inputOtherFamily.id = "inputOtherFamily";
        inputOtherFamily.name = "inputOtherFamily";
        inputOtherFamily.required = "required";

        element.appendChild(inputOtherFamily);
    }
    else{
        if(document.getElementById("inputOtherFamily") != null){
            document.getElementById("inputOtherFamily").remove();
        }
    }
}