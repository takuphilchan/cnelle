
<script src="javascript/jquery.js"></script>
<DOCTYPE html>
<html>
    <body>
           <?php
                session_start(); 
                include ('dbconnect.php'); 
                $sql = "SELECT t1.Date, t1.message, t1.SendBy, t1.Reciever, t2.username, t2.userImage FROM messages as t1 , users as t2 WHERE (t1.SendBy='{$_SESSION['username']}' or t1.Reciever ='{$_SESSION['username']}')  and (t1.SendBy=t2.username or t1.Reciever=t2.username) ORDER BY t1.Date ASC";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {     
                        while($row = $result->fetch_assoc()) {
                            $imgCustomer =  'userprofile/'.$row["userImage"]; 
                            if(($row['SendBy']) == ($_SESSION['username'])){
                                echo "<div class='message-container-me' >"."<div class='msg-com-me'>"."<p class='date-message'>".$row["Date"]."</p>".$row["message"]."</div>"."<img src='".$imgCustomer."' alt=''; class='sendby-me' draggable='false'/>"."</div>"."<br>";
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