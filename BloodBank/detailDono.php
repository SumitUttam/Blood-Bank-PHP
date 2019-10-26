<?php 
  session_start(); 
    $type="";
    $flag=1;

  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $type = $_SESSION['type'];
    $id = $_SESSION['id'];
  }
  include('server.php');
  if(isset($_POST['search'])){
      $nsearch = $_POST['name'];
      $query="Select * from donor where Name like '%$nsearch%'";
  }
  else{
  $query="Select * from Donor";}
  $result=mysqli_query($db,$query);
  if (mysqli_num_rows($result) < 1){
    $flag=0;
  }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Blood Bank Management System</title>
<link href="Style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="mainwrapper">
<header> 
    <div id="logo">BloodBank.Org</div>
    <nav>Donors</nav>
</header>
<br>
<center>
    <?php if (($type=="Employee"|| $type=="Manager")&&$flag!=0) : ?>
        <table border = 1  >
            <caption>Donor</caption>
            <thead>
                <th>Donor_ID</th>
                <th>Name</th>
                <th>DoB</th>
                <th>Sex</th>
                <th>Blood Type</th>
                <th>City</th>
                <th>Phone</th>
                <th>Last Donation Date</th>
                <th>Units Donated</th>
                <th></th>
            </thead>
            <tbody><?php
            while($row=$result->fetch_assoc()){
               echo "<tr>";
               echo     "<td>".$row['Donor_id']."</td>";
            echo "<td>".$row['Name']."</td>";
               echo "<td>".$row['DoB']."</td>";
               echo "<td>".$row['Sex']."</td>";
              echo "<td>".$row['blood_type']."</td>";
               echo "<td>".$row['Address']."</td>";
                echo "<td>".$row['Phone']."</td>";
                echo "<td>".$row['LastDonationDate']."</td>";
                echo "<td>".$row['Units']."</td>";
                echo"<td><a href=detailDonor.php?id=".(int)$row['Donor_id'].">View</a></td></tr>";
            }
                ?>
        </table>
        <form method="post" action="detaildono.php">
  	<div class="input-group">
  		<label>Search by name</label>
  		<input type="text" name="name" >
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="search">Search</button>
		</div>
	</form>
        <?php else : ?>
        <h3>0 Results</h3>
        <form method="post" action="detaildono.php">
  	<div class="input-group">
  		<label>Search by name</label>
  		<input type="text" name="name" >
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="search">Search</button>
		</div>
<?php endif;?>
        </center>
    </body>
</html>
                    
                