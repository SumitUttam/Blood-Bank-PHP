<?php include('server.php') ?>
<?php 
	$e="";
  if (isset($_GET['emp'])) {
		$log="Employee";
		$e="?emp='1'";
	}
	
  elseif (isset($_GET['hosp'])) {
		$log="Hospital";
		$e="?hosp='1'";
	}
	
  else {
		$log="Donor";
  }

?>
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo "$log Login";?></title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="mainwrapper">
<header> 
    <div id="logo">BloodBank.Org</div>
    <nav><?php echo $log ;?> Login</nav>
</header>
	 
  <form method="post" action="login.php<?php echo $e; ?>">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label><?php echo "$log id"?></label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="<?php echo "login_$log" ;?>">Login</button>
		</div>
		<?php if ($log == "Donor") : ?>
		<p>Not yet a member? contact our blood donation centers to register</p>
		<?php elseif ($log == "Hospital") : ?>
		<p>Not yet a member? <a href="registerh.php">Sign up</a></p>
		<?php endif ;?>
	</form>
</div>
</body>
</html>
