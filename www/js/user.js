/*********************** Функция закладок в личном кабинете **********************************************/

    $('.lk_menu li').click(function(event) {
        $('.lk_tab_item').hide();
        $('#' + $(this).attr('data')).fadeIn(200);
        $('.lk_menu li').removeClass('activ');
        $(this).addClass('activ');
    });