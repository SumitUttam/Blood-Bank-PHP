<?php 
  session_start(); 

  if (isset($_SESSION['username'])) {
      $id=$_SESSION['id'];
      $type=$_SESSION['type'];
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2><a href="index.php">Home Page</a></h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    
    <?php  if (isset($_GET['id'])) : ?>
    	<p>Welcome <strong>your <?php $ids=$_GET['id']; echo "id is $ids"; ?></strong></p>
        <p>Use this Id and your password to login</p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php  elseif (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?> as a <?php echo "$type id is $id"; ?></strong></p>
        <p>Use this Id and your password to login</p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>