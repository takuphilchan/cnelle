<?php 
error_reporting(0);
session_start(); 
if(empty($_SESSION['logged']) && empty($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<?php
error_reporting(0);
include ('connect.php');
session_start();
if(isset($_SESSION['username'])){
$update_query = "UPDATE customersellermessages SET message_status=1 WHERE message_status=0 and (Reciever = '{$_SESSION['username']}') and (SendBy = '{$_GET['company']}')";
mysqli_query($con, $update_query);
header("location:customerSellerMessages.php?company={$_GET['company']}"); 
}else if(isset($_SESSION['company'])){
    $update_query = "UPDATE customersellermessages SET message_status=1 WHERE message_status=0 and (Reciever = '{$_SESSION['company']}') and (SendBy = '{$_GET['username']}')";
    mysqli_query($con, $update_query);
   header("location:sellerCustomerMessages.php?username={$_GET['username']}");  
}

?>