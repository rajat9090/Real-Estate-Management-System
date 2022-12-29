<?php
session_start();
include_once 'buslogic.php';
//if(!isset($_SESSION["ucod"]))
//{
//    header("location:index.php");
//}
if(isset($_REQUEST["ccod"]))
{
$_SESSION["ccod"]=$_REQUEST["ccod"];
}
if(isset($_REQUEST["acod"]))
{
$_SESSION["acod"]=$_REQUEST["acod"];
}
 else {
    
 header("location:frmagt.php");
     
 }


?>
<!DOCTYPE html>
<html lang="en">
<head runat="server">
  <meta charset="utf-8">
  <title>Real Estate</title>
  <script>
      function abc(a)
{
window.location="frmagt.php?ccod="+a;
}
  function xyz(b)
{
    
window.location="frmagt.php?lcod="+b;
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
        <form id="form1" action="frmagt.php" method="post" enctype="multipart/form-data">
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
          <h3>Agent Profile</h3>
                  </header>
      <form action="frmprf.php" method="post">
    

        <div>

         

       
         

        </div>
                  
      
    <div class="col-md-12     form-line design-table">
        <?php
        if(isset($_SESSION["acod"]))
        {
            
        $obj=new clsagt();
        $arr=$obj->dspagtprf($_SESSION["acod"]);
        echo "<table class=w-100>";
     for($i=0;$i<count($arr);$i++)
     {
       //echo "<table class=w-100>";
                                echo"<tr><td rowspan=6 style=width: 243px>";
    if($arr[$i][3]==NULL)
            echo "<img src=agtpics/nopic.png height=150px width=150px class=b22 border=2 />";
            
        else
     echo"<img src=agtpics/".$arr[$i][3] ." height=150px width=150px class=b22 border=2 />";
                                              echo"</td><td>";
                                   
                                       echo "<h3>".$arr[$i][1]."</h3>";
                                   echo"</td></tr><tr>";
                                
                                   echo "<td><i>".$arr[$i][2]."</i></td>";
                           echo     "</tr><tr><td><p>".$arr[$i][4]."</p></td></tr><tr>";
                            $dt= date("Y-m-d", strtotime($arr[$i][5]));
              echo"<td><b>".$arr[$i][8]."</b> properties posted since:".$dt."</td>";
              echo "</tr><tr><td>";for($j=1;$j<=$arr[$i][6];$j++)
                                          {
             echo "<img src=img/star.png height=10px width=10px />&nbsp";
                                          }                
                                echo "Review". "&nbsp by"."&nbsp". $arr[$i][7]." customers</td></tr>";
                                
     }  
                        echo "</table>";
        }
        if(isset($_SESSION["acod"]))
        {
           $obj=new clsagt();
        $arr=$obj->dspagtrev($_SESSION["acod"]); 
        echo"<table class=w-100><tr><th>Customer Reviews</th></tr>";
         for($i=0;$i<count($arr);$i++)
     {
                    echo "<tr>";
                           
                           echo"<tr><td></td></tr>";
                            $dt= date("Y-m-d", strtotime($arr[$i][3]));
                           echo"<td>Posted Date :".$dt."</td>";
                       echo" </tr>
                        <tr>
                            <td colspan=2><h4>".$arr[$i][0]."</h4></td></tr><tr><td>";
  for($j=1;$j<=$arr[$i][2];$j++)
                                          {
             echo "<img src=img/star.png height=10px width=10px />";
                                          }  
                         echo   "</td><td>&nbsp;</td></tr><tr>";
                          echo "<td colspan=2>".$arr[$i][1]."</td></tr><tr>";
                            echo"<td>Posted By:&nbsp".$arr[$i][5]."</td>";
                            echo"<td>&nbsp;</td></tr>";
     }
                  echo  "</table>";
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