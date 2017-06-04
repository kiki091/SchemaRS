//true devtools and config vue js
Vue.config.devtools = true;
Vue.config.debug = true;
//end true devtools and config vue js
//function change password
Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");
var vmForm = new Vue({

    el: '#template_change_password',
    data: {
        models: {
            old_password: '',
            new_password: '',
            confirm_password: '',
            _token: ''
        },
        notif: '',
        showModal: false
    },

    methods: {

        showForm: function() {
            this.models = { old_password: '', new_password: '', confirm_password: '' }
            this.refresh()
            this.showModal = true;

            $('.popup__mask').addClass('is-visible');

            // add class di container saat popup
            $('.container__main').addClass('popupContainer');
        },

        refresh: function() {
            $('#error-old-password').text('')
            $('#error-new-password').text('')
            $('#error-confirm-password').text('')
        },

        closeForm: function() {
            this.showModal = false;

            // remove class di container saat popup
             $('.container__main').removeClass('popupContainer');

            // remove class di container saat popup
            setTimeout(function() {
              $('.popup__mask').removeClass('is-visible');
            }, 300);
        },

        showNotif: function(){
            $('.popup__notif').addClass('open');
            $('.submit-form').addClass('btn__disable');
            setTimeout(function () {
                $('.popup__notif').removeClass('open');
                $('.submit-form').removeClass('btn__disable');
            }, 5000)
            this.notif = 'Change Password Successful';
        },

        showErrorNotif: function(){
            $('#error-old-password').show();
            $('#error-old-password').text('Wrong old password');
        },

        changePassword: function () {
                var domain    = 'change-password';
                var users     = this.models
                
                var old_password     = users.old_password
                var new_password    = users.new_password
                var confirm_password     = users.confirm_password
                var _token     = users._token

                var payload = { old_password: old_password, new_password: new_password, confirm_password: confirm_password, _token: _token }
                this.refresh()

                this.$http.post(domain, payload).then(function (response) {
                    if (response.data.status==='') 
                    {
                        data = response.data
                        if(data.old_password)
                        {
                            $('#error-old-password').show();
                            $('#error-old-password').text(data.old_password);
                        }

                        if(data.new_password)
                        {
                            $('#error-new-password').show();
                            $('#error-new-password').text(data.new_password);
                        }

                        if(data.confirm_password)
                        {
                            $('#error-confirm-password').show();
                            $('#error-confirm-password').text(data.confirm_password);
                        }
                    }
                    else if (response.data.status === false) 
                    {
                        this.showErrorNotif()
                    } 
                    else if(response.data.status===true)
                    {
                        this.models = { old_password: '', new_password: '', confirm_password: '' }
                        this.showNotif()
                    }
                });
            },

    },

});
//end function change password
//vue custome directive sortable js https://github.com/RubaXa/Sortable

