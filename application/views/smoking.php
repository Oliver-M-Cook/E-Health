<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- links the external script to this view -->
    <script src="<?php echo base_url('application/public/js/smoking.js')?>"></script>
    <title><?php echo $appName?></title>
</head>
<body>
    <!-- form sends the data to the controller -->
    <form action="sendSmokeData" method="POST">
        <label>Smoking Status:</label>
        <select name="smokingState" id="smokingState" onchange="smokeCheck()" required>
                <option value="notSmoked">Never Smoked</option>  
                <option value="exSmoker">Ex-Smoker</option>
                <option value="currentSmoker">Current Smoker</option>  
        </select>
        <div id="smokeBox">
        </div>
        <button type="submit">Next Page</button>
    </form>
</body>
</html>