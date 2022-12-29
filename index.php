<?php
session_start();
include_once './buslogic.php';
if(isset($_REQUEST["sts"])&& $_REQUEST["sts"]=="S")
{
    unset($_SESSION["ucod"]);
}
if(isset($_POST["b1"]))
{
$obj=new clsusr();
$r=$obj->logincheck($_POST["txteml"], $_POST["txtpwd"]);

if($r==TRUE)
{
if($_SESSION["urol"]=='A')
header("location:agent/frmprf.php");
else if($_SESSION["urol"]=='D')
header("location:admin/frmcty.php");
else if($_SESSION["urol"]=='U')
{
    
       header("location:index.php");
}
}
else
{
    echo "<script>alert('Email Password Incorrect')</script>";

}
}
if(isset($_POST["b2"]))
{
   $obj1=new clsusr();
   $obj1->usrnam=$_POST["txtnm1"];
   $obj1->usrphon=$_POST["txtph1"];
   $obj1->usreml=$_POST["txteml1"];
   $obj1->usrpwd=$_POST["txtpwd1"];
   $obj1->usrregdat= date('y-m-d');
   $obj1->usrrol='U';
  
     $ab= $obj1->save_rec();
     if($ab==TRUE)
     {
         echo "<script>alert('Register Successfully')</script>";
     }
     else
     {
          echo "<script>alert('Email Id already Register')</script>";
     }
 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Real Estate</title>
    <script>
     function validate()
     {
var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
var txteml = document.getElementById('txteml').value;
var txtpwd = document.getElementById('txtpwd').value;


if (txteml == '')
{
document.getElementById('mail1').innerHTML="Please enter email address";
return false;
}
if(txteml.indexOf('@')<=0){
document.getElementById('mail1').innerHTML="Please enter valid email address";
return false;
}
if((txteml.charAt(txteml.length-4)!='.') && (txteml.charAt(txteml.length-3)!='.')) {
document.getElementById('mail1').innerHTML="Please enter valid email address";
return false;
}
 else if (!re.test(txteml))
{
document.getElementById('mail1').innerHTML="Please enter valid email address";
return false;
}
else{
  document.getElementById('mail1').innerHTML="";
}
if (txtpwd == '')
{
document.getElementById('pass1').innerHTML="Please enter Password";
return false;
}
if(txtpwd.length!="")
{
if(txtpwd.length > 10)
{
document.getElementById('pass1').innerHTML="Please Enter Less than 10 Character";
return false;
}else if(txtpwd.length < 6)
{
document.getElementById('pass1').innerHTML="You Enter Lass than 6 Character";
return false;
}
else{
  document.getElementById('pass1').innerHTML="";
}
}

}

     

function validate1()
 {
var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

var txtne = document.getElementById('txtnmm1').value;
var txthone = document.getElementById('txtphnn1').value;
var txteml = document.getElementById('txteml1').value;
var txtpwd = document.getElementById('txtpwd1').value;
var txtconpwd = document.getElementById('txtconpwd1').value;

if (txtne == '')
{
document.getElementById('nam11').innerHTML="Please Enter Your Name";
return false;
}
if (txtne.length<2)
{
document.getElementById('nam11').innerHTML="Name is too Short";
return false;
}
if (!isNaN(txtne))
{
document.getElementById('nam11').innerHTML="Please Enter Valid Name";
return false;
}
if (!/^[a-zA-Z ]{2,30}$/.test(txtne))
{
document.getElementById('nam11').innerHTML="Please Enter Valid Name";
return false;
}
else{
  document.getElementById('nam11').innerHTML="";
}
if (txthone == '')
{
document.getElementById('phon11').innerHTML="Please enter Phone Number";
return false;
}
if (isNaN(txthone))
{
document.getElementById('phon11').innerHTML="Invalid Phone Number";
return false;
}
if (txthone.length<10)
{
document.getElementById('phon11').innerHTML="Invalid Phone Number";
return false;
}
if (txthone.length>10)
{
document.getElementById('phon11').innerHTML="Invalid Phone Number";
return false;
}
if((txthone.charAt(0)!=9)&&(txthone.charAt(0)!=8)&&(txthone.charAt(0)!=7)&&(txthone.charAt(0)!=6))
  {
document.getElementById('phon11').innerHTML="Please enter valid Phone Number";
return false;
}
else{
  document.getElementById('phon11').innerHTML="";
}
if (txteml == '')
{
document.getElementById('mail').innerHTML="Please enter email address";
return false;
}
if(txteml.indexOf('@')<=0){
document.getElementById('mail').innerHTML="Please enter valid email address";
return false;
}
if((txteml.charAt(txteml.length-4)!='.') && (txteml.charAt(txteml.length-3)!='.')) {
document.getElementById('mail').innerHTML="Please enter valid email address";
return false;
}
if (!re.test(txteml))
{
document.getElementById('mail').innerHTML="Please enter valid email address";
return false;
}
else{
  document.getElementById('mail').innerHTML="";
}
if (txtpwd == '')
{
document.getElementById('pass').innerHTML="Please enter Password";
return false;
}
if(txtpwd.length!="")
{
if(txtpwd.length > 10)
{
document.getElementById('pass').innerHTML="Please Enter Less than 10 Character";
return false;
}if(txtpwd.length < 6)
{
document.getElementById('pass').innerHTML="You Enter Lass than 6 Character";
return false;
}
else{
  document.getElementById('pass').innerHTML="";
}
}
if(txtconpwd=='')
{
document.getElementById('cpass').innerHTML="Please enter confirm password";
return false;
} 
if(txtpwd !=txtconpwd)
{ 
document.getElementById('cpass').innerHTML="Password and confirm password must be match";
return false;
}
else{
  document.getElementById('cpass').innerHTML="";
}
}
function validate2()
 {
var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
var name = document.getElementById('name').value;
var txteml = document.getElementById('email').value;
var txtsub = document.getElementById('subject').value;
var txtphone = document.getElementById('phone').value;
var txtmess = document.getElementById('message').value;

if (name == '')
{
document.getElementById('nam').innerHTML="Please Enter Your Name";
return false;
}
if (name.length<2)
{
document.getElementById('nam').innerHTML="Name is too Short";
return false;
}
if (!isNaN(name))
{
document.getElementById('nam').innerHTML="Please Enter Valid Name";
return false;
}
if (!/^[a-zA-Z ]{2,30}$/.test(name))
{
document.getElementById('nam').innerHTML="Please Enter Valid Name";
return false;
}
else{
  document.getElementById('nam').innerHTML="";
  
}
if (txteml == '')
{
document.getElementById('maill').innerHTML="Please enter email address";
return false;
}
if(txteml.indexOf('@')<=0){
document.getElementById('maill').innerHTML="Please enter valid email address";
return false;
}
if((txteml.charAt(txteml.length-4)!='.') && (txteml.charAt(txteml.length-3)!='.')) {
document.getElementById('maill').innerHTML="Please enter valid email address";
return false;
}
 else if (!re.test(txteml))
{
document.getElementById('maill').innerHTML="Please enter valid email address";
return false;
}
else{
  document.getElementById('maill').innerHTML="";
}
if (txtsub == '')
{
document.getElementById('sub').innerHTML="Please enter Subject";
return false;
}
if (txtsub.length<4)
{
document.getElementById('sub').innerHTML="Subject is too Short";
return false;
}
if (!isNaN(txtsub))
{
document.getElementById('sub').innerHTML="Please enter Valid Subject";
return false;
}
if (!/^[a-zA-Z ]{2,30}$/.test(txtsub))
{
document.getElementById('sub').innerHTML="Please enter Valid Subject";
return false;
}
else{
  document.getElementById('sub').innerHTML="";
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
if (txtmess == '')
{
document.getElementById('mess').innerHTML="Please enter Message";
return false;
}
if (txtmess.length<10)
{
document.getElementById('mess').innerHTML="Message is too Short";
return false;
}
if (!isNaN(txtmess))
{
document.getElementById('mess').innerHTML="Please enter Valid Message";
return false;
}
if (!/^[a-zA-Z ]{10,5000}$/.test(txtmess))
{
document.getElementById('mess').innerHTML="Please enter Valid Meassage";
return false;
}
else{
  document.getElementById('mess').innerHTML="";
}
}
    </script>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
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
                          // echo  "<li><a href=# data-toggle=modal data-target=#profile-sec>Profile</a></li>";
                           echo "<li><a href=frmchgpwd.php>Change Password</a></li>";
                          
                      }
 else {
     
 }
                  ?>
          <li><a href="#contact">Contact</a></li>
         
          
                  
                  <?php
                  if(isset($_SESSION["ucod"]))
                  {
                   
                   echo  "<a href=index.php?sts=S>Signout</a>";  
                  }
 else {
  
                echo  "<li><a href=# data-toggle=modal data-target=#login-sec>Login</a></li>";
                echo "<li><a href=# data-toggle=modal data-target=#signup-sec>Signup</a></li>";
 }
                          ?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <div class="carousel-item active" style="background-image: url('img/intro-carousel/1.jpg');">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Real Property</h2>
                <p>Real property is defined as any property that is attached to, or affixed to land, including the land itself.  Each piece of real property can be very different from the next.  This becomes a matter of concern when trying to identifying a piece of real property.</p>
                <a href="frmsrc.php" class="btn-get-started scrollto">Get Started</a>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section><!-- #intro -->

  <main id="main">
    
    <section id="about">
      <div class="container">

        <header class="section-header">
          <h3>About Us</h3>
          <p>Real estate is "property consisting of land and the buildings on it, along with its natural resources such as crops, minerals or water; immovable property of this nature; an interest vested in this (also) an item of real property</p>
        </header>

        <div class="row about-cols">

          <div class="col-md-4 wow fadeInUp">
            <div class="about-col">
              <div class="img">
                <img src="img/about-mission.jpg" alt="" class="img-fluid">
                <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
              </div>
              <h2 class="title">Our Mission</h2>
              <p>
              Our mission is to provide residents with exemplary service in a quality home environment, to provide employees unparalleled opportunities for personal and professional development, and to provide partners and clients with maximized real estate asset value.
              </p>
            </div>
          </div>

          <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="about-col">
              <div class="img">
                <img src="img/about-plan.jpg" alt="" class="img-fluid">
                <div class="icon"><i class="ion-ios-list-outline"></i></div>
              </div>
              <h2 class="title">Our Plan</h2>
               <p>
                Our plan in the market, though just pure luck and a lot of arrogance, has put us in a position to literally change the real estate industry forever. The advent of e-commerce and the growth of the Internet has no bearing on our current business plan.
              </p>
            </div>
          </div>

          <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
            <div class="about-col">
              <div class="img">
                <img src="img/about-vision.jpg" alt="" class="img-fluid">
                <div class="icon"><i class="ion-ios-eye-outline"></i></div>
              </div>
              <h2 class="title">Our Vision</h2>
                 <p>
               Vision. Peterson Companies is a regional, full-service real estate development and management company. Our objective is to be a profitable leader in commercial, retail and residential real estate. We will serve our customers' needs and will consistently produce and manage developments of lasting value to the community.
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      Services Section
    ============================-->
    <section id="services">
      <div class="container">

        <header class="section-header wow fadeInUp">
          <h3>Services</h3>
         <p>Real Estate Sales Agents :: Job Description. Rent, buy, or sell property for clients. Perform duties, such as study property listings, interview prospective clients, accompany clients to property site, discuss conditions of sale, and draw up real estate contracts. Includes agents who represent buyer.</p>
        </header>

        <div class="row">

          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-analytics-outline"></i></div>
            <h4 class="title">Homes for sale</h4>
             <p class="description">A property description is the written portion of a real estate listing that describes the details of a home for sale or lease. Descriptions account for roughly one-third of a listing and are accompanied by property information (i.e. the number of bedrooms) and photographs. The goal of property description</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-bookmarks-outline"></i></div>
            <h4 class="title">Homes for rent</h4>
            <p class="description">Homes for rents also available here every types of home availabe for rent at very geniue price</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-paper-outline"></i></div>
            <h4 class="title">Estimates home values</h4>
             <p class="description">Estimate definition is — Define estimate: esteem; appraise; to judge tentatively or approximately the value, worth, or significance ofDefine estimate: esteem; appraise; to judge tentatively or ... These example sentences are selected automatically from various online news sources to reflect current usage of the word 'estimate.</p>
          </div>
          

        </div>

      </div>
    </section><!-- #services -->
  
    <!--==========================
      Portfolio Section
    ============================-->
    <section id="portfolio"  class="section-bg" >
      <div class="container ">

        <header class="section-header">
          <h3 class="section-title">Our Gallery</h3>
        </header>

  

        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="img/portfolio/app1.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/app1.jpg" data-lightbox="portfolio" data-title="App 1" class="link-preview" title="Preview"><i class="ion ion-eye"></i></a>
                
              </figure>

              <div class="portfolio-info">
                <h4>For Buying </h4>
                <p>Buying</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <figure>
                <img src="img/portfolio/web3.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/web3.jpg" class="link-preview" data-lightbox="portfolio" data-title="Web 3" title="Preview"><i class="ion ion-eye"></i></a>
                
              </figure>

              <div class="portfolio-info">
                <h4>For Rent </h4>
                <p>Rent</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <figure>
                <img src="img/portfolio/app2.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/app2.jpg" class="link-preview" data-lightbox="portfolio" data-title="App 2" title="Preview"><i class="ion ion-eye"></i></a>
                
              </figure>
              <div class="portfolio-info">
                <h4>For Remodelling </h4>
                <p>Remodelling</p>
              </div>
            </div>
          </div>
      </div>
    </section><!-- #portfolio -->

  
    <section id="contact" class="section-bg wow fadeInUp">
      <div class="container">

        <div class="section-header">
          <h3>Contact Us</h3>
          <p>Please Fill Form if You have any query...</p>
        </div>

        <div class="row contact-info">


          <div class="col-md-6">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:7404650301">7404650301</a></p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="email:rems98@yahoo.com">rems98@yahoo.com</a></p>
            </div>
          </div>

        </div>
        <?php
if(isset($_POST['tt']))
{
$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$number = $_POST["phone"];
$mess = $_POST["message"];
$file = fopen("file.txt","a+");
$text = "Name : ".$name."\n Email  : ".$email."\n Subject  : ".$subject."\n Phone Number   : ".$number."\n Message  : ".$mess."\n \n";
fwrite($file,$text);
fclose($file);
header("locaion:index.php");
}
?>
        <div class="form">
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div>
          <form action="mail.php" method="post" role="form" class="contactForm" onclick="return validate2()" >
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"  autocomplete="off" onkeyup="validate2()"/>
                <div class="validation"></div>
                <span id="nam" class="text-danger font-weight-bold"></span>
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email"  autocomplete="off" onkeyup="validate2()"/>
                <div class="validation"></div>
                <span id="maill" class="text-danger font-weight-bold"></span>
              </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"  autocomplete="off" onkeyup="validate2()"/>
              <div class="validation"></div>
              <span id="sub" class="text-danger font-weight-bold"></span>
            </div>
            <div class="form-group col-md-6">
              <input type="number" class="form-control" name="phone" id="phone" placeholder="Your Phone Number"  autocomplete="off" onkeyup="validate2()" />
              <div class="validation"></div>
              <span id="phon" class="text-danger font-weight-bold"></span>
            </div></div>
            <div class="form-group">
              <textarea class="form-control" name="message" id="message" rows="5"  placeholder="Message" autocomplete="off" onkeyup="validate2()"></textarea>
              <div class="validation"></div>
              <span id="mess" class="text-danger font-weight-bold"></span>
            </div>
            <div class="text-center"><button  type="submit" name="tt">Send Message</button></div>
            <span id="sub" class="text-danger font-weight-bold"></span>
          </form>
        </div>

      </div>
    </section><!-- #contact -->

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <img class="footer-sec" src="img/rems-logo.png" alt=""/>
            <p>Real estate is "property consisting of land and the buildings on it, along with its natural resources such as crops, minerals or water; immovable property of this nature; an interest vested in this (also) an item of real property.</p>
          </div>

          

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
           
              <strong>Phone:</strong>7404650301<br>
              <strong>Email:</strong>rems98@yahoo.com<br>
           

          </div>

        

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong class="rems-sec">REMS</strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<div class="modal fade" id="login-sec" role="dialog">
  <div class="modal-dialog">  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="--login-sec">   
        <h3>Login &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="button" class="btn btn-default close-btn" data-dismiss="modal"><a href=# >X</h3></a></button>
         <form name="form1" action="index.php" method="post" onsubmit="return validate()">
            <!-- form login -->
           
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="txteml" id="txteml" class="form-control"autocomplete="off" onkeyup="validate()"/>
                <span id="mail1" class="text-danger font-weight-bold"></span>
               
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="txtpwd" id="txtpwd" class="form-control" autocomplete="off" onkeyup="validate()"/>
                <span id="pass1" class="text-danger font-weight-bold"></span>
                
              </div>
            <input type="submit" name="b1" value="Login" class="btn btn-primary btn-lg btn-block"/>
             
             <div class="form-groups">
                
                 
              </div>  
         </form>
        </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default close-btn" data-dismiss="modal" ><a href=# data-toggle=modal data-target=#signup-sec>Not Register Sign-up here</a></button>
      <button type="button" class="btn btn-default close-btn" data-dismiss="modal" ><a href=# data-toggle=modal data-target=#forget-sec>Forgot Password</a></button>
        <!-- <button type="button" class="btn btn-default close-btn" data-dismiss="modal"><a href=# >Close</a></button> -->

      </div>
    </div>    
  </div>
     </div>

<div class="modal fade" id="signup-sec" role="dialog">
  <div class="modal-dialog">  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="signup-sec-inner">      
          <div class="box-panel">   
            <!-- buttons top --> <h3>Sign Up Here &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="button" class="btn btn-default close-btn" data-dismiss="modal"><a href=# >X</h3></a></button>
            
            <!-- end buttons top -->     
            <form name="f1" action="index.php" method="post" onsubmit="return validate1()">
                 
            <!-- form login -->
            <div class="form-row">
            <div class="form-group col-md-6" >
                <label>Name</label>
                <input type="text" name="txtnm1" id="txtnmm1" class="form-control" autocomplete="off" onkeyup="validate1()" />
                <span id="nam11" class="text-danger font-weight-bold"></span>
              </div>
              <div class="form-group col-md-6">
                <label>Phone Number</label>
                <input type="number" name="txtph1" id="txtphnn1" class="form-control" autocomplete="off" onkeyup="validate1()"/>
                <span id="phon11" class="text-danger font-weight-bold"></span>
              </div>
</div>
             <div class="form-group">
                <label>Email</label>
                <input type="text" name="txteml1" id="txteml1" class="form-control" autocomplete="off " onkeyup="validate1()"/>
                <span id="mail" class="text-danger font-weight-bold"></span>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="txtpwd1" id="txtpwd1" class="form-control" autocomplete="off" onkeyup="validate1()"/>
                <span id="pass" class="text-danger font-weight-bold"></span>
              </div>
             <div class="form-group">
                <label>Confirm Password</label>
               <input type="password" name="txtconpwd1" id="txtconpwd1" class="form-control" autocomplete="off" onkeyup="validate1()"/>
               <span id="cpass" class="text-danger font-weight-bold"></span>
              </div>
            <input type="submit" name="b2" value="Create Account" class="btn btn-primary btn-lg btn-block"/>

            
              <div class="form-group">
                <div class="">     
                  <div class="col-xs-12 text-right">
                    
                  </div>
                </div>
              </div>     
            </form> 
        
            <!-- form login -->     
          </div>
        </div> 
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default close-btn" data-dismiss="modal" ><a href=# data-toggle=modal data-target=#login-sec>Login</a></button>
      <!-- <button type="button" class="btn btn-default close-btn" data-dismiss="modal"><a href=# >Close</a></button> -->
      </div>
    </div>    
  </div>
</div>
<script>
  function validate3()
 {
var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
var eml1 = document.getElementById('eml00').value;
var pho1 = document.getElementById('phn10').value;
var pas = document.getElementById('pwd10').value;


if (eml1 == '')
{
document.getElementById('mail010').innerHTML="Please enter email address";
return false;
}
if(eml1.indexOf('@')<=0){
document.getElementById('mail010').innerHTML="Please enter valid email address";
return false;
}
if((eml1.charAt(eml1.length-4)!='.') && (eml1.charAt(eml1.length-3)!='.')) {
document.getElementById('mail010').innerHTML="Please enter valid email address";
return false;
}
if (!re.test(eml1))
{
document.getElementById('mail010').innerHTML="Please enter valid email address";
return false;
}
else{
  document.getElementById('mail010').innerHTML="";
}
if (pho1 == '')
{
document.getElementById('ph11').innerHTML="Phone number can't be empty";
return false;
}
if (isNaN(pho1))
{
document.getElementById('ph11').innerHTML="Please enter only Numbers(0-9)";
return false;
}
if (pho1.length<10)
{
document.getElementById('ph11').innerHTML="Phone Number cannot exceed more than 10";
return false;
}
if (pho1.length>10)
{
document.getElementById('ph11').innerHTML="Phone number be 10 digits only";
return false;
}
if((pho1.charAt(0)!=9) && (pho1.charAt(0)!=8) && (pho1.charAt(0)!=7) && (pho1.charAt(0)!=6))
  {
document.getElementById('ph11').innerHTML="Number can only start with 9,8,7,6";
return false;
}
else{
  document.getElementById('ph11').innerHTML="";
}
if (pas == '')
{
document.getElementById('pas10').innerHTML="Please enter Password";
return false;
}
if(pas.length!="")
{
if(pas.length > 10)
{
document.getElementById('pas10').innerHTML="Please Enter Less than 10 Character";
return false;
}if(pas.length < 6)
{
document.getElementById('pas10').innerHTML="You Enter Lass than 6 Character";
return false;
}
else{
  document.getElementById('pas10').innerHTML="";
}
}

}

  </script>
  <?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'config2.php';
if(isset($_POST['b5']))
{
      $email=$_POST['eml00'];
      $mobile=$_POST['ph10'];
      $newpassword=$_POST['pwd10'];
      $sql ="select usreml from tbusr where usreml='$email' and phone='$mobile'";
      $res= mysqli_query($link, $sql);
      if(mysqli_affected_rows($link)==1)
      {
      $qry="update tbusr set usrpwd='$newpassword' where usreml='$email' and phone='$mobile'";
      $res1= mysqli_query($link, $qry);
      echo "<script>alert('Your Password succesfully changed');</script>";
      }
      else {
        echo "<script>alert('Your Email id or Phone Number is Wrong');</script>";
      }
    }
        ?>
<div class="modal fade" id="forget-sec" role="dialog">
  <div class="modal-dialog">  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="forget-sec-inner">      
          <div class="box-panel">   
            <!-- buttons top --> <h3>Forgot Password &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="button" class="btn btn-default close-btn" data-dismiss="modal"><a href=# >X</h3></a></button>
            
            <!-- end buttons top -->     
            <form name="f6" action="index.php" method="post" onclick="return validate3()" >
                 
            <!-- form login -->
            
            <div class="form-group">
                <label>Enter Reg Email id</label>
                <input type="text" name="eml00" id="eml00" class="form-control" autocomplete="off" onkeyup="validate3()"/>
                <span id="mail010" class="text-danger font-weight-bold"></span>
              </div>
                
              <div class="form-group">
                <label>Enter Reg Phone Number</label>
                <input type="number" name="ph10" id="phn10" class="form-control" autocomplete="off" onkeyup="validate3()"/>
                <span id="ph11" class="text-danger font-weight-bold"></span>
              </div>

              <div class="form-group">
                <label>Enter New Password</label>
                <input type="password" name="pwd10" id="pwd10" class="form-control" autocomplete="off" onkeyup="validate3()"/>
                <span id="pas10" class="text-danger font-weight-bold"></span>
              </div>

          
            <input type="submit" name="b5" value="Update Password" class="btn btn-primary btn-lg btn-block"/>

             
              <div class="form-group">
                <div class="">     
                  <div class="col-xs-12 text-right">
                    
                  </div>
                </div>
              </div>     
            </form> 
        
            <!-- form login -->     
          </div>
        </div> 
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default close-btn" data-dismiss="modal" ><a href=# data-toggle=modal data-target=#login-sec>Login</a></button>
      <!-- <button type="button" class="btn btn-default close-btn" data-dismiss="modal"><a href=# >Close</a></button> -->

      </div>
    </div>    
  </div>
</div>

  <!-- JavaScript Libraries -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/main.js"></script>

  <script src="js/easing.min.js"></script>
  <script src="js/hoverIntent.js"></script>
  <script src="js/superfish.min.js"></script>
<!--  <script src="js/wow.min.js"></script>-->
  <script src="js/waypoints.min.js"></script>
  <script src="js/counterup.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/lightbox.min.js"></script>
  <script src="js/jquery.touchSwipe.min.js"></script>



  <!-- Template Main Javascript File -->
 

</body>
</html>
