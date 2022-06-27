<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- links the external script to this view -->
    <script src="<?php echo base_url('application/public/js/allergies.js')?>"></script>
    <title><?php echo $appName?></title>
</head>
<body>
    <!-- creates the form that will send the data -->
    <form action="sendAllergyData" method="POST">
        <label>Are you allergic to any medicines, substances or foods?</label>
        <!-- creates a select that calls a function when the user changes the value -->
        <select name="allergyCheck" id="allergyCheck" onchange="checkAllergy()" required>
            <option value="no">No</option>  
            <option value="yes">Yes</option>         
        </select>
        <!-- div to hold the elements when the script adds them -->
        <div id = allergyInfo></div>
        <!-- button that submits the data to the controller -->
        <button type="submit">Next Page</button>
    <form>
</body>
</html>