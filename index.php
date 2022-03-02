
<!DOCTYPE html> 
<html>
<head>
<title>cnelle</title>
<script src="javascript/jquery.js"></script>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.15.2/css/all.css" rel="stylesheet">
<meta content="width=device-width, initial-scale=0.80, maximum-scale=5.0, minimum-scale=0.80" name="viewport">
<link rel="stylesheet" href="css/main.css">
<script src="javascript/authoptions-toggle.js" ></script>
<script src="javascript/scroll-back-top.js" ></script>
<script src="javascript/notify.js"></script>
</head>
<body class="main">
<!--TOP NAVIGATION DIV-->
<div class="enclose">
<!--NOTIFICATION ANG MESSAGES BUYER-->
<?php  
       error_reporting(0);
       session_start();
       include ('connect.php');
       if(!empty($_SESSION["username"])){ ?>
<div style="display: inline-flex; float:right; margin-top: 5px;">
          <div class="notification-dropdown">
          <div  class="notifybtn"><i  class="fa fa-bell"></i></div>
          <span class="notify"></span>
          </div>
          <div id="notification" class="dropdownNotification"></div>
          <div class="dropdown">
          <div class="dropbtn"><i class="fa fa-envelope"></i></div>
          <span class="badge badge-danger"></span>
          </div>
          <div id="myDropdown" class="dropdown-content"></div>
</div>

<!--NOTIFICATION ANG MESSAGES SELLER-->
<?php }else if(!empty($_SESSION["company"])){ ?>
<div style="display: inline-flex; float:right; margin-top: 5px;">
          <div class="notification-dropdown">
          <div  class="notifybtn"><i  class="fa fa-bell"></i></div>
          <span class="notify"></span>
          </div>
          <div id="notification" class="dropdownNotification"></div>
          <div class="dropdown">
          <div  class="dropbtn"><i class="fa fa-envelope"></i></div>
          <span class="badge badge-danger"></span>
          </div>
          <div id="myDropdown" class="dropdown-content"></div>
</div>
<?php }else{?>
<div style="display: inline-flex; float:right; margin-top: 5px;">
<a href="login.php"><div  class="notifybtn"><i  class="fa fa-bell"></i></div></a>
<a href="login.php"><div class="dropbtn"><i class="fa fa-envelope"></i></div></a>
</div>
<?php }?>
<!--NAVIGATION OPTIONS AFTER LOGGED IN ALL -->
<div class="enclose-inner-container">
<div>
<?php if(!empty($_SESSION["company"]) || !empty($_SESSION["username"])){  ?>    
      <div class="top-dropper-container-all"> 
        <a id="topdropper2" class="top-dropper-main-options"><i class="fa fa-bars"></i></a>   
        <nav class="authoptions">
                       <a class="authoptions-remover">×</a>
                        <div class="authoptions-inner-container">
                        <?php
                        error_reporting(0);
                        session_start(); 
                        include ('connect.php');
                        if(isset($_SESSION['username'])){
                        $customer_sql = "SELECT * FROM customers WHERE username='{$_SESSION['username']}'";
                        $customer_result = mysqli_query($con, $customer_sql); 
                        if($customer_result==true){
                            while($row = $customer_result->fetch_assoc()){
                              $my_profile = 'customerprofile/'.$row["CustomerImage"];?>
                              <div class="main-options">
                                <?php echo '<img src="'.$my_profile.'" class="profile-picture" alt="">'; ?>
                              </div>
                            <?php } 
                              } ?>
                            <div class="main-option-container">
                                  <a href="profile.php"  class="main-options">My Profile</a>
                              </div>
                              <div class="main-option-container">
                                  <a href="allorders.php"  class="main-options">My Orders</a>
                              </div>
                              <div class="main-option-container">
                                  <a href="allChats.php"  class="main-options">Chats</a>
                              </div>
                              <div class="main-option-container">
                                  <a href="allengagementhistory.php"  class="main-options">My wishlist</a>
                              </div>  
                            <?php }else if(isset($_SESSION['company'])){
                              $company_sql = "SELECT * FROM owners WHERE company='{$_SESSION['company']}'";
                              $company_result = mysqli_query($con, $company_sql); 
                              if($company_result==true){
                                while($rows = $company_result->fetch_assoc()){
                                  $company_profile = 'storeprofile/'.$rows["OwnerImage"];?>
                                  <div>
                                    <?php echo '<img src="'.$company_profile.'" class="profile-picture" alt="">'; ?>
                                  </div>
                                <?php }
                                } ?> 
                            <div class="main-option-container">
                                  <a href="storeProfile.php"  class="main-options">My Profile</a>
                              </div>
                              <div class="main-option-container">
                                  <a href="storeOrders.php"  class="main-options">Customer Orders</a>
                              </div>
                              <div class="main-option-container">
                                  <a href="allChats.php"  class="main-options">Chats</a>
                              </div>
                            <?php 
                                }?>
                            <div class="main-option-container">
                            <a id="dropper-three-mobile"  class="main-options">Region</a> 
                            <div id="dropdownRegion-content-mobile" class="all-dropdown">
                                                    <a href="index.php?r=Zimbabwe">Zimbabwe</a>
                                                    <a href="index.php?r=China">China</a>
                                                    <a href="index.php?r=South Africa">South Africa</a>
                                                    <a href="index.php?r=Rwanda">Rwanda</a>
                                                    <a href="index.php?r=Ethiopia">Ethiopia</a>
                                                    <a href="index.php?r=Tanzania">Tanzania</a>
                            </div>
                            </div>
                            <div class="main-option-container" >
                            <a id="dropper-four-mobile"  class="main-options">Category</a>
                            <div id="dropdownCategory-content-mobile" class="all-dropdown">
                                                    <a href="index.php?c=Clothing">Clothing</a>
                                                    <a href="index.php?c=Women">Women</a>
                                                    <a href="index.php?c=Men">Men</a>
                                                    <a href="index.php?c=Sports">Sports</a>
                                                    <a href="index.php?c=Children">Children</a>
                                                    <a href="index.php?c=Youth">Youth</a>
                                                    <a href="index.php?c=Gaming">Gaming</a>
                                                    <a href="index.php?c=Beverages">Beverages</a>
                                                    <a href="index.php?c=Appliances">Appliances</a>
                                                    <a href="index.php?c=Gadgets">Gadgets</a>
                                                    <a href="index.php?c=Vegetables">Vegetables</a>
                                                    <a href="index.php?c=Hardware">Hardware</a>
                                                    <a href="index.php?c=Shoes">Shoes</a>
                                                    <a href="index.php?c=Grocery">Grocery</a>
                                                    <a href="index.php?c=Bags">Bags</a>
                                                    <a href="index.php?c=Books">Books</a>
                                                    <a href="index.php?c=Services">Services</a>
                                                    <a href="index.php?c=Dairy">Dairy</a>
                                                    <a href="index.php?c=Housing">Housing</a>
                                                    <a href="index.php?c=Cars">Cars</a>
                                                    <a href="index.php?c=Entertainment">Entertainment</a>
                                                    <a href="index.php?c=Other">Other</a>
                                    </div>
                        </div>
              <div class="main-option-container">      
              <a href="privacy.html" class="main-options">Privacy Policy</a>
              </div>          
              <div class="main-option-container">      
              <a href="contact.php" class="main-options">About</a>
              </div>
              <?php 
                  if(!empty($_SESSION["company"]) || !empty($_SESSION["username"])){
                    ?>
             <div class="main-option-container">      
              <a href="logout.php" class="main-options">Log Out</a>
                  <?php }?>
              </div>
              <footer class="authoptions-footer">&copy; 2021 cnelle.com <br> Designed and Developed by cnelle technology</footer>
              </div>
            </nav>
            <a class="company" href="index.php">cnelle.com</a> 
        </div>
<!--NAVIGATION OPTIONS AFTER LOGGED IN -->
<?php } ?>     
     <?php 
       error_reporting(0);
       include ('connect.php');
       session_start();
       if(!empty($_SESSION["company"]) || !empty($_SESSION["username"])){
       ?>  
       <div class="maintop">
        <?php
         include ('connect.php');
         session_start();
       if(isset($_SESSION["company"])){?> 
       <div class="main-option-container"><a href="helpStore.php" class="anchorindex"><i class="fa fa-question-circle"></i><span class="anchorindex-names">Help</span></a></div> 
       <div class="main-option-container"><a href="sell.php" class="anchorindex"><i class="fa fa-plus-square"></i><span class="anchorindex-names">Sell</span></a></div> 
       <div class="main-option-container"><a href="myStore.php" class="anchorindex"><i class="fa fa-building"></i><span class="anchorindex-names">MyStore</span></a></div>  
       <div class="main-option-container"> <a href="storeProfile.php" class="anchorindex"><i class="fa fa-user"></i><span class="anchorindex-names">Account</span></a></div> 
       <div class="note-anchorindex-outer"> <a class="note-anchorindex"><span class="anchorindex-names">Buy affordable and high quality products</span></a></div> 

       <?php }else if(isset($_SESSION["username"])){ 

        if (($_SESSION["username"]) == 'Administrator'){ ?>  
      <div class="main-option-container"> <a href="Management.php" class="anchorindex"><i class="fa fa-cogs"></i><span class="anchorindex-names">ControlPanel</span></a></div> 
      <div class="main-option-container"><a href="cart.php" class="anchorindex"><i class="fa fa-shopping-cart"></i><span class="anchorindex-names" >Cart</span></a></div>  
      <div class="main-option-container"> <a href="review.php" class="anchorindex"><i class="fa fa-thumbs-up"></i><span class="anchorindex-names">Feedback</span></a></div>  
      <div class="main-option-container"><a href="profile.php" class="anchorindex"><i class="fa fa-user"></i><span class="anchorindex-names">Account</span></a></div> 
      <div class="note-anchorindex-outer"> <a class="note-anchorindex"><span class="anchorindex-names">Buy affordable and high quality products</span></a></div> 
           
        <?php }else{ ?>

      <div class="main-option-container"><a href="help.php" class="anchorindex"><i class="fa fa-question-circle"></i><span class="anchorindex-names">Help</span></a></div> 
      <div class="main-option-container"><a href="cart.php" class="anchorindex"><i class="fa fa-shopping-cart"></i><span class="anchorindex-names">Cart</span></a></div> 
      <div class="main-option-container"><a href="review.php" class="anchorindex"><i class="fa fa-thumbs-up"></i><span class="anchorindex-names">Feedback</span></a></div> 
      <div class="main-option-container"> <a href="profile.php" class="anchorindex"><i class="fa fa-user"></i><span class="anchorindex-names">Account</span></a></div> 
      <div class="note-anchorindex-outer"><div class="main-option-container"><a class="note-anchorindex"><span class="anchorindex-names">Buy affordable and high quality products</span></a></div></div>
      <?php }
       } ?>
      </div>
       <?php }?>
    <!--NAVIGATION OPTIONS BEFORE LOGGED IN -->
    <?php if(empty($_SESSION["company"]) && empty($_SESSION["username"])){  ?>    
      <div class="top-dropper-container"> 
      <a id="topdropper2" class="top-dropper-main-options"><i class="fa fa-bars"></i></a>
      
        <nav class="authoptions">
                      <a class="authoptions-remover">×</a>
                     <div class="authoptions-inner-container">
                            <div class="main-options">
                               <img src="images/placeholder.jpg" class="profile-picture" alt="">
                              </div>
                              <div class="main-option-container">
                              <a  id="dropper1" class="main-options">Log In</a>
                                <div id="dropdownMainLogin-content" class="all-dropdown">
                                  <a href="login.php">Buyer</a>
                                  <a href="storeLoggin.php">Seller</a>
                                </div>
                              </div>
                              <div class="main-option-container">
                              <a id="dropper2"  class="main-options">Sign Up</a>
                                <div id="dropdownMainSignup-content" class="all-dropdown">
                                  <a href="register.php">Buyer</a>
                                  <a href="storeRegister.php">Seller</a>
                                </div>
                            </div>
                            <div class="main-option-container">
                            <a id="dropper3"  class="main-options">Region</a> 
                            <div id="dropdownRegion-content" class="all-dropdown">
                                                    <a href="index.php?r=Zimbabwe">Zimbabwe</a>
                                                    <a href="index.php?r=China">China</a>
                                                    <a href="index.php?r=South Africa">South Africa</a>
                                                    <a href="index.php?r=Rwanda">Rwanda</a>
                                                    <a href="index.php?r=Ethiopia">Ethiopia</a>
                                                    <a href="index.php?r=Tanzania">Tanzania</a>
                            </div>
                            </div>
                            <div class="main-option-container" >
                            <a id="dropper4"  class="main-options">Category</a>
                            <div id="dropdownCategory-content" class="all-dropdown">
                                                    <a href="index.php?c=Clothing">Clothing</a>
                                                    <a href="index.php?c=Women">Women</a>
                                                    <a href="index.php?c=Men">Men</a>
                                                    <a href="index.php?c=Sports">Sports</a>
                                                    <a href="index.php?c=Children">Children</a>
                                                    <a href="index.php?c=Youth">Youth</a>
                                                    <a href="index.php?c=Gaming">Gaming</a>
                                                    <a href="index.php?c=Beverages">Beverages</a>
                                                    <a href="index.php?c=Appliances">Appliances</a>
                                                    <a href="index.php?c=Gadgets">Gadgets</a>
                                                    <a href="index.php?c=Vegetables">Vegetables</a>
                                                    <a href="index.php?c=Hardware">Hardware</a>
                                                    <a href="index.php?c=Shoes">Shoes</a>
                                                    <a href="index.php?c=Grocery">Grocery</a>
                                                    <a href="index.php?c=Bags">Bags</a>
                                                    <a href="index.php?c=Books">Books</a>
                                                    <a href="index.php?c=Services">Services</a>
                                                    <a href="index.php?c=Dairy">Dairy</a>
                                                    <a href="index.php?c=Housing">Housing</a>
                                                    <a href="index.php?c=Cars">Cars</a>
                                                    <a href="index.php?c=Entertainment">Entertainment</a>
                                                    <a href="index.php?c=Other">Other</a>
                                    </div>
                        </div>
                <div class="main-option-container">      
              <a href="privacy.html" class="main-options">Privacy Policy</a>
              </div>       
              <div class="main-option-container">      
              <a href="contact.php" class="main-options">About</a>
              </div>
              <footer class="authoptions-footer">&copy; 2021 cnelle.com<br> Designed and Developed by cnelle technology</footer> 
            </div>
          </nav>
            <a class="company" href="index.php">cnelle.com</a>
        </div>
    <?php } ?>
