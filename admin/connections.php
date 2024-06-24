<?php
error_reporting(0);
session_start();
$conn=mysqli_connect('localhost','root','','quiry');

if($_SESSION['admin_data']!="")
{   
    echo "asdsa";
}
else {

      //  header('location:login.php');
    
}

?>