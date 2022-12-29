<?php
session_start();
include_once '../buslogic.php';
if(!isset($_SESSION["ucod"]))
{
    header("location:../index.php");
}
if(!isset($_SESSION["pcod"]))
{
    header("location:frmnewprp.php");
}
if(isset($_POST["btnsub"]))
{
    $obj=new clsprppic();
    $obj->prppicprpcod=$_SESSION["pcod"];
    $obj->prppicsts=$_POST["r1"];
    $obj->prppicdsc=$_POST["txtdsc"];
    $obj->prppicfil=$_FILES["filupl"]["name"];
   
    $obj->save_rec();
    if($obj->prppicfil!="")
    {
    move_uploaded_file($_FILES["filupl"]["tmp_name"],"../prpfils/".
            $_FILES["filupl"]["name"]);
}
}
if(isset($_REQUEST["ppiccod"]))
{
    if($_REQUEST["mode"]=='S')
    {
    $obj=new clsprp();
    $obj->prpcod=$_SESSION["pcod"];
    $obj->prpmanpiccod=$_REQUEST["ppiccod"];
    $obj->update_rec();
    }
    if($_REQUEST["mode"]=='D')
    {
         $obj2=new clsprppic();
    $obj2->prppiccod=$_REQUEST["ppiccod"];
    $obj2->delete_rec();
    }
}

?>

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
        <form id="form1" action="frmprppic.php" method="post" enctype="multipart/form-data">
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
          <h3>Property Picture</h3>
                  </header>
     
    <div class="form-group"><label for="exampleInputUsername"></label>
    
    <input type="radio" name="r1" required="required" value="P">Picture
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="r1" value="V" required="required">Video
    
    </div> <div class="form-group">
                            <label for="exampleInputUsername">Browse Picture</label>
                            <input type="file" name="filupl" required="required" class="form-control"/>
<!--          <asp:fileupload runat="server" id="filupl" cssclass="form-control"></asp:fileupload>          -->
                        </div> <div class="form-group">
                            <label for="exampleInputUsername">Description</label>
                            <textarea class="form-control" required="required" name="txtdsc" rows="4" cols="20"></textarea>
    <?php
    if(isset($agtprf))
    {
        echo $agtprf;
    }
    ?>
</textarea><div class="form-group">
            <input type="submit" name="btnsub" value="submit" class="btn btn-default submit"/>
          <asp:Button ID="Button1" runat="server" Text="Submit" CssClass="btn btn-default submit" OnClick="Button1_Click" />
        </div>
                          
                            <div>
                                <?php

          $obj1=new clsprppic();
          $arr=$obj1->disp_rec();
          //trpcod,trpdat,trplik,locnam,ctynam,trpcst,trptit,pic 
       if(count($arr)>0)
           echo "<table class=trip-tbl  width=100% ><thead><tr><th>Propety Picture </th></tr></thead>";
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
  echo "<img src=../prpfils/".$arr[$i][2]." height=150px width=150px />";
        else
         echo "<embed src=../prpfils/".$arr[$i][2]." height=150px width=150px autoplay=false />";
  
        // echo "";
         
         //echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        
          //echo "<br><a class=upload href=frmprppic.php?ppiccod=".$arr[$i][0]."&mode=E >Edit</a>";
           echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           echo "<a class=upload href=frmprppic.php?ppiccod=".$arr[$i][0]."&mode=D >Delete</a><br>";
         echo "<br><a class=upload href=frmprppic.php?ppiccod=".$arr[$i][0]."&mode=S >Set As Main Picture</a><br></td>";
         if($j==1)
             echo "</tr>";
      }
       echo "</table>";
      
?>
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