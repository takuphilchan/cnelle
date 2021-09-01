<head> 
<link rel="stylesheet" href="css/main.css">
</head>
<button onclick="location.href='index.php'" class="homebutton">Return to Home</button> 
<div class="myproduct">
<?php
    error_reporting(0);
    include ('connect.php'); 
    session_start();
 
        $category = $_POST['category'];
        $safe_value = stripcslashes(htmlspecialchars($category));
        $sql = "SELECT * FROM products WHERE category like '{$safe_value}'";
        $result= $con->query($sql); 
        While($row = $result->fetch_assoc()){        
			echo "<div class='anchordeco'>"."<a class='compname' href='clientsidestore.php'>".$row['company']."</a><img data-u='image' src='display.php?id=".$row['id']."' style='height:220px; width:250px;'>"."<br>".$row['name']."<br>".$row['price']."<br>"."<a href='cart.php'><button style='width:70%;height:50px;margin-top:16px;'>Add to cart</button></a>"."</div>"; 
      }
 ?>
 </div>