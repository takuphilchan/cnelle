<!DOCTYPE html>
<html>
<head>
<title>cnelle</title>
<script src="javascript/jquery.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.css" rel="stylesheet"> 
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<link rel="stylesheet" href="css/main.css">
<script src="javascript/keypads.js"></script>
<script src="javascript/autocomp.js"></script>
</head>
<body class="body-background-with-design">
<button onclick="location.href='index.php'" class="top-left-button">Home</button> 
<?php
error_reporting(0); 

if(isset($_POST['submit'])){
  session_start();
  session_destroy();
  include ('connect.php'); 
    $username = $_POST['myName'];
    $pass = $_POST['mypass']; 
    $username = stripcslashes(htmlspecialchars($username));
    $pass = stripcslashes(htmlspecialchars($pass));
    $result = mysqli_query($con, "SELECT * FROM customers WHERE BINARY username = '{$username}'"); 
    if(mysqli_num_rows($result)>0){
            while($rows = mysqli_fetch_array($result)){
            if(password_verify($pass, $rows["password"])){
            $_SESSION['loggedin']=true; 
            $_SESSION['username']=$username; 
            header('Location:index.php'); 
           }else{
            echo "<p class='invalid'>incorrect password<p>"; 
           }
         }
       }else{
         echo "<p class='invalid'>Sorry, username entered does not match any existing username. Try creating a new account click on Customer Signup<p>"; 
          } 
    }
?>
<script src="javascript/mask.js"></script>
<div class="login"> 
  <div class="form-top">
    <strong class="form-name">Buyer Login</strong>
  </div>
 <div class="form-body">
<form action="login.php" method="POST">
 
          <div class="form">
              <input type="text" id="username" name="myName" class="form-input"  required maxlength=20>
              <label for="myName" class="label-name">
                  <span class="content-name">Enter your username</span>
              </label>
           </div>
           <div class="form">
                <input type="text" name="mypass" id="password-field" autocomplete="new-password" oninput="turnOnPasswordStyle()" required>
                <label for="mypass" class="label-name">
                  <span class="content-name">Enter your password </span>
                </label>
                <i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i>
             </div>
          <button type="submit" name="submit" class="button-for-forms">LOG IN</button><br>
          <div class="form-have-account">Don't have an account?<a href="register.php" class="already"> Click here to create account </a>
        </div>

</form>
</div>
</div>
<footer id="footer">&copy; 2021 cnelle.com<footer>
</body>
</html>