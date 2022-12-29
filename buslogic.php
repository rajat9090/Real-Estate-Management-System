<?php
error_reporting(0);
include_once 'config.php';
class clsagt
{
    //dspagtbyloc
    //dspagtprf
public $agtcod,$agtnam,$agtloccod,$agtser,$agtpic,$agtprf,$agtusrcod;
public function dspagtrev($acod)
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspagtrev($acod)";
    $res=  mysqli_query($link, $qry)or die(mysqli_error($link));
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function dspagtprf($acod)
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspagtprf($acod)";
    $res=  mysqli_query($link, $qry)or die(mysqli_error($link));
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function dspagtbyloc($locod)
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspagtbyloc($locod)";
    $res=  mysqli_query($link, $qry)or die(mysqli_error($link));
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function save_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call insagt('$this->agtnam',$this->agtloccod,'$this->agtser','$this->agtpic','$this->agtprf',$this->agtusrcod)";
    $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function update_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
      $qry="call updagt($this->agtcod,'$this->agtnam','$this->agtser','$this->agtpic','$this->agtprf')";
    $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function delete_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call delagt($this->agtcod)";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function disp_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspagt()";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function find_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call fndagt($this->agtcod)";
    $res=  mysqli_query($link, $qry) or die(mysqli_error($link));
if(mysqli_num_rows($res))
{
   $r=  mysqli_fetch_row($res);
  
      $this->agtcod=$r[0];
        $this->agtnam=$r[1];
         $this->agtloccod=$r[2];
          $this->agtser=$r[3];
           $this->agtpic=$r[4];
            $this->agtprf=$r[5];
            $this->agtusrcod=$r[6];
   }
     $con->db_close(); 
}

}
class clsagtrev
{
    public $agtrevcod,$agtrevagtcod,$agtrevusrcod,$agtrevprpcod,
            $agtrevdat,$agtrevtit,$agtrevdsc,$agtrevscr;
    public function save_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call insagtrev('$this->agtrevagtcod',$this->agtrevusrcod,$this->agtrevprpcod,"
            . "'$this->agtrevdat','$this->agtrevtit','$this->agtrevdsc',$this->agtrevscr)";
    $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function update_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
       $qry="call updagtrev('$this->agtrevagtcod',$this->agtrevusrcod,$this->agtrevprpcod,"
            . "'$this->agtrevdat','$this->agtrevtit','$this->agtrevdsc',$this->agtrevscr)";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function delete_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call delagtrev($this->agtrevcod)";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function disp_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspagtrev()";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function find_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call fndagtrev($this->agtrevcod)";
    $res=  mysqli_query($link, $qry);
if(mysqli_num_rows($res)>0)
{
    
    $r=  mysqli_fetch_row($res);
      $this->agtrevcod=$r[0];
        $this->agtrevagtcod=$r[1];
      $this->agtrevusrcod=$r[2];
      $this->agtrevprpcod=$r[3];
      $this->agtrevdat=$r[4];
      $this->agtrevtit=$r[5];
      $this->agtrevdsc=$r[6];
      $this->agtrevscr=$r[7];
}
$con->db_close();
}
}
class clsapp
{
    public $appcod,$appusrcod,$appprpcod,$appnam,$appdat,$appdsc,$appphn,$appsts;
    //dspprptit   dspagttit
     public function dspprptit($ucod)
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspprptit($ucod)";
    $res=  mysqli_query($link, $qry)or die(mysqli_error($link));
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
  public function dspagttit($ucod)
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspagttit($ucod)";
    $res=  mysqli_query($link, $qry)or die(mysqli_error($link));
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
    public function dispapp($pcod)
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dispapp($pcod)";
    $res=  mysqli_query($link, $qry)or die(mysqli_error($link));
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}

    public function save_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call insapp($this->appusrcod,$this->appprpcod,'$this->appnam','$this->appdat','$this->appdsc','$this->appphn','$this->appsts')";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}

