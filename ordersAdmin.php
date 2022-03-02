
<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<?php
if($_SESSION['username']==='Administrator'){
?>
<title>cnelle</title>
<link rel="stylesheet" href="css/main.css"/>
<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.15.2/css/all.css" rel="stylesheet">
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<body class="body-background">
<h2 class="admin-top-heading">ALL CUSTOMER ORDERS</h2>
<form action="ordersAdmin.php" method="GET" >
<div class="searchbarstatistics"> 
          <input type="text" class="searchbar" name="customer" placeholder="customer email..."/>
          <button type="submit" name="submit" id="icon"><i class="fa fa-search"></i></button>
</div>
</form>

<style>
th{
    background-color: gold;
}
</style>
<table cellpadding="5" cellspacing="1" >
<tbody>
<tr>
<th  style="text-align:center;" width="5%">Delivered</th>   
<th  style="text-align:center;" width="5%">Not yet Delivered</th>
<th  style="text-align:center;" width="5%">Customer Name</th>   
<th  style="text-align:center;" width="5%">Product Name</th>
<th  style="text-align:center;" width="5%">Product Code</th>
<th  style="text-align:center;" width="5%">Customer country</th>
<th  style="text-align:center;" width="5%">Customer email</th>
<th  style="text-align:center;" width="5%">Company</th>
<th  style="text-align:center;" width="5%">company Address</th>
<th  style="text-align:center;" width="5%">company  email</th>
<th style="text-align:center;"  width="5%" >Quantity</th>
<th  style="text-align:center;" width="5%">PricePerUnit</th>
<th  style="text-align:center;" width="5%">Total Price</th>
<th  style="text-align:center;" width="10%">Delivery Status</th>
<th  style="text-align:center;" width="5%">Bought</th>
</tr>
<?php
        error_reporting(0);
        session_start(); 
      include ('connect.php');
      if(isset($_GET['customer'])){
        $count = 0; 
        $cust = $_GET['customer'];
        $safe_cust= stripcslashes(htmlspecialchars($cust));
        $customer = mysqli_query($con, "SELECT t1.OrderId, t1.Recieved, t1.prodimage, t2.CustomerImage, t2.country, t2.username, t1.company, t3.company,t1.customer, t1.productName, t3.OwnerAddress,t3.OwnerEmail, t1.code,t1.orderStatus,t2.email, t1.quantity, t1.unitPrice, t1.totalPrice, t1.Date FROM orders as t1, customers as t2, owners as t3 WHERE  t2.email like '%$safe_cust%' and t2.username = t1.customer and t3.company = t1.company and t1.orderStatus = 1 ORDER BY t1.Date DESC");
        while($row = $customer->fetch_assoc()){ 
          $image =  'productimages/'.$row["prodimage"];
          $profile =  'customerprofile/'.$row["CustomerImage"];
        ?>
          <tr>
          <td style="text-align:center;"><a style="text-decoration: none;"  href="recieved.php?OrderId=<?php echo $row['OrderId']; ?>">✔</a></td> 
          <td style="text-align:center;" ><a style="text-decoration: none;"  href="norecieved.php?OrderId=<?php echo $row['OrderId']; ?>">X</a></td>   
          <td style="text-align:center;"> <?php echo "<img src='".$profile."' style='height:60px; width:60px; border-radius:50%;'>"."<br>".$row["customer"];?></td>  
           <td style="text-align:center;"><?php echo "<img src='".$image."' style='height:60px; width:60px; border-radius:50%;'>"."<br>".$row["productName"];?></td>
             <td style="text-align:center;"><?php echo $row["code"];?> </td>
             <td style="text-align:center;"><?php echo $row["country"];?> </td>
             <td style="text-align:center;"><?php echo $row["email"];?> </td>
             <td style="text-align:center;"><?php echo $row["company"];?> </td>
             <td style="text-align:center;"><?php echo $row["OwnerAddress"];?> </td>
             <td style="text-align:center;"><?php echo $row["OwnerEmail"];?> </td>
             <td style="text-align:center;"><?php echo $row["quantity"];?> </td>
             <td style="text-align:center;"><?php echo "$".$row["unitPrice"];?> </td>
             <td style="text-align:center;"><?php echo "$".$row["totalPrice"];?> </td>
             <td style="text-align:center;"> <?php if($row["Recieved"]==0) echo "--"; else echo "✔";?></td>
             <td style="text-align:center;"> <?php echo $row["Date"];?></td>
            </tr>
          <?php
      $count = $count + 1 ; 
    }
    echo  "<p style='font-size: 2em; text-align: center;'>Available customer orders: ".$count."</p>";
    }else{
      $customer = mysqli_query($con, "SELECT t1.OrderId, t1.Recieved, t1.prodimage, t2.CustomerImage, t2.country, t2.username, t1.customer, t1.company, t3.company, t1.productName, t3.OwnerAddress, t3.OwnerEmail, t1.code, t2.email, t1.orderStatus, t1.quantity, t1.unitPrice, t1.totalPrice, t1.Date FROM orders as t1, customers as t2, owners as t3 WHERE (t2.username = t1.customer AND t3.company = t1.company AND t1.orderStatus = 1) ORDER BY t1.Date DESC");
      while($rows = $customer->fetch_assoc()){ 
        $image =  'productimages/'.$rows["prodimage"];
        $profile =  'customerprofile/'.$rows["CustomerImage"];
      ?>
        <tr>
        <td style="text-align:center;"><a style="text-decoration: none;"  href="recieved.php?OrderId=<?php echo $rows['OrderId']; ?>">✔</a></td>  
         <td style="text-align:center;"><a style="text-decoration: none;" href="norecieved.php?OrderId=<?php echo $rows['OrderId']; ?>">X</a></td>      
        <td style="text-align:center;"> <?php echo "<img src='".$profile."' style='height:60px; width:60px; border-radius:50%;'>"."<br>".$rows["customer"];?></td>  
         <td style="text-align:center;"><?php echo "<img src='".$image."' style='height:60px; width:60px; border-radius:50%;'>"."<br>".$rows["productName"];?></td>
           <td style="text-align:center;"><?php echo $rows["code"];?> </td>
           <td style="text-align:center;"><?php echo $rows["country"];?> </td>
           <td style="text-align:center;"><?php echo $rows["email"];?> </td>
           <td style="text-align:center;"><?php echo $rows["company"];?> </td>
           <td style="text-align:center;"><?php echo $rows["OwnerAddress"];?> </td>
           <td style="text-align:center;"><?php echo $rows["OwnerEmail"];?> </td>
           <td style="text-align:center;"><?php echo $rows["quantity"];?> </td>
           <td style="text-align:center;"><?php echo "$".$rows["unitPrice"];?> </td>
           <td style="text-align:center;"><?php echo "$".$rows["totalPrice"];?> </td>
           <td style="text-align:center;"> <?php if($rows["Recieved"]==0) echo "--"; else echo "✔";?></td>
           <td style="text-align:center;"> <?php echo $rows["Date"];?></td>
            </tr>

<?php
     }
    }
    ?> 
</tbody> 
</table>
</body>
<?php }else{
   header("Location:index.php");  
} ?>