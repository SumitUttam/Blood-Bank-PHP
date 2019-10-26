<?php 
  session_start(); 
  $type="";
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $type = $_SESSION['type'];
    $id = (int)$_SESSION['id'];
  }
  $flag=0;
  if(isset($_GET['id'])) {
      $ids=(int)$_GET['id'];
      if($type==""){
          $flag=1;
      }
  }
  include('server.php');
  $query="Select * from Hospital Where hospital_id = $id";
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
    <nav>Hospital Details</nav>
</header>
        <center>
        <table border="0">
            <caption>Hospital</caption>
            <tbody>
                <tr>
                <td>Hospital_ID</td>  <td><?php echo $row['Hospital_id']; ?></td>
                </tr>
                <tr>
                <td>Name</td>  <td><?php echo $row['Name']; ?></td>
                </tr>
              
                <td>City</td>  <td><?php echo $row['Address']; ?></td>
                </tr>
                 <tr>
                <td>Phone</td>  <td><?php echo $row['Phone']; ?></td>
                </tr>
            </tbody>>
        </table>
        </center>
    </body>
</html>
     