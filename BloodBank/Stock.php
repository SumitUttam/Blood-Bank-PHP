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
  $query="Select Count(*) as stock,type,Bank_no from Blood Group by Bank_no,type ";
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
    <nav>Stock</nav>
</header>
<br>
        <center>
        <table border = 1 width=90% >
            <caption>Stock</caption>
            <thead>
                <th>Stock</th>
                <th>Bank_no</th>
                <th>Blood Type</th>
                <th>City</th>
<?php if($type=="Hospital") : ?>
                <th></th>
<?php endif;?>
               
            </thead>
            <tbody>
            <?php
            while($row=$result->fetch_assoc()){
               echo "<tr><td>".$row['stock']."</td>";
               echo "<td>".$row['Bank_no']."</td>";
               echo "<td>".$row['type']."</td>";
               $bno=$row['Bank_no'];
               $query="Select * from Bloodbank Where Bank_no = $bno";
               $results=mysqli_query($db,$query);
               $ro=mysqli_fetch_assoc($results);
               echo "<td>".$ro['Address']."</td>";
               if ($type=="Hospital"){
                $btype=$row['type'];
                $query="Select * from Blood where type='$btype' and bank_no=$bno ";
                $resul=mysqli_query($db,$query);
                $r=mysqli_fetch_assoc($resul);
                $ids=$r['Blood_id'];
               echo "<td><a href='order.php?id=$ids'>order</a></td>";
            }}
                ?>
        </table>
        <center>
    </body>
</html