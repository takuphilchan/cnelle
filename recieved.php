
<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<?php
if($_SESSION['username']==='Administrator'){
include ('connect.php'); 

$id = $_GET['OrderId']; // get id through query string
$recieved = 1; 
$OrderRecieved = mysqli_query($con,"UPDATE orders SET Recieved='$recieved' where OrderId = '$id'"); // update query

if($OrderRecieved)
{
    mysqli_close($con); // Close connection
    header("location:ordersAdmin.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deactivating record"; // display error message if not delete
}
 }else{
   header("Location:index.php");  
} ?>