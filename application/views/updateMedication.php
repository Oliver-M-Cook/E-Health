<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- links to external files that are used on this view -->
    <link rel="stylesheet" href="<?php echo base_url('application/public/css/medication.css')?>"/> 
    <script src="<?php echo base_url('application/public/js/updateMedication.js')?>"></script>
    <title>Update Medication</title>
</head>
<body>
    <form action="sendMedication" method="POST">
        <label>Are you currently taking any medication:</label>
        <select name="medicationState" id="medicationState" onchange="medicationCheck()" required>
            <?php
                if($Medication_YN == "Yes"){
                    echo '<option value="No">No</option>';
                    echo '<option value="Yes" selected="selected">Yes</option> ';
                }
                else{
                    echo '<option value="No" selected="selected">No</option>';
                    echo '<option value="Yes">Yes</option> '; 
                }
            ?>       
        </select>
        <div id="medicationTypes">
        <?php
            if(isset($medArray)){
                echo '<script type="text/javascript">';
                echo 'var medArray = '.json_encode($medArray).';';
                echo 'medicationCheck(medArray);';
                echo '</script>';
            }
        ?>
        </div>
        <button type="submit">Save and Next Page</button>
    </form>
</body>
</html>