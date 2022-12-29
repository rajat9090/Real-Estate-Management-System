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
   $obj=new clsprpfet();
   $obj->prpfetprpcod=$_SESSION["pcod"];
   $obj->prpfetfetcod=$_POST["drpfet"];
   $obj->prpfetdsc=$_POST["txtdsc"];
   $obj->save_rec();
    header("location:frmprppic.php");
}
 if($_REQUEST["mode"]=='D')
    {
        $obj=new clsprpfet();
        $obj->prpfetcod=$_REQUEST["ccod"];
        $obj->delete_Rec();
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
   
    
    var txtdsc = document.getElementById('txtdsc').value;
    
    
    
    if(txtdsc=='')
    {
        document.getElementById('txtdsc').focus();
        alert("Please enter Property Feature ");
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
        <form id="form1" action="frmprpfet.php" method="post" onsubmit="return validate_register()" >
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
          <h3>Property Feature</h3>
                  </header>
       <div class="form-group">
           <label for="exampleInputUsername">Select Feature<br /> </label> &nbsp;
            <?php
                            $obj=new clsfet();
                            $arr=$obj->disp_rec();
                            echo "<select name=drpfet onchange=abc(this.value); class=form-control >";
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
           <div class="form-group"><label for="exampleInputUsername">Description</label>
               <input type="text" name="txtdsc" id="txtdsc" class="form-control"/> 
               
               </div>
               <div class="form-group">
                   <input type="submit" name="btnsub" class="btn btn-default submit" value="submit"/>
                   <br />
                   <div>

            <?php
            if(isset($_SESSION["pcod"]))
            {
                                       // echo 'hello';
                                        $obj=new clsprpfet();
                                        $arr=$obj->dispprpfet($_SESSION["pcod"]);
                                       // print_r($arr);
                                        if(count($arr)>0)
                                        {
                                            echo "<table   width=100% >";
                                            echo "<tr><th>Sr No</th><th>Feature</th><th>Description</th></tr>";
                                            for($i=0;$i<count($arr);$i++)
                                            {
                                                $c=$i+1;
                                                echo "<tr><td>".$c."</td>";
                                                
                                                echo "<td>".$arr[$i][2]."</td>";
                                                 echo "<td>".$arr[$i][3]."</td><td>";
//                                                echo "<td class=button-right><a  class=edit-btn href=frmcty.php?ccod=".$arr[$i][0]."&mode=E>Edit</a>";
//                                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                                echo "<a class=delete-btn href=frmprpfet.php?ccod=".$arr[$i][0]."&mode=D>Delete</a></td></tr>";
                                            }
                                        }
                                        echo '</table>';
            }
            
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