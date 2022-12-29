<?php
session_start();
include_once 'buslogic.php';
if(!isset($_SESSION["ucod"]))
{
    header("location:index.php");
}
if(isset($_REQUEST["acod"]))
{
    $_SESSION["acod"]=$_REQUEST["acod"];
}
if(isset($_REQUEST["pcod"]))
{
    $_SESSION["pcod"]=$_REQUEST["pcod"];
}
if(isset($_POST["btnsub"]))
{
    $obj=new clsagtrev();
  $obj->agtrevagtcod=$_SESSION["acod"];
  
   $obj->agtrevprpcod=$_SESSION["pcod"];
   $obj->agtrevusrcod=$_SESSION["ucod"];
   $obj->agtrevdat= date("y-m-d");
   $obj->agtrevtit=$_POST["txttit"];
   $obj->agtrevscr=$_POST["r1"];
   $obj->agtrevdsc=$_POST["txtdsc"];
   $obj->save_rec();
   header("location:frmprf.php?acod=".$_SESSION["acod"]);
}
//if(isset($_REQUEST["pcod"]))
//{
//    $_SESSION["pcod"]=$_REQUEST["pcod"];
//}
//if(!isset($_REQUEST["pcod"]))
//{
//    header("location:frmsrc.php");
//}



?>
<!DOCTYPE html>
<html lang="en">
<head runat="server">
  <meta charset="utf-8">
  <title>Real Estate</title>
  <script>
  function abc(a)
{
window.location="frmrev.php?ccod="+a;
}

  function xyz(b)
{
    
window.location="frmsrc.php?lcod="+b;
}

     function validate()
     {

var txtti = document.getElementById('txttit').value;
// var txt = document.getElementById('r1').value;
// var txtdes = document.getElementById('txtdsc').value;

if (txtti == '')
{
document.getElementById('tit').innerHTML="Please enter Review Title";
return false;
}
if (txtti.length<4)
{
document.getElementById('tit').innerHTML="Review Title is too Short";
return false;
}
if (!isNaN(txtti))
{
document.getElementById('tit').innerHTML="Please enter Valid Title";
return false;
}
if (!/^[a-zA-Z ]{2,30}$/.test(txtti))
{
document.getElementById('tit').innerHTML="Please enter Valid Title";
return false;
}
else{
  document.getElementById('tit').innerHTML="";
}
}
  </script>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon1.png" rel="icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
  <!-- Bootstrap CSS File -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Libraries CSS Files -->
  <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">
  <link href="css/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="css/owl.carousel.min.css" rel="stylesheet">
 <link href="css/lightbox.min.css" rel="stylesheet">
  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
</head>
<body>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="#intro" class="scrollto"><img class="brand_logo" src="img/rems-logo.png" alt="error"/></a></h1>
      </div>
       
      <nav id="nav-menu-container">
              <ul class="nav-menu">
            <li class="menu-active"><a href="index.php">Home</a></li>
          <li><a href="frmsrc.php">Search</a></li>
                      <li><a href="frmagt.php">Agents</a></li>
                      <?php
                      if(isset($_SESSION["ucod"]))
                      {
                          echo "<li><a href=frmfav.php>Favourites</a></li>";
                          //echo "<li><a href=frmrev.php>Write Review</a></li>";
                      }
 else {
     
 }
                  ?>
<!--          <li><a href="#contact">Contact</a></li>-->
 <li><a href="frmchgpwd.php">Change Password</a></li>
                  
                   <?php
                  if(isset($_SESSION["ucod"]))
                  {
                   echo  "<a href=index.php?sts=S>Signout</a>";  
                  }
 else {
//                echo  "<li><a href=# data-toggle=modal data-target=#login-sec>Login</a></li>";
//                echo "<li><a href=# data-toggle=modal data-target=#signup-sec>Signup</a></li>";
 }
                          ?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  

  <main id="main">
    
    <section id="about">
      <div class="container">
 <div class="map-bgs">
    
<header class="section-header">
          <h3>Write Review</h3>
                  </header>
   
     <form action="frmrev.php" name="f1" method="post" onsubmit="return validate()" >
    <div class="col-md-6  cty-frm    form-line">
                 
        <div class="form-group">
                            <label for="exampleInputUsername">Review Title</label>
                 
                            <input type="text" name="txttit" id="txttit"  value="" required class="form-control"/>
                            <span id="tit" class="text-danger font-weight-bold"></span>
                        </div>
          <div class="form-group">
                            <label for="exampleInputUsername">Rating</label>
                             <input type="radio" name="r1" id="r1"  value="1"/>1
<input type="radio" name="r1" value="2" required="required" />2
<input type="radio" name="r1" value="3" required="required"/>3
<input type="radio" name="r1" value="4" required="required"/>4
<input type="radio" name="r1" value="5" required="required"/>5
<span id="r2" class="text-danger font-weight-bold"></span> 
                        </div>
        <div class="form-group">
                            <label for="exampleInputUsername">Description</label>
                            <textarea class="form-control" name="txtdsc" id="txtdsc" required rows="4" cols="20"></textarea>
                            <span id="dsc" class="text-danger font-weight-bold"></span>
                        </div>
                        <div>
                            <input type="submit" name="btnsub" class="btn btn-default submit" value="Submit"/>
                            </div>
      </div>
        <!-- <div> -->
</form>

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
  

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong class="rems-sec">REMS</strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/main.js"></script>

  <script src="js/easing.min.js"></script>
  <script src="js/hoverIntent.js"></script>
  <script src="js/superfish.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/waypoints.min.js"></script>
  <script src="js/counterup.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/lightbox.min.js"></script>
  <script src="js/jquery.touchSwipe.min.js"></script>



  <!-- Template Main Javascript File -->
 

</body>
</html>