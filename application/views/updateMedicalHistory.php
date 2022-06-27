<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- 
    This view has a very similar structure to most of the other update views
    A script is called on load to make sure that the correct inputs are shown
    Several if statements are used to make sure that the correct value is shown on the select elements
 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="<?php echo base_url('application/public/js/updateMedicalHistory.js')?>"></script>
    <title>Update Medical History</title>
</head>
<body>
    <form action="sendMedicalHistory" method="POST">
        <table>
            <tr>
                <th>Condition</th>
                <th>Affected</th>
                <th>Family Member</th>
            </tr>
            <tr>
                <td>Heart Disease:</td>
                <td>
                    <select name="hDCheck" id="hDCheck" onchange="checkHD()" required>
                    <?php
                        if($has_heart_disease == "no"){
                            echo '<option value="no" selected="selected">No</option>';
                            echo '<option value="yes">Yes</option>';
                        }
                        else{
                            echo '<option value="no">No</option>';
                            echo '<option value="yes" selected="selected">Yes</option>';
                        }
                    ?>
                    </select>
                </td>
                <td>
                    <div id="hDFamily"></div>
                    <script type="text/javascript">
                    checkHD("<?php echo $has_heart_disease ?>");
                    </script>
                </td>
            </tr>
            <tr>
                <td>Cancer:</td>
                <td>
                    <select name="canCheck" id="canCheck" onchange="checkCan()" required>
                    <?php
                        if($has_cancer == "no"){
                            echo '<option value="no" selected="selected">No</option>';
                            echo '<option value="yes">Yes</option>';
                        }
                        else{
                            echo '<option value="no">No</option>';
                            echo '<option value="yes" selected="selected">Yes</option>';
                        }
                    ?> 
                    </select>
                </td>
                <td>
                    <div id="canFamily"></div>
                    <script type="text/javascript">
                    checkCan("<?php echo $has_cancer ?>");
                    </script>
                </td>
            </tr>
            <tr>
                <td>Stroke:</td>
                <td>
                    <select name="stroCheck" id="stroCheck" onchange="checkStro()" required>
                    <?php
                        if($has_stroke == "no"){
                            echo '<option value="no" selected="selected">No</option>';
                            echo '<option value="yes">Yes</option>';
                        }
                        else{
                            echo '<option value="no">No</option>';
                            echo '<option value="yes" selected="selected">Yes</option>';
                        }
                    ?>
                    </select>
                </td>
                <td>
                    <div id="stroFamily"></div>
                    <script type="text/javascript">
                    checkStro("<?php echo $has_stroke ?>");
                    </script>
                </td>
            </tr>
            <tr>
                <td>Other:</td>
                <td>
                    <select name="otherCheck" id="otherCheck" onchange="checkOther()" required>
                    <?php
                        if($has_other == "no"){
                            echo '<option value="no" selected="selected">No</option>';
                            echo '<option value="yes">Yes</option>';
                        }
                        else{
                            echo '<option value="no">No</option>';
                            echo '<option value="yes" selected="selected">Yes</option>';
                        }
                    ?>
                    </select>
                </td>
                <td>
                    <div id="otherFamily"></div>
                    <script type="text/javascript">
                    checkStro("<?php echo $has_other ?>");
                    </script>
                </td>
            </tr>
        </table>
        <button type="submit">Save and Next Page</button>
    </form>
</body>
</html>