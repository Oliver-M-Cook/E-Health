/* 
A modified function of the previous allergy script
this function can handle data being entered into the script
*/
function checkAllergy(allergyData){
    //To avoid a null variable being accessed, this make an empty variable as a placeholder
    if(allergyData == "no" || allergyData == null){
        allergyData = "";
    }
    var selectAllergy = document.getElementById("allergyCheck").value;
    if(selectAllergy == "yes"){
        var element = document.getElementById("allergyInfo");
        var inputAllergy = document.createElement("input");
        inputAllergy.id = "inputAllergy";
        inputAllergy.name = "inputAllergy";
        inputAllergy.value = allergyData;
        inputAllergy.required = "required";

        element.appendChild(inputAllergy);
    }
    else{
        if(document.getElementById("inputAllergy") != null){
            document.getElementById("inputAllergy").remove();
        }
    }
}