public function update_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
     $qry="call updapp($this->appusrcod,$this->appprpcod,'$this->appnam','$this->appdat','$this->appdsc','$this->appphn','$this->appsts')";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function delete_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call  delapp($this->appcod)";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function disp_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspapp()";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function find_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
     $qry="call fndapp($this->appcod)";
    $res=  mysqli_query($link, $qry);
if(mysqli_num_rows($res)>0)
{
    
    $r=  mysqli_fetch_row($res);
      $this->appcod=$r[0];
        $this->appusrcod=$r[1];
         $this->appprpcod=$r[2];
         $this->appname=$r[3];
          $this->appdat=$r[4];
           $this->appdsc=$r[5];
            $this->appphn=$r[6];
             $this->appsts=$r[7];
}
$con->db_close();
}

}
class clsusr
{
    public $usrcod,$usrnam,$usrphon,$usreml,$usrpwd,$usrregdat,$usrrol;
     function chgpwd($ucod,$oldpwd,$newpwd)
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call chgpwd($ucod,'$oldpwd','$newpwd',@ret)";
        $res=  mysqli_query($link,$qry);
        $res1=  mysqli_query($link,"select @ret");
        $r=  mysqli_fetch_row($res1)or die(mysqli_error($link));
        mysqli_close();
        return $r[0];
    }
   public function logincheck($eml,$pwd)
{
$con=new clscon();
$link=$con->db_connect();
$qry="call logincheck('$eml','$pwd',@cod,@rol)";
$res= mysqli_query($link, $qry);
$res1= mysqli_query($link,"select @cod,@rol");
$r= mysqli_fetch_row($res1);

$con->db_close();
if($r[0]==-1 || $r[0]==-2)
return FALSE;
else 
{
$_SESSION["ucod"]=$r[0];
$_SESSION["urol"]=$r[1];
return TRUE;
}
}
 
    public function save_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call insusr('$this->usrnam','$this->usrphon','$this->usreml','$this->usrpwd','$this->usrregdat','$this->usrrol',@cod)";
    $res=  mysqli_query($link,$qry);
    $res1=  mysqli_query($link,"select @cod");
    $r=  mysqli_fetch_row($res1);
    $con->db_close();
    return $r[0];
}
public function update_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call updusr($this->usrcod,'$this->usrnam','$this->usrphon','$this->usreml','$this->usrpwd','$this->usrregdat','$this->usrrol')";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function delete_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call delusr($this->usrcod)";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function disp_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dispusr()";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function find_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call findusr($this->usrcod)";
    $res=  mysqli_query($link, $qry);