Vue.directive("sort", {
    bind: function(){
        $(this.el).sortable({
            axis: 'y',
            opacity: 0.7,
            handle: '.handle',
            placeholder: 'plcehldr',
            start: function(ev, ui){
              isMoved = false;
              init_X = cX = ev.pageX;
              init_Y = cY = ev.pageY;
              sortingEl = ui.item;
              placeholderEl = ui.placeholder;
              sortingEl.addClass("sort-el").siblings().addClass("sort-items sort-trans");
              sortingItems = $(this).find('.sort-items');
              $(this).addClass("sort-active");
              sort_items_length = sortingItems.length;
              if (!isMoved) {
              minTop = sortingEl[0].offsetTop;
                maxTop = sortingEl.parent().outerHeight() - minTop - sortingEl.outerHeight();
                sortingElHeight = sortingEl.outerHeight()+5; // 3 is[margin(top+bottom)/2]
              }
            },
            sort: function(ev,ui){
              isMoved = true;
              cX = ev.pageX;
              cY = ev.pageY;
              new_Y =  cY - init_Y;

              if (new_Y < -minTop){
                new_Y = -minTop;
              }
              if (new_Y > maxTop){
                new_Y = maxTop;
              }
              sortingEl.css({"transform":"translateY("+new_Y+"px)"});

              sortingItems.each(function () {
                var currentEl = $(this);
                if (currentEl[0] === sortingEl[0]) return;
                var currentElOffset = currentEl[0].offsetTop;
                var currentElHeight = currentEl.outerHeight();
                var sortingElOffset = sortingEl[0].offsetTop + new_Y;

                if ((sortingElOffset >= currentElOffset - currentElHeight / 2) && sortingEl.index() < currentEl.index()) {
                  currentEl.css({"transform":"translateY(-"+sortingElHeight+"px)"});
                  placeholderEl.insertAfter(currentEl);
                }
                else if ((sortingElOffset <= currentElOffset + currentElHeight / 2) && sortingEl.index() > currentEl.index()) {
                currentEl.css({"transform":"translateY("+sortingElHeight+"px)"});
                  placeholderEl.insertBefore(currentEl);
                  return false;
                }
                else {
                  $(this).css({"transform":"translateY(0px)"});
                }
              });
            },
            stop: function(ev,ui){
              $(this).removeClass("sort-active");
              isMoved = false;
              sortingEl.removeAttr("style").removeClass("sort-el");
              sortingItems.removeClass("sort-trans sort-items").removeAttr("style");
            }
        }) // fin sortable
    },
    update: function (value) {
            $(this.el).val(value).trigger('drop')
        },
    unbind: function () {
        $(this.el).off().sortable('destroy')
    }
})

//end vue custome directive sortable js




function setSelectedFolder()
{
    var CURRENT_SLUG = window.location.href.split("#")[1]
    var $SIDEBAR_MENU = $('.folder--nav')

    $SIDEBAR_MENU.find('a.folder--selected').removeClass("folder--selected")
    var addingClass = $SIDEBAR_MENU.find('a[href="#' + CURRENT_SLUG + '"]').addClass("folder--selected")

}

function property() {
    $('.btn__add').click(function()
    {
        var btn = $(this);
        var text = $(this).html();
        
        btn.removeClass('btn__add').addClass('btn__add btn__disable');
        //$('.new__form__input__field').val("");
        btn.parent().closest('.main__wrapper__content').find('.main__content__form__layer').slideDown(400);
    });

    $('.btn__add__cancel').click(function()
    {
        var btn = $(this);
        var text = $(this).html();
        
        btn.removeClass('btn__add__cancel').addClass('btn__add__cancel');
        $('.btn__disable').removeClass('btn__disable');
        $('.new__form__input__field').val("");
        btn.parent().closest('.main__wrapper__content').find('.main__content__form__layer').slideUp(400);
    });

    notify();

}

function setupCKEDITOR(){
	$(document).ready(function(){

		Vue.directive('rich-editor', {
	        twoWay: true,
	        /*bind: function () {
	            Vue.nextTick(this.setupEditor.bind(this));
	        },*/
	        bind: function () {
	            var self = this;
	            CKEDITOR.replace(this.el.id);
	            CKEDITOR.instances[this.el.id].setData(this);
	            CKEDITOR.instances[this.el.id].on('change', function () {
	                self.set(CKEDITOR.instances[self.el.id].getData());
	            });
	        },
	        setupEditor: function () {
	            // if (!document.contains(this.el))
	            //    return Vue.nextTick(this.bind.bind(this));
	            var vm = this;
	            CKEDITOR.replace(this.el.id);
	            CKEDITOR.instances[this.el.id].on('change', function () {
	                vm.set(CKEDITOR.instances[vm.el.id].getData());
	            });
	        },
	        update: function (value) {
	            if (!CKEDITOR.instances[this.el.id])
	                return Vue.nextTick(this.update.bind(this, value));
	            CKEDITOR.instances[this.el.id].setData(value);
	        },
	        unbind: function () {
	            CKEDITOR.instances[this.el.id].destroy();
	        }
	    })
	});
}

