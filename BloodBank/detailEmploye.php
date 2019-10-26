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
  $query="Select * from Employee";
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
    <nav>Employees</nav>
</header>
<br>
        <center>
        <?php if (($type=="Manager")&&$flag!=0) : ?>
        <table border = 1 >
            <caption>Employee</caption>
            <thead>
                <th>Employee_id</th>
                <th>Name</th>
                <th>Salary</th>
                <th>Designation</th>
                <th>Bank no</th>
                <th>City</th>
                <th>Phone</th>
                
            </thead>
            <tbody>
            <?php
            while($row=$result->fetch_assoc()){
               echo "<tr>";
               echo     "<td>".$row['Emp_id']."</td>";
            echo "<td>".$row['Name']."</td>";
               echo "<td>".$row['Salary']."</td>";
               echo "<td>".$row['Designation']."</td>";
              echo "<td>".$row['Bank_no']."</td>";
               echo "<td>".$row['Address']."</td>";
                echo "<td>".$row['Phone']."</td>";
                echo"<td><a href=detailEmployee.php?id=".(int)$row['Emp_id'].">View</a></td></tr>";
            }
                ?>
        </table>
        <?php endif; ?>
        </center>
    </body>
</html