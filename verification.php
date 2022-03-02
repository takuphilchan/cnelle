<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">  
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.png" type="image/x-icon" /> 
<link rel="stylesheet" href="css/main.css">
</head>
<body>
<button onclick="location.href='index.php'" class="homebutton">Return to Home</button> 
<?php
error_reporting(0); 
session_start(); 
include ('connect.php');
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $pass = $_POST['password']; 
    $name = stripcslashes(htmlspecialchars($name));
    $pass = stripcslashes(htmlspecialchars($pass));
    $result = mysqli_query($con, "SELECT * FROM customers WHERE FirstName = '{$_SESSION['FirstName']}' and FirstName ='$name'");
   echo "<p>Sorry, you dont have an account try signing in <p>"; 
   if($result==true){
        if(mysqli_num_rows($result)>0){
            header('Location:delete.php'); 
        }
    }
    else {
        die("failed to query database");
    }
}
?>
<script src="mask.js"></script>
<div id="login">
<form action="verification.php" method="POST">
    <strong style="font-size: 2em; margin-top: 5px; color:navy;">Verification</strong>
    <br><br><br>
     Please enter your username. <br><br> 
    <input type="text" name="name" class="name" required><br><br><br>
    Please enter your password. <br><br> 
    <div style="display: inline-flex;">
    <input type="password" name="password" id="password-field" required>
     <i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i>
    </div><br><br>
    <input type="submit" name="submit" class="button" style="background-color:red; color: white;" value="Delete"> <br><br>
</form>
</div>
</body>

</html>