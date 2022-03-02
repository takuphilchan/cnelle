<?php 
session_start(); 
if(!isset($_SESSION['logged'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location: storeLoggin.php"); }
?>
<title>cnelle</title>
<script src="javascript/jquery.js"></script>
<script src="javascript/image.js"></script>
<script src="javascript/reload.js"></script>
<script src="javascript/image-placement.js"></script>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.15.2/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css">
        <link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />    
    </head>
<body class="body-background-with-design-messages">     
         <?php  
            error_reporting(0);
            session_start(); 
            include ('connect.php');
            if(!empty($_SESSION['company'])){
            $message = $_POST['message'];
            $firstnames = $_GET['username'];
            $message = stripcslashes(htmlspecialchars($message)); 
            $firstnames  = stripcslashes(htmlspecialchars($firstnames)); 
            if(isset($_POST['submit'])){
                if(!empty($message) && empty($_FILES["image"]["name"])){
                        $imgContent = "";
                    }else if(empty($message) && empty($_FILES["image"]["name"])){
                      header("Location: sellerCustomerMessages.php?username=$firstnames");
                      exit;
                  }else if(!empty($_FILES["image"]["name"])){
                $image = explode(".", $_FILES["image"]["name"]);
                $imgContent = round(microtime(true)). '.' . end($image);
                $temp = $_FILES["image"]["tmp_name"];
                $check = move_uploaded_file($temp, "messagesImages/".$imgContent); 
               }
                $sql= "INSERT INTO customersellermessages  (image,message,SendBy,Reciever) values ('$imgContent','$message','{$_SESSION['company']}', '$firstnames')";
                mysqli_query($con,$sql); 
                header("Location: sellerCustomerMessages.php?username=$firstnames");
                }
            }else{
                header('Location: storeLoggin.php');
            }
        ?>
        <script>
            $(document).ready(function(){
                setInterval(function(){
                    $("#message").load("fetchsellerCustomerMessages.php?username=<?php echo $firstnames; ?>"); 
                },3000);
            });
        </script>

    <nav class="top-relative">
    <button onclick="location.href='index.php?company=<?php echo $_SESSION['company'];?>'" class="top-left-button">Home</button>
        <button onclick="location.href='allChats.php'" class="top-left-button">Chat</button>
        <button onclick="location.href='myStore.php'" class="top-right-button">Store</button>
        <button onclick="location.href='storeOrders.php?company=<?php echo $_SESSION['company'];?>'"  class="top-right-button">Orders</button><br>
    </nav>
        <h2 class="chats-heading-messaging" >Chatting with <?php echo $_GET['username']; ?></h2>
        <form action="sellerCustomerMessages.php?username=<?php echo $_GET['username']; ?> " method="POST" enctype="multipart/form-data">
            <div class="messages-textbox-container">
                <div class="design" id="message">
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
                              echo "<div class='message-container-me' >"."<div class='msg-com-me-img'>"."<div class='msg-com-me'>"."<p class='date-message-img-me'>".$row["Date"]."</p>".$row["message"]."</div>"."<br>"."<img src='".$imageURL."' alt='';  class='msg-images'  draggable='false'/>"."<br>"."</div>"."<img src='".$imgOwner."' alt=''; class='sendby-me' draggable='false'/>"."</div>";
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
                </div>
                <div class="textbox-area">  
                <textarea type="text" class="textbox" name="message" placeholder="type a message" autocomplete="off"></textarea>
                <input type="file" id="file" name="image" style="display: none;" onchange="loadFile(event)">
                <label for="file"><div style="background-image: url('images/product.png');" class="choose-image" id="imgplace"></div></label>
              <button type="submit" class="send-button" name="submit" value="submit" ><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </form>
    </body>
</html>
<script src="javascript/scroll.js"></script>
<footer id="footer">&copy; 2021 cnelle.com<footer>