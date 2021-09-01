<title>cnelle</title>
<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.15.2/css/all.css" rel="stylesheet">
<script src="javascript/jquery.js"></script>
<script src="javascript/scroll-back-top.js" ></script>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<meta content="width=device-width, initial-scale=0.80, maximum-scale=5.0, minimum-scale=0.80" name="viewport">
<link rel="stylesheet" href="css/main.css"/>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<body class="main">
<?php 
  error_reporting(0);
  include ('connect.php');
  if($_GET["company"]){
  $sql_cover = "SELECT * FROM owners WHERE company='{$_GET["company"]}'";
  $result_cover = mysqli_query($con, $sql_cover); 
  if($result_cover==true){
      while($row_cover = $result_cover->fetch_assoc()){
        $imgURL1 = 'storeprofile/'.$row_cover["OwnerImage"];
        $phone = $row_cover['phone'];


?>
<div  style="background-image: url('images/cover.jpeg');" class="top-store-cover">
<div class="top-store" style="background-color:<?php echo $row_cover['storeColor'];?>" >

<?php }
}
 }?>
<button  onclick="location.href='index.php'" class="top-left-button-custom">Home</button> 
<button  class="top-right-button-custom" onclick="location.href='storeContact.php?company=<?php echo $_GET['company']; ?>'">info</button>
<button  class="top-right-button-custom" onclick="location.href='update_notification_status.php?company=<?php echo $_GET['company']; ?>'">Messages</button>
<?php
       error_reporting(0);
        include ('connect.php');
        if($_GET["company"]){
        $sql = "SELECT * FROM owners WHERE company='{$_GET["company"]}'";
        $result = mysqli_query($con, $sql); 
        if($result==true){
            while($row = $result->fetch_assoc()){
              $imgURL1 = 'storeprofile/'.$row["OwnerImage"];
              echo "<div style='margin-top: 40px;color:white;font-size: 1.2em; font-weight: bold; text-align:center;font-variant-caps: all-petite-caps;'>"."<img src='".$imgURL1."' class='profile-image-store'>"."<br>".$row['company']."</div>";  
         }
       }
    }
    ?> 
  </div>
</div>

<div class="products">
<?php
error_reporting(0);
include ("connect.php");
$product = mysqli_query($con, "SELECT * FROM products where company='{$_GET["company"]}' ORDER BY RAND()");
if ($product ->num_rows > 0) {  
      while($product_array = $product->fetch_assoc()){
        $imgURL = 'productimages/'.$product_array["image"];
   ?>
 	<div class="productdeco">
        <div class="productImg-container"> 
          <a href="product.php?p=<?php echo $product_array["id"]; ?>" class="productImg-link">
          <?php echo "<img src='".$imgURL."' class='productImg' draggable='false'>"?>
          </a>
        </div>
       <div class="product-title"><?php echo substr($product_array["prodname"], 0 , 12); ?></div>
       <div class="product-det">
       <div class="product-price"><?php echo "$".$product_array["price"]; ?></div>
       </div>
  </div>
   <?php
   }
}else{
  echo "<div class='no-products'>No products yet from this store</div>";
}
   ?>
   </div>
  <a class="whatsapp" href="https://wa.me/<?php echo $phone;?>"><img src='images/whatsapp.jpeg'/></a>
   <a id="back2Top" title="Back to top" href="#">&#10148;</a>
   </body>