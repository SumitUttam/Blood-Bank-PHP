<?php 
  session_start(); 

  if (isset($_SESSION['username'])) {
		header('location : index.php');
  }
?>
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="mainwrapper">
<header> 
    <div id="logo">BloodBank.Org</div>
    <nav>Register Hospital</nav>
</header>
  <form method="post" action="registerh.php">
  	<?php include('errors.php'); ?>
	<div class="input-group">
  	  <label>Hospital Name</label>
  	  <input type="text" name="name">
  	</div>
  	<div class="input-group">
  	  <label>Phone No.</label>
  	  <input type="number" name="number">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <label>City</label>
  	  <input type="text" name="address">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_hospital">Register</button>
  	</div>
	<p><a href="index.php"> go home </a></p>
	</form>


</div>
</body>
</html>