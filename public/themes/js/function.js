function buttonClickOpen() {
    $('.content__btn a').click(function(){
        var id = $(this).attr('id');
        $('#'+ id + '-content').slideDown('swing');
        $('.content__btn a').removeClass('btn__disable');
        $(this).addClass('btn__disable');
        $('.main__content__form__layer').not($('#'+ id + '-content')).slideUp('swing');

        $('.folder--nav').addClass('folder--hidden');

        var filter = $('#filter-function');
        filter.fadeOut('swing');
    });
}
function buttonClickClose() {
    $('.form--top__btn a').click(function(){

        $('.content__btn a').removeClass('btn__disable');
        $(this).closest('.main__content__form__layer').slideUp('swing');

        $('.folder--nav').removeClass('folder--hidden');

        var filter = $('#filter-function');
        filter.fadeIn('swing');
    });
}
