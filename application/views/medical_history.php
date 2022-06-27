<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- links the external script to this view -->
    <script src="<?php echo base_url('application/public/js/medical_history.js')?>"></script>
    <title><?php echo $appName?></title>
</head>
<body>
    <!-- form that sends the data to the controller -->
    <form action="sendMedicalHistoryData" method="POST">
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
                    <option value="no">No</option>  
                    <option value="yes">Yes</option> 
                    </select>
                </td>
                <td>
                    <div id="hDFamily"></div>
                </td>
            </tr>
            <tr>
                <td>Cancer:</td>
                <td>
                    <select name="canCheck" id="canCheck" onchange="checkCan()" required>
                    <option value="no">No</option>  
                    <option value="yes">Yes</option> 
                    </select>
                </td>
                <td>
                    <div id="canFamily"></div>
                </td>
            </tr>
            <tr>
                <td>Stroke:</td>
                <td>
                    <select name="stroCheck" id="stroCheck" onchange="checkStro()" required>
                    <option value="no">No</option>  
                    <option value="yes">Yes</option> 
                    </select>
                </td>
                <td>
                    <div id="stroFamily"></div>
                </td>
            </tr>
            <tr>
                <td>Other:</td>
                <td>
                    <select name="otherCheck" id="otherCheck" onchange="checkOther()" required>
                    <option value="no">No</option>  
                    <option value="yes">Yes</option> 
                    </select>
                </td>
                <td>
                    <div id="otherFamily"></div>
                </td>
            </tr>
        </table>
        <!-- creates a button that submits the form -->
        <button type="submit">Next Page</button>
    </form>
</body>
</html>