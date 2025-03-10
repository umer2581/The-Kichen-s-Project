<?php
error_reporting(0);
session_start();
$conn=mysqli_connect('localhost','root','','restaurent');

if($_SESSION['admin_data']!="")
{   
//    echo "Connection successfully";
}
else {

       // header('location:login.php');
    
}

?>