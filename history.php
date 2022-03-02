<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<?php 
          error_reporting(0);
          session_start(); 
          include ('connect.php');
          if(!empty($_POST['company']) || !empty($_POST['id']) && !empty($_SESSION['username'])){
            $total = $_POST['total'];
            $total = stripcslashes(htmlspecialchars($total)); 
            $quant = $_POST['quantity'];  
            $quant = stripcslashes(htmlspecialchars($quant));
            $prodid = $_POST['prodid'];  
            $prodid = stripcslashes(htmlspecialchars($prodid));
            $image = $_POST['image'];  
            $image = stripcslashes(htmlspecialchars($image));
            $comp = $_POST['company'];  
            $comp = stripcslashes(htmlspecialchars($comp));
            $cod= $_POST['cod'];  
            $cod = stripcslashes(htmlspecialchars($cod));
            $prod = $_POST['products']; 
            $prod = stripcslashes(htmlspecialchars($prod));
            $price = $_POST['price']; 
            $price = stripcslashes(htmlspecialchars($price));
            $initial_status = 0; 
            $status = stripcslashes(htmlspecialchars($initial_status));
                            $orders= "INSERT INTO orders (prodimage, productName, prodId, totalPrice,unitPrice, customer, quantity, code, company, orderStatus) values ('$image','$prod','$prodid','$total','$price','{$_SESSION['username']}', '$quant', '$cod','$comp', '$status')";
                            $result = mysqli_query($con,$orders);
              $username = $_SESSION['username'];          
             header("Location: cart.php?username=$username");
           
}
?>