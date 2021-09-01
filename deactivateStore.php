<?php 
error_reporting(0);
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<?php

include ('connect.php'); 

$id = $_GET['SupplierID']; // get id through query string
$inActive = 0; 
$deActivate = mysqli_query($con,"UPDATE owners SET activationCode='$inActive' where SupplierID = '$id'"); // update query

if($deActivate)
{
    mysqli_close($con); // Close connection
    header("location:storeManagement.php");
    exit;	
}
else
{
    echo "Error deactivating record"; // display error message if not delete
}
?>