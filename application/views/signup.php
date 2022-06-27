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
    <!-- form that sends the data to the controller -->
    <form action="Signup/SendData" method="POST">
    <div>Enter username:</div>
    <input name="username" type="text" required>
    <br/>
    <div>Enter password:</div>
    <input name="password" type="password" required>
    <br/>
    <button type="button" onclick="location.href='<?php echo base_url('index.php')?>'">Cancel</button>
    <button type="submit">Submit</button>
</form>
</body>
</html>