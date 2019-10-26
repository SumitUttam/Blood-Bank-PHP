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
    $ldate=$row['LastDonationDate'];
    $unit=(int)$row['Units']+1;
    $btype=$row['blood_type'];
    $flag=1;
    if($ldate!=NULL){
    $interval=-(strtotime($ldate)-strtotime(date("y-m-d")))/(3600*24);
    if($interval<90){
        $flag=2;
    }}
    $esql="Select * from employee where emp_id=$id";
    $r=mysqli_fetch_assoc(mysqli_query($db,$esql));
    $bno=$r['Bank_no'];
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
    if(mysqli_query($db,"Insert into blood(type, bank_no) values ('$btype',$bno)")){
        if(mysqli_query($db,"Update donor set lastdonationdate=now(), units=$unit where donor_id=$ids")){
        echo "Data Entered";}
        else{
            echo "Error: ". mysqli_error($db);
        }
    }
    else{
        echo "Error: ". mysqli_error($db);
    }}
    elseif($flag==2){
        echo "90 days waiting period is not over";
    }
          ?>
      	</h3>
      </div>
</div>
<h4><a href="../index.php">Home</a></h4>
		
</body>
</html>