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
$Active = 1; 
$Activate = mysqli_query($con,"UPDATE owners SET activationCode='$Active' where SupplierID = '$id'"); // update query

if($Activate)
{
    mysqli_close($con); // Close connection
    header("location:storeManagement.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deactivating record"; // display error message if not delete
}
?>