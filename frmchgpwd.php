<?php
session_start();
include_once 'buslogic.php';
if(!isset($_SESSION["ucod"]))
{
    //echo "<script>alert('Please Login First')</script>";
    header("location:index.php");
}

if(isset($_POST["btnsub"]))
{
    
    if($_POST["txtnewpwd"]==$_POST["txtconpwd"])
    {
        $obj=new clsusr();
        $a=$obj->chgpwd($_SESSION["ucod"], $_POST["txtoldpwd"], $_POST["txtnewpwd"]);
        
        if($a==1)
            $msg="Password updated successfully.";
        else 
            $msg="Old Password Incorrect.";
 }
    else
        $msg="Password & Confirm Password do not match.";
}


?>
<!DOCTYPE html>
<html lang="en">
<head runat="server">
  <meta charset="utf-8">
  <title>Real Estate</title>
   <script>
   function validate1()
 {


var txtoldpwd = document.getElementById('txtoldpwd').value;
var txtnewpwd = document.getElementById('txtnewpwd').value;
var txtconpwd = document.getElementById('txtconpwd').value;

if (txtoldpwd == '')
{
document.getElementById('txtoldpwd').focus();
alert("Please enter old Password");
return false;
}
if (txtnewpwd == '')
{
document.getElementById('txtnewpwd').focus();
alert("Please enter New Password");
return false;
}
if(txtnewpwd.length!="")
{
if(txtnewpwd.length > 10)
{
document.getElementById('txtnewpwd').focus();
alert("Please Enter Less than 10 Character");
return false;
}else if(txtnewpwd.length < 6)
{
document.getElementById('txtnewpwd').focus();
alert("You Enter Lass than 6 Character");
return false;
}
}
if(txtconpwd=='')
{
document.getElementById('txtconpwd').focus();
alert("Please enter confirm password");
return false;
} 
if(txtnewpwd !=txtconpwd)
{ 
document.getElementById('txtconpwd').focus();
alert("Password and confirm password must be match");
return false;
}



}
</script>
  <script>
  function abc(a)
{
window.location="frmrev.php?ccod="+a;
}
  function xyz(b)
{
    
window.location="frmsrc.php?lcod="+b;
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
                         // echo "<li><a href=frmrev.php>Write Review</a></li>";
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
          <h3>Change Password</h3>
                  </header>
   
     <form action="frmchgpwd.php" method="post" onsubmit="return validate1()">
    <div class="col-md-6  cty-frm    form-line">
                 
        <div class="form-group">
                            <label for="exampleInputUsername">Old Password</label>
<!--                            <input type="text" name="txtcty" value="" class="form-control"/>-->
                            <input type="password" name="txtoldpwd" id="txtoldpwd" value="" class="form-control"/>
                            
                        </div>
          <div class="form-group">
                            <label for="exampleInputUsername">New Password</label>
<!--                            <input type="text" name="txtcty" value="" class="form-control"/>-->
                            <input type="password" name="txtnewpwd" id="txtnewpwd" value="" class="form-control"/>
                            
                        </div>
        <div class="form-group">
                            <label for="exampleInputUsername">Confirm Password</label>
<!--                            <input type="text" name="txtcty" value="" class="form-control"/>-->
                            <input type="password" name="txtconpwd" id="txtconpwd" value="" class="form-control"/>
                            
                        </div>
        <div class="form-group">
            <label for="exampleInputUsername">
                <?php
                if(isset($msg))
                {
                    echo "$msg";
                }
                ?>
            </label>
<!--                            <input type="text" name="txtcty" value="" class="form-control"/>-->
                           
                            
                        </div>
          
        
                    
                        <div>
                            <input type="submit" name="btnsub" class="btn btn-default submit" value="Submit"/>
                           
                               
                            </div>
       


      </div>

        <div>

         
  
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