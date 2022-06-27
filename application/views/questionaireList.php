<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- links the external script to this view -->
    <script src="<?php echo base_url('application/public/js/questionaireList.js')?>"></script>
    <title>Questionaire List</title>
</head>
<body>
    <?php
    if($patientList == null){
        echo '<p>No Patients have completed the questionaire</p>';
    }
    else{
        echo<<<_END
        <form action="./sendData" method="POST">
            <label>Patients:</label>
            <select name="patientSelect" id="patientSelect" onchange="displayStatus()" required>
        _END;
        foreach($patientList as $patient){
            echo<<<_END
            <option value="
            _END;
            echo $patient[0].'|'.$patient[2].'">';
            echo $patient[1];
            echo<<<_END
            </option>
            _END;
        }
        echo<<<_END
            </select>
            <div id="buttonBox">
            <button type="submit" name="action" value="viewQuestionaire">View Questionaire</button>
            </div>
            <p id="statusOutput"></p>
            <script type="text/javascript">
            displayStatus();
            </script>
        </form>
        _END;
    }
    ?>
    <button type="button" onclick="location.href='<?php echo base_url('index.php/Dashboard')?>'">Dashboard</button>
</body>
</html>