<?php 
  session_start(); 
  $type="";
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $type = $_SESSION['type'];
    $id = $_SESSION['id'];
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.php");
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
  <header > 
    <div id="logo">BloodBank.Org</div>
<nav> 
  <?php if(!isset($_SESSION['username'])) : ?><a href='login.php' title='Donor Login'>Donor</a><a href="login.php?emp='1'" title='Employee login'>| Employee</a><a href="login.php?hosp='1'" title='Link'>| Hospital</a>
  <?php  else : ?><a href="index.php?logout='1'" style='color: red;'>logout <?php echo $username;?></a> <?php endif;?>
  
</nav>
</header>

  <div id="content">
    <div class="notOnDesktop"> 
      <!-- This search box is displayed only in mobile and tablet laouts and not in desktop layouts -->
      <input type="text" placeholder="Search">
    </div>
    <section id="mainContent"> 
      <!--************************************************************************
    Main Blog content starts here
    ****************************************************************************-->
      <h1><!-- Blog title --> Donate Blood</h1>
      <h3><!-- Tagline -->Give Blood Save Life</h3>
      <div id="bannerImage"><img src="Assets/images/db.jpg" alt=""/></div>
      <p></p>
      <aside id="authorInfo"> 
        <!-- The author information is contained here -->
        <h2>About us</h2>
        <p>Are you ready to save a life?</br>
            You can be one of our registered donors on our BloodBank</br>
            BloodBank.org a non-profit, non-commercial interface </br>
            was born out of our social commitment and our desire</br>
           to use the power of the Internet to help common people. </p>
      </aside>
    </section>
    <section id="sidebar"> 
      <!--************************************************************************
    Sidebar starts here. It contains a searchbox, sample ad image and 6 links
    ****************************************************************************-->
      <nav>
        <ul>
          <li><a href="Address.php" title="Link">Our Branches</a></li>
          <li><a href="detail<?php echo $type;?>.php?id=<?php echo $id?>" title="Link">View your details</a></li>
          <?php if ($type=="Employee"|| $type=="Manager") :?>
          <li><a href="registerd.php" title="Link">Register donor</a></li>
          <li><a href="detaildono.php" title="Donors">Donors</a></li>
          <li><a href="Stock.php" title="Link">Stock</a></li>
          <?php endif;?>
          <?php if ($type=="Manager") :?>
          <li><a href="detailemploye.php" title="Emloyees">Employees</a></li>
          <li><a href="registere.php" title="Link">Register Employee</a></li>
          <?php endif;?>
          <?php if ($type=="Hospital") :?>
          <li><a href="Stock.php" title="Link">Order Blood</a></li>
          <?php endif;?>
        </ul>
      </nav>
    </section>
    <footer> 
      <!--************************************************************************
    Footer starts here
    ****************************************************************************-->
      <article>
        <h3>User's speak</h3>
        <p>” To whomsoever saved my life – ‘Thank you’ I owe you my blood”</p>
        <center><p>-A small kid</p></center>
        
      </article>
      <article>
        <h3>Donor's speak</h3>
        <p>“It feels good, It makes me Proud, I am a blood donor.”</p>
        <center><p>-Anonymous</p></center>
      </article>
    </footer>
  </div>
  <div id="footerbar"><!-- Small footerbar at the bottom --></div>
</div>
</body>
</html>
