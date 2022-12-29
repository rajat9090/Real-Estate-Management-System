<?php

// var e=/^[0-9]+$/;
session_start();
include_once '../buslogic.php';
if(!isset($_SESSION["ucod"]))
{
    header("location:../index.php");
}
if(isset($_POST["btnsub"]))
{
    
   $obj=new clsprp();
   $obj->prpagtcod=$_SESSION["ucod"];
   $obj->prpadd=$_POST["txtadd"];
   $obj->prpcrd=$_POST["Hidden1"];
   //$obj->prpcrd=$_POST["Hidden1"];
   $obj->prpdsc=$_POST["txtdsc"];
   $obj->prplstdat= date('y-m-d');
   $obj->prpmanpiccod=-1;
   $obj->prpprc=$_POST["txtcst"];
   $obj->prpprptypcod=$_POST["drpprptyp"];
   $obj->prpsalsts=$_POST["r1"];
   $obj->prptit=$_POST["txtprptit"];
   $obj->prpsts='A';
   $a=$obj->save_rec();
   $_SESSION["pcod"]=$a;
   //echo "this is a value:$a";
   //die();
   header("location:frmprpfet.php");
   
   
}


?>
<!DOCTYPE html>
<html lang="en">
<head runat="server">
  <meta charset="utf-8">
  <title>Real Estate</title>
  <script>
function validate_register()
{
   // alert('hello');
   
     var re =/^[0-9]+$/;
    var txtcst = document.getElementById('txtcst').value;
    
    var txtdsc = document.getElementById('txtdsc').value;
    
    
    
    if(txtdsc=='')
    {
        document.getElementById('txtdsc').focus();
        alert("Please enter Description ");
        return false;
    }
    if(txtcst=='')
    {
        document.getElementById('txtcst').focus();
        alert("Please enter Cost");
        return false;
    }
     else if (!re.test(txtcst))
    {
        document.getElementById('txtcst').focus();
        alert("Please enter only numeric characters only");
        return false;
    }
   
}
</script>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="../img/favicon1.png" rel="icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
  <!-- Bootstrap CSS File -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Libraries CSS Files -->
  <link href="../css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/animate.min.css" rel="stylesheet">
  <link href="../css/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="../css/owl.carousel.min.css" rel="stylesheet">
 <link href="../css/lightbox.min.css" rel="stylesheet">
  <!-- Main Stylesheet File -->
  <link href="../css/style.css" rel="stylesheet">
</head>
<body onload="intialize();">

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="#intro" class="scrollto"><img class="brand_logo" src="../img/rems-logo.png" alt="error"/></a></h1>
      </div>
        <form id="form1" action="frmnewprp.php" method="post" onsubmit="return validate_register()">
      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="frmprf.php">Profile</a></li>
          <li><a href="frmprp.php">My Properties</a></li>
          <li><a href="frmnewprp.php">Add New Property</a></li>
          <li><a href="frmrev.php">Reviews</a></li>
             <li>
          <!-- hare add signout button -->
             <a href="../index.php?sts=S">Signout</a>
          </li>
          
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

   <header class="section-header ">
          <h3>Property Information</h3>
                  </header>
    <div class="container design-tab">
    <div class="col-md-6     form-line">
          
        
        <script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsYXS5KEfQfuLJQnftXa-qiaSdrFxVTJY&sensor=false">
    </script><script lang="javascript">
    function intialize()
    {
        var mapOptions = {
            center: { lat: 30.7900, lng: 76.7800 },
            zoom: 8
        };
        var map = new google.maps.Map(document.getElementById('map'),mapOptions);
        google.maps.event.addListener(map, 'click', getLangLong);
    }
    function getLangLong(e)
    {
        document.getElementById('lblcrd').innerHTML = e.latLng;
        document.getElementById('Hidden1').value = e.latLng;
    }

</script><div id="map" style="height:200px; width:1000px;" ></div>
<div class="form-group"><label for="exampleInputUsername"></label>
    
<!--    <input type="radio" name="r1" required="" value="S">For Sale
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
    <input type="radio" name="r1" required="" value="P">Purchase
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="r1" required="" value="R">For Rent
    
    
    </div><div class="form-group"><label for="exampleInputUsername">Select Property Type</label> 
         <?php
                            $obj=new clsprptyp();
                            $arr=$obj->disp_rec();
                            echo "<select name=drpprptyp class=form-control >";
                            for($i=0;$i<count($arr);$i++)
                            {
                               
                                echo "<option value=".$arr[$i][0]."  >".$arr[$i][1];
                               
                            }
                            echo '</select>';
                            ?>
       </div>
    <div class="form-group">
        <label for="exampleInputUsername">Property Title</label> 
        <input type="text" name="txtprptit" required="" class="form-control"/>
<!--        <asp:TextBox ID="txtprptit" runat="server" CssClass="form-control"></asp:TextBox></div>-->
    <div class="form-group"><label for="exampleInputUsername">Property Cost</label>
         <input type="text" name="txtcst" id="txtcst" class="form-control"/>
        
    </div>
    <div class="form-group"><label for="exampleInputUsername">Coordinates</label>
       <label class="form-control" name="lblcrd"  id="lblcrd" size="30"><?php if(isset($lcrd)) echo$lcrd; ?></label>
 <input type="hidden" name="Hidden1" id="Hidden1" class="form-control"/>
                


                </div><div class="form-group"><label for="exampleInputUsername">Address</label> 
                    <input type="text" name="txtadd" id="txtadd" required="" class="form-control"/>
                    </div>
                    <div class="form-group"><label for="exampleInputUsername">Description</label> 
                        <textarea class="form-control" id="txtdsc" name="txtdsc" required="" rows="4" cols="20"></textarea></div>
                        <div class="form-group">&nbsp;&nbsp; 
                            <input type="submit" name="btnsub" value="submit" class="btn btn-default submit"/>
                            
                        </div>
        </asp:TabPanel>
      </div>
    </section><!-- #about -->

 

   
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
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/main.js"></script>

  <script src="../js/easing.min.js"></script>
  <script src="../js/hoverIntent.js"></script>
  <script src="../js/superfish.min.js"></script>
  <script src="../js/wow.min.js"></script>
  <script src="../js/waypoints.min.js"></script>
  <script src="../js/counterup.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/isotope.pkgd.min.js"></script>
  <script src="../js/lightbox.min.js"></script>
  <script src="../js/jquery.touchSwipe.min.js"></script>



  <!-- Template Main Javascript File -->
 

</body>
</html>