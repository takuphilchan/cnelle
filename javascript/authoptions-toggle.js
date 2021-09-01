
//AUTHOPTIONS MAIN DROPPER
$(document).ready(function(){
    $('#dropper1').click(function(){
      $(this).next('#dropdownMainLogin-content').slideToggle();
      $(this).toggleClass('active');
      })
  });  
  $(document).click(function (e) {
    var container = $('#dropper1');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('#dropdownMainLogin-content').hide();
    }
});


 $(document).ready(function(){
    $('#dropper2').click(function(){
      $(this).next('#dropdownMainSignup-content').slideToggle();
      $(this).toggleClass('active');
      })
  });
$(document).click(function (e) {
  var container = $('#dropper2');
  if (!container.is(e.target) && container.has(e.target).length === 0) {
      $('#dropdownMainSignup-content').hide();
  }
});

$(document).ready(function(){
    $('#dropper3').click(function(){
      $(this).next('#dropdownRegion-content').slideToggle();
      $(this).toggleClass('active');
      })
  });
$(document).click(function (e) {
  var container = $('#dropper3');
  if (!container.is(e.target) && container.has(e.target).length === 0) {
      $('#dropdownRegion-content').hide();
  }
});



$(document).ready(function(){
    $('#dropper4').click(function(){
      $(this).next('#dropdownCategory-content').slideToggle();
      $(this).toggleClass('active');
      })
  });

$(document).click(function (e) {
  var container = $('#dropper4');
  if (!container.is(e.target) && container.has(e.target).length === 0) {
      $('#dropdownCategory-content').hide();
  }
});
$(document).ready(function(){
  $('#dropper-one').click(function(){
    $(this).next('#dropdownMain-content-second').slideToggle();
    $(this).toggleClass('active');
    })
});  
$(document).click(function (e) {
  var container = $('#dropper-one');
  if (!container.is(e.target) && container.has(e.target).length === 0) {
      $('#dropdownMain-content-second').hide();
  }
});

//AUTHOPTIONS SECOND
$(document).ready(function(){
  $('#dropper-two').click(function(){
    $(this).next('#dropdownMainSignup-content-second').slideToggle();
    $(this).toggleClass('active');
    })
});
$(document).click(function (e) {
var container = $('#dropper-two');
if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('#dropdownMainSignup-content-second').hide();
}
});

$(document).ready(function(){
  $('#dropper-three').click(function(){
    $(this).next('#dropdownRegion-content-second').slideToggle();
    $(this).toggleClass('active');
    })
});
$(document).click(function (e) {
var container = $('#dropper-three');
if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('#dropdownRegion-content-second').hide();
}
});



$(document).ready(function(){
  $('#dropper-four').click(function(){
    $(this).next('#dropdownCategory-content-second').slideToggle();
    $(this).toggleClass('active');
    })
});

$(document).click(function (e) {
var container = $('#dropper-four');
if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('#dropdownCategory-content-second').hide();
}
});
//DROPPER AUTHOPTIONS TOP
$(document).ready(function(){
  $('#dropper-three-mobile').click(function(){
    $(this).next('#dropdownRegion-content-mobile').slideToggle();
    $(this).toggleClass('active');
    })
});
$(document).click(function (e) {
var container = $('#dropper-three-mobile');
if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('#dropdownRegion-content-mobile').hide();
}
});



$(document).ready(function(){
  $('#dropper-four-mobile').click(function(){
    $(this).next('#dropdownCategory-content-mobile').slideToggle();
    $(this).toggleClass('active');
    })
});

$(document).click(function (e) {
var container = $('#dropper-four-mobile');
if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('#dropdownCategory-content-mobile').hide();
}
});

//NOTIFICATION MESSAGES DROPDOWN

$(document).ready(function(){
  $('.notification-dropdown').click(function(){
    $(this).next('.dropdownNotification').slideToggle();
    $(this).toggleClass('active');
    })
});

$(document).click(function (e) {
var container = $('.notification-dropdown');
if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('.dropdownNotification').hide();
}
});

$(document).ready(function(){
  $('.dropdown').click(function(){
    $(this).next('.dropdown-content').slideToggle();
    $(this).toggleClass('active');
    })
});

$(document).click(function (e) {
var container = $('.dropdown');
if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('.dropdown-content').hide();
}
});

//AUTHOPTIONS DROPPER
$(document).ready(function(){
  $('#topdropper').click(function(){
    $(this).next('.authoptions').slideToggle();
    $(this).toggleClass('active');
    })
});

$(document).ready(function(){
  $('.authoptions-remover').click(function(){
    $('.authoptions').hide();
    })
});
//SECOND AUTHOPTONS DROPPER
$(document).ready(function(){
  $('#topdropper2').click(function(){
    $(this).next('.authoptions').slideToggle();
    $(this).toggleClass('active');
    })
});

$(document).ready(function(){
  $('.authoptions-remover').click(function(){
    $('.authoptions').hide();
    })
});