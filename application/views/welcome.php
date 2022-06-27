<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $appName;?></title>
</head>
<body>

<div id="container">
	<h1><?php echo "Welcome to the " .$appName. " Portal";?></h1>
	<div id="body">
		<!-- buttons allow the user to login or sign up -->
		<button onclick="location.href='<?php echo base_url('index.php/signup')?>'">Sign Up</button>
		<button onclick="location.href='<?php echo base_url('index.php/login')?>'">Login</button>	
	</div>	
	
</div>

</body>
</html>