<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<html>
<head>
<title>cnelle</title>
<link rel="stylesheet" href="css/main.css">
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
</head>
<body class="body-background-with-design">
<button onclick="location.href='index.php'" class="top-left-button">Home</button>
<button onclick="location.href='logout.php'" class="top-right-button">Logout</button>
<h1 class="myprofile-profile">myProfile</h1> 
<div class="profile-background">
<h1 class="username-profile"> <?php echo $_SESSION['username']; ?></h1>  

 <?php
        error_reporting(0);
        session_start(); 
        include ('connect.php');
        if(!empty($_SESSION['username'])){
        $sql = "SELECT * FROM customers WHERE username='{$_SESSION['username']}'";
        $result = mysqli_query($con, $sql); 
        if($result==true){
            while($row = $result->fetch_assoc()){
              $imgURL = 'customerprofile/'.$row["CustomerImage"]; 
            echo'<div style="font-weight: normal;color:black;">'."<img src='".$imgURL."' draggable='false' class='profile-image'>".'<br>'.
            '<div style="display: inline-flex;">'.'<div style="display: inline-block; margin-left: 2vw;">'.'<br>'.
            '<h1 class="details">'.'FirstName'.'</h1>'.'<p class="all-info">'.$row['FirstName'].'</p>'.'<br>'.
            '<h1 class="details">'.'LastName'.'</h1>'.'<p class="all-info">'.$row['LastName'].'</p>'.'<br>'.
            '<h1 class="details">'.'Phone'.'</h1>'.'<p class="all-info">'.$row['phone'].'</p>'.'<br>'.
           
            '</div>'.
           '<div style="display: inline-block; margin-left: 5vw;">'.'<br>'.
            '<h1 class="details" >'.'Email'.'</h1>'.'<p class="all-info">'.$row['email'].'</p>'.'<br>'.
            '<h1 class="details">'.'Province'.'</h1>'.'<p class="all-info">'.$row['province'].'</p>'.'<br>'.
            '<h1 class="details">'.'Country'.'</h1>'.'<p class="all-info">'.$row['Country'].'</p>'.'<br>'.
            '</div>';
  
         }
       }
     
    }else{
         header('Location: login.php');
       }
    ?>
</div><br>
<button onclick="location.href='updateCustomer.php'"  class="button-for-profiles">Update Account</button>
</body>
</html>   