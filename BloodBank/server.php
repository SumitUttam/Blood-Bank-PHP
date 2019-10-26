<?php
if (!isset($_SESSION)){
session_start();
}

if (isset($_SESSION['username'])){
    $id = $_SESSION['id'];  
}

// initializing variables
$username = "";
$errors = array();
date_default_timezone_set('Asia/Kolkata');


// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'blood_bank') Or die ("Cannot connect to database");

// REGISTER DONOR
if (isset($_POST['reg_donor'])) {
if(isset($_SESSION['username'])){
if ($_SESSION['type']=="Employee" || $_SESSION['type']=="Manager"){

  // receive all input values from the form
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $number = mysqli_real_escape_string($db, $_POST['number']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $dob = $_POST['dob'];
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);
  $blood = mysqli_real_escape_string($db, $_POST['blood']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($number)) { array_push($errors, "phone number is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($dob)) { array_push($errors, "Date of birth is required"); }
  else{
  $interval=strtotime(date("y-m-d")) - strtotime($dob);
  if (($interval/(3600*24*365)) < 18) { array_push($errors, "Donor should be above 18 to register"); }}
  if (empty($address)) { array_push($errors, "city is reqired"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM donor WHERE username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['Username'] === $username) {
      array_push($errors, "Username already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password =($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO donor (Name, Username, Phone, Password, DoB , Address, Blood_type, Sex) 
  			  VALUES('$name','$username', '$number', '$password', '$dob' ,'$address', '$blood', '$gender')";
    //mysqli_query($db, $query);
    if (mysqli_query($db, $query)) {
      echo "New record created successfully";
    } //else {
      //echo "Error: " . $query . "<br>" . mysqli_error($db);
}
//    header('location: index.php');
    
  }
else{
  array_push($errors, "You are not authorised to register Donor");
}}
else{
  array_push($errors, "You are not authorised to Donor");
}}

// REGISTER Employee
if (isset($_POST['reg_employee'])) {
  if(isset($_SESSION['username'])){
  if ($_SESSION['type']=="Manager"){
  
    // receive all input values from the form
    $name = mysqli_real_escape_string($db, $_POST['name']);
    //$username = mysqli_real_escape_string($db, $_POST['username']);
    $number = mysqli_real_escape_string($db, $_POST['number']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $doj = $_POST['doj'];
    $salary = mysqli_real_escape_string($db, $_POST['salary']);
    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($name)) { array_push($errors, "Username is required"); }
    if (empty($number)) { array_push($errors, "phone number is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if (empty($doj)) { array_push($errors, "Date of birth is required"); }
    if (empty($salary)) { array_push($errors, "salary is required"); }
    if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
    }
  
    $Branch_query="select * from employee where emp_id = '$id'";
    $result=mysqli_query($db, $Branch_query);
    $row=mysqli_fetch_assoc($result);
    $bank=$row["Bank_no"];
    $address=$row["Address"];
    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
      $password =($password_1);//encrypt the password before saving in the database
  
      $query = "INSERT INTO employee (Name, Phone, Password, DoJ , Address, Bank_no, Salary) 
            VALUES('$name', '$number', '$password', '$doj' ,'$address', '$bank', '$salary')";
      //mysqli_query($db, $query);
      if (mysqli_query($db, $query)) {
        echo "New record created successfully";
        $query = "select * from employee where name = '$name' and Phone = $number";
        $result= mysqli_query($db,$query);
        $row = mysqli_fetch_assoc($result);
        $ids=$row['Emp_id'];
        header("location: success.php?id='$ids'");
      } //else {
        //echo "Error: " . $query . "<br>" . mysqli_error($db);
  }
  //    header('location: index.php');
      
    }
  else{
    array_push($errors, "You are not authorised to register Donor");
  }}
  else{
    array_push($errors, "You are not authorised to Donor");
  }}
  

//Register Hospital
if (isset($_POST['reg_hospital'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['name']);
  $number = mysqli_real_escape_string($db, $_POST['number']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($address)) { array_push($errors, "City is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($number)) { array_push($errors, "Phone number is required"); }
  if ($password_1 != $password_2) {
  array_push($errors, "The two passwords do not match");
  }
  // first check the database to make sure 
  // a user does not already exist with the same username
  $user_check_query = "SELECT * FROM hospital WHERE name='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['Name'] === $username) {
      array_push($errors, "Username already exists");
  }}

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = ($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO hospital (Name, Address, password, Phone) 
  			  VALUES('$username', '$address', '$password','$number')";
    mysqli_query($db, $query);
    $query = "select * from hospital where name = '$username'";
    $result= mysqli_query($db,$query);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $username;
    $_SESSION['id'] = (int)$row['Hospital_id'];
    $_SESSION['success'] = "You are now logged in";
    $_SESSION['type'] = "hospital";
    header('location: success.php');
    
  }
}




// LOGIN DONOR
if (isset($_POST['login_Donor'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = ($password);
        $query = "SELECT * FROM Donor WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $row=mysqli_fetch_assoc($results);
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          $_SESSION['type'] = "Donor";
          $_SESSION['id'] = (int)$row['Donor_id'];
          header('location: index.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
//Login Employee
  if (isset($_POST['login_Employee'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $query = "SELECT * FROM employee WHERE emp_id='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $row=$results-> fetch_assoc();
          $_SESSION['username'] = $row["Name"];
          $_SESSION['success'] = "You are now logged in";
          $_SESSION['id']=(int)$row['Emp_id'];
          $_SESSION['type'] = $row['Designation'];
          header('location: index.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
  
  
// LOGIN Hospital
if (isset($_POST['login_Hospital'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
      array_push($errors, "Username is required");
  }
  if (empty($password)) {
      array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
      $query = "SELECT * FROM Hospital WHERE Hospital_id=$username AND password='$password'";
      $results = mysqli_query($db, $query);
      if (mysqli_num_rows($results) == 1) {
        $row=mysqli_fetch_assoc($results);
        $_SESSION['success'] = "You are now logged in";
        $_SESSION['type'] = "Hospital";
        $_SESSION['id'] = (int)$username;
        $_SESSION['username'] = $row['Name'];
        header('location: index.php');
      }else {
          array_push($errors, "Wrong username/password combination");
      }
  }
}
  ?>