<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- link the external script file to this view -->
    <script src="<?php echo base_url('application/public/js/updateAllergies.js')?>"></script>
    <title>Update Allergies</title>
</head>
<body>
    <form action="sendAllergy" method="POST">
        <label>Are you allergic to any medicines, substances or foods?</label>
        <select name="allergyCheck" id="allergyCheck" onchange="checkAllergy()" required>
        <?php
            if($allergy_details == "no"){
                echo '<option value="no" selected="selected">No</option>';
                echo '<option value="yes">Yes</option>';
            }
            else{
                echo '<option value="no">No</option>';
                echo '<option value="yes" selected="selected">Yes</option>';
            }
        ?>       
        </select>
        <div id = allergyInfo></div>
        <!-- calls the script once the div is loaded just incase the value requires the extra info -->
        <script type="text/javascript">
        checkAllergy("<?php echo $allergy_details ?>");
        </script>
        <button type="submit">Save and Next Page</button>
    <form>
</body>
</html>