</div>
<div>
<?php
 $query_name_search = mysqli_query($con, "SELECT prodname FROM products ORDER BY RAND() ");
 while($name_search  = mysqli_fetch_array($query_name_search)){
        $placeholder = $name_search['prodname'];
 }
?>
<!--SEARCH-->
<form action="index.php" method="GET" >
    <div id="search"> 
              <input type="text" class="searchbar" name="search" placeholder="<?php if(empty($_GET['search'])){echo $placeholder; }else{ echo $_GET['search'];}?>"/>
              <button type="submit" name="submit" id="icon"><i class="fa fa-search"></i></button>
    </div>
</form>
</div>
</div>
<!--OPTIONS-->
<?php if(empty($_SESSION["company"]) && empty($_SESSION["username"])){?>
<div class="maintop-placeholder">      
      <div class="main-option-container"><a href="help.php" class="anchorindex"><i class="fa fa-question-circle"></i><span class="anchorindex-names">Help</span></a></div> 
      <div class="main-option-container"><a href="cart.php" class="anchorindex"><i class="fa fa-shopping-cart"></i><span class="anchorindex-names">Cart</span></a></div> 
      <div class="main-option-container"><a href="sell.php" class="anchorindex"><i class="fa fa-plus-square"></i><span class="anchorindex-names">Sell</span></a></div> 
      <div class="main-option-container"><a href="review.php" class="anchorindex"><i class="fa fa-thumbs-up"></i><span class="anchorindex-names">Feedback</span></a></div> 
      <div class="main-option-container"> <a href="profile.php" class="anchorindex"><i class="fa fa-user"></i><span class="anchorindex-names">Account</span></a></div> 
      <div class="note-anchorindex-outer"> <a class="note-anchorindex"><span class="anchorindex-names">Buy affordable and high quality products</span></a></div> 
</div>
<?php }?>
</div>
<div>
<?php
  if(empty($_GET['search']) && empty($_GET['l']) && empty($_GET['c']) && empty($_GET['r'])){?>
<div class="top-section-container">
<div class="top-display-container">
<script src="javascript/image-slider.js"></script>

<div>
<h1 class="section-heading">Latest Arrivals</h1>
<?php
  $product = mysqli_query($con, "SELECT * FROM Adverts where current='active' limit 1");
     while($product_array = $product->fetch_assoc()){
       $imgURL = 'productimages/'.$product_array["image1"];
       $imgURL2 = 'productimages/'.$product_array["image2"];
       $imgURL3 = 'productimages/'.$product_array["image3"];
  ?> 
        <!--image slider start-->
        <div class="slider">
   
       <div class="slides">
        <!--radio buttons start-->
        <input type="radio" name="radio-btn" id="radio1">
        <input type="radio" name="radio-btn" id="radio2">
        <input type="radio" name="radio-btn" id="radio3">
        <!--radio buttons end-->
        <!--slide images start-->
      
          <div class="slide first">
          <a href="index.php?l=gadgets" style="text-decoration: none; outline: none;">
          <?php echo "<img src='".$imgURL."' draggable='false'>"?>      
           </a>
          </div>
          <div class="slide">
          <a href="index.php?l=shoes" style="text-decoration: none; outline: none;">
          <?php echo "<img src='".$imgURL2."' draggable='false'>"?>      
           </a>
          </div>
          <div class="slide">
          <a href="index.php?l=clothing" style="text-decoration: none; outline: none;">
          <?php echo "<img src='".$imgURL3."' draggable='false'>"?>      
           </a>
          </div>
        <!--automatic navigation start-->
        <div class="navigation-auto">
          <div class="auto-btn1"></div>
          <div class="auto-btn2"></div>
          <div class="auto-btn3"></div>
        </div>       
        <!--automatic navigation end-->
      </div>
      <!--manual navigation start-->
      <div class="navigation-manual">
        <label for="radio1" class="manual-btn"></label>
        <label for="radio2" class="manual-btn"></label>
        <label for="radio3" class="manual-btn"></label>
      </div>
      <!--manual navigation end-->
    </div>
    </div>
  </div>
</div>
<!--TOP CATEGORY-->
<div class="top-category-outer">
<div class="category-background">
<h1 class="section-heading">Top categories</h1> 
<div class="top-container-category">
<div class="top-category">
<div class="category-container"><a href="index.php?c=Women" style="text-decoration: none; " class="main-category-names"><div style="background-image: url('categoryIcons/women.jpeg');" class="main-category"></div><span>Women</span></a></div>
<div class="category-container"><a href="index.php?c=Men" style="text-decoration: none; " class="main-category-names"><div style="background-image: url('categoryIcons/men.jpeg');" class="main-category"></div><span>Men</span></a></div>
<div class="category-container"><a href="index.php?c=Children" style="text-decoration: none; " class="main-category-names"><div style="background-image: url('categoryIcons/kids.jpeg');" class="main-category"></div><span>Children</span></a></div>
<div class="category-container"><a href="index.php?c=shoes" style="text-decoration: none; " class="main-category-names"><div style="background-image: url('categoryIcons/Shoes.jpeg');" class="main-category" ></div><span>Shoes</span></a></div>
<div class="category-container"><a href="index.php?c=gadgets" style="text-decoration: none; " class="main-category-names" ><div style="background-image: url('categoryIcons/gadgets.jpeg');" class="main-category"></div><span>Gadgets</span></a></div>
</div>
<div class="top-category">
<div class="category-container"><a href="index.php?c=Books" style="text-decoration: none; " class="main-category-names" ><div style="background-image: url('categoryIcons/books.jpeg');" class="main-category" ></div><span>Books</span></a></div>
<div class="category-container"><a href="index.php?c=Bags" style="text-decoration: none; " class="main-category-names"><div style="background-image: url('categoryIcons/bags.jpeg');" class="main-category"></div><span>Bags</span></a></div>
<div class="category-container"><a href="index.php?c=Other" style="text-decoration: none; " class="main-category-names"><div style="background-image: url('categoryIcons/others.jpeg');" class="main-category"></div><span>Other</span></a></div>
<div class="category-container"><a href="index.php?c=Sports" style="text-decoration: none; " class="main-category-names"><div style="background-image: url('categoryIcons/Sports.jpeg');" class="main-category" ></div><span>Sports</span></a></div>
<div class="category-container"><a href="index.php?c=Clothing" style="text-decoration: none; " class="main-category-names"><div style="background-image: url('categoryIcons/clothing.jpeg');" class="main-category"></div><span>Clothing</span></a></div>
</div>
</div>
</div>
</div>
  <?php
       }
  }
