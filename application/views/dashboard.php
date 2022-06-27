<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $appName?></title>
</head>
<body>
    <!-- creates a header that displays the users name on the dashboard -->
    <h1><?php echo "Welcome ".$_SESSION['username'];?></h1>
    <?php
    // Admins and Patients have different dashboards, this loads different dashboards
        if($adminCheck){
            // HEREdoc creates a HTML button through php
            echo <<<_END
            <button type="button" onclick="location.href='
            _END;
                echo base_url('index.php/Dashboard/questionaire_list');
            echo <<<_END
            '">View Questionaire List</button>  
            _END;

            echo <<<_END
            <button type="button" onclick="location.href='
            _END;

            echo base_url('index.php/Dashboard/show_graphs');

            echo <<<_END
            '">View Graphs</button>
            _END;

        }
        else{
            // if no status is set then the account is fresh or missing critical info
            if($status == ""){
                echo <<<_END
                <button type="button" onclick="location.href='
                _END;
                echo base_url('index.php/questionaire');
                echo <<<_END
                '">Complete Questionaire</button>
                _END;
            }
            else{
                echo <<<_END
                <button type="button" onclick="location.href='
                _END;
                echo base_url('index.php/update_questionaire');
                echo <<<_END
                '">Update Questionaire</button>
                _END;
            }
        }
        
    ?> 
    <!-- creates a button that calls a signout function -->
    <button type="button" onclick="location.href='<?php echo base_url('index.php/Dashboard/signOut')?>'">Sign Out</button>
    <?php
    // if the status is set and the user is not an admin, it will display an application status
        if($status != "" && !$adminCheck){
            echo "<p>You're application is ".$status."</p>";
        }
    ?>
</body>
</html>