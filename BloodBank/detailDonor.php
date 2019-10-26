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
      if($type=="Employee"||$type=="Manager"||$id=$ids){
          $flag=1;
      }
  }
  include('server.php');
  $query="Select * from Donor Where donor_id = $ids";
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
        <center>
        <?php if ($flag==1) : ?>
        <table border="0">
            <caption>Donor</caption>
            <tbody>
                <tr>
                <td>Donor_ID</td>  <td><?php echo $row['Donor_id'];?></td>
                </tr>
                <tr>
                <td>Name</td>  <td><?php echo $row['Name']?></td>
                </tr>
                 <tr>
                <td>DoB</td>  <td><?php echo $row['DoB']?></td>
                </tr>
                 <tr>
                <td>Gender</td>  <td><?php echo $row['Sex']?></td>
                </tr>
                 <tr>
                <td>Blood_type</td>  <td><?php echo $row['blood_type']?></td>
                </tr>
                 <tr>
                <td>City</td>  <td><?php echo $row['Address']?></td>
                </tr>
                 <tr>
                <td>Phone</td>  <td><?php echo $row['Phone']?></td>
                </tr>
<?php if( $type=="Employee"||$type=="Manager"  ){
    $ids=$row['Donor_id'];
    echo "<tr><td><a href='assets/delete.php?id=$ids'>Delete Donor</a></td><td><a href='assets/addblood.php?id=$ids'>Donated Blood</a></td></tr>";
} ?>
            </tbody>>
        </table>
<?php else : ?>
    <h2>No result found<h2><br><a href='index.php'>Home</a>
<?php endif; ?>
        </center>
    </body>
</html>
                    
     