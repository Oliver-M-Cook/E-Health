<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Questionaire</title>
    <link rel="stylesheet" href="<?php echo base_url('application/public/css/userdetails.css')?>"/>
    <script src="<?php echo base_url('application/public/js/userdetails.js')?>"></script>
</head>
<body>
    <!-- form sends the data to the controller -->
    <form action="view_questionaire/changeStatus" method="POST">
    <?php
    // displays all the user details
        echo '<h4>User Details</h4>';
        echo '<p>Title: '.$userDetails['title'].' | Firstname: '.$userDetails['firstname'].' | Surname: '.$userDetails['surname'].'</p>';
        echo '<p>Date of Birth: '.$userDetails['dob'].' | Marital Status: '.$userDetails['marital_status'].'</p>';
        echo '<p>Address: '.$userDetails['address'].' | Postcode: '.$userDetails['postcode'].'</p>';
        echo '<p>SMS Communication: '.$userDetails['SMS_YN'].'</p>';
        echo '<p>Email Address: '.$userDetails['email'].' | Occupation: '.$userDetails['occupation'].'</p>';
        echo '<p>Email Communication: '.$userDetails['email_yn'].'</p>';
        echo '<p>Gender: '.$userDetails['gender'].'</p>';
        echo '<p>Height: '.$userDetails['height'].' | Weight: '.$userDetails['weight'].'</p>';

        echo '<h4>Next of Kin</h4>';
        echo '<p>Name: '.$userDetails['kin_name'].' | Relationship: '.$userDetails['kin_relationship'].' | Telephone: '.$userDetails['kin_telephone'].'</p>';

        echo '<h4>Medication</h4>';
        echo '<p>Currently taking medication: '.$medication['Medication_YN'].'</p>';

        echo '<h4>Smoking Status</h4>';
        echo '<p>'.$smoking['smoke_status'].'</p>';

        echo '<h4>Alcohol Audit Score</h4>';
        echo '<p>'.$auditScore.'</p>';

        echo '<h4>Medical History</h4>';
        echo '<p>Heart Disease: '.$medical_history['has_heart_disease'].'</p>';
        echo '<p>Cancer: '.$medical_history['has_cancer'].'</p>';
        echo '<p>Stroke: '.$medical_history['has_stroke'].'</p>';
        echo '<p>Other: '.$medical_history['has_other'].'</p>';

        echo '<h4>Allergies</h4>';
        echo '<p>Has Allergies: '.$allergies.'</p>';

        echo '<h4>Lifestyle</h4>';
        echo '<p>Regular Exercise: '.$lifestyle['exercise'].'</p>';
        echo '<p>Diet: '.$lifestyle['diet'].'</p>';

        // if status is pending, the admin can reject or accept the application
        if($userDetails['status'] == "Pending"){
            echo '<button type="submit" name="action" value="accept">Accept</button>';
            echo '<button type="submit" name="action" value="reject">Reject</button>';
        }
    ?>
    <!-- the admin can also return to the dashboard if they change their mind -->
    <button type="submit" name="action" value="dashboard">Dashboard</button>
    </form>
</body>
</html>