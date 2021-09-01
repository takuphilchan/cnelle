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
    session_destroy();
    session_start();
    include ('connect.php'); 
    $email=$_POST['email'];
    $company = $_POST['company'];
    $password = $_POST['mypass']; 
    $company = stripcslashes(htmlspecialchars($company));
    $email = stripcslashes(htmlspecialchars($email));
    $activationCode = stripcslashes(htmlspecialchars($activationCode));
    $password = stripcslashes(htmlspecialchars($password));
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
    $result = mysqli_query($con, "SELECT * FROM owners WHERE company='{$company}'");
    if(mysqli_num_rows($result)>0){
         while($rows = mysqli_fetch_array($result)){ 
                  if($rows["OwnerEmail"]==$email){
                        if($rows["activationCode"]=='1'){
                              if(password_verify($password, $rows["password"])){
                                  $_SESSION['logged']=true;
                                  $_SESSION['company']=$company;
                                  header('Location:index.php'); 
                                }else{
                                  echo "<p class='invalid'>incorrect password</p>"; 
                                }
                        }else{
                          $_SESSION['logged']=false;
                          echo "<p class='notification-message'>Your Store Account is not activated, please wait for confirmation and activation</p>";
                        }
                 }else{
              echo "<p class='invalid'>Sorry, email does not match your company name. Try again.</p>"; 
              }
          }
       }else{
        echo "<p class='invalid'>Sorry, company name does not match any existing company name. Try again.</p>"; 
      }
  }else{
    echo"<p class='invalid'> invalid email</p>"; 
  }
}
?>
<script src="javascript/mask.js"></script>
<div class="login">
  <div  class="form-top">
    <strong class="form-name">Seller Login</strong>
</div>
<div class="form-body">
<form method="POST" action="storeLoggin.php" >
     <div class="form">
              <input type="text" id="compName" name="company" class="form-input"  required maxlength=20>
              <label for="compName" class="label-name">
                  <span class="content-name">Enter your company name</span>
              </label>
      </div>
     <div class="form">
              <input type="text"  name="email" class="form-input"  required maxlength=30>
              <label for="email" class="label-name">
                  <span class="content-name">Enter your email</span>
              </label>
    </div>
    <div class="form">
                <input type="text" name="mypass" id="password-field" autocomplete="new-password" oninput="turnOnPasswordStyle()" required>
                <label for="mypass" class="label-name">
                  <span class="content-name">Enter your password </span>
                </label>
                <i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i>
             </div>
    <button type="submit" name="submit" class="button-for-forms">LOG IN</button><br><br>
</form>
<div class="form-have-account">Don't have an account?<a href="storeRegister.php" class="already"> Click here to create account</a></div>
</div>
</div>
</body>
<footer id="footer">&copy; 2021 cnelle.com<footer>
</html>