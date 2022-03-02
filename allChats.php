<title>cnelle</title>
<link rel="stylesheet" href="css/main.css">
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<nav class="top-relative">
<button onclick="location.href='index.php'" class="top-right-button">Home</button> 
<?php 
        error_reporting(0);
        include ('connect.php'); 
        session_start(); 
        if(!empty($_SESSION['username'])){ ?>
         <button onclick="location.href='profile.php'" class="top-right-button">Profile</button> 
    <?php }else if(!empty($_SESSION['company'])){ ?>
         <button onclick="location.href='myStore.php'" class="top-right-button">Store</button> 
    <?php } ?>
    
<strong class="chats-heading">All Chats</strong>
</nav>
<div style="width:890px; margin: auto;">
<?php
       error_reporting(0);
        include ('connect.php'); 
        session_start(); 
        if(!empty($_SESSION['username'])){
        $sql = "SELECT t2.OwnerImage,t2.company, t1.SendBy, t1.Reciever, t1.Date FROM customersellermessages as t1, owners as t2 WHERE ((t1.SendBy = '{$_SESSION['username']}') and (t1.Reciever = t2.company)) GROUP BY t2.company ORDER BY t1.Date DESC";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {     
            while($row = $result->fetch_assoc()) {
                $imgURL = 'storeprofile/'.$row["OwnerImage"]; ?>
                <form action="update_notification_status.php?company=<?php echo $row['Reciever']; ?>" method="post">
                    <?php
                         echo "<button type='submit'  class='chats-container'>"."<br>"."<div style='display: inline-flex;'>"."<img src='".$imgURL."' class='chats-profile-image'>"."<strong class='chats-sender'>".$row['Reciever']."</strong>"."</div>"."</button>"."<hr/>";
                     ?>
                </form>
                 <?php }
                     }else {
                            echo "<div class='no-messages'>No chats</div>";
                    }
       }else if(!empty($_SESSION['company'])){
        $sql = "SELECT t2.CustomerImage,t2.username, t1.SendBy, t1.Reciever,t1.Date, t1.idMsg FROM customersellermessages as t1, customers as t2  WHERE ((t1.Reciever='{$_SESSION['company']}') and (t2.username = t1.SendBy)) GROUP BY t2.username ORDER BY t1.Date DESC";
        $result = $con->query($sql);
              if ($result->num_rows > 0) {     
                while($row = $result->fetch_assoc()) {
                    $imgURL = 'customerprofile/'.$row["CustomerImage"]; ?>
                    <form action="update_notification_status.php?username=<?php echo $row['SendBy']; ?>" method="post">
                        <?php
                             echo "<button type='submit'  class='chats-container'>"."<br>"."<div style='display: inline-flex;'>"."<img src='".$imgURL."' class='chats-profile-image'>"."<strong class='chats-sender'>".$row['SendBy']."</strong>"."</div>"."</button>"."<hr/>";
                         ?>
                    </form>
                     <?php }
                         }else {
                                echo "<div class='no-messages'>No chats</div>";
                        }  
        }?>
</div>
<footer id="footer">&copy; 2021 cnelle.com<footer>