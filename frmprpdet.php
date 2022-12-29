<?php
session_start();
include_once 'buslogic.php';
//if(!isset($_SESSION["ucod"]))
//{
//    header("location:index.php");
//}
if(!isset($_REQUEST["pcod"]))
{
    header("location:frmsrc.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head runat="server">
  <meta charset="utf-8">
  <title>Real Estate</title>
  <script>
    
 function getcat()
 {
     if(document.getElementById('r1').checked)
     {
         var r=document.getElementById('r1').value;
         window.location="frmsrc.php?rcod="+r;
        // alert(r);
     }
     else if(document.getElementById('r2').checked)
     {
         var r=document.getElementById('r2').value;
         window.location="frmsrc.php?rcod="+r;
        // alert(r);
        }
 }
 
      function abc(a)
{
window.location="frmsrc.php?ccod="+a;
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
<body onload="intialize();">

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="#intro" class="scrollto"><img class="brand_logo" src="img/rems-logo.png" alt="error"/></a></h1>
      </div>
        <form id="form1" action="frmprpdet.php" method="post" enctype="multipart/form-data">
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
    <script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsYXS5KEfQfuLJQnftXa-qiaSdrFxVTJY&sensor=false">
    </script>
    <script lang="javascript">
                 var map;
                 function intialize() {
                     var mapOptions = {
                         center: { lat: 30.7900, lng: 76.7800 },
                         zoom: 8
                     };
                     map = new google.maps.Map(document.getElementById('map'), mapOptions);
                 
                     
                     //var args = locationList[0].split(',');
                     //var location = new google.maps.LatLng(args[0], args[1])
                     //var a = 1;

                     var marker = new google.maps.Marker({
                         position: new google.maps.LatLng(30.7900, 76.7800),
                         map: map,
                     });
        //             var marker = new google.maps.Marker(
        //{
        //    position: location,
        //    map: map,
        //    icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + a + '|FF0000|000000'
        //});

                     //marker.setTitle(message[0]);
                     //attachSecretMessage(marker, 0);
                     

                 }
                 //function attachSecretMessage(marker, number) {
                 //    var infowindow = new google.maps.InfoWindow(
                 //    {
                 //        content: message[number],
                 //        size: new google.maps.Size(50, 50)
                 //    });
                 //    google.maps.event.addListener(marker, "click", function () {
                 //        infowindow.open(map, marker);
                 //    });
                 //}

</script>
<header class="section-header">
          <h3>Property Details</h3>
                  </header>
    <div id="map"  style="height:200px; width: 1000px;">
        
    </div>
<form action="frmprpdet.php" method="post">
    <div class="col-md-6 frm-location     form-line">
        <br />
                          
                            <br />
                               
                            </div>

        <div>

         
  <div class="col-md-12     form-line design-table">
        <?php
        if(isset($_REQUEST["pcod"]))
        {
        $obj=new clsprp();
        $arr=$obj->dspprpdet($_REQUEST["pcod"]);
//        echo "<pre>";
//        print_r($arr);
//        echo "</pre>";
       
           echo"<table class=w-100 <tr><th>Search Property</th><tr>";
             for($i=0;$i<count($arr);$i++)
     {
            echo"<tr><td rowspan=4 align=center style=width: 238px>";
     if($arr[$i][8]==NULL)
            echo "<img src=agtpics/nopic.png height=150px width=150px class=b22 border=2 />";
        else
     echo"<img src=prpfils/".$arr[$i][8] ." height=150px width=150px class=b22 border=2 />";
                                              echo"</td>";
                                                               
                 
                               echo "<td><a href=frmprppic.php?pcod=".$arr[$i][0].">View Propety Picture</a></td></tr><tr>";
                     
                               echo "<td><b>Address: </b>".$arr[$i][2]."</td></tr><tr>";
                       
                               echo "<td><b>Price :</b>".$arr[$i][6]."</td></tr><tr>";
                           echo "<td><p>".$arr[$i][5]."</p></td>";
                            
                            echo "</tr><tr><td style=width: 238px align=center>";
                       // echo"<a href=frmprf.php?acod=".$arr[$i][8] .">".$arr[$i][9]."</a><br />";
    
                          echo "</td><td align=right>";
                   echo"<a href=frmfav.php?pcod=".$arr[$i][0].">Add To Favourites</a> ";
                   echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo"<a href=frmapp.php?pcod=".$arr[$i][0].">Book Appointment</a> </td></tr> ";
                                   
     }
     
     echo "</table>";
        }
    ?>
    </div>
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