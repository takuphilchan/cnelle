<?php 
session_start(); 
if(!isset($_SESSION['logged'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location: storeLoggin.php"); }
?>
<DOCTYPE html> 
<script src="javascript/jquery.js"></script>
<html>
     <body>
     <?php
                error_reporting(0);
                include ('connect.php'); 
                session_start(); 
                 $sql = "SELECT t1.Date, t1.message, t1.SendBy, t1.image, t1.Reciever, t2.CustomerImage, t3.OwnerImage FROM customersellermessages as t1, customers as t2, owners as t3 WHERE (t1.SendBy=t2.username or t1.Reciever=t2.username) and (t1.SendBy=t3.company or t1.Reciever=t3.company) and( t1.Reciever='{$_GET['username']}' or t1.Reciever='{$_SESSION['company']}') and (t1.SendBy='{$_SESSION['company']}' or t1.SendBy='{$_GET['username']}') ORDER BY t1.Date ASC";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {  
                        while($row = $result->fetch_assoc()) {
                          $imgOwner =  'storeprofile/'.$row["OwnerImage"]; 
                          $imgCustomer =  'customerprofile/'.$row["CustomerImage"]; 
                          $imageURL = 'messagesImages/'.$row["image"];
                          if (!empty($row["image"]) && !empty($row["message"])){
                            if(($row["SendBy"])==($_SESSION["company"])){
                              echo "<div class='message-container-me' >"."<div class='msg-com-me-img'>"."<div class='msg-com-me'>"."<p class='date-message-me'>".$row["Date"]."</p>".$row["message"]."</div>"."<br>"."<img src='".$imageURL."' alt='';  class='msg-images'  draggable='false'/>"."<br>"."</div>"."<img src='".$imgOwner."' alt=''; class='sendby-me' draggable='false'/>"."</div>";
                              }else{
                                echo "<div class='message-container-sender'>"."<img src='".$imgCustomer."' alt=''; class='sendby-someone' draggable='false'/>"."<div class='msg-com-img'>"."<div class='msg-com'>"."<p class='date-message-img-someone'>".$row["Date"]."</p>".$row["message"]."</div>"."<br>"."<img src='".$imageURL."' alt='';  class='msg-images'  draggable='false'/>"."<br>"."</div>"."</div>"."<br>";
                              }
                        } else if(!empty($row["image"])){
                             if(($row["SendBy"])==($_SESSION["company"])){
                                echo "<div class='message-container-me'>"."<div class='msg-com-me-img'>"."<p class='date-message'>".$row["Date"]."</p>"."<img src='".$imageURL."' alt='';  class='msg-images' draggable='false'/>"."</div>"."<img src='". $imgOwner."' alt=''; class='sendby-me' draggable='false'/>"."</div>"."<br>";
                              }else{
                                echo "<div class='message-container-sender'>"."<img src='".$imgCustomer."' alt=''; class='sendby-someone' draggable='false'/>"."<div class='msg-com-img'>"."<p class='date-message'>".$row["Date"]."</p>"."<img src='".$imageURL."' alt='';  class='msg-images' draggable='false'/>"."</div>"."</div>"."<br>";
                              }
                            }else  if(empty($row["image"])){
                                if(($row["SendBy"])==($_SESSION["company"])){
                                  echo "<div class='message-container-me'>"."<div class='msg-com-me'>"."<p class='date-message-me'>".$row["Date"]."</p>".$row["message"]."</div>"."<img src='". $imgOwner."' alt=''; class='sendby-me' draggable='false'/>"."</div>"."<br>";
                              }else{
                                echo "<div class='message-container-sender'>"."<img src='".$imgCustomer."' alt=''; class='sendby-someone' draggable='false'/>"."<div class='msg-com'>"."<p class='date-message'>".$row["Date"]."</p>".$row["message"]."</div>"."</div>"."<br>";
                              }
                            }    
                        }
                    } else {
                            echo "<div class='no-messages'>No messages</div>";
                        }
             ?> 
      </body>
</html>