if(mysqli_num_rows($res)>0)
{
    $r=  mysqli_fetch_row($res);
      $this->usrcod=$r[0];
      $this->usrnam=$r[1];
        $this->usreml=$r[2];
      $this->usrpwd=$r[3];
       $this->usrregdat=$r[4];
       $this->usrrol=$r[5];
       
}
$con->db_close();
}
}
class clscty
{
    public $ctycod,$ctynam;

    
    public function save_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
   $qry="call inscty('$this->ctynam')";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
   public function update_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
   $qry="call upcty($this->ctycod,'$this->ctynam')";
    $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
   public function delete_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call delcty($this->ctycod)";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function disp_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
      $qry="call dspcty()";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function find_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call fndcty($this->ctycod)";
    $res=  mysqli_query($link, $qry);
if(mysqli_num_rows($res)>0)
{
    $r=  mysqli_fetch_row($res);
      $this->ctycod=$r[0];
        $this->ctynam=$r[1];
     
}
$con->db_close();
}

}
class clsfav
{
public $favcod,$favusrcod,$favprpcod,$favdat;
public function save_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call insfav($this->favusrcod,$this->favprpcod,'$this->favdat')";
    $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function update_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
     $qry="call updfav($this->favcod,$this->favusrcod,$this->favprpcod,'$this->favdat')";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function delete_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call delfav($this->favcod)";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function disp_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspfav()";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function find_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call fndfav($this->favcod)";
    $res=  mysqli_query($link, $qry) or die(mysqli_error($link));
if(mysqli_num_rows($res))
{
   
   $r=  mysqli_fetch_row($res);
  
      $this->favcod=$r[0];
        $this->favusrcod=$r[1];
 $this->favprpcod=$r[2];
         $this->favdat=$r[3];
   }
     $con->db_close(); 
}


}
class clsfet
{
    public $fetcod,$fetdsc;

    
    public function save_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
  echo $qry="call insfet('$this->fetdsc')";
    $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
   public function update_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
   $qry="call updfet($this->fetcod,'$this->fetdsc')";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
   public function delete_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call delfet($this->fetcod)";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function disp_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
      $qry="call dspfet()";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function find_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call fndfet($this->fetcod)";
    $res=  mysqli_query($link, $qry);
if(mysqli_num_rows($res)>0)
{
    $r=  mysqli_fetch_row($res);
      $this->fetcod=$r[0];
        $this->fetdsc=$r[1];
     
}
$con->db_close();
}

}
class clsloc
{
public $loccod,$locnam,$locctycod,$loccrd;
public function save_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
   $qry="call insloc('$this->locnam',$this->locctycod,'$this->loccrd')";
    $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function update_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    echo  $qry="call updloc($this->loccod,'$this->locnam',$this->locctycod,'$this->loccrd')";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function delete_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call delloc($this->loccod)";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function disp_rec($locd)
{
    $con=new clscon();
    $link=$con->db_connect();
      $qry="call dsploc($locd)";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function find_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call fndloc($this->loccod)";
    $res=  mysqli_query($link, $qry) or die(mysqli_error($link));
if(mysqli_num_rows($res))
{
   
   $r=  mysqli_fetch_row($res);
  
      $this->loccod=$r[0];
        $this->locnam=$r[1];
        $this->locctycod=$r[2];
         $this->loccrd=$r[3];
   }
     $con->db_close(); 
}
}
class clsprp
{
public $prpcod,$prptit,$prpagtcod,$prpprptypcod,$prpadd,$prpcrd,$prpsalsts,$prpdsc,
       $prpprc,$prplstdat,$prpmanpiccod,$prpsts ;

//dspprpdet  dispfav updprpdet
public function updprpdet()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call updprpdet($this->prpcod,'$this->prptit',$this->prpagtcod,$this->prpprptypcod,"
            . "'$this->prpadd','$this->prpcrd','$this->prpsalsts','$this->prpdsc',$this->prpprc,'$this->prplstdat','$this->prpsts')";
     $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function dispfav($ucod)
{
    $con=new clscon();
    $link=$con->db_connect();
   $qry="call dispfav($ucod)";
    $res=  mysqli_query($link, $qry)or die(mysqli_error($link));
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function dspprpdet($pcod)
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspprpdet($pcod)";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function srcprp($lcod,$sts)
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call srcprp($lcod,'$sts')";
    $res=  mysqli_query($link, $qry)or die(mysqli_error($link));
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
       $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function dspagtprp($agtcod)
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspagtprp($agtcod)";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function updprpsts()
{
    $con=new clscon();
    $link=$con->db_connect();
  echo   $qry="call updprpsts($this->prpcod,'$this->prpsts')";
    $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function save_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call insprp('$this->prptit',$this->prpagtcod,$this->prpprptypcod,"
            . "'$this->prpadd','$this->prpcrd','$this->prpsalsts','$this->prpdsc',$this->prpprc,'$this->prplstdat',$this->prpmanpiccod,'$this->prpsts',@cod)";
    $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    $res1=  mysqli_query($link,"select @cod");
    $r=  mysqli_fetch_row($res1);
    $con->db_close();
    return $r[0];
}
public function update_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
  echo   $qry="call updprp($this->prpcod,$this->prpmanpiccod)";
    $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function delete_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call delprp($this->prpcod)";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function disp_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspprp()";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function find_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call fndprp($this->prpcod)";
    $res=  mysqli_query($link, $qry) or die(mysqli_error($link));
if(mysqli_num_rows($res))
{
    
   $r=  mysqli_fetch_row($res);
  
   $this->prpcod=$r[0];
   $this->prptit=$r[1];
   $this->prpagtcod=$r[2];
   $this->prpprptypcod=$r[3];
   $this->prpadd=$r[4];
   $this->prpcrd=$r[5];
   $this->prpsalsts=$r[6];
   $this->prpdsc=$r[7];
   $this->prpprc=$r[8];
   $this->prplstdat=$r[9];
   $this->prpmanpiccod=$r[10];
   $this->prpsts=$r[11];
   }
     $con->db_close(); 
}


}
class clsprpfet
{
public $prpfetcod,$prpfetprpcod,$prpfetfetcod,$prpfetdsc;
public function save_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call insprpfet($this->prpfetprpcod,$this->prpfetfetcod,'$this->prpfetdsc')";
    $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function update_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call updprpfet($this->prpfetcod,$this->prpfetprpcod,$this->prpfetfetcod,'$this->prpfetdsc')";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function delete_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call delprpfet($this->prpfetcod)";
    $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function disp_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspprpfet()";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function dispprpfet($pcod)
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dispprpfet($pcod)";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function find_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call fndprpfet($this->prpfetcod)";
    $res=  mysqli_query($link, $qry) or die(mysqli_error($link));
if(mysqli_num_rows($res))
{
   
   $r=  mysqli_fetch_row($res);
  
   $this->prpfetcod=$r[0];
     $this->prpfetprpcod=$r[1];
       $this->prpfetfetcod=$r[2];
         $this->prpfetdsc=$r[3];
   }
     $con->db_close(); 
}
}
class clsprppic
{
public $prppiccod,$prppicprpcod,$prppicfil,$prppicdsc,$prppicsts;
public function save_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call insprppic($this->prppicprpcod,'$this->prppicfil','$this->prppicdsc','$this->prppicsts')";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function update_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
   $qry="call updprppic($this->prppiccod,$this->prppicprpcod,'$this->prppicfil','$this->prppicdsc','$this->prppicsts')";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function delete_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call delprppic($this->prppiccod)";
    $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
//dspprppict
public function dspprppict($ppcod)
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspprppict($ppcod)";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function disp_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call dspprppic()";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function find_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call fndprppic($this->prppiccod)";
    $res=  mysqli_query($link, $qry) or die(mysqli_error($link));
if(mysqli_num_rows($res)>0)
{
     
   $r=  mysqli_fetch_row($res);
  
      $this->prppiccod=$r[0];
       $this->prppicprpcod=$r[1];
      $this->prppicfil=$r[2];
      $this->prppicdsc=$r[3];
      $this->prppicsts=$r[4];
   }
     $con->db_close(); 
}

}
class clsprptyp
{
    public $prptypcod,$prptypnam;

    
    public function save_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
  echo $qry="call insprptyp('$this->prptypnam')";
    $res=  mysqli_query($link,$qry)or die(mysqli_error($link));
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
   public function update_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
  $qry="call updprptyp($this->prptypcod,'$this->prptypnam')";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
   public function delete_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call delprptyp($this->prptypcod)";
    $res=  mysqli_query($link,$qry);
    if(mysqli_affected_rows($link)==1)
    {
        $con->db_close();
        return TRUE;
    }
    else
    {
        $con->db_close();
        return FALSE;
    }
}
public function disp_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
      $qry="call dspprptyp ()";
    $res=  mysqli_query($link, $qry);
    $i=0;
    $arr=array();
    while ($r=  mysqli_fetch_row($res))
    {
        $arr[$i]=$r;
       $i++;
    }
$con->db_close();
return $arr;
}
public function find_rec()
{
    $con=new clscon();
    $link=$con->db_connect();
    $qry="call fndprptyp($this->prptypcod)";
    $res=  mysqli_query($link, $qry);
if(mysqli_num_rows($res)>0)
{
    $r=  mysqli_fetch_row($res);
      $this->prptypcod=$r[0];
        $this->prptypnam=$r[1];
     
}
$con->db_close();
}

}



?>
