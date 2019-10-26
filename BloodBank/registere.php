<?php 
	session_start(); 
	$type="";

  if (isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
		$type=$_SESSION['type'];
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
    <nav>Register Employee</nav>
</header>
<?php if ($type=="Manager") : ?>
	
  <form method="post" action="registere.php">
  	<?php include('errors.php'); ?>
	<div class="input-group">
  	  <label>Full Name</label>
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
  	  <label>Date of Joining</label>
  	  <input type="date" name="doj">
  	</div>
  	<div class="input-group">
  	  <label>Salary</label>
  	  <input type="number" name="salary">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_employee">Register</button>
  	</div>
	<p><a href="index.php"> go home </a></p>
	</form>
	<?php else :?>
		<h2> you are not authorised to view this page <a href="index.php"> Go to home page </a> </h2>
<?php endif;?>

</div>
</body>
</html>