<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- links the external script to this view -->
    <script src="<?php echo base_url('application/public/js/lifestyle.js')?>"></script>
    <title><?php echo $appName?></title>
</head>
<body>
    <!-- form that will send the data the user enters -->
    <form action="sendLifestyleData" method="POST">
        <label>Do you take regular exercise:</label>
        <!-- when the select is changed the script is called and update the html -->
        <select name="exerciseCheck" id="exerciseCheck" onchange="checkExercise()" required>
            <option value="no">No</option>  
            <option value="yes">Yes</option>         
        </select>
        <!-- location for the elements that are created by the script -->
        <div id="exerciseInfo"></div>
        <label>Which one of the following best describes your diet:</label>
        <select name="dietSelect" id="dietSelect" required>
            <option value="good">Good</option>  
            <option value="average">Average</option> 
            <option value="poor">Poor</option> 
            <option value="vegetarian">Vegetarian</option> 
            <option value="vegan">Vegan</option> 
            <option value="low fat">Low Fat</option> 
            <option value="low salt">Low Salt</option>         
        </select>
        <!-- creates a button that will submit the questionaire to the controller -->
        <button type="submit">Submit questionaire</button>
    </form>
</body>
</html>