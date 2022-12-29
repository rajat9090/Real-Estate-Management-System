<?php
session_start();
include_once '../buslogic.php';
if(!isset($_SESSION["ucod"]))
{
    header("location:../index.php");
}

if(isset($_POST["btnsub"]))
{
    $chk=$_POST["ck1"];
   
    foreach ($chk as $v) {
    
            if(isset($st))
            {
                $st.=",".$v;
            }
 else {
     $st=$v;
 }
    }
   
   
//to store record to tbusr

//to store record to tbagt
$obj1=new clsagt();
$obj1->agtser=$st;
$obj1->agtcod=$_SESSION["ucod"];
$obj1->agtnam=$_POST["txtnam"];
$obj1->agtprf=$_POST["txtprf"];
//$obj1->agtregdat=date('y-m-d');
//$obj1->agtusrcod=$a;
$obj1->agtpic=$_FILES["filupl"]["name"];
$obj1->update_rec();
//to upload pic on server
if($obj1->agtpic!="")
{
move_uploaded_file($_FILES["filupl"]["tmp_name"],"../agtpics/".
$_FILES["filupl"]["name"]);
}
//to send email containing password
//mail($_POST["txteml"],"Login Information","Your Password is ".$pwd);
}
if(isset($_SESSION["ucod"]))
{
    $obj=new clsagt();
    $obj->agtcod=$_SESSION["ucod"];
    $obj->Find_Rec();
    $agtnam=$obj->agtnam;
    $agtpic=$obj->agtpic;
    $agtprf=$obj->agtprf;
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
<body>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
        <h1><a href="#intro" class="scrollto"><img class="brand_logo" src="../img/rems-logo.png" alt="error"/></a></h1>
      </div>
        <form id="form1" action="frmprf.php" method="post" enctype="multipart/form-data">
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
          <h3>Manage Profile</h3>
                  </header>
    <div class="col-md-12     form-line design-table">
                        <div class="form-group">
                            <label for="exampleInputUsername">Services Offered</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="ck1[]" id="ck1" required="" value="Buying">Buying
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="ck1[]" id="ck1"  value="Selling">Selling
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="ck1[]" id="ck1" value="Rental">Rental
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="ck1[]" id="ck1" value="Furnishing">Furnishing
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="ck1[]" id="ck1" value="Mortgaging">Mortgaging
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" name="ck1[]" id="ck1" value="Estimation">Estimation
<!--                            <asp:checkboxlist runat="server" cssclass="form-control" id="ck1" Height="65px" RepeatColumns="3" RepeatDirection="Horizontal">
                                <asp:ListItem>Buying</asp:ListItem>
                                <asp:ListItem>Selling</asp:ListItem>
                                <asp:ListItem>Rental</asp:ListItem>
                                <asp:ListItem>Furnishing</asp:ListItem>
                                <asp:ListItem>Mortgaging</asp:ListItem>
                                <asp:ListItem>Estimation</asp:ListItem>
                                <asp:ListItem>Purchase</asp:ListItem>
                            </asp:checkboxlist>                              -->
                        </div>
         <div class="form-group">
                            <label for="exampleInputUsername">Agent Name</label>
                            <input type="text" name="txtnam" value="<?php if(isset($agtnam)) echo $agtnam ;?>" class="form-control" />
<!--                        <asp:textbox runat="server" id="txtdsc" cssclass="form-control" textmode="Multiline" Height="265px"></asp:textbox><asp:RequiredFieldValidator ID="RequiredFieldValidator1" runat="server" ErrorMessage="Description Required" ControlToValidate="txtdsc"></asp:RequiredFieldValidator>       -->
                        </div>
                    <div class="form-group">
                            <label for="exampleInputUsername">Profile</label>
                            <textarea class="form-control" name="txtprf" rows="4" cols="20">
    <?php
    if(isset($agtprf))
    {
        echo $agtprf;
    }
    ?>
</textarea>
<!--                            <input type="text" name="txtdsc" class="form-control" />-->
<!--                        <asp:textbox runat="server" id="txtdsc" cssclass="form-control" textmode="Multiline" Height="265px"></asp:textbox><asp:RequiredFieldValidator ID="RequiredFieldValidator1" runat="server" ErrorMessage="Description Required" ControlToValidate="txtdsc"></asp:RequiredFieldValidator>       -->
                        </div>
      <div class="form-group">
                            <label for="exampleInputUsername">Browse Picture</label>
                            <input type="file" name="filupl" class="form-control"/>
<!--          <asp:fileupload runat="server" id="filupl" cssclass="form-control"></asp:fileupload>          -->
                        </div>
        <br />
        <div class="form-group">
            <input type="submit" name="btnsub" value="submit" class="btn btn-default submit"/>
          <asp:Button ID="Button1" runat="server" Text="Submit" CssClass="btn btn-default submit" OnClick="Button1_Click" />
        </div>
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