<head>
<title>cnelle</title>
<script data-ad-client="ca-pub-2754740649298708" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<link rel="stylesheet" href="css/main.css"/>
<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.15.2/css/all.css" rel="stylesheet">
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script>
function changeImage(x){
  document.getElementById('image').src = x.src;
} 
</script> 
</head>
<body class="body-background">
<div class="product-all-container">
<div class="productback-product">
<?php 
error_reporting(0);
include ("connect.php");
$quant = $_POST['quantity'];  
$quant = stripcslashes(htmlspecialchars($quant));
$prodid = $_POST['prodid'];  
$prodid = stripcslashes(htmlspecialchars($prodid));
$color = $_POST['color'];  
$color = stripcslashes(htmlspecialchars($color));
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
$total = $quant * $price;
$total = stripcslashes(htmlspecialchars($total));
if(isset($_POST['wishlist'])){
if(!empty($_SESSION['username']) && !empty($_POST['prodid'])){
                  $status = 0; 
                  $orders= "INSERT INTO orders (prodimage, productName, prodId, color,totalPrice,unitPrice, customer, quantity, code, company, orderStatus) values ('$image','$prod','$prodid','$color','$total','$price','{$_SESSION['username']}', '$quant', '$cod','$comp', '$status')";
                          $result = mysqli_query($con,$orders);
                  echo "<div class='no-messages'>Added to wishlist</div>";
}else{
  header("Location:login.php"); 
}
}else if(isset($_POST['cart'])){
  header("Location:cart.php?action=add&p=$prodid&c=$color&q=$quant");
}
?>
<?php
error_reporting(0);
$proid=$_GET["p"];
include ("connect.php");
$product = mysqli_query($con, "SELECT t1.id, t1.image, t1.image2, t1.image3, t1.category, t1.video, t1.company, t1.price, t1.prodname ,t1.Date, t1.description, t1.color, t2.company, t2.country FROM products as t1, owners as t2 where (t1.company=t2.company and id='$proid')");
      while($product_array = $product->fetch_assoc()){
        $imgURL='productimages/'.$product_array["image"];
        $imgURL2='productimages/'.$product_array["image2"];
        $imgURL3='productimages/'.$product_array["image3"];
        $category = $product_array["category"];
        $productName = $product_array["prodname"];
        $product_id = $product_array['id'];
        $product_company = $product_array["company"] 
?>
      <div class="product-name"><?php echo $product_array["prodname"]; ?></div>
       <div class="container-product-img-info">
       <div style="display: block;">
       <div><?php echo "<img src='".$imgURL."' id='image' alt='' class='product-main-image' raggable='false'>"?></div>
       <div style="display: inline-flex; margin-left: 20px; margin-top: 20px;">
       <?php echo "<img src='".$imgURL."' alt='' onclick='changeImage(this)' class='small-images' draggable='false'>"?>  
       <?php echo "<img src='".$imgURL2."' alt='' onclick='changeImage(this)' class='small-images' style='margin-left: 20px;' draggable='false' >"?>
       <?php echo "<img src='".$imgURL3."' alt='' onclick='changeImage(this)' class='small-images' style='margin-left: 20px;' draggable='false'>"?>
      <?php 
       if(!empty($product_array["video"])){
         
                $videoURL='productvideos/'.$product_array["video"];
       ?>
      <?php echo "<video class='small-video' style='margin-left: 20px;' controls><source src='".$videoURL."' type='video/mp4'></video>";?>
       <?php }?>
      </div>
      </div> 
      <div>
       <div class="proddet">
       <div class="namedsgn"><strong class="product-section-name">SUPPLIER NAME</strong><br><?php echo $product_array["company"];?></div><br>
       <div class="namedsgn"><strong class="product-section-name">PRODUCT PRICE</strong><br><?php echo "$".$product_array["price"]; ?></div><br>
       <div class="namedsgn"><strong class="product-section-name">COUNTRY</strong><br><?php echo $product_array["country"]; ?></div><br>
       <?php if($product_array["country"]=='China'){?><div class="namedsgn"><strong class="product-section-name">SHIPPING TIME</strong><br>
        9 - 12 days</div><br><?php 
       } ?>
       <div class="namedsgn"><strong class="product-section-name">COLOR</strong><br><?php echo $product_array["color"]; ?></div><br>
       <div class="namedsgn"><strong class="product-section-name">POSTED ON </strong><br><?php echo $product_array["Date"]; ?></div><br>
       <div class="namedsgn"><strong class="product-section-name">PRODUCT DESCRIPTION</strong><br><?php echo $product_array["description"]; ?></div><br>
        </div><br>     
        <form action="" method="POST">
        <div class="color-wishlist-container">
        <div><input type="text" name="quantity" class="choose-color-quantity" value="1" size="2"/></div>
       <div>
        <input type="text" name="color"  list="color"  class="choose-color-quantity" placeholder="choose color" required maxlength=22>
					<datalist id="color">
								<option value="Black">
								<option value="Blue">
								<option value="Red">
								<option value="White">
								<option value="Brown">
								<option value="Pink">
								<option value="Grey">
		            </datalist>
				</div> 
        <div>
				<input type="text" name="prodid" hidden  value="<?php echo $product_array["id"]; ?> ">
        <input type="text" name="image" hidden value="<?php echo $product_array["image"]; ?> ">
        <input type="text" name="company" hidden value="<?php echo $product_array["company"]; ?>">
				<input type="text" name="cod" hidden value="<?php echo $product_array["code"]; ?>">
				<input type="text" name="products" hidden value="<?php echo $product_array["prodname"]; ?> ">
				<input type="text" name="price" hidden value="<?php echo $product_array["price"]; ?> ">
        </div>      
        </div><br>
        <div class="cart-action-product">
        <button type="submit" name="wishlist" class="add-to-wishlist"><i class="fa fa-heart"></i><br/>Add to wishlist</button>
        <button type="submit" name="cart" class="add-to-cart"><i class="fa fa-shopping-cart"></i><br>Add to cart</button> 
        </div>
       </form>
      </div>
      </div><br>  
      <div class="proddet-comp">
      <?php 
        $imgComp = mysqli_query($con, "SELECT OwnerImage, company FROM owners where company = '{$product_company}'");
        while ($comp = $imgComp->fetch_assoc()){
            $img='storeprofile/'.$comp["OwnerImage"]; ?><br>
            <buttom onclick="location.href='clientsidestore.php?company=<?php echo $product_company;?>'" class="product-button-to-store"> <?php echo "<img src='".$img."' class='store-image-product'><br>"; echo $product_company;?></button>
       </form>
    </div> 
   <?php
        }
   }
   ?>
