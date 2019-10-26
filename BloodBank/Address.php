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
  $query="Select * from Bloodbank";
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
    <nav>Blood Banks</nav>
</header>
<br>
        <center>
        <table border = 1 width=90% >
            <caption>Blood Bank</caption>
            <thead>
                <th>Bank_no</th>
                <th>Manager</th>
                <th>City</th>
                <th>Phone</th>
               
            </thead>
            <tbody>
            <?php
            while($row=$result->fetch_assoc()){
               echo "<tr>";
               echo "<td>".$row['Bank_no']."</td>";
               $bno=$row['Manager_id'];
               $results=mysqli_query($db,"select * from employee where emp_id=$bno ");
               $r=mysqli_fetch_assoc($results);
               echo "<td>".$r['Name']."</td>";
               echo "<td>".$row['Address']."</td>";
               echo "<td>".$row['Phone_no']."</td>";
            }
                ?>
        </table>
        <center>
    </body>
</html