<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- 
This view is used to display user details from the database
The inputs are validated, the ones that aren't optional have the required attribute
they also use the type attribute to enforce a type.
Some input have a pattern which enforce a certain format on the user input.
The select tags have if statements to set the right value.
 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="<?php echo base_url('application/public/js/userdetails.js')?>"></script>
    <title>Update Questionaire</title>
</head>
<body>
<form action="update_questionaire/sendUserData" method="POST">
    <label>Title:</label>
    <input name="title" type="text" value="<?php echo $title?>" required>
    <br>

    <label>Name(s):</label>
    <input name="firstname" type="text" value="<?php echo $firstname?>" required>
    <br>

    <label>Surname:</label>
    <input name="surname" type="text" value="<?php echo $surname?>" required>
    <br>

    <label>Date of Birth:</label>
    <input name="dob" type="date" value="<?php echo $dob?>" required>
    <br>

    <label>Marital Status:</label>
    <select name="marriage" value="<?php echo $marital_status?>">
        <option value="Single">Single</option>
        <option value="Sarried">Married</option>
        <option value="Divorced">Divorced</option>
        <option value="Civil Partnership">Civil Partnership</option>
        <option value="Other">Other</option>
    </select>
    <br>

    <label>Address:</label>
    <input name="address" value="<?php echo $address?>" required>
    <br>

    <label>Postcode:</label>
    <input name="postcode" value="<?php echo $postcode?>" required>
    <br>

    <label>Mobile:</label>
    <input name="mobile" type="tel" pattern="0[0-9]{10}" value="<?php echo $mobile?>" required>
    <br>

    <label>Home Telephone:</label>
    <input name="homeTelephone" type="tel" pattern="0[0-9]{10}" value="<?php echo $home_telephone?>" required>
    <br>

    <label>SMS Contact:</label>
    <select name="smsCon" value="<?php echo $SMS_YN?>">
        <option value="No">No</option>
        <option value="Yes">Yes</option>
    </select>
    <br>

    <label>Email:</label>
    <input name="email" type="email" value="<?php echo $email?>">
    <br>

    <label>Email Contact:</label>
    <select name="emailCon" value="<?php echo $email_yn?>">
        <option value="No">No</option>
        <option value="Yes">Yes</option>    
    </select>
    <br>

    <label>Occupation:</label>
    <input name="occupation" type="text" value="<?php echo $occupation?>">
    <br>

    <?php
        echo '<div id="genderBox">';
        echo '<label>Gender:</label>';
        if(strpos($gender, 'Other') !== false){
            $genderArray = explode('-' , $gender);
            
            $genderExp = $genderArray[0];
            $otherSpecify = $genderArray[1];
            echo '<select id="gender" name="gender"';
            echo<<<_END
            " onchange="genderCheck('
            _END;
            echo $otherSpecify;
            echo<<<_END
            ')">
            _END;
            echo '<option value="Male">Male</option>';
            echo '<option value="Female">Female</option>';
            echo '<option value="Non-Binary">Non-Binary</option>';
            echo '<option value="Other" selected="selected">Other</option>';
            echo '<script type="text/javascript">genderCheck("';
            echo $otherSpecify;
            echo '");</script>';
        }
        if($gender == "Male"){
            echo '<select id="gender" name="gender" onchange="genderCheck()">';
            echo '<option value="Male" selected="selected">Male</option>';
            echo '<option value="Female">Female</option>';
            echo '<option value="Non-Binary">Non-Binary</option>';
            echo '<option value="Other">Other</option>';
        }
        if($gender == "Female"){
            echo '<select id="gender" name="gender" onchange="genderCheck()">';
            echo '<option value="Male">Male</option>';
            echo '<option value="Female" selected="selected">Female</option>';
            echo '<option value="Non-Binary">Non-Binary</option>';
            echo '<option value="Other">Other</option>';
        }
        if($gender == "Non-Binary"){
            echo '<select id="gender" name="gender" onchange="genderCheck()">';
            echo '<option value="Male">Male</option>';
            echo '<option value="Female">Female</option>';
            echo '<option value="Non-Binary" selected="selected">Non-Binary</option>';
            echo '<option value="Other">Other</option>';
        }
        echo '</select>';
        echo '</div>';
        echo '<br>';
    ?>

    <label>Weight:</label>
    <input name="weight" type="number" placeholder="in KG" value="<?php echo $weight?>" required>
    <br>

    <label>Height:</label>
    <input name="height" type="number" placeholder="in CM" value="<?php echo $height?>" required>
    <br>

    <label>Kin Name:</label>
    <input name="kinName" type="text" value="<?php echo $kin_name?>" required>
    <br>

    <label>Kin Relationship:</label>
    <input name="kinRel" type="text" value="<?php echo $kin_relationship?>" required>
    <br>

    <label>Kin Telephone:</label>
    <input name="kinNum" type="tel" pattern="0[0-9]{10}" value="<?php echo $kin_telephone?>" required>
    <br>
    <button type="submit">Save and Next Page</button>
</form>
</body>
</html>