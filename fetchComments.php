<?php 
error_reporting(0);
session_start(); 
if(empty($_SESSION['logged'] and $_SESSION['loggedin'])==false){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:index.php"); }
?>
<script src="javascript/jquery.js"></script>
<DOCTYPE html>
<html>
    <body>
    <?php
                    error_reporting(0);
                    session_start(); 
                    include ('connect.php');
                            $sql = "SELECT t1.Date, t1.message, t1.customer, t2.CustomerImage FROM comments as t1, customers as t2 WHERE prodid = {$_SESSION['id']} and t1.customer = t2.username ORDER BY Date DESC";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $imgCustomer = 'customerprofile/'.$row["CustomerImage"]; 
                                    if(($row['customer']) == ($_SESSION['username'])){
                                        echo "<div class='message-container-me' >"."<div class='msg-com-me'>"."<p style='font-size:0.7em;color:grey;text-align:center;'>".$row["Date"]."</p>".$row["message"]."</div>"."<img src='".$imgCustomer."' alt=''; class='sendby-me' draggable='false'/>"."</div>"."<br>";
                                    }else{
                                      echo "<div class='message-container-sender'>"."<img src='".$imgCustomer."' alt=''; class='sendby-someone' draggable='false'/>"."<div class='msg-com'>"."<p style='font-size:1em;color:grey;text-align:center;'>".$row["Date"]."</p>".$row["message"]."</div>"."</div>"."<br>";
                                    }
                                                        }
                                        }else{
                                          echo "<div class='no-messages'>No comments</div>";
                                        }
                ?>
    </body>
</html>