<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<link rel="stylesheet" href="css/main.css">
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.png" type="image/x-icon" />
<button onclick="location.href='index.php'" class="homebutton">Return to Home</button>

<?php
include ('connect.php');
error_reporting(0);
$result = mysqli_query($con, "DELETE FROM customers WHERE FirstName = '{$_SESSION['FirstName']}'");
if(mysqli_num_rows($result)==0){
            unset($_SESSION["FirstName"]);
            echo "<p style='color:navy; text-align: center; font-size: 3em;'>Your Account has been deleted</p>";
            session_destroy();
        }else {
           echo "<p class='invalid'>Sorry, you dont have an account try signing in <p>"; 
       }
?>
