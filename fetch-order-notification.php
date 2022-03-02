
<?php
//fetch.php;
if(isset($_POST["view"])){
    include ('connect.php');  
    if(isset($_SESSION['username'])){
        if($_POST["view"] != ''){
         $update_query = "UPDATE orders SET notificationStatusCustomer=1 WHERE notificationStatusCustomer=0 and Recieved=1 and  customer ='{$_SESSION['username']}' and orderStatus=1 ";
         mysqli_query($con, $update_query);
        }
       $query = "SELECT * FROM orders where customer = '{$_SESSION['username']}' and Recieved=1 ORDER BY OrderId DESC LIMIT 5"; 
        $result = mysqli_query($con, $query);
        $output = '';
        
        if(mysqli_num_rows($result) > 0)
        {
         while($row = mysqli_fetch_array($result))
         {
          $output .= '<a  class="notification-details" href="allorders.php?username='.$row["customer"].'"><strong class="notification-heading">'.$row["company"].'</strong><br /><small class="notification-info"><em>'.$row["productName"].'</em></small>
           </a>
          ';
         }
        }
        else
        {
         $output .= '<a href="#" style="text-decoration: none;">No Notification Found</ a>';
        }
        
        $query_1 = "SELECT * FROM orders WHERE notificationStatusCustomer=0 and Recieved=1 and orderStatus=1 and customer ='{$_SESSION['username']}' ";
        $result_1 = mysqli_query($con, $query_1);
        $count = mysqli_num_rows($result_1);
        $data = array(
            'notificationOrder'   => $output,
            'order_notification' => $count
        );
        echo json_encode($data);
       }

  
if(isset($_SESSION['company'])){
    if($_POST["view"] != ''){
     $update_query = "UPDATE orders SET notificationStatusStore=1 WHERE notificationStatus=0 and company ='{$_SESSION['company']}' and orderStatus=1 ";
     mysqli_query($con, $update_query);
    }
   $query = "SELECT * FROM orders where company = '{$_SESSION['company']}' and orderStatus=1 ORDER BY OrderId DESC LIMIT 5"; 
    $result = mysqli_query($con, $query);
    $output = '';
    
    if(mysqli_num_rows($result) > 0)
    {
     while($row = mysqli_fetch_array($result))
     {
      $output .= '<a  class="notification-details" href="storeOrders.php?company='.$_SESSION["company"].'"><strong class="notification-heading">'.$row["customer"].'</strong><br /><small class="notification-info"><em>'.$row["productName"].'</em></small>
       </a>
      ';
     }
    }
    else
    {
        $output .= '<a href="#" style="text-decoration:none;">No Notification Found</ a>';
    }
    $query_1 = "SELECT * FROM orders WHERE notificationStatusStore=0 and orderStatus=1 and company ='{$_SESSION['company']}'";
    $result_1 = mysqli_query($con, $query_1);
    $count = mysqli_num_rows($result_1);
    $data = array(
     'notificationOrder'   => $output,
     'order_notification' => $count
    );
    echo json_encode($data);
   }
}
?>