<?php 
error_reporting(0);
session_start();
include ("connect.php");
if(isset($_POST["send"])){
   if(!empty($_SESSION['username'])){
    $message = $_POST['message'];
    $comment_by = $_SESSION['username'];
    $product_id = $_GET['p'];
    if(!empty($message) && !empty($product_id) && !empty($comment_by)){
    $sql = "INSERT INTO comments (message, customer, prodid) values ('$message', '$comment_by', '$product_id')";
    mysqli_query($con, $sql);
    } 
}else{
  header("Location:login.php");
}
}
?>   

<div class="product-reviews-textbox-container">
<form action="product.php?p=<?php echo $_GET['p'];?>" method="POST">
 <?php
                    error_reporting(0);
                    session_start(); 
                    include ('connect.php');
                            $sql = "SELECT t1.Date, t1.message, t1.customer, t2.CustomerImage FROM comments as t1, customers as t2 WHERE ((prodid = '{$_GET['p']}') and (t1.customer = t2.username)) ORDER BY t1.Date DESC";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {?> 
                             <div class="messages-textbox-container">
                               <div class="review-title">
                                <strong>PRODUCT REVIEWS</strong>
                              </div> 
                              <div class="comment" id="message">   
                              <?php
                                while($row = $result->fetch_assoc()) {
                                    $imgCustomer = 'customerprofile/'.$row["CustomerImage"]; 
                                    if(($row['customer']) == ($_SESSION['username'])){
                                        echo "<div class='message-container-me' >"."<div class='msg-com-me'>"."<p class='date-message-me'>".$row["Date"]."</p>".$row["message"]."</div>"."<img src='".$imgCustomer."' alt=''; class='sendby-me' draggable='false'/>"."</div>"."<br>";
                                    }else{
                                      echo "<div class='message-container-sender'>"."<img src='".$imgCustomer."' alt=''; class='sendby-someone' draggable='false'/>"."<div class='msg-com'>"."<p class='date-message-img-someone'>".$row["Date"]."</p>".$row["message"]."</div>"."</div>"."<br>";
                                      }
                                    }?>   
                                 </div><br>   
                                <?php
                                  }else{
                                          echo "<div class='no-messages'>No reviews yet<br><br> Leave a review</div><br>";
                                    }
                                 ?>
                            <div class="textbox-area-product">
                            <textarea type="text" class="textbox" name="message" placeholder="type a review" autocomplete="off"></textarea>
                            <button type="submit" name="send" class="send-button"><i class="fa fa-paper-plane"></i></button>
                          </div> 
                      </div>     
              </form>  
            </div>
          
            <?php
              include ('connect.php');
              $safe_value = stripcslashes(htmlspecialchars($category));
              $safe_product_value = stripcslashes(htmlspecialchars($productName));
              $new_product_name = substr($safe_product_value, 0 , 3);
              $query = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname,t1.category, t1.company, t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) and t1.category like '{$safe_value}' or t1.prodname like  '{$new_product_name}' ORDER BY RAND() limit 10");
              if ($query ->num_rows > 1) {  ?>
              <div class="products-main-page-allproducts">
              <h3 class="products-heading-section">Other related products</h3>
              <?php
              while($product = mysqli_fetch_array($query)){
                $imgURL = 'productimages/'.$product["image"];
                $imageOwner = 'storeprofile/'.$product["OwnerImage"]; 
                if($product['id'] !== $proid){
               ?>
                <div class="productdeco">
                      <div class="productImg-container"> 
                      <a href="product.php?p=<?php echo $product["id"]; ?>" class="productImg-link">
                      <?php echo "<img src='".$imgURL."' class='productImg' draggable='false'>"?>
                      </a>
                      </div>
                    <div class="product-title"><?php echo substr($product["prodname"], 0 , 17); ?></div>
                    <div class="product-det">   
                    <div class="product-price"><?php echo "$".$product["price"]; ?></div>
                      <a class="product-company" href="clientsidestore.php?company=<?php echo $product["company"]; ?>">
                      <div class="company-prod">
                          <?php echo "<img src='".$imageOwner."' class='store-image' draggable='false'>"?><strong class="store-name-productdeco"><?php echo substr($product_array["company"], 0 , 14).' '.'⟩⟩'; ?></strong>
                    </div>
                    </a><br>
                    </div>
                </div>
              <?php
                    } 
                  }
                }else{
                  echo "<div class='no-messages'>No other related products</div>";
                }
                  ?>
    </div>             
</body>


