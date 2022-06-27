<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $appName?></title>
</head>
<body>
    <h1><?php echo $appName;?></h1>
    <!-- sends the data that the user entered -->
    <form action="Login/sendData" method="POST">
    <div>Enter username:</div>
    <!-- creates an input that is required  -->
    <input name="username" type="text" required>
    <br/>
    <div>Enter password:</div>
    <!-- creates an input field with the type 'password' -->
    <input name="password" type="password" required>
    <br/>
    <!-- creates a button that will take the user back to the index page -->
    <button type="button" onclick="location.href='<?php echo base_url('index.php')?>'">Cancel</button>

    <!-- creates a button that submits the form to the controller -->
    <button type="submit">Login</button>
</form>
</body>
</html>