<?php 
error_reporting(0);
session_start(); 
if(!isset($_SESSION['logged'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:StoreLoggin.php"); }
?>
<script src="javascript/jquery.js"></script>
<DOCTYPE html>
<html>
    <body>
    <?php
                include ('connect.php'); 
                session_start(); 
                $sql = "SELECT t1.Date, t1.message, t1.SendBy, t1.Reciever, t2.CustomerImage, t2.username, t3.OwnerImage, t3.company FROM storehelp as t1, customers as t2, owners as t3 WHERE (t1.SendBy=t2.username or t1.Reciever=t2.username) and (t1.SendBy=t3.company or t1.Reciever=t3.company) and (t1.Reciever='{$_SESSION['company']}' or t1.SendBy='{$_SESSION['company']}') ORDER BY t1.Date ASC";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {     
                        while($row = $result->fetch_assoc()) {
                            $imgCustomer =  'customerprofile/'.$row["CustomerImage"]; 
                            $imgOwner = 'storeprofile/'.$row["OwnerImage"]; 
                            if(($row["SendBy"])==($_SESSION["company"])){
                                echo "<div class='message-container-me'>"."<div class='msg-com-me'>"."<p class='date-message-me'>".$row["Date"]."</p>".$row["message"]."</div>"."<img src='". $imgOwner."' alt=''; class='sendby-me' draggable='false'/>"."</div>"."<br>";
                            }else{
                              echo "<div class='message-container-sender'>"."<img src='".$imgCustomer."' alt=''; class='sendby-someone' draggable='false'/>"."<div class='msg-com'>"."<p class='date-message'>".$row["Date"]."</p>".$row["message"]."</div>"."</div>"."<br>";
                            }           
                        }
                     }else {
                            echo "<div class='no-messages'>No messages</div>";
                        }

                        
             ?>
    </body>
</html>