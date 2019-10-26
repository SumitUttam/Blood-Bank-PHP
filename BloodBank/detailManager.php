<?php 
  session_start(); 
  $type="";
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $type = $_SESSION['type'];
    $id = $_SESSION['id'];
  }
  $flag=0;
  if(isset($_GET['id'])) {
      $ids=$_GET['id'];
      if($type=="Manager"||$id=$ids){
          $flag=1;
      }
  }
  include('server.php');
  $query="Select * from Employee Where Emp_id=$ids";
  $result=mysqli_query($db,$query);
  if (mysqli_num_rows($result) < 1){
    $flag=0;
  }
  $row=mysqli_fetch_assoc($result);
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
    <nav>Donor Details</nav>
</header>
    <body>
        <center>
        <table border="0">
            <caption>Employee</caption>
            <tbody>
                <tr>
                <td>Employee_ID</td>  <td><?php echo $row['Emp_id'] ?></td>
                </tr>
                <tr>
                <td>Name</td>  <td><?php echo $row['Name'] ?></td>
                </tr>
                 <tr>
                <td>Salary</td>  <td><?php echo $row['Salary'] ?></td>
                </tr>
                 <tr>
                <td>Designation</td>  <td><?php echo $row['Designation'] ?></td>
                </tr>
                 
                 <tr>
                <td>City</td>  <td><?php echo $row['Address'] ?></td>
                </tr>
                 <tr>
                <td>Phone</td>  <td><?php echo $row['Phone'] ?></td>
                </tr>
            </tbody>>
        </table>
        </center>
    </body>
</html>