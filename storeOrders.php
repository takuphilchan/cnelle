
<?php 
session_start(); 
if(!isset($_SESSION['logged'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:storeLoggin.php"); }
?>
<title>cnelle</title>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.15.2/css/all.css" rel="stylesheet">
<meta content="width=device-width, initial-scale=0.80, maximum-scale=5.0, minimum-scale=0.80" name="viewport">
<link rel="stylesheet" href="css/main.css"/>
<div class="top-store">
<button onclick="location.href='index.php'" class="top-left-button-custom">Home</button>
<button onclick="location.href='myStore.php'" class="top-right-button-custom">myStore</button> 
<form action="storeOrders.php" method="GET" >
<div id="search"> 
          <input type="text" class="searchbar" name="email" placeholder="Customer email..."/>
          <button type="submit" name="submit" id="icon"><i class="fa fa-search"></i></button>
</div>
</form>
<div class="txt-heading-store"><h3 class="mystore-orders">MY CUSTOMER ORDERS</h3></div>
</div>
<table class="all-tbls-store" cellpadding="5"  cellspacing="1" >
<tbody>
<tr>
<th  width="5%"style="text-align:center;">Customer Name</th>      
<th width="5%" style="text-align:center;">Product Name</th>
<th width="5%" style="text-align:center;">email</th>
<th width="5%" style="text-align:center;">Quantity</th>
<th width="5%" style="text-align:center;">Color</th>
<th width="5%" style="text-align:center;">PricePerUnit</th>
<th width="5%" style="text-align:center;">Total Price</th>
<th width="5%" style="text-align:center;">Delivered</th>
<th width="5%" style="text-align:center;" >Bought</th>
<th width="5%" style="text-align:center;">Talk to buyer</th>
</tr>
<?php
        error_reporting(0);
        session_start(); 
        include ('connect.php');
      if(isset($_GET['email'])){
        $count = 0;
        $cust = $_GET['email'];
        $safe_cust= stripcslashes(htmlspecialchars($cust));
        $customer = mysqli_query($con, "SELECT t1.OrderId, t1.prodimage,  t1.Recieved,t2.CustomerImage,t1.customer, t1.productName, t1.code, t2.email, t1.quantity, t1.unitPrice, t1.totalPrice, t1.Date,t1.orderStatus FROM orders as t1, customers as t2 WHERE  t2.email like '%$safe_cust%' and t1.company='{$_SESSION['company']}'  and t2.username = t1.customer and t1.orderStatus=1 ORDER BY t1.Date DESC");
        while($row = $customer->fetch_assoc()){ 
          $image =  'productimages/'.$row["prodimage"];
          $profile =  'customerprofile/'.$row["CustomerImage"];
        ?>
          <tr>
          <td style="text-align:center;"> <?php echo "<img src='".$profile."' class='tbl-small-image'>"."<br>".$row["customer"];?></td>  
           <td style="text-align:center;"><?php echo "<img src='".$image."'  class='tbl-small-image'>"."<br>".$row["productName"];?></td>
             <td style="text-align:center;"><?php echo $row["email"];?> </td>
             <td style="text-align:center;"><?php echo $row["quantity"];?> </td>
             <td style="text-align:center;"><?php echo $row["color"];?> </td>
             <td style="text-align:center;"><?php echo "$".$row["unitPrice"];?> </td>
             <td style="text-align:center;"><?php echo "$".$row["totalPrice"];?> </td>
             <td style="text-align:center;"> <?php if($row["Recieved"]==0) echo "--"; else echo "✔";?></td>
             <td style="text-align:center;"> <?php echo $row["Date"];?></td>
             <td><a class="message-button-cart"  href="sellerCustomerMessages.php?username=<?php echo $row["customer"];?> && company = <?php echo $_SESSION['company'];?>" style="text-decoration: none; color navy; text-align:center;"> <i class="fa fa-comment"></i></a></td>
            </tr>

          <?php
      $count = $count + 1 ; 
    }
    echo  "<div style='width: 100%; font-size: 1em; text-align: center; color: gold; border: none; background-color:navy;'>Available customer orders: ".$count."</div>";
    }elseif(!isset($_POST['submit'])){   
        $sqlproducts = "SELECT t1.OrderId,t1.prodimage, t1.Recieved, t2.CustomerImage, t1.customer, t1.productName, t1.code, t2.email, t1.quantity, t1.unitPrice, t1.totalPrice, t1.Date, t1.orderStatus FROM orders as t1, customers as t2 WHERE t1.company='{$_SESSION['company']}' AND t2.username = t1.customer AND t1.orderStatus=1 ORDER BY t1.Date DESC";
        $res = mysqli_query($con, $sqlproducts); 
        if($res==true){
            while($rows = $res->fetch_assoc()){ 
                $image =  'productimages/'.$rows["prodimage"];
                $profile =  'customerprofile/'.$rows["CustomerImage"];
              ?>
                <tr>
              <td style="text-align:center;"> <?php echo "<img src='".$profile."'class='tbl-small-image'>"."<br>".$rows["customer"];?></td>  
              <td style="text-align:center;"><?php echo "<img src='".$image."' class='tbl-small-image'>"."<br>".$rows["productName"];?></td>
             <td style="text-align:center;"><?php echo $rows["email"];?> </td>
             <td style="text-align:center;"><?php echo $rows["quantity"];?> </td>
             <td style="text-align:center;"><?php echo $row["color"];?> </td>
             <td style="text-align:center;"><?php echo  "$".$rows["unitPrice"];?> </td>
             <td style="text-align:center;"><?php echo  "$".$rows["totalPrice"];?> </td>
             <td style="text-align:center;"> <?php if($rows["Recieved"]==0) echo "--"; else echo "✔";?></td>
             <td style="text-align:center;"> <?php echo $rows["Date"];?></td>
             <td><a class="message-button-cart"  href="sellerCustomerMessages.php?username=<?php echo $rows["customer"];?> && company = <?php echo $_SESSION['company'];?>" style="text-decoration: none; color navy; text-align:center;"> <i class="fa fa-comment"></i></a></td>
            </tr>

<?php
     }
         
       }
    }
    ?> 
</tbody>
</table>