function pushNotifMessage(status,message, validation)
{
    
    var time = '10000';
    var container = $('.notifyjs-corner');
    var message_error_title = 'Sorry, there are few missing contents detected, please complete all the required fields.';

    if(status == true)
    {
        $('.notifyjs-corner').removeClass('hidden');
        $('.notif__form').addClass('notif__success');
        $("#data-value").text(message);
        $('.notifyjs-corner').slideDown(400).fadeIn('slow');
    }
    else
    {
        $('.notifyjs-corner').removeClass('hidden');
        $('.notif__form').addClass('notif__error');
        $("#data-value").text(message_error_title);
        $("#data-validation").html(validation);
        $('.notifyjs-corner').slideDown(400).fadeIn('slow');
    }

    function remove_notice() {
        container.stop().fadeOut('slow').remove()
    }
    
    var timer =  setInterval(remove_notice, time);
}

function pushNotifV2(status, title, message, autoHide, position)
{
    if (typeof autoHide == 'undefined') {
        autoHide = true
    }

    if (typeof title == 'undefined' || title == '' || title == 'default') {
        title = 'Sorry, there are few missing contents detected, please complete all the required fields.'
    }

    if (typeof position == 'undefined') {
        position = 'bottom left'
    }

    var className = '';
    if (status == false) {
        var className = 'error';
    }

    $.notify({
        title: title,
        message: message,
    }, {
        style: 'notif-msg',
        autoHide: autoHide,
        clickToHide: false,
        position: position,
        className: className
    });
}

function pushNotifV3(status, message)
{
    var time = '5000';
    if(status == true)
    {
        new TabbedNotification({
            title: 'Success !!',
            text: message,
            type: 'info',
            sound: false
        });
    }
    else{
        new TabbedNotification({
            title: 'Failed !!',
            text: message,
            type: 'error',
            sound: false
        });
    }

    function hideNotif()
    {
        var tabid = idname = '';

        $('.notification_close', function(e) {
            idname = $(this).parent().parent().attr("id");
            tabid = '10';
            $('#ntf' + tabid).remove();
            $('.notifications a').first().addClass('active');
            $('#notif-group div').first().css('display', 'block');
        });
    }

    var timer =  setInterval(hideNotif, time);
}




function showLoadingData()
{
    var options = {
        theme:"sk-cube-grid",
        textColor:"white",
    };
    HoldOn.open(options);
    
}

function hideLoading()
{
    HoldOn.close();
}

function replaceToCkEditor()
{
	$(".ckeditor").each(function(){
        CKEDITOR.replace( $(this).attr('id') );
    });

}

function destroyInstanceCkEditor()
{
    for (instance in CKEDITOR.instances) {
        if (CKEDITOR.instances[instance]) {
            CKEDITOR.instances[instance].destroy(true);
        }
    }
}

function showModalDelete()
{
    swal({
        title: "Ajax request example",
        text: "Submit to run ajax request",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    },
    function(){
        setTimeout(function(){
            swal("Ajax request finished!");
        }, 2000);
    });
}

function scrollTop()
{
    $('.main__content__layer').scrollTop(0);
}

function mainGeneral(){
    scrollTop();
    datePicker();
    setSelectedFolder();
    buttonClickOpen();
    buttonClickClose();
}

// INIT FUNCTION WEB CMS
function initDataRegistration()
{
    mainGeneral()
    crudDataRegistration();
    replaceToCkEditor();
}


// INIT FUNCTION WEB CMS
function initDataRegistrationInpatient()
{
    mainGeneral()
    crudDataRegistrationInpatient();
    replaceToCkEditor();
}


// INIT FUNCTION WEB CMS
function initDataDoctor()
{
    mainGeneral()
    crudDataDoctor();
    replaceToCkEditor();
}