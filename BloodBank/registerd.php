<!-- A registeration form for donors -->
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
    <nav>Register Donor</nav>
</header>
<?php if ($type=="Employee" || $type=="Manager") : ?>
	
  <form method="post" action="registerd.php">
  	<?php include('errors.php'); ?>
	<div class="input-group">
  	  <label>Full Name</label>
  	  <input type="text" name="name">
  	</div>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Phone No.</label>
  	  <input type="number" name="number">
  	</div>
	<div class="input-group">
    <label>Gender</label>
  	<select name='gender'>
  		<option value="M" >M</option>
  		<option value="F">F</option>
  		<option value="others">others</option>
	  </select>
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
  	  <label>Date of Birth</label>
  	  <input type="date" name="dob">
  	</div>
	<div class="input-group">
  	  <label>Blood Group</label>
  	  <select name='blood'>
  		<option value="A+">A+</option>
  		<option value="B+">B+</option>
  		<option value="AB+">AB+</option>
	    <option value="O+">O+</option>
  		<option value="A-">A-</option>
  		<option value="B-">B-</option>
  		<option value="AB-">AB-</option>
	    <option value="O-">O-</option>
	  </select>
  	</div>
  	<div class="input-group">
  	  <label>City</label>
  	  <input type="text" name="address">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_donor">Register</button>
  	</div>
	<p><a href="index.php"> go home </a></p>
	</form>
	<?php else :?>
		<h2> you are not authorised to view this page <a href="index.php"> Go to home page </a> </h2>
<?php endif;?>

</div>
</body>
</html>
