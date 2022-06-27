<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- link the external files to this view -->
    <link rel="stylesheet" href="<?php echo base_url('application/public/css/medication.css')?>"/> 
    <script src="<?php echo base_url('application/public/js/medication.js')?>"></script>
    <title><?php echo $appName?></title>
</head>
<body>
    <!-- form that sends the data to the controller -->
    <form action="sendMedData" method="POST">
        <label>Are you currently taking any medication:</label>
        <!-- creates select that calls a function when the value is changed -->
        <select name="medicationState" id="medicationState" onchange="medicationCheck()" required>
            <option value="No">No</option>
            <option value="Yes">Yes</option>        
        </select>
        <!-- location the script will add the elements to -->
        <div id="medicationTypes">
        </div>
        <!-- button submits the form -->
        <button type="submit">Next Page</button>
    </form>
</body>
</html>