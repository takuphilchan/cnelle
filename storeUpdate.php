<?php 
session_start(); 
if(!isset($_SESSION['logged'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:storeLoggin.php"); }
?>
<!DOCTYPE html>
<html>
<head>
<title>cnelle</title>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.css" rel="stylesheet">  
<link rel="stylesheet" href="css/main.css">
<script src="javascript/keypads.js"></script>
<script src="javascript/autocomp.js"></script>
</head>
<body class="body-background-with-design">
<button onclick="location.href='storeProfile.php'" class="top-left-button">Account</button>  
<?php 
error_reporting(0);
   
session_start();
include ('connect.php');
   if(isset($_POST["submit"])){
    if(empty($_FILES["image"]["name"])){ 
        $imgContent = "placeholder.png";
       }else{
        $image = explode(".", $_FILES["image"]["name"]);
        $imgContent = round(microtime(true)). '.' . end($image);
        $temp = $_FILES["image"]["tmp_name"];
        $check = move_uploaded_file($temp, "storeprofile/".$imgContent);
        if($check == false){
            echo "Your store profile picture was not uploaded, try another picture";
           }
         }
        $postalCode = $_POST['postalCode'];
        $phone = $_POST['phone'];
        $code = $_POST['countryCode'];
        $email= $_POST['email'];
        $address = $_POST['address'];
        $storeColor = $_POST['storeColor'];
        $password = $_POST['mypass'];
        $phone = stripcslashes(htmlspecialchars($phone));
        $postalCode = stripcslashes(htmlspecialchars($postalCode));
        $email = stripcslashes(htmlspecialchars($email));
        $address = stripcslashes(htmlspecialchars($address));
        $storeColor = stripcslashes(htmlspecialchars($storeColor));
        $password = stripcslashes(htmlspecialchars($password));
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $updt = "UPDATE owners SET OwnerImage ='$imgContent', OwnerEmail='$email',  password='$hash', phone='$phone', storeColor='$storeColor', OwnerAddress='$address', PostalCode='$postalCode' WHERE company = '{$_SESSION['company']}'"; 
                       $success = mysqli_query($con,$updt);  
                       if($success == true){
                       echo "<p class='notification-message'>Congratulations $company your account has been updated</p>";
                            }
                    else{
                            echo"<p >Account $company  was not updated</p>"; 
                        }     
            }else{
                echo"<p class='invalid'>invalid email</p>";
            }  
        }  
    ?>
<?php 
 error_reporting(0);
 session_start();
 include ('connect.php'); 
 $result =  mysqli_query($con,"SELECT OwnerImage, OwnerEmail, password, phone, OwnerAddress, PostalCode FROM owners where company = '{$_SESSION['company']}'");
 $row= mysqli_fetch_array($result);

?>
<script src="javascript/image.js"></script>
<script src="javascript/mask.js"></script>
<div id="store">
<div class="form-top"> <strong class="form-name">Update Account</strong> </div>
   <div class="form-body">
        <form action="storeUpdate.php" method="POST" enctype="multipart/form-data">
            <h2 class="select-photo-label">Store Picture</h2><br>
            <input type="file" id="file" name="image" style="display: none;" onchange="loadFile(event)" value="<?php echo $row['OwnerImage'];?>">
            <label for="file"><?php $imgURL = 'storeprofile/'.$row["OwnerImage"];  echo "<img id='imgplace' src='".$imgURL."' draggable='false' style='height:200px; border-radius:50%; width:200px;'>";?></label>
                <br> <br> <br>
               <div class="form">
               <input type="tel" name="phone" id="phone" class="form-input"  onkeypress='return restrictAlphabets(event)' maxlength=20 value="<?php echo $row['phone']; ?>">
                <label for="phone" class="label-name">
                    <span class="content-name">Enter your new phone number</span>
                </label>
                </div>
                <div class="form">
                <input type="text" name="email" class="form-input"  required maxlength=30 value="<?php echo $row['OwnerEmail']; ?>">
                <label for="email" class="label-name">
                    <span class="content-name">Enter  your new email</span>
                </label>
                </div> 

                
                <div class="form">
                <input type="text" name="address" class="form-input"  required  maxlength=80 value="<?php echo $row['OwnerAddress']; ?>">
                <label for="address" class="label-name">
                    <span class="content-name">Enter your new store address</span>
                    </label>
                </div> 
                <div class="form">
                <input type="text" name="storeColor" list="storeColor" class="form-input" required value="<?php echo $row['storeColor']; ?>" maxlength=50>
                <label for="storeColor" class="label-name">
                    <span class="content-name">Select your new store background color</span>
                </label>
                <datalist name="storeColor" class="form-input" style="background-color: white;" id="storeColor">
                <option Selected value="purple">purple</option>
                <option value="orange">orange</option>
                    <optgroup label="Other countries">
                        <option value="blue">blue</option>
                        <option value="royalblue">royalblue</option>
                        <option value="green">green</option>
                        <option value="black">black</option>
                        <option value="grey">grey</option>
                        <option value="red">red</option>
                        <option value="pink">pink</option>
                      </optgroup>
               </datalist>
               </div> 
                <div class="form">
                <input type="text" name="postalCode" class="form-input"  required maxlength=10 value="<?php echo $row['PostalCode']; ?>">
                <label for="postalCode" class="label-name">
                    <span class="content-name">Enter your new postal code</span>
                    </label>
                </div> 

                <div class="form">
                <input type="text" name="mypass" id="password-field" autocomplete="new-password" oninput="turnOnPasswordStyle()" required>
                <label for="mypass" class="label-name">
                  <span class="content-name">Enter your new password </span>
                </label>
                <i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i>
                </div>
               <button type="submit" name="submit" class="button-for-forms">UPDATE</button><br><br><br>
          </form><br>
          </div>
          
    </div>
</body>
<footer id="footer">&copy; 2021 cnelle.com<footer>
</html>