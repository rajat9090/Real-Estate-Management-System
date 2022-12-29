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
//to store record to tbusr
$obj=new clsusr();
$obj->usreml=$_POST["txteml"];
$obj->usrregdat= date('y-m-d');
$pwd= "%".rand(1,100000)."@";
$obj->usrpwd=$pwd;
$obj->usrrol='A';
$a=$obj->Save_Rec();
//to store record to tbagt
$obj1=new clsagt();
$obj1->agtloccod=$_POST["drploc"];
$obj1->agtnam=$_POST["txtnam"];
$obj1->agtpic="";
$obj1->agtprf="";
$obj1->agtser="";
$obj1->agtregdat=date('y-m-d');
$obj1->agtusrcod=$a;
$obj1->agtpic=$_FILES["filupl"]["name"];
$obj1->Save_Rec();
//to upload pic on server

//to send email containing password
//mail($_POST["txteml"],"Login Information","Your Password is ".$pwd);
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
window.location="frmreg.php?ccod="+a;
}
      </script>
      <script>
         function validate_register()
{
    var re1 = /^[A-Za-z]+$/;
     var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
     
  var txtnam= document.getElementById('txtnam').value;
   var txteml= document.getElementById('txteml').value;
    
     
   
    
    
    
    if(txtnam=='')
    {
        document.getElementById('txtnam').focus();
        alert("Please enter Agent Name ");
        return false;
    }
     else if (!re1.test(txtnam))
    {
        document.getElementById('txtnam').focus();
        alert("Please enter only Charecter value");
        return false;
    }
   
  
    if(txteml=='')
    {
        document.getElementById('txteml').focus();
        alert("Please Enter Email");
        return false;
    }
    else if (!re.test(txteml))
    {
        document.getElementById('txteml').focus();
        alert("Please enter valid email address");
        return false;
    }
    

   
}</script>
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
          <h3>Register New Agent</h3>
          <form name="f1" action="frmreg.php" method="post" onsubmit="return validate_register()">
                  </header>
    <div class="col-md-6 reg-frm     form-line">
                        <div class="form-group">
                            <label for="exampleInputUsername">Select City</label>
                             <?php
                            $obj=new clscty();
                            $arr=$obj->disp_rec();
                            echo "<select name=drpcty onchange=abc(this.value); class=form-control >";
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
                            <label for="exampleInputUsername">Select Location</label>
                             <?php
                             if(isset($_SESSION["ccod"]))
                             {
                            $obj=new clsloc();
                            $arr=$obj->disp_rec($_SESSION["ccod"]);
                            echo "<select name=drploc class=form-control >";
                            for($i=0;$i<count($arr);$i++)
                            {
                                
                                echo "<option value=".$arr[$i][0]."  >".$arr[$i][1];
                                
                            }
                            echo '</select>';
                             }
                            ?>
 
                        
                        </div>
          <div class="form-group">
                            <label for="exampleInputUsername">Agent Name</label>
                            <input type="text" name="txtnam" id="txtnam" class="form-control"/>
       
             
                        
                        </div>
          <div class="form-group">
                            <label for="exampleInputUsername">Agent Email</label>
                            <input type="text" name="txteml" id="txteml" class="form-control"/>
                                         
                        
                        </div>
        <div class="form-group">
            <input type="submit" name="btnsub" value="submit" class="submit"/>
            

        </div>
                      <br />
                            <br />
                            <br />
                            <asp:ObjectDataSource ID="ObjectDataSource1" runat="server" SelectMethod="disp_rec" TypeName="nszillow.clscty"></asp:ObjectDataSource>
                            <asp:ObjectDataSource ID="ObjectDataSource2" runat="server" SelectMethod="disp_rec" TypeName="nszillow.clsloc">
                                <SelectParameters>
                                    <asp:ControlParameter ControlID="drpcty" Name="ctycod" PropertyName="SelectedValue" Type="Int32" />
                                </SelectParameters>
                            </asp:ObjectDataSource>
    
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