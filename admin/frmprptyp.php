<?php
session_start();
include_once '../buslogic.php';
if(!isset( $_SESSION["ucod"]))
{
    header("location:../index.php");
}
if(isset($_POST["btnsub"]))
{
    //die();
    $obj=new clsprptyp();
    $obj->prptypnam=$_POST["txtcty"];
    
    if(isset($_SESSION["ccod"]))
    {
        $obj->prptypcod=$_SESSION["ccod"];
        $obj->update_Rec();
        unset($_SESSION["ccod"]);
    }
    else
    {
    $obj->save_rec();
    }
    
    
}
if(isset($_REQUEST["ccod"]))
{
    if($_REQUEST["mode"]=='D')
    {
        $obj=new clsprptyp();
        $obj->prptypcod=$_REQUEST["ccod"];
        $obj->delete_Rec();
    }
    if($_REQUEST["mode"]=='E')
    {
        $obj=new clsprptyp();
        $obj->prptypcod=$_REQUEST["ccod"];
        $obj->find_rec();
        $cnam=$obj->prptypnam;
        $_SESSION["ccod"]=$_REQUEST["ccod"];
        
    }
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
   
     var re = /^[A-Za-z]+$/;
    var txtcty = document.getElementById('txtcty').value;
    
    
    
    if(txtcty=='')
    {
        document.getElementById('txtcty').focus();
        alert("Please enter Property Type ");
        return false;
    }
     else if (!re.test(txtcty))
    {
        document.getElementById('txtcty').focus();
        alert("Please enter only Charecter value");
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
<body>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="#intro" class="scrollto"><img class="brand_logo" src="../img/rems-logo.png" alt="error"/></a></h1>
      </div>
        
      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="frmcty.php">Cities</a></li>
          <li><a href="frmloc.php">Locations</a></li>
          <li><a href="frmprptyp.php">Property Type</a></li>
         <li><a href="frmfet.php">Features</a></li>
          <li><a href="frmagt.php">Agents</a></li>
            <li>
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

         <header class="section-header">
          <h3>Property Type</h3>
          <form name="f1" action="frmprptyp.php" method="post" onsubmit="return validate_register()">
                  </header>
    <div class="col-md-6  cty-frm    form-line">
                        <div class="form-group">
                            <label for="exampleInputUsername">Property Type</label>
                            <input type="text" name="txtcty" id="txtcty" value="<?php if(isset($cnam)) echo $cnam ?>" class="form-control"/>
                            
                        </div>
                    
                        <div>
                            <input type="submit" name="btnsub" class="btn btn-default submit" value="Submit"/>
                           
                               
                            </div>
       <div>

            <?php
                                       // echo 'hello';
                                        $obj=new clsprptyp();
                                        $arr=$obj->disp_rec();
                                       // print_r($arr);
                                        if(count($arr)>0)
                                        {
                                            echo "<table   width=100% >";
                                            echo "<tr><th>Sr No</th><th>Propety Name</th><th></th></tr>";
                                            for($i=0;$i<count($arr);$i++)
                                            {
                                                $c=$i+1;
                                                echo "<tr><td>".$c."</td>";
                                                
                                                echo "<td>".$arr[$i][1]."</td>";
                                                echo "<td class=button-right><a  class=edit-btn href=frmprptyp.php?ccod=".$arr[$i][0]."&mode=E>Edit</a>";
                                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                                echo "<a class=delete-btn href=frmprptyp.php?ccod=".$arr[$i][0]."&mode=D>Delete</a></td></tr>";
                                            }
                                        }
                                        echo '</table>';
                                        ?>

        </div>


      </div>
    </section><!-- #about -->

 
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