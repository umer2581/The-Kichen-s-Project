<?php

include "connections.php";
unset($_SESSION["admin_data"]); 
session_destroy();

echo "<script>window.location='../index.php'</script>";
?>