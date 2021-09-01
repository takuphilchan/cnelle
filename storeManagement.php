<?php 
session_start(); 
error_reporting(0);
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<?php
if($_SESSION['username']==='Administrator'){
?>
<head>
<style>
th{
    background-color: navy;
    color: white;
}

</style>
<title>cnelle</title>
<link rel="stylesheet" href="css/main.css">
<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.15.2/css/all.css" rel="stylesheet">
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
</head>
<body class="body-background">
<h2 class="admin-top-heading">STORE OWNERS</h2>
<form action="storeManagement.php" method="GET" >
<div class="searchbarstatistics"> 
          <input type="text" class="searchbar" name="storeAd" placeholder="company..."/>
          <button type="submit" name="submit" id="icon"><i class="fa fa-search"></i></button>
</div>
</form>

<table style="color: black;"  cellpadding="5" cellspacing="1">
<tbody style="border:1px solid grey;">
<th width="5%">Deactivate</th>
<th width="5%">Activate</th>
<th width="5%">Store name</th>
<th width="5%">Owner Name</th>
<th width="5%">Owner LastName</th>
<th width="5%">id Type</th>
<th width="5%">id Number</th>
<th width="5%">Phone</th>
<th width="5%">email</th>
<th width="5%">Activation Code</th>
<th width="5%">Address</th>
<th width="5%">City</th>
<th width="5%">Province</th>
<th width="5%">Country</th>
<th width="5%">Opened On</th>
<th width="5%">Delete Account</th>
<?php
    $count = 0;
    include ('connect.php');
    $sql = "SELECT * FROM owners"; 
    $stores = mysqli_query($con, $sql);
  if(isset($_GET['storeAd'])){
    $storeAd = $_GET['storeAd'];
    $safe_store= stripcslashes(htmlspecialchars($storeAd));
    $owner = mysqli_query($con, "SELECT * FROM owners WHERE company like '%$safe_store%'  ORDER BY Date DESC");
    while($row = $owner->fetch_assoc()){ 
      ?>
      <tr>
      <td><a href="deactivateStore.php?SupplierID=<?php echo $row['SupplierID']; ?>">Deactivate</a></td>
      <td><a href="activateStore.php?SupplierID=<?php echo $row['SupplierID']; ?>">Activate</a></td>
      <td> <?php echo $row['company']; ?></td>
      <td> <?php echo $row['OwnerFirstName']; ?></td>
      <td> <?php echo $row['OwnerLastName']; ?></td>
      <td> <?php echo $row['idType']; ?></td>
      <td> <?php echo $row['idNumber']; ?></td>
      <td> <?php echo $row['phone']; ?></td>
      <td> <?php echo $row['OwnerEmail']; ?></td>
      <td> <?php echo $row['activationCode']; ?></td>
      <td> <?php echo $row['OwnerAddress']; ?></td>
      <td> <?php echo $row['City']; ?></td>
      <td> <?php echo $row['province']; ?></td>
      <td> <?php echo $row['Country']; ?></td>
      <td> <?php echo $row['Date']; ?></td>
      <td><a href="deleteStore.php?SupplierID=<?php echo $row['SupplierID']; ?>">Delete</a></td>
      </tr>
      <?php
  $count = $count + 1 ; 
}
echo  "<p style='font-size: 2em; text-align: center;'>Available stores: ".$count."</p>";
}elseif(!isset($_POST['submit'])){
         while($row = $stores->fetch_assoc()){
           ?>
           <tr>
           <td><a href="deactivateStore.php?SupplierID=<?php echo $row['SupplierID']; ?>">Deactivate</a></td>
           <td><a href="activateStore.php?SupplierID=<?php echo $row['SupplierID']; ?>">Activate</a></td>
           <td> <?php echo $row['company']; ?></td>
           <td> <?php echo $row['OwnerFirstName']; ?></td>
           <td> <?php echo $row['OwnerLastName']; ?></td>
           <td> <?php echo $row['idType']; ?></td>
           <td> <?php echo $row['idNumber']; ?></td>
           <td> <?php echo $row['phone']; ?></td>
           <td> <?php echo $row['OwnerEmail']; ?></td>
           <td> <?php echo $row['activationCode']; ?></td>
           <td> <?php echo $row['OwnerAddress']; ?></td>
           <td> <?php echo $row['City']; ?></td>
           <td> <?php echo $row['province']; ?></td>
           <td> <?php echo $row['Country']; ?></td>
           <td> <?php echo $row['Date']; ?></td>
           <td><a href="deleteStore.php?SupplierID=<?php echo $row['SupplierID']; ?>">Delete</a></td>
           </tr>
           <?php
           $count = $count + 1 ; 
         }
         echo  "<p style='font-size: 2em; text-align: center;'>Current stores: ".$count."</p>";
    }
?>
</tbody>
</table>
</body>
<?php }else{
   header("Location:index.php");  
} ?>