<?php
class clscon
{
    private $link;
    public function db_connect()
    {
        $host="localhost";
        $nam="root";
        $pwd="";
        $this->link= mysqli_connect($host,$nam,$pwd,"rems")or die(mysqli_error($this->link));
        return $this->link;
    }
    public function db_close()
    {
        mysqli_close($this->link);
    }
}


?>