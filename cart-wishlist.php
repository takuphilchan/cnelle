<?php 
include ("connect.php");
$product_number = $_GET['p'];
if(isset($_POST['cart'])){
header("Location: cart.php?action=add&p=$product_number");
}else if(isset($_POST['wishlist'])){
    header("Location: allengagementhistory.php");
}
?>