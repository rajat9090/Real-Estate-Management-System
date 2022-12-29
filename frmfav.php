<?php
session_start();
include_once 'buslogic.php';
if(isset($_REQUEST["pcod"]))
{
  $_SESSION["pcod"]=$_REQUEST["pcod"];
}
if(!isset($_SESSION["ucod"]))
{
    header("location:index.php");
}

if(isset($_REQUEST["pcod"]))
{
    $_SESSION["pcod"]=$_REQUEST["pcod"];
}
if(isset($_SESSION["pcod"]))
{
    $obj=new clsfav();
    $obj->favdat= date('y-m-d');
    $obj->favprpcod=$_SESSION["pcod"];
    $obj->favusrcod=$_SESSION["ucod"];
    $obj->save_rec();
}

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
        <form id="form1" action="frmfav.php" method="post" enctype="multipart/form-data">
      <nav id="nav-menu-container">
              <ul class="nav-menu">
            <li class="menu-active"><a href="index.php">Home</a></li>
          <li><a href="frmsrc.php">Search</a></li>
                      <li><a href="frmagt.php">Agents</a></li>
                      <?php
                      if(isset($_SESSION["ucod"]))
                      {
                          echo "<li><a href=frmfav.php>Favourites</a></li>";
                          
                         
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
          <h3>Favourites</h3>
                  </header>
      <form action="frmagt.php" method="post">
    <div class="container">
    <div class="col-md-12 form-line search-page">
        
                            <!--here write next code -->
                            <br />
                            <br />
                         
    
                 
                  

    
                        <br />
                      
    
                 
                  

    
                 </div>
     </div>

        <div>

         

       
         

        </div>
                  
      
    <div class="col-md-12     form-line design-table">
        <?php
        if(isset($_SESSION["ucod"]))
        {
        $obj=new clsprp();
        $arr=$obj->dispfav($_SESSION["ucod"]);
      echo "<table class=w-100 >";
      for($i=0;$i<count($arr);$i++)
      {
      echo "<tr> <td rowspan=4 align=center style=width: 238px>";                                                   
                                                               
    if($arr[$i][7]==NULL)
            echo "<img src=agtpics/nopic.png height=150px width=150px class=b22 border=2 />";
        else
     echo"<img src=prpfils/".$arr[$i][7] ." height=150px width=150px class=b22 border=2 />";
      echo "<embed src=prpfils/".$arr[$i][7]." height=200px width=200px autoplay=false />";
                                                               echo" </td><td>";
                                                               
     echo"<h3><a href=frmprpdet.php?pcod=".$arr[$i][0] .">".$arr[$i][1]."</a></h3></td></tr>";                       
    
            echo"<tr><td>";                            
                                                             
           echo"<b>Listed on :</b>".$arr[$i][6]."</td></tr><tr><td>";
              echo"<b>Price :Rs</b>".$arr[$i][5]."</td></tr><tr><td>";
                echo"".$arr[$i][4]."</td> </tr><tr><td style=width: 238px align=center>";
                echo "<a href=frmprf.php?acod=".$arr[$i][8] .">".$arr[$i][9]."</a><br/>";
             
      for($j=1;$j<=$arr[$i][10];$j++)
                                          {
             echo "<img src=img/star.png height=10px width=10px />";
                                          } 
                                          echo "</td> <td align=right>";
                   echo"<a href=frmprpdet.php?pcod=".$arr[$i][0] .">View Details</a> </td></tr> </td></tr> ";                                             
               
                                                               
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