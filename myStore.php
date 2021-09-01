<?php 
session_start(); 
if(!isset($_SESSION['logged'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location: storeLoggin.php"); }
?>
<html>
<head>
<title>cnelle</title> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.css" rel="stylesheet"> 
<script src="javascript/jquery.js"></script>
<script src="javascript/scroll-back-top.js" ></script>
<link rel="stylesheet" href="css/main.css">
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<meta content="width=device-width, initial-scale=0.80, maximum-scale=5.0, minimum-scale=0.80" name="viewport">
</head>


<body class="main">
        <?php 
          error_reporting(0);
          include ('connect.php');
          if($_SESSION["company"]){
            $sql_cover = "SELECT * FROM owners WHERE company='{$_SESSION["company"]}'";
            $result_cover = mysqli_query($con, $sql_cover); 
            if($result_cover==true){
                while($row_cover = $result_cover->fetch_assoc()){
                  $imgURL1 = 'storeprofile/'.$row_cover["OwnerImage"];
          ?>
        <div style="background-image: url('images/cover.jpeg');" class="top-store-cover" >
        <div class="top-store" style="background-color:<?php echo $row_cover['storeColor'];?>" >
        <button onclick="location.href='index.php'" class="top-left-button-custom">Home</button>
        <button onclick="location.href='sell.php'" class="top-right-button-custom">Sell</button> 
        <button onclick="location.href='storeOrders.php?company=<?php echo  $_SESSION['company'];?>'" class="top-right-button-custom">Orders</button> 
        <button onclick="location.href='allChats.php'" class="top-right-button-custom">Chats</button> 
        <form action="myStore.php" method="GET" >
        <div id="search"> 
                  <input type="text" class="searchbar" name="search" placeholder="Search..."/>
                  <button type="submit" name="submit" id="icon" style="color: <?php echo $row_color['storeColor'];?>"><i class="fa fa-search"></i></button>
        </div>
        </form>
        <div class="txt-heading-store" >
            <a href="myStore.php?company=<?php echo $_SESSION['company'];?>" id="companyname" ><?php
            if(!empty($_SESSION['company'])){
            echo  "<img src='".$imgURL1."' class='profile-image-store'>";?></a>
        </div>
        </div>
    </div>
    <div class="products">
        <?php
        error_reporting(0);
        session_start();
        include ('connect.php');
        if(isset($_GET['search'])){
          ?>
          <h1 class="section-heading">Search results of <?php echo $_GET['search'];?> </h1>	
              <?php 
              $search = $_GET['search'];
              $safe_search = stripcslashes(htmlspecialchars($search));
              $search_query = mysqli_query($con, "SELECT * FROM products WHERE (company='{$_SESSION['company']}') and (prodname like '%$safe_search%') ORDER BY RAND()");
              if ($search_query ->num_rows > 0) { 
              while($product_array = $search_query->fetch_assoc()){
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
                <div class="cart-action">
                <button class="buttonprod-mystore-update" onclick="location.href='productUpdate.php?p=<?php echo $product_array['id']; ?> && company=<?php echo $product_array['company']; ?>''" style='background-color:<?php echo $row_color['storeColor'];?>'>Update</button>
                <button class="buttonprod-mystore-delete" onclick="location.href='deleteProduct.php?p=<?php echo $product_array['id']; ?>'">Delete</button>
                </div>
                </div>
              </div>
            <?php
            }
          }else{
            echo "<div class='no-products'>No products with this name</div>";
          }
        }else{
        $product = mysqli_query($con, "SELECT * FROM products where company='{$_SESSION['company']}' ORDER BY RAND()");
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
            <div class="cart-action">
            <button class="buttonprod-mystore-update" onclick="location.href='productUpdate.php?p=<?php echo $product_array['id']; ?> && company=<?php echo $product_array['company']; ?>'" style="background-color: <?php echo $row_cover['storeColor'];?>">Update</button>
            <button class="buttonprod-mystore-delete" onclick="location.href='deleteProduct.php?p=<?php echo $product_array['id']; ?>'">Delete</button>
            </div>
            </div>
          </div>
        <?php
        }
      }else{
        echo "<div class='no-products'>No products yet</div>";
      }
        }
      }
        ?>  
        <a id="back2Top" title="Back to top" href="#">&#10148;</a>
    </div>
     <?php }
        }
        }?>
    </body>
</html>