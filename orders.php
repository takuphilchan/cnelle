<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<html>
<title>cnelle</title>
<link rel="stylesheet" href="css/main.css">
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<body class="body-background-with-design">
<button onclick="location.href='index.php'" class="top-left-button">Home</button>
<button onclick="location.href='profile.php'" class="top-right-button">Profile</button>
<button onclick="location.href='cart.php?username=<?php echo $_SESSION['username']; ?>'" class="top-right-button">Cart</button><br><br>
<div class="information-background">
<?php
error_reporting(0);
session_start();

                include ('connect.php');
                $Active = 1; 
                  $sql = "SELECT * FROM orders WHERE customer='{$_SESSION['username']}' AND code='{$_GET['code']}'";
                  $sql2 = mysqli_query($con,"UPDATE orders SET orderStatus='$Active' where customer = '{$_SESSION['username']}' AND company = '{$_GET['company']}' AND code = '{$_GET['code']}'");
                  $result = mysqli_query($con, $sql); 

                  if($result==true){
                    echo '<p style="font-size: 3em; text-align: center; color: navy;">Your order has been placed</p>'.'<br>';
                      while($row = $result->fetch_assoc()){
                        $imgURL = 'customerprofile/'.$row["image"]; 
                      echo'<div style="font-weight: normal;color:black;">'.
                     '<div style="display: inline-block; margin-left: 10vw;">'.'<br>'.
                      '<h1 class="details" >'.'Product Name'.'</h1>'.'<p>'.$row['productName'].'</p>'.'<br>'.
                      '<h1 class="details">'.'Quantity'.'</h1>'.'<p >'.$row['quantity'].'</p>'.'<br>'.
                      '<h1 class="details">'.'Price'.'</h1>'.'<p >'.$row['unitPrice'].'</p>'.'<br>'.
                      '<h1 class="details">'.'Total Price'.'</h1>'.'<p>'.$row['totalPrice'].'</p>'.'<br>'.
                      '<h1 class="details">'.'Product Code'.'</h1>'.'<p>'.$row['code'].'</p>'.'<br>'.
                      '</div>';
            
                   }
                 }else{
                  echo"<p> Order not placed</p>"; 
                }
?>
</div><br>
</body>
</html>