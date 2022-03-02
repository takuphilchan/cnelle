<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" /> 
<link rel="stylesheet" href="css/main.css">
<nav class="top-relative">
<button  class="top-left-button" onclick="location.href='clientsidestore.php?company=<?php echo $_GET['company']; ?>'">Store</button>
</nav>
<div id="contact">
<?php
error_reporting(0);
include ("connect.php");
$sql = "SELECT * FROM owners where company = '{$_GET["company"]}'";
$Info = $con->query($sql);
        while ($comp = $Info -> fetch_assoc()){
        ?>    
    <h3 class="info-headings">First Name</h3>
    <?php echo $comp["OwnerFirstName"]; ?>
        <br/> 
    <h3 class="info-headings">Last Name</h3>
    <?php echo $comp["OwnerLastName"]; ?>
        <br/>     
    <h3 class="info-headings">Email</h3>
    <?php echo $comp["OwnerEmail"]; ?><br/>
     
    <h3 class="info-headings">Address</h3>
        <?php echo $comp["OwnerAddress"];  ?>
        <br>
    <h3 class="info-headings">Mobile Number</h3>
   <?php echo "+".$comp["phone"]; ?><br>
   <h3 class="info-headings">whatsapp</h3>
  <a href="https://wa.me/<?php echo $comp["phone"]; ?>"> <img src="images/whatsapp.png" alt="" style="height: 50px; width: 50px; border-radius: 50%;">  </a>    
          
          
       
       <?php }         
?>  
</div>