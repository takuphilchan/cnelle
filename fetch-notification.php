
<?php
//fetch.php;
if(isset($_POST["view"]))
{
 include ('connect.php');
 if(isset($_SESSION['username'])){
 if($_POST["view"] != ''){
  $update_query = "UPDATE customersellermessages SET message_status=1 WHERE message_status=0 and Reciever = '{$_SESSION['username']}'";
  mysqli_query($con, $update_query);
 }
$query = "SELECT * FROM customersellermessages where Reciever = '{$_SESSION['username']}' ORDER BY idMsg DESC LIMIT 5"; 
 $result = mysqli_query($con, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<a  class="notification-details" href="customerSellerMessages.php?company='.$row["SendBy"].'"><strong class="notification-heading">'.$row["SendBy"].'</strong><br /><small class="notification-info"><em>'.$row["message"].'</em></small>
    </a>
   ';
  }
 }
 else
 {
  $output .= '<a href="#" style="text-decoration: none;">No Messages Found</ a>';
 }
 
 $query_1 = "SELECT * FROM customersellermessages WHERE message_status=0 and Reciever = '{$_SESSION['username']}'  ";
 $result_1 = mysqli_query($con, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
if(isset($_SESSION['company'])){
    if($_POST["view"] != ''){
     $update_query = "UPDATE customersellermessages SET message_status=1 WHERE message_status=0 and Reciever ='{$_SESSION['company']}' ";
     mysqli_query($con, $update_query);
    }
   $query = "SELECT * FROM customersellermessages where Reciever = '{$_SESSION['company']}' ORDER BY idMsg DESC LIMIT 5"; 
    $result = mysqli_query($con, $query);
    $output = '';
    
    if(mysqli_num_rows($result) > 0)
    {
     while($row = mysqli_fetch_array($result))
     {
      $output .= '<a  class="notification-details" href="sellerCustomerMessages.php?username='.$row["SendBy"].'"><strong  class="notification-heading">'.$row["SendBy"].'</strong><br /><small class="notification-info"><em>'.$row["message"].'</em></small>
       </a>
      ';
     }
    }
    else
    {
        $output .= '<a href="#" style="text-decoration:none;">No Messages Found</ a>';
    }
    $query_1 = "SELECT * FROM customersellermessages WHERE message_status=0 and Reciever ='{$_SESSION['company']}'";
    $result_1 = mysqli_query($con, $query_1);
    $count = mysqli_num_rows($result_1);
    $data = array(
     'notification'   => $output,
     'unseen_notification' => $count
    );
    echo json_encode($data);
   }
}
?>

