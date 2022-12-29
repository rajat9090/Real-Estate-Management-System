<?php
session_start();
include_once 'buslogic.php';
//if(!isset($_SESSION["ucod"]))
//{
//    header("location:index.php");
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
                        //  echo "<li><a href=frmrev.php>Write Review</a></li>";
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
          <h3>Property Picture And Video</h3>
                  </header>
    
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
            
        

          $obj1=new clsprppic();
          $arr=$obj1->dspprppict($_REQUEST["pcod"]);
          //trpcod,trpdat,trplik,locnam,ctynam,trpcst,trptit,pic 
       if(count($arr)>0)
           echo "<table class=trip-tbl  width=100% ><thead><tr><th>Propety Picture And Video </th></tr></thead>";
       $j=1;
      for($i=0;$i<count($arr);$i++)
      {
          $j++;
          if($j==2)
          {
              echo "<tr>";
              $j=0;
          }
         echo "<td>";
        if($arr[$i][4]=='P')
  echo "<img src=prpfils/".$arr[$i][2]." height=500px width=500px />";
        else
         echo "<embed src=prpfils/".$arr[$i][2]." height=500px width=500px autoplay=false />";
     
       // echo"<td style=width: 238px align=center>";
                        echo"<p>".$arr[$i][3]."</p></td>";
     
     
         
         //echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        
//          echo "<br><a class=upload href=frmprppic.php?ppiccod=".$arr[$i][0]."&mode=E >Edit</a>";
//           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//           echo "<a class=upload href=frmprppic.php?ppiccod=".$arr[$i][0]."&mode=D >Delete</a><br>";
//         echo "<br><a class=upload href=frmprppic.php?ppiccod=".$arr[$i][0]."&mode=S >Set As Main Picture</a><br></td>";
         if($j==1)
             echo "</tr>";
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