?>
<!--ALL PRODUCTS-->
<?php
error_reporting(0);
session_start();
include ('connect.php');
if(empty($_GET['r']) && empty($_GET['c']) && empty($_GET['search']) && empty($_GET['l'])){
  $query = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname, t1.company, t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) ORDER BY RAND() ");
  ?>
<div class="products-main-page-allproducts">
<h1 class="section-heading">All products</h1>
<?php
while($product_array = mysqli_fetch_array($query)){
  $imgURL = 'productimages/'.$product_array["image"];
  $imageOwner = 'storeprofile/'.$product_array["OwnerImage"]; 
?>
	<div class="productdeco">
        <div class="productImg-container"> 
        <a href="product.php?p=<?php echo $product_array["id"]; ?>" class="productImg-link">
        <?php echo "<img src='".$imgURL."' class='productImg' draggable='false'>"?>
        </a>
        </div>
       <form method="post" action="cart.php?action=add&p=<?php echo $product_array["id"]; ?>">
       <div class="product-title"><?php echo substr($product_array["prodname"], 0 , 17); ?></div>
       <div class="product-det">   
       <div class="product-price"><?php echo "$".$product_array["price"]; ?></div>
        <a class="product-company" href="clientsidestore.php?company=<?php echo $product_array["company"]; ?>">
        <div class="company-prod">
             <?php echo "<img src='".$imageOwner."' class='store-image' draggable='false'>"?><strong class="store-name-productdeco"><?php echo substr($product_array["company"], 0 , 14).' '.'⟩⟩'; ?></strong>
       </div>
       </a><br>
      </div>
      </form>
	</div>

<?php
    }
    ?>
 </div>
