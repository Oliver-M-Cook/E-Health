<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- links the external script to the view -->
    <script src="<?php echo base_url('application/public/js/updateLifestyle.js')?>"></script>
    <title>Update Lifestyle</title>
</head>
<body>
    <form action="sendLifestyle" method="POST">
        <label>Do you take regular exercise:</label>
        <select name="exerciseCheck" id="exerciseCheck" onchange="checkExercise()" required>
        <?php
            if($exercise == "no"){
                echo '<option value="no" selected="selected">No</option>';
                echo '<option value="yes">Yes</option>';
            }
            else{
                echo '<option value="no">No</option>';
                echo '<option value="yes" selected="selected">Yes</option>';
            }
        ?>       
        </select>
        <div id="exerciseInfo"></div>
        <?php
        // check to see if the array is set
            if(isset($exerciseArray)){
                echo '<script type="text/javascript">';
                // the array needs to converted to a js array to make it compatible with the script
                echo 'var exerciseArray = '.json_encode($exerciseArray).';';
                echo 'checkExercise(exerciseArray);';
                echo '</script>';
            }
        ?>
        <label>Which one of the following best describes your diet:</label>
        <select name="dietSelect" id="dietSelect" required>
        <?php
            $options = array("Good", "Average", "Poor", "Vegetarian", "Low Fat", "Low Salt");
            foreach($options as $option){
                // strtolower converts the string all to lower case 
                if($diet == strtolower($option)){
                    echo '<option value="'.strtolower($option).'" selected="selected">'.$option.'</option>';
                }
                else{
                    echo '<option value="'.strtolower($option).'">'.$option.'</option>';
                }
            }
        ?>
        </select>
        <button type="submit">Save and Dashboard</button>
    </form>
</body>
</html>