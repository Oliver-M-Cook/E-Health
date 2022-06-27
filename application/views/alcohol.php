<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- links the css file that makes the table look a little better -->
    <link rel="stylesheet" href="<?php echo base_url('application/public/css/alcohol.css')?>"/> 
    <title><?php echo $appName?></title>
</head>
<body>
    <!-- creates the form that will send the data to the controller -->
    <form action="sendAlcoholData" method="POST">
        <table>
            <tr>
                <th rowspan="2">Questions</th>
                <th colspan="5">Scoring System</th>
            </tr>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
            </tr>
            <?php
            // loops through each question
                for($i = 0; $i < sizeof($questions); $i++){
                    echo '<tr>';
                    // access the question and put it into the cell
                    echo '<td>'.$questions[$i][0].'</td>';
                    // loops through all the questions responses
                    for($j = 1; $j < sizeof($questions[$i]); $j++){
                        echo '<td>';
                        // if the data isn't blank then add the data into the cell
                        if($questions[$i][$j] != ""){
                            echo '<label>'.$questions[$i][$j].'</label><br>';
                            echo '<input type="radio" name="responseSet'.$i.'"value="'.$j.'" required>';
                        }
                        echo '</td>';
                    }
                    echo '</tr>';
                }
            ?>
        </table>
        <!-- creates a button that submits the form to the controller -->
        <button type="submit">Next Page</button>
    </form>
</body>
</html>