<!--ALL SEARCH CATEGORIES-->
<?php
 }else if(!empty($_GET['r']) || !empty($_GET['c']) || !empty($_GET['l']) || !empty($_GET['search'])){
?>
<div class="products-main-page">
<?php
if(isset($_GET['c'])){
  ?>
  <!--CATEGORY SEARCH-->
<h1 class="section-heading"><?php echo $_GET['c']; ?> category </h1>
<?php
  $category = $_GET['c'];
  $safe_value = stripcslashes(htmlspecialchars($category));
  $query = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname,t1.category, t1.company, t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) and t1.category like '{$safe_value}' ORDER BY RAND()");
  if ($query ->num_rows > 0) {  
  }else{
    echo "<div class='no-products'>No products yet in this category</div>";
  }
 }else if(!empty($_GET['search'])){
?>
<!--SEARCH-->
<h1 class="section-heading">Search results for <?php echo $_GET['search']; ?></h1>
<?php
  $search = $_GET['search'];
  $safe_search = stripcslashes(htmlspecialchars($search));
  $query = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname, t1.company, t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) and (t1.prodname like '%$safe_search%' or t1.company like '%$safe_search%') ORDER BY RAND()");
if ($query ->num_rows > 0){  
}else{
  echo "<div class='no-products'>No products or stores with this name</div>";
}
}else if(!empty($_GET['l'])){
  ?>
  <!--SEARCH-->
  <h1 class="section-heading">Latest <?php echo $_GET['l']; ?></h1>
  <?php
    $latest = $_GET['l'];
    $safe_latest = stripcslashes(htmlspecialchars($latest));
    $query = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname,t1.category, t1.company, t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) and t1.category like '{$safe_latest}' ORDER BY t1.Date DESC");
  if ($query ->num_rows > 0){  
  }else{
    echo "<div class='no-products'>No latest products</div>";
  }
}else if(!empty($_GET['r'])){
?>
  <!--REGION-->
<h1 class="section-heading">Results of products of suppliers in <?php echo $_GET['r']; ?></h1>
<?php
    $region = $_GET['r'];
    $safe_region = stripcslashes(htmlspecialchars($region));
    $query = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname, t1.company, t2.Country,t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) and (t2.Country like '%$safe_region%') ORDER BY RAND()");
  if ($query ->num_rows > 0) {  
  }else{
  echo "<div class='no-products'>No suppliers yet in this region</div>"; }
  }
