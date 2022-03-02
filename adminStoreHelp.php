<?php
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<?php
if($_SESSION['username']==='Administrator'){
?>
<script src="javascript/scroll.js"></script>
<!DOCTYPE html>
<html>
    <head>
        <title>cnelle</title>
        <script src="javascript/jquery.js"></script>
        <link rel="stylesheet" href="css/main.css">
        <link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
        <?php 
            error_reporting(0); 
            include ('connect.php');
            if(!empty($_SESSION['username'])){
            $message = $_POST['message'];
            $stores = $_POST['store'];
            $message = stripcslashes(htmlspecialchars($message)); 
            $stores  = stripcslashes(htmlspecialchars($stores)); 
            if(isset($_POST['submit']) && !empty($_POST['message']) && !empty($_POST['store'])){
                $sql= "INSERT INTO storehelp  (message,SendBy,Reciever) values ('$message','{$_SESSION['username']}', '$stores ')";
                mysqli_query($con,$sql); 
                $companies = $_SESSION['username'];
                header("Location: adminStoreHelp.php");
                exit;
                }
            }else{
                header('Location: login.php');
            }
        ?>
        <script>
            $(document).ready(function(){
                setInterval(function(){
                    $("#message").load("fetchadminStoreHelp.php"); 
                },1);
            });
        </script>
    </head>
    <body class="body-background">
    <script src="javascript/scroll.js"></script>
        <h2 class="admin-top-heading">STORE HELP AND SERVICE CENTER</h2>
        <form action="adminStoreHelp.php" method="POST">
          <div class="messages-textbox-container"> 
             <div class="design" id="message">
             </div> 
              <div class="textbox-area-admin">
                <div class="buyers">
                <select name="store" class="select-senders">
                    <?php
                        error_reporting(0);
                        include ('connect.php'); 
                        session_start(); 
                        $sql = "SELECT DISTINCT SendBy FROM storehelp WHERE (Reciever='{$_SESSION['username']}') ORDER BY Date DESC";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {     
                                while($row = $result->fetch_assoc()) {
                                            echo "<option style='margin-left:5px;' selected disabled hidden>"."Send to"."</option>";
                                            echo "<option value='".$row['SendBy']."'>"."<div>"."<strong style='font-size:1.7em; color:rgb(59, 59, 207);'>".$row["SendBy"]."</strong>"."</div>"."</option>";
                                                                }
                                            }else {
                                                echo "<option selected disabled hidden> No senders </option>";
                                            }
                    ?>
                </select> 
                </div>
                <div style="display: inline-flex;">    
                    <textarea type="text" class="textbox" name="message" placeholder="type a message" autocomplete="off"></textarea>
                    <button type="submit" name="submit" value="submit" class="send-button">Send</button>
               </div>
            </div>
        </div>
    </form>
    </body>
</html>
<?php }else{
   header("Location:index.php");  
} ?>