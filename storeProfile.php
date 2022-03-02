<?php 
session_start(); 
if(!isset($_SESSION['logged'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:storeLoggin.php"); }
?>
<html>
<head>
<title>cnelle</title>
<link rel="stylesheet" href="css/main.css">
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
</head>
<body class="body-background-with-design">
<button onclick="location.href='index.php'" class="top-left-button">Home</button>
<button onclick="location.href='logoutStore.php'" class="top-right-button">Logout</button>
<h1 class="myprofile-profile">myStore Profile</h1><br>
<div class="profile-background" >
<h1 class="username-profile"> <?php  echo $_SESSION['company']; ?></h1>  

    <?php
        error_reporting(0);
        session_start();
        include ('connect.php');
        if(!empty($_SESSION['company'])){
        $sql = "SELECT * FROM owners WHERE company ='{$_SESSION['company']}'";
        $result = mysqli_query($con, $sql); 
        if($result==true){
            while($row = $result->fetch_assoc()){
              $imgURL = 'storeprofile/'.$row["OwnerImage"]; 
            echo'<div style="font-weight: normal;color:black;">'."<img src='".$imgURL."' draggable='false' class='profile-image'>".'<br>'.
            '<div style="display: inline-flex;">'.'<div style="display: inline-block; margin-left: 4vw;">'.'<br>'.
            '<h1 class="details">'.'First Name'.'</h1>'.'<p class="all-info">'.$row['OwnerFirstName'].'</p>'.'<br>'.
            '<h1 class="details">'.'Last Name'.'</h1>'.'<p class="all-info">'.$row['OwnerLastName'].'</p>'.'<br>'.
            '<h1 class="details" >'.'Company'.'</h1>'.'<p class="all-info">'.$row['company'].'</p>'.'<br>'.'<br>'.
            '<h1 class="details" >'.'PostalCode'.'</h1>'.'<p class="all-info" >'.$row['PostalCode'].'</p>'.'<br>'.
            '<h1 class="details">'.'Phone'.'</h1>'.'<p class="all-info">'.$row['phone'].'</p>'.'<br>'.
           
            '</div>'.
           '<div style="display: inline-block; margin-left: 10vw;">'.'<br>'.
            '<h1 class="details" >'.'Email'.'</h1>'.'<p class="all-info">'.$row['OwnerEmail'].'</p>'.'<br>'.
            '<h1 class="details">'.'City'.'</h1>'.'<p class="all-info">'.$row['City'].'</p>'.'<br>'.
            '<h1 class="details">'.'Province'.'</h1>'.'<p class="all-info">'.$row['province'].'</p>'.'<br>'.
            '<h1 class="details">'.'Country'.'</h1>'.'<p class="all-info">'.$row['Country'].'</p>'.'<br>'.
            '<h1 class="details">'.'Address'.'</h1>'.'<p class="all-info">'.$row['OwnerAddress'].'</p>'.'<br>'.
            '</div>';
         }
       }
    }else{
      header('Location: index.php');
    }
    ?>
    
    
  </div>
  <br><button onclick="location.href='storeUpdate.php'" class="button-for-profiles">Update Account</button>
</body>

</html>