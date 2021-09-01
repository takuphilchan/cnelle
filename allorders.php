<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.15.2/css/all.css" rel="stylesheet">
<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<title>cnelle</title>
<link rel="stylesheet" href="css/main.css"/>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<div class="top">
<button onclick="location.href='index.php'" class="top-left-button-with-background">Home</button>
<button onclick="location.href='cart.php'" class="top-right-button-with-background">Cart</button><br><br>
<p  class="txt-heading">All my Orders</p>
</div>
<table class="all-tbls" cellpadding="5" cellspacing="1" >
<tbody>
<tr >
<th  style="text-align:center;" width="5%">Name</th>
<th  style="text-align:center;" width="5%">Product Code</th>
<th  style="text-align:center;" width="5%">Color</th>
<th  style="text-align:center;" width="5%">Company</th>
<th style="text-align:center;" width="5%" >Quantity</th>
<th  style="text-align:center;" width="5%">PricePerUnit</th>
<th  style="text-align:center;" width="5%">Total Price</th>
<th  style="text-align:center;" width="5%">Ordered On</th>
<th  style="text-align:center;" width="5%">Delivered</th>
<th style="text-align:center;" width="5%">Talk to supplier</th>
</tr>
<?php
        error_reporting(0);
        session_start(); 
        include ('connect.php');
  
        if($_SESSION['username']){      
        $sqlproducts = "SELECT * FROM orders WHERE customer='{$_SESSION['username']}' AND orderStatus = 1 ORDER BY Date DESC";
        $res = mysqli_query($con, $sqlproducts); 
        if($res==true){
            while($rows = $res->fetch_assoc()){ 
                $image =  'productimages/'.$rows["prodimage"];
              ?>
                <tr>
                 <td style="text-align:center;"><?php echo "<img src='".$image."' style='height:60px; width:60px; border-radius:50%;'>"."<br>".$rows["productName"];?></td>
             <td style="text-align:center;"><?php echo $rows["code"];?> </td>
             <td style="text-align:center;"><?php echo $rows["color"];?> </td>
             <td style="text-align:center;"><?php echo $rows["company"];?> </td>
             <td style="text-align:center;"><?php echo $rows["quantity"];?> </td>
             <td style="text-align:center;"><?php echo  "$".$rows["unitPrice"];?> </td>
             <td style="text-align:center;"><?php echo  "$".$rows["totalPrice"];?> </td>
             <td style="text-align:center;"> <?php echo $rows["Date"];?></td>
             <td style="text-align:center;"> <?php if($rows["Recieved"]==0) echo "--"; else echo "✔";?></td>
             <td><a class="message-button-cart"  href="customerSellerMessages.php?company=<?php echo $rows['company']; ?> && username = <?php echo $_SESSION['username'];?>" style="text-decoration: none; color navy; text-align:center;"><i class="fa fa-comment"></i></a></td>
           
            </tr>

<?php
     }
         
       }
    }
    ?> 
</tbody> 
</table>