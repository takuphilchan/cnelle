<?php 
error_reporting(0);
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location: index.php"); }
     ?>
<DOCTYPE html>
<html>
    <body>
    <script src="javascript/jquery.js"></script>
    <?php
                    error_reporting(0);
                        include ('connect.php'); 
                        session_start(); 
                        $sql = "SELECT t1.Date, t1.message, t1.SendBy, t1.Reciever, t2.CustomerImage, t3.OwnerImage  FROM storehelp  as t1, customers as t2, owners as t3 WHERE ((t2.username = t1.Reciever) or (t2.username = t1.SendBy)) and (t1.SendBy='{$_SESSION['username']}' or t1.Reciever='{$_SESSION['username']}') and (t1.SendBy=t3.company or t1.Reciever=t3.company) ORDER BY Date ASC";
                        $result = $con->query($sql);
                            if ($result->num_rows > 0) {     
                                while($row = $result->fetch_assoc()) {
                                    $imgCustomer =  'customerprofile/'.$row["CustomerImage"];
                                    $imgOwner = 'storeprofile/'.$row["OwnerImage"]; 
                                    if(($row['SendBy']) == ($_SESSION['username'])){
                                        echo "<div class='message-container-me' >"."<div class='msg-com-me'>"."<p style='font-size:1em;color:grey;text-align:center;'>".$row["Date"]."</p>".$row["message"]."</div>"."<img src='".$imgCustomer."' alt=''; class='sendby-me' draggable='false'/>"."</div>"."<br>";
                                    }else{
                                      echo "<div class='message-container-sender'>"."<img src='".$imgOwner."' alt=''; class='sendby-someone' draggable='false'/>"."<div class='msg-com'>"."<p style='font-size:1em;color:grey;text-align:center;'>".$row["Date"]."<br>".$row["username"]."</p>".$row["message"]."</div>"."</div>"."<br>";
                                    }          
                                }
                             }else {
                                   echo "<div class='no-messages'>No messages</div>";
                                }    
                    ?>
    </body>
</html>