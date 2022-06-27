<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?php echo base_url('application/public/css/alcohol.css')?>"/> 
    <title>Update Alcohol</title>
</head>
<body>
    <form action="sendAlcohol" method="POST">
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
                    echo '<td>'.$questions[$i][1].'</td>';
                    // loops through each response
                    for($j = 2; $j < sizeof($questions[$i]); $j++){
                        echo '<td>';
                        if($questions[$i][$j] != ""){
                            echo '<label>'.$questions[$i][$j].'</label><br>';
                            // checks to see if the response if equal to what the user entered
                            if($questions[$i][0] == $j-1){
                                // creates a radio input that is checked
                                echo '<input type="radio" name="responseSet'.$i.'"value="'.($j-1).'" checked>';
                            }
                            else{
                                echo '<input type="radio" name="responseSet'.$i.'"value="'.($j-1).'" required>';
                            }
                            
                        }
                        echo '</td>';
                    }
                    echo '</tr>';
                }
            ?>
        </table>
        <button type="submit">Save and Next Page</button>
    </form>
</body>
</html>