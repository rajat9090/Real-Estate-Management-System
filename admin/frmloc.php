<?php
session_start();
include_once '../buslogic.php';
if(!isset( $_SESSION["ucod"]))
{
    header("location:../index.php");
}
if(isset($_REQUEST["ccod"]))
{
$_SESSION["ccod"]=$_REQUEST["ccod"];
}
if(isset($_POST["btnsub"]))
{
   // die();
   // echo 'hello';
$obj=new clsloc();
$obj->locctycod=$_POST["drpcty"];
$obj->locnam=$_POST["txtloc"];
$obj->loccrd=$_POST["Hidden1"];
if(isset($_SESSION["lcod"]))
{
$obj->loccod=$_SESSION["lcod"];
$obj->Update_Rec();
unset($_SESSION["lcod"]);
}
else
$obj->Save_Rec();
}
if(isset($_REQUEST["lcod"]) && $_REQUEST["mod"]=='E')
{
$obj=new clsloc();
$obj->loccod=$_REQUEST["lcod"];
$obj->find_rec();
$lnam=$obj->locnam;
$lcrd=$obj->loccrd;
$lctycod=$obj->locctycod;
$_SESSION["lcod"]=$_REQUEST["lcod"];
}
if(isset($_REQUEST["lcod"]) && $_REQUEST["mod"]=='D')
{
$obj=new clsloc();
$obj->loccod=$_REQUEST["lcod"];
$obj->delete_rec();
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
 <div class="map-bgs">
    <script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsYXS5KEfQfuLJQnftXa-qiaSdrFxVTJY&sensor=false">
    </script>
<script lang="javascript">
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
        document.getElementById('lblcrd').innerHTML= e.latLng;
        document.getElementById('Hidden1').value = e.latLng;
    }
function abc(a)
{
window.location="frmloc.php?ccod="+a;
}
</script>
  <script>
function validate_register()
{
   
     //var re = /^[A-Za-z]+$/;
    var txtloc = document.getElementById('txtloc').value;
    var lblcrd = document.getElementById('lblcrd').value;
    
    
    
    if(txtloc=='')
    {
        document.getElementById('txtloc').focus();
        alert("Please enter Location");
        return false;
    }
     if(lblcrd=='')
    {
        document.getElementById('lblcrd').focus();
        alert("Please enter coordinate");
        return false;
    }
    
   
}
</script>
   
<header class="section-header">
          <h3>Locations</h3>
                  </header>
    <div id="map"  style="height:200px;">
        
    </div>
    <form action="frmloc.php" method="post" onsubmit="return validate_register();">
    <div class="col-md-6 frm-location     form-line">
        <br />
                        <div class="form-group">
                            <label for="exampleInputUsername">Select City</label>
                            <?php
                            $obj=new clscty();
                            $arr=$obj->disp_rec();
                            echo "<select name=drpcty onchange=abc(this.value); required=required class=form-control >";
                            for($i=0;$i<count($arr);$i++)
                            {
                                if(isset($_SESSION["ccod"])&& $_SESSION["ccod"]==$arr[$i][0])
                                echo "<option value=".$arr[$i][0]." selected >".$arr[$i][1];
                                else
                                   echo "<option value=".$arr[$i][0]." >".$arr[$i][1];   
                            }
                            echo '</select>';
                            ?>
 
                        </div>
        <div class="form-group">
                            <label for="exampleInputUsername">Location</label>
                            <input type="text" name="txtloc" id="txtloc" value="<?php if(isset($lnam)) echo $lnam ;?>" class="form-control"/>
 
            
                        </div>
        <div class="form-group">
                            <label for="exampleInputUsername">Coordinates</label>
                            <label class="form-control" name="lblcrd"  id="lblcrd" size="30"><?php if(isset($lcrd)) echo$lcrd; ?></label>
                             <input type="hidden" name="Hidden1" id="Hidden1" class="form-control"/>
          
                        </div>
                    
                        <div>
                            <input type="submit" name="btnsub" value="submit" class="btn btn-default submit"/>
                            
                          </div>     
                            <br />
                               
                            </div>

        <div>

         

          <?php
$obj=new clsloc();
if(isset($_SESSION["ccod"]))
$a=$_SESSION["ccod"];
else
$a=1;
$arr=$obj->Disp_Rec($a);
if(count($arr)>0)
{
echo '<table width=100% class="itmtable full-table" ><tr><th>Location</th><th colspan=3 >Coordinates</th></tr>';
for($i=0;$i<count($arr);$i++)
{
echo "<tr><td>".$arr[$i][1]."</td>";
echo "<td>".$arr[$i][3]."</td>";
echo "<td><a href=frmloc.php?lcod=".$arr[$i][0]."&mod=E >Edit</a></td>";
echo "<td><a href=frmloc.php?lcod=".$arr[$i][0]."&mod=D >Delete</a></td>";
echo "</tr>";
}
echo "</table>";
}  
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