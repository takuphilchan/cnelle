<?php 
error_reporting(0);
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location: index.php"); }
     ?>
<?php
if($_SESSION['username']==='Administrator'){
?>
<DOCTYPE html>
<script src="javascript/jquery.js"></script>
<html>
    <body>
    <?php
                include ('connect.php'); 
                session_start(); 
                 $sql = "SELECT t1.Date, t1.message, t1.SendBy, t1.Reciever, t2.CustomerImage, t2.username FROM help as t1 , customers as t2 WHERE (t1.SendBy='{$_SESSION['username']}' or t1.Reciever ='{$_SESSION['username']}')  and t1.SendBy=t2.username ORDER BY Date ASC";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {     
                      while($row = $result->fetch_assoc()) {
                          $imgCustomer =  'customerprofile/'.$row["CustomerImage"]; 
                          if(($row['SendBy']) == ($_SESSION['username'])){
                              echo "<div class='message-container-me' >"."<div class='msg-com-me'>"."<p style='font-size:1em;color:grey;text-align:center;'>".$row["Date"]."</p>".$row["message"]."</div>"."<img src='".$imgCustomer."' alt=''; class='sendby-me' draggable='false'/>"."</div>"."<br>";
                          }else{
                            echo "<div class='message-container-sender'>"."<img src='".$imgCustomer."' alt=''; class='sendby-someone' draggable='false'/>"."<div class='msg-com'>"."<p style='font-size:1em;color:grey;text-align:center;'>".$row["Date"]."<br>".$row["username"]."</p>".$row["message"]."</div>"."</div>"."<br>";
                          }          
                      }
                   }else {
                         echo "<div class='no-messages'>No messages</div>";
                      }
             ?>
    </body>
</html>
<?php }else{
   header("Location:index.php");  
} ?>