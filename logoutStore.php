<?php 
session_start(); 
if(!isset($_SESSION['logged'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location: storeLoggin.php"); }
?>
<?php
error_reporting(0);
session_destroy();
header('location: index.php');
?>