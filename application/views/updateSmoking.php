<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="<?php echo base_url('application/public/js/updateSmoking.js')?>"></script>
    <title>Update Smoking</title>
</head>
<body>
    <form action="sendSmoking" method="POST">
        <label>Smoking Status:</label>
        <select name="smokingState" id="smokingState" onchange="smokeCheck()" required>
            <?php
            // these if statements select the right value for the select tag
                if($smoke_status == "notSmoked"){
                    echo '<option value="notSmoked" selected="selected">Never Smoked</option>';
                    echo '<option value="exSmoker">Ex-Smoker</option>';
                    echo '<option value="currentSmoker">Current Smoker</option>';
                }
                if($smoke_status == "exSmoker"){
                    echo '<option value="notSmoked">Never Smoked</option>';
                    echo '<option value="exSmoker" selected="selected">Ex-Smoker</option>';
                    echo '<option value="currentSmoker">Current Smoker</option>';
                }
                if($smoke_status == "currentSmoker"){
                    echo '<option value="notSmoked">Never Smoked</option>';
                    echo '<option value="exSmoker">Ex-Smoker</option>';
                    echo '<option value="currentSmoker" selected="selected">Current Smoker</option>';
                }
            ?> 
        </select>
        <div id="smokeBox">
        <?php
            if(isset($smokeArray)){
                echo '<script type="text/javascript">';
                echo 'var smokeArray = '.json_encode($smokeArray).';';
                echo 'smokeCheck(smokeArray);';
                echo '</script>';
            }
        ?>
        </div>
        <button type="submit">Save and Next Page</button>
    </form>
</body>
</html>