<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>

<title>cnelle</title>
<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.15.2/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="css/main.css"/>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<div class="top">
<button onclick="location.href='index.php'" class="top-left-button-with-background">Home</button>
<button onclick="location.href='cart.php'" class="top-right-button-with-background">Cart</button><br>
<p  class="txt-heading">Wishlist all products</p>
</div>
<table class="all-tbls" cellpadding="5" cellspacing="1" >
<tbody>
<tr >
<th  style="text-align:center;" width="5%">Delete</th>
<th  style="text-align:center;" width="5%">Name</th>
<th  style="text-align:center;" width="5%">Product Code</th>
<th  style="text-align:center;" width="5%">Color</th>
<th  style="text-align:center;" width="5%">Company</th>
<th style="text-align:center;" width="5%" >Quantity</th>
<th  style="text-align:center;" width="5%">PricePerUnit</th>
<th  style="text-align:center;" width="5%">Total Price</th>
<th  style="text-align:center;" width="5%">Engaged On</th>
<th  style="text-align:center;" width="5%">Order now</th>
</tr>
<?php
        error_reporting(0);
        session_start(); 
        include ('connect.php');
        if(!empty($_SESSION['username'])){      
          $sqlproducts = "SELECT * FROM orders WHERE customer='{$_SESSION['username']}' AND orderStatus = 0 ORDER BY Date DESC";
        $res = mysqli_query($con, $sqlproducts); 
        if($res==true){
            while($rows = $res->fetch_assoc()){ 
                $image =  'productimages/'.$rows["prodimage"];
              ?>
                <tr>
             <td style="text-align:center;"><a href="deletehistory.php?OrderId=<?php echo $rows['OrderId'];?>"><i class="fa fa-trash"><i></a></td>  
             <td style="text-align:center;"><?php echo "<img src='".$image."' style='height:60px; width:60px; border-radius:50%;'>"."<br>".$rows["productName"];?></td>
               
             <td style="text-align:center;"><?php echo $rows["code"];?> </td>
             <td style="text-align:center;"><?php echo $rows["color"];?> </td>
             <td style="text-align:center;"><?php echo $rows["company"];?> </td>
             <td style="text-align:center;"><?php echo $rows["quantity"];?> </td>
             <td style="text-align:center;"><?php echo  "$".$rows["unitPrice"];?> </td>
             <td style="text-align:center;"><?php echo  "$".$rows["totalPrice"];?> </td>
             <td style="text-align:center;"> <?php echo $rows["Date"];?></td>
             <td style="text-align:center;"><a href="orders.php?code=<?php echo $rows['code'];?> && company=<?php echo $rows['company'];?> && username = <?php echo $_SESSION['username'];?> && OrderId=<?php echo 
             $rows['OrderId'];?>" style="text-decoration: none; color navy; text-align:center;">ORDER</a></td>
            </tr>

     <?php
         }
       }
      }
    ?> 
</tbody> 
</table>