<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $appName?></title>
    <link rel="stylesheet" href="<?php echo base_url('application/public/css/userdetails.css')?>"/>
    <script src="<?php echo base_url('application/public/js/userdetails.js')?>"></script>
</head>
<body>
    <p>User Details</p>
    <!-- form to submit the data to the controller -->
    <form action="Completequest/sendUserData" method="POST">
        <label>Title:</label>
        <input name="title" type="text" required>
        <br>

        <label>Name(s):</label>
        <input name="firstname" type="text" required>
        <br>

        <label>Surname:</label>
        <input name="surname" type="text" required>
        <br>

        <label>Date of Birth:</label>
        <input name="dob" type="date" required>
        <br>

        <label>Marital Status:</label>
        <select name="marriage" required>
            <option value="Single">Single</option>
            <option value="Sarried">Married</option>
            <option value="Divorced">Divorced</option>
            <option value="Civil Partnership">Civil Partnership</option>
            <option value="Other">Other</option>
        </select>
        <br>

        <label>Address:</label>
        <input name="address" required>
        <br>

        <label>Postcode:</label>
        <input name="postcode" required>
        <br>

        <label>Mobile:</label>
        <input name="mobile" type="tel" pattern="0[0-9]{10}" required>
        <br>

        <label>Home Telephone:</label>
        <input name="homeTelephone" type="tel" pattern="0[0-9]{10}" required>
        <br>

        <label>SMS Contact:</label>
        <select name="smsCon">
            <option value="No">No</option>
            <option value="Yes">Yes</option>
        </select>
        <br>

        <label>Email:</label>
        <input name="email" type="email">
        <br>

        <label>Email Contact:</label>
        <select name="emailCon">
            <option value="No">No</option>
            <option value="Yes">Yes</option>    
        </select>
        <br>

        <label>Occupation:</label>
        <input name="occupation" type="text">
        <br>
        <div id="genderBox">
            <label>Gender:</label>
            <select id="gender" name="gender" onchange = "genderCheck('')" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Non-Binary">Non-Binary</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <br>

        <label>Weight:</label>
        <input name="weight" type="number" placeholder="in KG" required>
        <br>

        <label>Height:</label>
        <input name="height" type="number" placeholder="in CM" required>
        <br>

        <label>Kin Name:</label>
        <input name="kinName" type="text" required>
        <br>

        <label>Kin Relationship:</label>
        <input name="kinRel" type="text" required>
        <br>

        <label>Kin Telephone:</label>
        <input name="kinNum" type="tel" pattern="0[0-9]{10}" required>
        <br>

        <button type="submit">Next Page</button>
    </form>
</body>
</html>