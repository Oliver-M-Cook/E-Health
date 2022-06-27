/* 
Function check what allergy is selected and presents an input field accordingly
*/
function checkAllergy(){
    //gets the element from the html document
    var selectAllergy = document.getElementById("allergyCheck").value;
    if(selectAllergy == "yes"){
        //Gets the element that will hold the input field
        var element = document.getElementById("allergyInfo");

        //Creates the input element and assigns the attributes
        var inputAllergy = document.createElement("input");
        inputAllergy.id = "inputAllergy";
        inputAllergy.name = "inputAllergy";
        inputAllergy.required = "required";

        //appends the element to the div that holds the box
        element.appendChild(inputAllergy);
    }
    else{
        //This will remove the field if the user changes select and it exists on the document
        if(document.getElementById("inputAllergy") != null){
            document.getElementById("inputAllergy").remove();
        }
    }
}