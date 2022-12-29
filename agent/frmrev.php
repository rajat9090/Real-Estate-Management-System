<?php
session_start();//next work for close propery
include_once '../buslogic.php';
if(!isset($_SESSION["ucod"]))
{
    header("location:../index.php");
}
//if(!isset($_REQUEST["pcod"]))
//{
//   header("location:frmprp.php"); 
//}

?>
<!DOCTYPE html>
<html lang="en">
<head runat="server">
  <meta charset="utf-8">
  <title>Real Estate</title>
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
<body>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="#intro" class="scrollto"><img class="brand_logo" src="../img/rems-logo.png" alt="error"/></a></h1>
      </div>
        <form id="form1" action="frmrev.php" method="post" enctype="multipart/form-data">
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

  <div class="map-bgs">
 <header class="section-header">
          <h3>Reviews</h3>
    
                  </header>
    <div class="col-md-12     form-line design-table">
        <?php
        if(isset($_SESSION["ucod"]))
        {
        $obj=new clsagt();
        $arr=$obj->dspagtrev($_SESSION["ucod"]);
       // print_r($arr);
        echo "<table class=w-100>";
     for($i=0;$i<count($arr);$i++)
     {
         echo "<tr><td>&nbsp;</td>";
         $dt= date("Y-m-d", strtotime($arr[$i][3]));
                          echo  "<td>Posted Date :".$dt."</td>";
                       echo "</tr><tr>";
                        
                           echo "<td colspan=2><h4>".$arr[$i][0]."</h4></td>";
                       echo"</tr><tr><td>";
                        
                            
   echo "<tr><td>"; for($j=1;$j<=$arr[$i][2];$j++)
                                          {
             echo "<img src=../img/star.png height=10px width=10px />";
                                          }
                          echo " </td> <td>&nbsp;</td>
                        </tr>
                        <tr>";
                           
                           echo" <td colspan=2>".$arr[$i][1]."</td>";
                       echo" </tr><tr>";
                        
                          echo " <td>Posted By :".$arr[$i][5]."</td>";
                           echo "<td>&nbsp;</td></tr>  ";
     }
                          echo "</table>";
                        
                  
        }
        ?>
    </div>
        </div>

</form>
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