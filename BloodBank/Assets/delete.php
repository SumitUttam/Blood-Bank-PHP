<?php 
  session_start(); 
    $type="";
    $flag=1;
  if (isset($_SESSION['username'])) {
      $id=$_SESSION['id'];
      $type=$_SESSION['type'];
  }
  if (isset($_GET['id'])){
    $ids=(int)$_GET['id'];
    include('../Server.php');
    $dsql="select * from donor where donor_id = $ids";
    $result=mysqli_query($db,$dsql);
    $row=mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result)!=1){
        $flag=2;
    }
    if ($type!="Employee"&&$type!="Manager"){
        $flag=0;
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <div id="mainwrapper">
<header> 
    <div id="logo">BloodBank.Org</div>
    <nav>Add Blood</nav>
</header>
<div class="content">
      <div class="error success" >
      	<h3>
          <?php 
if ($flag==1){
    if(mysqli_query($db,"delete from donor where donor_id = $ids")){
        echo "Data Deleted";}
    else{
        echo "Error: ". mysqli_error($db);
    }}
    elseif($flag==2){
        echo "This Donor id doesnot exsist";
    }
    elseif($flag==0){
        echo "You Are not authorised personal";
    }
          ?>
      	</h3>
      </div>
</div>
<h4><a href="../index.php">Home</a></h4>
		
</body>
</html>