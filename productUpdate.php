<?php 
session_start(); 
if(!isset($_SESSION['logged'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location: storeLoggin.php"); }
?>
<!DOCTYPE html>
<html>
<head>
<title>cnelle</title>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">  
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />    
<link rel="stylesheet" href="css/main.css">
<script src="javascript/keypads.js"></script>
</head>
<body class="body-background-with-design">
<button onclick="location.href='myStore.php'" class="top-left-button">myStore</button>  
<?php
error_reporting(0);
session_start();
include ('connect.php');
   if(isset($_POST["submit"])){
            $product_price=$_POST['price'];
            $product_id=$_POST['id'];
            $product_Date=$_POST['date'];
            $product_name =$_POST['name'];
            $product_category =$_POST['category'];
            $product_price = stripcslashes(htmlspecialchars ($product_price));
            $product_name = stripcslashes(htmlspecialchars ($product_name));
            $product_category = stripcslashes(htmlspecialchars ($product_category));
            $updt = "UPDATE products set price='$product_price', prodname='$product_name',Date='$product_Date', category = '$product_category' WHERE company = '{$_SESSION['company']}' and id = '$product_id'"; 
                      $success = mysqli_query($con,$updt);  
                      if($success==true){
                       echo "<p class='notification-message'>Congratulations product information has been updated</p>";

                    }
                    else{
                            echo"<p class='invalid'>Product information failed to update</p>"; 
                        }    
               }  
?>  
<?php 
error_reporting(0);
session_start();
include ('connect.php'); 
            $result = mysqli_query($con, "SELECT id, image, price, prodname, category, Date FROM products where company = '{$_SESSION['company']}' and id = {$_GET['p']}"); 
$row= mysqli_fetch_array($result);
?>
<div id="register">
<div class="form-top"> <strong class="form-name">Update Product</strong> </div><br>
<div class="form-body">
              <h2 style="margin:auto;">Product picture</h2> <br>
              <?php $imgURL = 'productimages/'.$row["image"];  echo "<img src='".$imgURL."' draggable='false' style='height:200px; border-radius:50%; width:200px;'>";?><br><br>
             <form action="productUpdate.php?id=<?php echo $row['id']; ?> && company=<?php echo $row['company']; ?>" method="POST">
              <input type="text" name="id" style="display: none;" maxlength=30 value="<?php echo $row['id'];?>">
              <input type="text" name="date" style="display: none;" maxlength=30 value="<?php echo $row['Date'];?>"> 
                <div class="form">
              <input type="text"  name="name" class="form-input"  required maxlength=30 value="<?php echo $row['prodname'];?>">
              <label for="name" class="label-name">
                      <span class="content-name">Enter new product name</span>
                  </label>
              </div>
              <div class="form">
              <input type="text"  name="price" id="price" class="form-input" required maxlength=30 value="<?php echo $row['price']; ?>">
              <label for="price" class="label-name">
                      <span class="content-name">Enter new price</span>
                  </label>
              </div>
              <div class="form">
              <input type="text" name="category" class="form-input" list="category" value="<?php echo $row['category'];?>" required maxlength=22>
                  <label for="category" class="label-name">
                          <span class="content-name">Enter new category</span>
                  </label>
                  <datalist id="category">
                                <option value="Clothing">
                                <option value="Drinks and beverages">
                                <option value="appliances">
                                <option value="gadgets"> 
                                <option value="fruits and vegetables">
                                <option value="Hardware">
                                <option value="Shoes">
                                <option value="Grocery">
                                <option value="Bags">
                                <option value="Books">
                                <option value="Services">
                                <option value="farm products">
                                <option value="housing">
                                <option value="Cars and trucks">
                                <option value="Women">
                                <option value="Men">
                                <option value="Sports">
                                <option value="Children">
                                <option value="Youth">
                                <option value="Gaming">
                                <option value="Entertainment">
                                <option value="Other">
                            </datalist>
                         </div>  
                <button type="submit" name="submit" class="button-for-forms">UPDATE</button><br><br>
        </form><br>
</div>  
</div>
<footer id="footer">&copy; 2021 cnelle.com<footer>
</body>
</html>