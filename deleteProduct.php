<?php 
session_start(); 
if(!isset($_SESSION['logged'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location: storeLoggin.php"); }
?>

<?php

include ('connect.php'); 

$id = $_GET['p']; // get id through query string

$del = mysqli_query($con,"delete from products where id = '$id'"); // delete query

if($del)
{
    mysqli_close($con); // Close connection
    header("location:myStore.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>
