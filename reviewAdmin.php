<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<?php
if($_SESSION['username']==='Administrator'){
?>
<!DOCTYPE html>
<html>
    <head>
        <title>cnelle</title>
        <script src="javascript/jquery.js"></script>
        <link rel="stylesheet" href="css/main.css">
        <link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
            <?php  
            error_reporting(0);
            session_start(); 
            include ('connect.php');
            if(!empty($_SESSION['username'])){
            $message = $_POST['message'];
            $username = $_POST['customer'];
            $message = stripcslashes(htmlspecialchars($message)); 
            if(isset($_POST['submit']) && !empty($_POST['message'])){
                $sql= "INSERT INTO review (message,SendBy, Reciever) values ('$message','{$_SESSION['username']}', '$username')";
                mysqli_query($con,$sql); 
                header("Location: reviewAdmin.php");
                exit;
                }
            }else{
                header('Location: login.php');
            }
        ?>
        <script>
            $(document).ready(function(){
                setInterval(function(){
                    $("#message").load("fetchreviewAdmin.php"); 
                },1);
            });
        </script>
    </head>
    <body class="body-background">
    <script src="javascript/scroll.js"></script>
        <h2 class="admin-top-heading">CUSTOMER REVIEWS AND FEEDBACK</h2>
        <form action="reviewAdmin.php" method="POST">
        <div class="messages-textbox-container">   
                <div class="design" id="message">
                </div>
            <div class="textbox-area-admin">
                <div class="buyers">
                <select name="customer" class="select-senders">
                    <?php
                        error_reporting(0);
                        include ('connect.php'); 
                        session_start(); 
                        $sql = "SELECT DISTINCT SendBy FROM review WHERE (Reciever='{$_SESSION['username']}') ORDER BY Date DESC";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {     
                                while($row = $result->fetch_assoc()) {
                                            echo "<option style='margin-left:5px;' selected disabled hidden>"."Send to"."</option>";
                                            echo "<option value='".$row['SendBy']."'>"."<strong style='font-size:1.7em; color:rgb(59, 59, 207);'>".$row["SendBy"]."</strong>"."</option>";
                                                                }
                                                } 
                                            else {
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
            </div>
        </form>
    </body>    
</html>
<?php }else{
   header("Location:index.php");  
} ?>