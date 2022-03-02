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
<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.15.2/css/all.css" rel="stylesheet">
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<link rel="stylesheet" href="css/main.css">
</head>
<body class="body-background">
<h2 class="admin-top-heading">CUSTOMERS</h2>
<form action="customerManagement.php" method="GET" >
<div class="searchbarstatistics"> 
          <input type="text" class="searchbar" name="emailAd" placeholder="email..."/>
          <button type="submit" name="submit" id="icon"><i class="fa fa-search"></i></button>
</div>
</form>

<table style="color: black;"  cellpadding="5" cellspacing="1">
<tbody>
<th width="5%" style="text-align:center;">Username</th>
<th width="5%">First name</th>
<th width="5%">Last Name</th>
<th width="5%">Phone</th>
<th width="5%">email</th>
<th width="5%">Province</th>
<th width="5%">Country</th>
<th width="5%">Joined On </th>
<th width="5%">Delete Account</th>
<?php
    $count = 0;
    include ('connect.php');
    $sql = "SELECT * FROM customers"; 
    $custo = mysqli_query($con, $sql);
    if(isset($_GET['emailAd'])){
      $emailAd = $_GET['emailAd'];
      $safe_email= stripcslashes(htmlspecialchars($emailAd));
      $customer = mysqli_query($con, "SELECT * FROM customers WHERE email like '%$safe_email%'  ORDER BY Date DESC");
      while( $row = $customer->fetch_assoc()){
        ?>
        <tr>
        <td style="text-align:center;"> <?php echo $row['username']; ?></td>
        <td> <?php echo $row['FirstName']; ?></td>
        <td> <?php echo $row['LastName']; ?></td>  
        <td> <?php echo $row['phone']; ?></td>
        <td> <?php echo $row['email']; ?></td>
        <td> <?php echo $row['province']; ?></td>
        <td> <?php echo $row['Country']; ?></td>
        <td> <?php echo $row['Date']; ?></td>
        <td><a href="deleteCustomer.php?CustomerID=<?php echo $row['CustomerID']; ?>">Delete</a></td>
        </tr>
        <?php
          $count = $count + 1 ; 
  }
    echo  "<p style='font-size: 2em; text-align: center;'>Available users: ".$count."</p>";
}elseif(!isset($_POST['submit'])){
         while($row = $custo->fetch_assoc()){
           ?>
           <tr>
           <td style="text-align:center;"> <?php echo $row['username']; ?></td>
           <td> <?php echo $row['FirstName']; ?></td>
           <td> <?php echo $row['LastName']; ?></td>
           <td> <?php echo $row['phone']; ?></td>
           <td> <?php echo $row['email']; ?></td>
           <td> <?php echo $row['province']; ?></td>
           <td> <?php echo $row['Country']; ?></td>
           <td> <?php echo $row['Date']; ?></td>
           <td><a href="deleteCustomer.php?CustomerID=<?php echo $row['CustomerID']; ?>">Delete</a></td>
           </tr>
           <?php
           $count = $count + 1; 
         }
         echo  "<p style='font-size: 2em; text-align: center;'>Current users: ".$count."</p>"; 
    }
?>
</tbody>
</table>
</body>
<?php }else{
   header("Location:index.php");  
} ?>