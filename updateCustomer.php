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
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">  
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />  
<link rel="stylesheet" href="css/main.css">
<script src="javascript/keypads.js"></script>
<script src="javascript/autocomp.js"></script>
</head>
<body class="body-background-with-design">
<button onclick="location.href='profile.php'" class="top-left-button">myProfile</button> 
<?php
error_reporting(0);
session_start();
include ('connect.php');
   if(isset($_POST["submit"])){
    if(empty($_FILES["image"]["name"])){
      $imgContent= "placeholder.jpg";
            }else{
            $image = explode(".", $_FILES["image"]["name"]);
            $imgContent = round(microtime(true)). '.' . end($image);
            $temp = $_FILES["image"]["tmp_name"];
            $check = move_uploaded_file($temp, "customerprofile/".$imgContent);
            if($check==false){
                echo  "Picture was not uploaded,  try another picture";
                }
            }
            $phone=$_POST['phone'];
            $code = $_POST['countryCode'];
            $country=$_POST['country'];
            $province=$_POST['province'];
            $email=$_POST['email'];
            $pass = $_POST['mypass'];
            $email = stripcslashes(htmlspecialchars ($email));
            $phone = stripcslashes(htmlspecialchars ($phone));
            $country = stripcslashes(htmlspecialchars ($country));
            $province = stripcslashes(htmlspecialchars ($province));
            $pass = stripcslashes(htmlspecialchars($pass));
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $updt = "UPDATE customers set CustomerImage ='$imgContent', email='$email', password='$hash', Phone='$phone', Country='$country', province='$province' WHERE username = '{$_SESSION['username']}'"; 
                      $success = mysqli_query($con,$updt);  
                      if($success==true){
                       echo "<p class='notification-message'>Congratulations $name your account has been updated</p>";
                       $_SESSION['loggedin']=true;

                    }
                    else{
                            echo"<p class='invalid'>Account $name failed to update</p>"; 
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
$result = mysqli_query($con, "SELECT CustomerImage, email, password, Phone, Country, province FROM customers where username = '{$_SESSION['username']}'"); 
$row= mysqli_fetch_array($result);
?>
<script src="javascript/mask.js"></script>
<script src="javascript/image.js"></script>
<div id="register">
<div class="form-top"> <strong class="form-name">Update Account</strong> </div>
<div class="form-body">
      <form action="updateCustomer.php" method="POST" enctype="multipart/form-data">
              <h2 class="select-photo-label">Select new profile picture</h2> <br>
              <input type="file" id="file" name="image" style="display: none;"  onchange="loadFile(event)" value="<?php echo $row['CustomerImage']; ?>">
              <label for="file"><?php $imgURL = 'customerprofile/'.$row["CustomerImage"];  echo "<img id='imgplace' src='".$imgURL."' draggable='false' class='image-update-container'>";?></label>
              <br><br><br> 
             <div class="form">
              <input type="text" name="email" class="form-input" maxlength=30 value="<?php echo $row['email'];?>">
              <label for="email" class="label-name">
                  <span class="content-name">Enter your new email</span>
              </label>
              </div>
              <div class="form">
              <input type="tel" name="phone" id="phone" class="form-input" onkeypress='return restrictAlphabets(event)' maxlength=20 value="<?php echo $row['Phone']; ?>">
                <label for="phone" class="label-name">
                    <span class="content-name">Enter your new phone number</span>
                </label>
              </div>
              <div class="form">
              <input type="text" name="province" class="form-input" onkeypress='return restrictNumbers(event)' maxlength=30 value="<?php echo $row['province']; ?>" >
              <label for="province" class="label-name">
                  <span class="content-name">Enter your new province</span>
              </label>
             </div>  
             <div class="form">
                <input type="text" list="country" name="country" class="form-input"  onkeypress='return restrictNumbers(event)' maxlength=56 value="<?php echo $row['Country']; ?>"> 
                <label for="myName" class="label-name">
                  <span class="content-name">Select your country</span>
                </label>
               
                <datalist id="country">
                              <option value="Afghanistan">Afghanistan</option>
                              <option value="Albania">Albania</option>
                              <option value="Algeria">Algeria</option>
                              <option value="American Samoa">American Samoa</option>
                              <option value="Andorra">Andorra</option>
                              <option value="Angola">Angola</option>
                              <option value="Anguilla">Anguilla</option>
                              <option value="Antartica">Antarctica</option>
                              <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                              <option value="Argentina">Argentina</option>
                              <option value="Armenia">Armenia</option>
                              <option value="Aruba">Aruba</option>
                              <option value="Australia">Australia</option>
                              <option value="Austria">Austria</option>
                              <option value="Azerbaijan">Azerbaijan</option>
                              <option value="Bahamas">Bahamas</option>
                              <option value="Bahrain">Bahrain</option>
                              <option value="Bangladesh">Bangladesh</option>
                              <option value="Barbados">Barbados</option>
                              <option value="Belarus">Belarus</option>
                              <option value="Belgium">Belgium</option>
                              <option value="Belize">Belize</option>
                              <option value="Benin">Benin</option>
                              <option value="Bermuda">Bermuda</option>
                              <option value="Bhutan">Bhutan</option>
                              <option value="Bolivia">Bolivia</option>
                              <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                              <option value="Botswana">Botswana</option>
                              <option value="Bouvet Island">Bouvet Island</option>
                              <option value="Brazil">Brazil</option>
                              <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                              <option value="Brunei Darussalam">Brunei Darussalam</option>
                              <option value="Bulgaria">Bulgaria</option>
                              <option value="Burkina Faso">Burkina Faso</option>
                              <option value="Burundi">Burundi</option>
                              <option value="Cambodia">Cambodia</option>
                              <option value="Cameroon">Cameroon</option>
                              <option value="Canada">Canada</option>
                              <option value="Cape Verde">Cape Verde</option>
                              <option value="Cayman Islands">Cayman Islands</option>
                              <option value="Central African Republic">Central African Republic</option>
                              <option value="Chad">Chad</option>
                              <option value="Chile">Chile</option>
                              <option value="China">China</option>
                              <option value="Christmas Island">Christmas Island</option>
                              <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                              <option value="Colombia">Colombia</option>
                              <option value="Comoros">Comoros</option>
                              <option value="Congo">Congo</option>
                              <option value="Congo">Congo, the Democratic Republic of the</option>
                              <option value="Cook Islands">Cook Islands</option>
                              <option value="Costa Rica">Costa Rica</option>
                              <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                              <option value="Croatia">Croatia (Hrvatska)</option>
                              <option value="Cuba">Cuba</option>
                              <option value="Cyprus">Cyprus</option>
                              <option value="Czech Republic">Czech Republic</option>
                              <option value="Denmark">Denmark</option>
                              <option value="Djibouti">Djibouti</option>
                              <option value="Dominica">Dominica</option>
                              <option value="Dominican Republic">Dominican Republic</option>
                              <option value="East Timor">East Timor</option>
                              <option value="Ecuador">Ecuador</option>
                              <option value="Egypt">Egypt</option>
                              <option value="El Salvador">El Salvador</option>
                              <option value="Equatorial Guinea">Equatorial Guinea</option>
                              <option value="Eritrea">Eritrea</option>
                              <option value="Estonia">Estonia</option>
                              <option value="Ethiopia">Ethiopia</option>
                              <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                              <option value="Faroe Islands">Faroe Islands</option>
                              <option value="Fiji">Fiji</option>
                              <option value="Finland">Finland</option>
                              <option value="France">France</option>
                              <option value="France Metropolitan">France, Metropolitan</option>
                              <option value="French Guiana">French Guiana</option>
                              <option value="French Polynesia">French Polynesia</option>
                              <option value="French Southern Territories">French Southern Territories</option>
                              <option value="Gabon">Gabon</option>
                              <option value="Gambia">Gambia</option>
                              <option value="Georgia">Georgia</option>
                              <option value="Germany">Germany</option>
                              <option value="Ghana">Ghana</option>
                              <option value="Gibraltar">Gibraltar</option>
                              <option value="Greece">Greece</option>
                              <option value="Greenland">Greenland</option>
                              <option value="Grenada">Grenada</option>
                              <option value="Guadeloupe">Guadeloupe</option>
                              <option value="Guam">Guam</option>
                              <option value="Guatemala">Guatemala</option>
                              <option value="Guinea">Guinea</option>
                              <option value="Guinea-Bissau">Guinea-Bissau</option>
                              <option value="Guyana">Guyana</option>
                              <option value="Haiti">Haiti</option>
                              <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                              <option value="Holy See">Holy See (Vatican City State)</option>
                              <option value="Honduras">Honduras</option>
                              <option value="Hong Kong">Hong Kong</option>
                              <option value="Hungary">Hungary</option>
                              <option value="Iceland">Iceland</option>
                              <option value="India">India</option>
                              <option value="Indonesia">Indonesia</option>
                              <option value="Iran">Iran (Islamic Republic of)</option>
                              <option value="Iraq">Iraq</option>
                              <option value="Ireland">Ireland</option>
                              <option value="Israel">Israel</option>
                              <option value="Italy">Italy</option>
                              <option value="Jamaica">Jamaica</option>
                              <option value="Japan">Japan</option>
                              <option value="Jordan">Jordan</option>
                              <option value="Kazakhstan">Kazakhstan</option>
                              <option value="Kenya">Kenya</option>
                              <option value="Kiribati">Kiribati</option>
                              <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                              <option value="Korea">Korea, Republic of</option>
                              <option value="Kuwait">Kuwait</option>
                              <option value="Kyrgyzstan">Kyrgyzstan</option>
                              <option value="Lao">Lao People's Democratic Republic</option>
                              <option value="Latvia">Latvia</option>
                              <option value="Lebanon" selected>Lebanon</option>
                              <option value="Lesotho">Lesotho</option>
                              <option value="Liberia">Liberia</option>
                              <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                              <option value="Liechtenstein">Liechtenstein</option>
                              <option value="Lithuania">Lithuania</option>
                              <option value="Luxembourg">Luxembourg</option>
                              <option value="Macau">Macau</option>
                              <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                              <option value="Madagascar">Madagascar</option>
                              <option value="Malawi">Malawi</option>
                              <option value="Malaysia">Malaysia</option>
                              <option value="Maldives">Maldives</option>
                              <option value="Mali">Mali</option>
                              <option value="Malta">Malta</option>
                              <option value="Marshall Islands">Marshall Islands</option>
                              <option value="Martinique">Martinique</option>
                              <option value="Mauritania">Mauritania</option>
                              <option value="Mauritius">Mauritius</option>
                              <option value="Mayotte">Mayotte</option>
                              <option value="Mexico">Mexico</option>
                              <option value="Micronesia">Micronesia, Federated States of</option>
                              <option value="Moldova">Moldova, Republic of</option>
                              <option value="Monaco">Monaco</option>
                              <option value="Mongolia">Mongolia</option>
                              <option value="Montserrat">Montserrat</option>
                              <option value="Morocco">Morocco</option>
                              <option value="Mozambique">Mozambique</option>
                              <option value="Myanmar">Myanmar</option>
                              <option value="Namibia">Namibia</option>
                              <option value="Nauru">Nauru</option>
                              <option value="Nepal">Nepal</option>
                              <option value="Netherlands">Netherlands</option>
                              <option value="Netherlands Antilles">Netherlands Antilles</option>
                              <option value="New Caledonia">New Caledonia</option>
                              <option value="New Zealand">New Zealand</option>
                              <option value="Nicaragua">Nicaragua</option>
                              <option value="Niger">Niger</option>
                              <option value="Nigeria">Nigeria</option>
                              <option value="Niue">Niue</option>
                              <option value="Norfolk Island">Norfolk Island</option>
                              <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                              <option value="Norway">Norway</option>
                              <option value="Oman">Oman</option>
                              <option value="Pakistan">Pakistan</option>
                              <option value="Palau">Palau</option>
                              <option value="Panama">Panama</option>
                              <option value="Papua New Guinea">Papua New Guinea</option>
                              <option value="Paraguay">Paraguay</option>
                              <option value="Peru">Peru</option>
                              <option value="Philippines">Philippines</option>
                              <option value="Pitcairn">Pitcairn</option>
                              <option value="Poland">Poland</option>
                              <option value="Portugal">Portugal</option>
                              <option value="Puerto Rico">Puerto Rico</option>
                              <option value="Qatar">Qatar</option>
                              <option value="Reunion">Reunion</option>
                              <option value="Romania">Romania</option>
                              <option value="Russia">Russian Federation</option>
                              <option value="Rwanda">Rwanda</option>
                              <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                              <option value="Saint LUCIA">Saint LUCIA</option>
                              <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                              <option value="Samoa">Samoa</option>
                              <option value="San Marino">San Marino</option>
                              <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                              <option value="Saudi Arabia">Saudi Arabia</option>
                              <option value="Senegal">Senegal</option>
                              <option value="Seychelles">Seychelles</option>
                              <option value="Sierra">Sierra Leone</option>
                              <option value="Singapore">Singapore</option>
                              <option value="Slovakia">Slovakia (Slovak Republic)</option>
                              <option value="Slovenia">Slovenia</option>
                              <option value="Solomon Islands">Solomon Islands</option>
                              <option value="Somalia">Somalia</option>
                              <option value="South Africa">South Africa</option>
                              <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                              <option value="Span">Spain</option>
                              <option value="SriLanka">Sri Lanka</option>
                              <option value="St. Helena">St. Helena</option>
                              <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                              <option value="Sudan">Sudan</option>
                              <option value="Suriname">Suriname</option>
                              <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                              <option value="Swaziland">Swaziland</option>
                              <option value="Sweden">Sweden</option>
                              <option value="Switzerland">Switzerland</option>
                              <option value="Syria">Syrian Arab Republic</option>
                              <option value="Taiwan">Taiwan, Province of China</option>
                              <option value="Tajikistan">Tajikistan</option>
                              <option value="Tanzania">Tanzania, United Republic of</option>
                              <option value="Thailand">Thailand</option>
                              <option value="Togo">Togo</option>
                              <option value="Tokelau">Tokelau</option>
                              <option value="Tonga">Tonga</option>
                              <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                              <option value="Tunisia">Tunisia</option>
                              <option value="Turkey">Turkey</option>
                              <option value="Turkmenistan">Turkmenistan</option>
                              <option value="Turks and Caicos">Turks and Caicos Islands</option>
                              <option value="Tuvalu">Tuvalu</option>
                              <option value="Uganda">Uganda</option>
                              <option value="Ukraine">Ukraine</option>
                              <option value="United Arab Emirates">United Arab Emirates</option>
                              <option value="United Kingdom">United Kingdom</option>
                              <option value="United States">United States</option>
                              <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                              <option value="Uruguay">Uruguay</option>
                              <option value="Uzbekistan">Uzbekistan</option>
                              <option value="Vanuatu">Vanuatu</option>
                              <option value="Venezuela">Venezuela</option>
                              <option value="Vietnam">Viet Nam</option>
                              <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                              <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                              <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                              <option value="Western Sahara">Western Sahara</option>
                              <option value="Yemen">Yemen</option>
                              <option value="Yugoslavia">Yugoslavia</option>
                              <option value="Zambia">Zambia</option>
                              <option value="Zimbabwe">Zimbabwe</option>
                </datalist>
              
               </div>   
               <div class="form">
                <input type="text" name="mypass" id="password-field" autocomplete="new-password" oninput="turnOnPasswordStyle()" required>
                <label for="mypass" class="label-name">
                  <span class="content-name">Enter your password </span>
                </label>
                <i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i>
               </div>
              <button type="submit" name="submit" class="button-for-forms">UPDATE</button><br><br><br><br>
        </form>
</div>
</div>
<footer id="footer">&copy; 2021 cnelle.com<footer>
</body>
</html>