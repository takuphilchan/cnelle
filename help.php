<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<!DOCTYPE html>
<html>
    <head>       
    <title>cnelle</title>
        <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.15.2/css/all.css" rel="stylesheet">
        <script src="javascript/jquery.js"></script>
        <script src="javascript/scroll.js"></script>
        <link rel="stylesheet" href="css/main.css">
        <link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
            <?php  
            error_reporting(0);
            session_start(); 
            include ('connect.php');
            if(!empty($_SESSION['username'])){
            $message = $_POST['message'];
            $Admin = "Administrator";
            $message = stripcslashes(htmlspecialchars($message)); 
            if(isset($_POST['submit']) && !empty($_POST['message'])){
                $sql= "INSERT INTO help (message,SendBy, Reciever) values ('$message','{$_SESSION['username']}', '$Admin')";
                mysqli_query($con,$sql); 
                header("Location: help.php");
                exit;
                }
            }else{
                header('Location: login.php');
            }
        ?>
        <script>
            $(document).ready(function(){
                setInterval(function(){
                    $("#message").load("helpfetch.php"); 
                },1);
            });
        </script>
    </head>
<body class="body-background">
    <nav class="top-relative">
    <button onclick="location.href='index.php'" class="top-left-button">Home</button>
    <strong  class="chats-heading-help-review">CNELLE CUSTOMER SERVICE</strong> 
    </nav>
        <form action="help.php" method="POST">
        <div class="messages-textbox-container">   
            <div class="design" id="message">
            </div>   
            <div class="textbox-area-help-review">
                <textarea type="text" class="textbox" name="message" placeholder="type a message" autocomplete="off"></textarea>
                <button type="submit" class="send-button" name="submit"><i class="fa fa-paper-plane"></i></button>
           </div>
        </div>
        </form>
</body>
<footer id="footer">&copy; 2021 cnelle.com</footer>    
</html>