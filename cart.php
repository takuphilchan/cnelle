<title>cnelle</title>
<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.15.2/css/all.css" rel="stylesheet">
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<link rel="stylesheet" href="css/main.css"/>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<?php
error_reporting(0);
session_start();
require_once ("connect.php");
//code for Cart
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	//code for adding product in cart
	case "add":
		if(!empty($_GET["q"])) {
			$pid=$_GET["p"];
			$result=mysqli_query($con,"SELECT * FROM products WHERE id='$pid' and status=1");
	          while($productByCode=mysqli_fetch_array($result)){
			$itemArray = array($productByCode["code"]=>array('image'=>$productByCode['image'],'id'=>$productByCode["id"],'company'=>$productByCode['company'], 'prodname'=>$productByCode["prodname"], 'color'=>$_GET["c"] ,'code'=>$productByCode["code"], 'quantity'=>$_GET["q"], 'price'=>$productByCode["price"]));
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_GET["q"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			}  else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	}
	break;

	// code for removing product from cart
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	// code for if cart is empty
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<HEAD>
</HEAD>
<BODY id="cartbody">


<!-- Cart ---->
<div class="top">
<button onclick="location.href='index.php'" class="top-left-button-with-background">Home</button>	
<button onclick="location.href='cart.php?action=empty'" class="emptyCart">Empty Cart</button><br><br>
<p class="txt-heading">My Shopping Cart</p>
</div>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>
<table class="all-tbls" cellpadding="5" cellspacing="1">
<tbody>
	
<tr>
<th style="text-align:center;" width="5%">Remove</th>
<th style="text-align:center;" width="5%">Name</th>
<th style="text-align:center;" width="5%">Store Name</th>
<th style="text-align:center;" width="10%">Choose color</th>
<th style="text-align:center;" width="10%">Quantity</th>
<th style="text-align:center;" width="5%">Unit Price</th>
<th style="text-align:right;" width="5%">Total Price</th>
<th style="text-align:center;" width="5%">Talk to supplier</th>

</tr>

<?php	
foreach ($_SESSION["cart_item"] as $item){ 
		if($item["quantity"]<0){
			header("Location: index.php"); 
		}
		else{
		$item_price = $item["quantity"]*$item["price"];
		$image =  'productimages/'.$item["image"];
		?>
		  <tr>
				<td style="text-align:center;"><a href="cart.php?action=remove&code=<?php echo $item["code"];?>" class="btnRemoveAction"><i class="fa fa-trash"><i></a></td>	
				<td style="text-align:left;"><a style="text-decoration: none; color:navy;" href="product.php?p=<?php echo $item["id"]; ?>"><?php echo "<img src='".$image."' style='height:50px; width:50px; border-radius:50%;'>"?><br><?php echo $item["prodname"]; ?></a></td>
				<td style="text-align:left;"><a style="text-decoration: none; color:navy;" href="clientsidestore.php?company=<?php echo $item["company"]; ?>"><?php echo $item["company"]; ?></a></td>
				<td><input type="text" name="color" readonly="readonly" style="border: none;height: 100%;font-size: 1em; width: 100%;" value="<?php echo $item["color"]; ?>" maxlength=22> </td>
				<td style="text-align:right;"><input type="text" readonly="readonly" style="border: none;height: 100%;font-size: 1em; width: 100%;" name="quantity" value="<?php echo $item['quantity']; ?> "></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price); ?></td>	
				<?php 
							$total_quantity += $item["quantity"];
							$total_price += ($item["price"]*$item["quantity"]);
				?>
				
				<input type="text" name="total" hidden value="<?php echo $total_price; ?>">
				<input type="text" name="prodid" hidden  value="<?php echo $item['id']; ?> ">
				<input type="text" name="image" hidden value="<?php echo $item['image']; ?> ">
                <input type="text" name="company" hidden value="<?php echo $item['company']; ?> ">
				<input type="text" name="cod" hidden value="<?php echo $item['code']; ?> ">
				<input type="text" name="products" hidden value="<?php echo $item['prodname']; ?> ">
				<input type="text" name="price" hidden value="<?php echo $item['price']; ?> ">
				<td><button onclick="location.href='update_notification_status.php?company=<?php echo $item['company']; ?>&&p=<?php echo $item['id'];?>'"  class="message-button-cart" ><i class="fa fa-comment"></i></button></td> 
             </tr>
				<?php
				
		}	
	}
?>
<tr>
<td colspan="4" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="6"><strong><?php echo "$ ".number_format($total_price); ?></strong></td>
</tr>
</tbody>
</table>
<?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</BODY>
<footer id="footer">&copy; 2020 cnelle.com<footer>
</HTML>