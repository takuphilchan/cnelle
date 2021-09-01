function playSound()
{
    var audio = new Audio('static/audio.mp3');
    audio.play();

}

$(document).ready(function(){
 
 function load_unseen_notification(view = ''){
  $.ajax({
   url:"fetch-notification.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-content').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.badge-danger').html(data.unseen_notification);
    }else{
      $('.badge-danger').html('0')
    }
   }
  });
 }
 
 load_unseen_notification();

 $(document).on('click', '.dropdown', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
setInterval(function(){ 
  load_unseen_notification();
 }, 1000);



});

function playSound()
{
    var audio = new Audio('static/audio.mp3');
    audio.play();

}

$(document).ready(function(){
 
 function load_order_notification(view = ''){
  $.ajax({
   url:"fetch-order-notification.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdownNotification').html(data.notificationOrder);
    if(data.order_notification > 0)
    {
     $('.notify').html(data.order_notification);
    }else{
      $('.notify').html('0')
    }
   }
  });
 }
 
 load_order_notification();

 $(document).on('click', '.notification-dropdown', function(){
  $('.count').html('');
  load_order_notification('yes');
 });
 
setInterval(function(){ 
  load_order_notification();
 }, 1000);



});
