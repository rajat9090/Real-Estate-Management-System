<?php
session_start();
include_once 'buslogic.php';
if(!isset($_SESSION["ucod"]))
{
    header("location:index.php");
}
if(isset($_REQUEST["pcod"]))
{
    $_SESSION["pcod"]=$_REQUEST["pcod"];
}
//if(!isset($_REQUEST["pcod"]))
//{
//    header("location:frmsrc.php");
//}
if(isset($_POST["btnsub"]))
{
    
    $obj=new clsapp();
    $obj->appnam=$_POST["txtnam"];
    $obj->appdat=$_POST["txtdate"];
    $obj->appdsc=$_POST["txtdsc"];
    $obj->appphn=$_POST["txtphone"];
    $obj->appprpcod=$_SESSION["pcod"];
    $obj->appsts='B';
    $obj->appusrcod=$_SESSION["ucod"];
    $aa= $obj->save_rec();
    if($aa==TRUE)
    {
        $msg="<b>Appointment Booked Successfully.Agent will contact you soon.</b>";
    }
 else {
        $msg="<b>Appointment Not Booked Successfully.</b>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head runat="server">
<link href="css/style.css" rel="stylesheet">
  <meta charset="utf-8">
  <title> Real Estate</title>
  <script>
   
function validate_register()
{
   // alert('hello');
   
     var re =/^\d{10}$/;
     var txtnam = document.getElementById('txtnam').value;
     var txtdat = document.getElementById('txtdat').value;
    var txtphone = document.getElementById('txtphone').value;
    var txtdsc = document.getElementById('txtdsc').value;



if (txtnam == '')
{
document.getElementById('nam').innerHTML="Please Enter Your Name";
return false;
}
if (txtnam.length<2)
{
document.getElementById('nam').innerHTML="Name is too Short";
return false;
}
if (!isNaN(txtnam))
{
document.getElementById('nam').innerHTML="Please Enter Valid Name";
return false;
}
if (!/^[a-zA-Z ]{2,30}$/.test(txtnam))
{
document.getElementById('nam').innerHTML="Please Enter Valid Name";
return false;
}
else{
  document.getElementById('nam').innerHTML="";
}
if (txtdat == '')
{
document.getElementById('dat').innerHTML="Please Enter Date";
return false;
}
else{
  document.getElementById('dat').innerHTML="";
}
if (txtphone == '')
{
document.getElementById('phon').innerHTML="Please enter valid Phone Number";
return false;
}
if (isNaN(txtphone))
{
document.getElementById('phon').innerHTML="Please enter valid Phone Number";
return false;
}
if (txtphone.length<10)
{
document.getElementById('phon').innerHTML="Please enter valid Phone Number";
return false;
}
if (txtphone.length>10)
{
document.getElementById('phon').innerHTML="Please enter valid Phone Number";
return false;
}
if((txtphone.charAt(0)!=9) && (txtphone.charAt(0)!=8) && (txtphone.charAt(0)!=7) && (txtphone.charAt(0)!=6))
  {
document.getElementById('phon').innerHTML="Please enter valid Phone Number";
return false;
}
else{
  document.getElementById('phon').innerHTML="";
}
if (txtdsc == '')
{
document.getElementById('des').innerHTML="Please enter Description";
return false;
}
if (txtdsc.length<10)
{
document.getElementById('des').innerHTML="Message is too Short";
return false;
}
if (!isNaN(txtdsc))
{
document.getElementById('des').innerHTML="Please enter Valid Message";
return false;
}
if (!/^[a-zA-Z ]{2,30}$/.test(txtdsc))
{
document.getElementById('des').innerHTML="Please enter Valid Meassage";
return false;
}
else{
  document.getElementById('des').innerHTML="";
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
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
  
  
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
          <h3>Book Appointment</h3>
                  </header>
   
     <form action="frmapp.php" method="post" autocomplete="off" onsubmit="return validate_register()" >
     <div class="col-md-6  cty-frm    form-line">
                        <div class="form-group">
                            <label for="exampleInputUsername">Name</label>
                            <input type="text" name="txtnam" id="txtnam" placeholder="Your Name"  value="" class="form-control"/>
                            <span id="nam" class="text-danger font-weight-bold"></span>
</div>
                        
                        <div class="form-group">
                            <label for="exampleInputUsername">Suitable Date</label>
<!--                            <input type="text" name="txtcty" value="" class="form-control"/>-->
                            <input type="date" name="txtdate" id="txtdat"   value="" class="form-control"/>
                            <script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#txtdat').attr('min',today);
</script>
                            <span id="dat" class="text-danger font-weight-bold"></span>
                        </div>
        <div class="form-group">
                            <label for="exampleInputUsername">Phone No</label>
<!--                            <input type="text" name="txtcty" value="" class="form-control"/>-->
                            <input type="number" name="txtphone" id="txtphone" value="" maxlength="10"placeholder="Your Mobile Number" class="form-control"/>
                            <span id="phon" class="text-danger font-weight-bold"></span>
                        </div>
        <div class="form-group">
                            <label for="exampleInputUsername">Description</label>
                            <textarea class="form-control" name="txtdsc" id="txtdsc" rows="4" cols="20" placeholder="Message"></textarea>
                            <span id="des" class="text-danger font-weight-bold"></span>
                        </div>
        <div class="form-group">
                           <?php
                           if(isset($msg))
                           {
                               echo $msg;
                           }
                           ?>
<!--                            <label class="form-control" name="lblcrd"  id="lblcrd" size="30"></label>-->
                             <input type="hidden" name="Hidden1" id="Hidden1" class="form-control">
          
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