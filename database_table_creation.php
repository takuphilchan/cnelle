<?php
      $host="localhost";
      $user="root";
      $password="";
      $db="newcnelle";
$con = mysqli_connect($host,$user,$password,$db);
      if(!$con){
          die('error connecting to database');
      }
      else{
           echo'';
          }
$owner = "CREATE TABLE IF NOT EXISTS `owners`(
    `SupplierID`        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `OwnerImage`             VARCHAR(255) NOT NULL,
     `OwnerFirstName`   VARCHAR(50) NOT NULL,
     `OwnerLastName`    VARCHAR(50) NOT NULL,
     `idNumber`            VARCHAR(30) NOT NULL,
     `idType`            VARCHAR(11) NOT NULL,
     `phone`            VARCHAR(20)  NOT NULL, 
     `OwnerEmail`       VARCHAR(50) NOT NULL,
     `company`          VARCHAR(30) NOT NULL,
     `OwnerAddress`          VARCHAR(80) NOT NULL,
     `age`            VARCHAR(3) NOT NULL, 
     `gender`            VARCHAR(6) NOT NULL,
     `password`         VARCHAR(255) NOT NULL,
     `City`             text NOT NULL,
     `province`         text NOT NULL,
     `Country`          text NOT NULL,
     `PostalCode`      VARCHAR(10) NOT NULL, 
     `TypeGoods`       VARCHAR(60) NOT NULL,
     `activationCode`       VARCHAR(1) NOT NULL,
     `Date`            datetime NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP


)"; 
$con->query($owner); 
$customers = "CREATE TABLE IF NOT EXISTS `customers`(
     `CustomerID`       INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
     `image`             VARCHAR(255) NOT NULL,
     `username`         VARCHAR(50) UNIQUE NOT NULL,
     `FirstName`         VARCHAR(50) NOT NULL,
     `LastName`          VARCHAR(50) NOT NULL,
     `phone`            VARCHAR(20) NOT NULL, 
     `email`            VARCHAR(50) NOT NULL,
     `password`         VARCHAR(255) NOT NULL,
     `province`         text NOT NULL,
     `Country`          text NOT NULL,
     `Date`            datetime NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP


)"; 
$con->query($customers);
$products = "CREATE TABLE IF NOT EXISTS `products`(
     `id`        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
     `image`            VARCHAR(255) NOT NULL,
     `image2`           VARCHAR(255) NOT NULL,
     `image3`           VARCHAR(255) NOT NULL,
     `video`            VARCHAR(255) NOT NULL,
     `prodname`         VARCHAR(30) NOT NULL,
     `price`            VARCHAR(50) NOT NULL,
     `category`         VARCHAR(30) NOT NULL,
     `prodweight`       VARCHAR(30) NOT NULL,
     `company`          VARCHAR(30) NOT NULL,
     `prodaddress`      VARCHAR(80) NOT NULL,
     `description`      VARCHAR(300) NOT NULL,
     `color`            VARCHAR(30) NOT NULL,
     `UnitsInStock`     VARCHAR(30) NOT NULL,
     `code`             VARCHAR(100) UNIQUE NOT NULL, 
     `Date`             datetime NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
     `status`           SMALLINT(1) NOT NULL default 1
)";
$con->query($products);
$messages = "CREATE TABLE IF NOT EXISTS `customersellermessages`(
    `id`        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `message`           VARCHAR(255) NOT NULL,
    `Reciever`             VARCHAR(255),
    `SendBy`          VARCHAR(30),
    `Date`              datetime NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
)";
$con->query($messages);

$help = "CREATE TABLE IF NOT EXISTS `help`(
    `id`        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `message`           VARCHAR(255) NOT NULL,
    `Reciever`             VARCHAR(255),
    `SendBy`          VARCHAR(30),
    `Date`              datetime NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
)";
$con->query($help);

$storehelp = "CREATE TABLE IF NOT EXISTS `storehelp`(
    `id`        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `message`           VARCHAR(255) NOT NULL,
    `Reciever`             VARCHAR(255),
    `SendBy`          VARCHAR(30),
    `Date`              datetime NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
)";
$con->query($storehelp);



$ads = "CREATE TABLE IF NOT EXISTS `Adverts`(
    `id`        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `company`           VARCHAR(255) NOT NULL,
    `productName`      VARCHAR(255),
    `current`          VARCHAR(30)
)";
$con->query($ads);
$comments = "CREATE TABLE IF NOT EXISTS `comments`(
    `id`        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `message`           VARCHAR(255) NOT NULL,
    `image`             VARCHAR(255),
    `Customer`          VARCHAR(30),
    `Date`              datetime NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP, 
    `proid`             INT(100)
)"; 
$con->query($comments);
$review =  "CREATE TABLE IF NOT EXISTS `review`(
            `id`        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `message`   VARCHAR(255) NOT NULL,
            `SendBy`  VARCHAR(30),
            `Reciever`  VARCHAR(30),
            `Date`      datetime NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP      
)";
$con-> query($review);
$orders = "CREATE TABLE IF NOT EXISTS `orders`(
    `OrderId`        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `prodId`               VARCHAR(255) NOT NULL,
    `prodimage`            VARCHAR(255) NOT NULL,
    `product Name`         VARCHAR(255) NOT NULL,
    `unitPrice`            VARCHAR(255) NOT NULL,
    `totalPrice`       VARCHAR(255) NOT NULL,
    `customer`         VARCHAR(13) NOT NULL,
    `company`          VARCHAR(30) NOT NULL,
    `quantity`         VARCHAR(255) NOT NULL,
    `code`             VARCHAR(10) NOT NULL, 
    `Date`             datetime NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
)";
$con->query($orders);

$payments = "CREATE TABLE IF NOT EXISTS `payments` (
    `payment_id` int(11) NOT NULL AUTO_INCREMENT,
    `item_number` varchar(50) NOT NULL,
    `txn_id` varchar(50) NOT NULL,
    `payment_status` varchar(20) NOT NULL,
    `payment_gross` double(10,2) NOT NULL,
    `currency_code` varchar(5) NOT NULL,
    `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`payment_id`)
  )";
  $con->query($payments);
?>