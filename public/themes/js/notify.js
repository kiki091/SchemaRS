function notify(){
  $('.test-notif').on('click', function(){
    $.notify({
      title: 'Sorry, there are few missing contents detected, please complete all the required fields.',
      message: '<li class="notif__content__li"><span class="text" >Offers Title.jp is missing</span></li>'
    }, { 
      style: 'notif-msg',
      autoHide: false,
      clickToHide: false,
      position: 'bottom left',
      className: 'error'
    });

    $('.notifyjs-wrapper').on('load', '.notif__content__ul', function(){
    
      $(this).mCustomScrollbar({
        theme:"dark-thin",
        axis:"y"
      });
    });
  });

  /* FORM ERROR STYLE */
  var img = '../themes/cms/svg/ico-important.svg';
  var count = $( '.notif__content__li' ).size();
  $.notify.addStyle('notif-msg', {
    html:
    '<div>' +
      '<div class="notif__form__error">' +
          '<div class="notif__icon">' +
              '<img src="' + img + '" alt="">' +
          '</div>' +
          '<div class="notif__msg">' +
              '<button class="notif__close no">&times;</button>' +
              '<p class="notif__content">' +
                  '<span data-notify-html="title"></span>' +
                  '<ul class="notif__content__ul" data-notify-html="message"></ul>' +
              '</p>' +
          '</div>' +
      '</div>' +
    '</div>'
  });
  
  // $('.notif__content__ul').mCustomScrollbar({
  //   theme:"dark-thin",
  //   axis:"y"
  // });
  $(document).on('click', '.notifyjs-notif-msg-base .no', function() {
    $(this).trigger('notify-hide');
  });



  /* GLOBAL NOTIF STYLE */
  $.notify.addStyle('foo', {
    html:
    '<div>' +
      '<div class="notification__wrapper">' +
        '<div class="notification__style">' +
            '<div class="notification__messages">' +
                '<span data-notify-html="title"></span>' +
            '</div>' +
            '<div class="notification__button">' +
                '<button class="btn__notif__close no" id="close-notif">&times;</button>' +
            '</div>' +
        '</div>' +
      '<div class="notification__shadow"></div>' +
      '</div>' +
    '<div>'
  });
  $(document).on('click', '.notifyjs-foo-base .no', function() {
    $(this).trigger('notify-hide');
  });
}