while($product_array = mysqli_fetch_array($query)){
  $imgURL = 'productimages/'.$product_array["image"];
  $imageOwner = 'storeprofile/'.$product_array["OwnerImage"]; 
?>
	<div class="productdeco">
        <div class="productImg-container"> 
        <a href="product.php?p=<?php echo $product_array["id"]; ?>" class="productImg-link">
        <?php echo "<img src='".$imgURL."' class='productImg' draggable='false'>"?>
        </a>
       </div>
       <div class="product-title"><?php echo substr($product_array["prodname"], 0 , 17); ?></div>
       <div class="product-det">   
       <div class="product-price"><?php echo "$".$product_array["price"]; ?></div>
        <a class="product-company" href="clientsidestore.php?company=<?php echo $product_array["company"]; ?>">
        <div class="company-prod">
             <?php echo "<img src='".$imageOwner."' class='store-image' draggable='false'>"?><strong class="store-name-productdeco"><?php echo substr($product_array["company"], 0 , 14).' '.'⟩⟩'; ?></strong>
       </div>
       </a><br>
      </div>
	</div>
<?php  }?>
</div>
<?php } ?>
</div>
<!--BACK TO TOP-->
<a id="back2Top" title="Back to top" href="#">&#10148;</a>
</body>
</html>
