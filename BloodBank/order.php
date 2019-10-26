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
    include('Server.php');
    $dsql="select * from blood where blood_id = $ids";
    $result=mysqli_query($db,$dsql);
    $row=mysqli_fetch_assoc($result);
    $btype=$row['Type'];
    if (mysqli_num_rows($result)!=1){
        $flag=0;
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
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
if ($flag==1&&$type="Hospital"){
    if(mysqli_query($db,"Insert into orders(type, blood_id, hospital_id) values ('$btype',$ids,$id)")){
        if(mysqli_query($db,"Delete from blood where blood_id=$ids")){
        echo "order placed";}
        else{
            echo "Error: ". mysqli_error($db);
        }
    }
    else{
        echo "Error: ". mysqli_error($db);
    }}
    elseif($flag==0){
        echo "Blood Bag with this id does not exsist";
    }
          ?>
      	</h3>
      </div>
</div>
<h4><a href="index.php">Home</a></h4>
		
</body>
</html>