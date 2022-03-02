<?php 
session_start();
error_reporting(0);
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
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> 
 <script src="javascript/reload.js"></script>
    <script src="javascript/image-placement-sell.js"></script>
 <link rel="stylesheet" href="css/main.css">
</head>
<body class="body-background-forms">
<?php 
error_reporting(0);
session_start();
include ('connect.php');
   if(isset($_POST["submit"])){
      $image = explode(".", $_FILES["image"]["name"][0]);
      $imgContent = round(microtime(true)) .'1'.'.' . end($image);
      $temp1 = $_FILES["image"]["tmp_name"][0];
      $check = move_uploaded_file($temp1, "productimages/".$imgContent);

      $image2 = explode(".", $_FILES["image"]["name"][1]);
      $imgContent2 = round(microtime(true)) .'2'.'.' . end($image2);
      $temp2 = $_FILES["image"]["tmp_name"][1];
      $check2 = move_uploaded_file($temp2, "productimages/".$imgContent2);
     
      if($check!== false and $check2 !== false){
            $ad_query = mysqli_query($con, "SELECT * from productTags");
                       if(mysqli_num_rows($ad_query)==0){
            $insert_query = mysqli_query($con,"INSERT INTO productTags (image1, image2,current) VALUES ('$imgContent', '$imgContent2', 'active')");             
                       }else{
            $update_query = mysqli_query($con, "UPDATE productTags SET image1 ='$imgContent', image2 = '$imgContent2' WHERE current = 'active'");               
                       if($update_query == true){

                       echo "<p class='notification-message'>tags have been updated</p>";
                            }else{
                            echo"<p class='invalid'>tag were not updated</p>"; 
                        } 
                    }  
                }else{ 
                    "<p class='invalid'>failed to upload your product pictures try other pictures</p>";
                }   
        }  
    ?>
<h2 class="admin-top-heading">TOP PRODUCT ADVERTISEMENT</h2>
<script src="javascript/image.js"></script>
<script src="javascript/mask.js"></script>
<div class="productback-sell">
<div class="form-top">
    <strong class="form-name">New Top product Ad</strong>
  </div><br>
<div class="form-body">
        <form action="productTags.php" method="POST" enctype="multipart/form-data">
                    <div id="sellimg">
                    Add 3 images(required)
                    <div class="frame-display">
                    <input type="file" id="file" name="image[]" multiple style="display: none; outline-color: transparent;" required>
                    <div class="frame" id="dvPreview"></div>
                    <label for="file"><div class="addbutton">Click to add images</div></label>
                    </div><br>
               <button type="submit" name="submit" class="button-for-forms" >Post Ad</button><br><br><br>
          </form><br>
     </div>   
    </div>
</body>
</html>
<?php }else{
   header("Location:index.php");  
} ?>