/*********************** Функция закладок в личном кабинете **********************************************/

    $('.lk_menu li').click(function(event) {
        $('.lk_tab_item').hide();
        $('#' + $(this).attr('data')).fadeIn(200);
        $('.lk_menu li').removeClass('activ');
        $(this).addClass('activ');
    });

    $('.message_autor a').click(function(event) {
        var hash = $(this).parent().parent().attr('data-hash');
        var id = document.location.href.split('id=');
        id = id[1];
        $.ajax({
            url: '../inc/read_message.php',
            type: 'POST',
            data: {hash: hash, id: id},
            success: function(result_com){
                var res = $.parseJSON(result_com);
            }
        });
        showMessageWindow('#' + hash);
        $(this).parent().parent().removeClass('message_bold');
        clearCount();
        return false;
    });

    $('.message_name a').click(function(event) {
        var hash = $(this).parent().parent().attr('data-hash');
        var id = document.location.href.split('id=');
        id = id[1];
        $.ajax({
            url: '../inc/read_message.php',
            type: 'POST',
            data: {hash: hash, id: id},
            success: function(result_com){
                var res = $.parseJSON(result_com);
            }
        });
        showMessageWindow('#' + hash);
        $(this).parent().parent().removeClass('message_bold');
        clearCount();
        return false;
    });

    $('.message_item_menu').find('.fa-eye').parent().click(function(event) {
        var hash = $(this).parent().parent().parent().parent().attr('data-hash');
        var id = document.location.href.split('id=');
        id = id[1];
        $.ajax({
            url: '../inc/read_message.php',
            type: 'POST',
            data: {hash: hash, id: id},
            success: function(result_com){
                var res = $.parseJSON(result_com);
            }
        });
        showMessageWindow('#' + hash);
        $(this).parent().parent().parent().parent().removeClass('message_bold');
        clearCount();
        return false;
    });

    $('.message_item_menu').find('.fa-check-square-o').parent().click(function(event) {
        var hash = $(this).parent().parent().parent().parent().attr('data-hash');
        var id = document.location.href.split('id=');
        id = id[1];
        $.ajax({
            url: '../inc/read_message.php',
            type: 'POST',
            data: {hash: hash, id: id},
            success: function(result_com){
                var res = $.parseJSON(result_com);
            }
        });
        $(this).parent().parent().parent().parent().removeClass('message_bold');
        clearCount();
        return false;
    });

    function showMessageWindow(win){
        $('html, body').addClass('no_scroll');
        $('#comment_back_list').height($(document).height()).show();
        $('#add_comment_body').css({top: $(window).scrollTop() + ($(window).height() - $('#add_comment_body').outerHeight(true)) / 2 - 40 + 'px', left: ($(window).width() - $('#add_comment_body').outerWidth(true)) / 2 + 'px'}).find('.content_message').html($(win).html());
    }

    function clearCount(){
        var count = $('li[data="lk_message"]').find('span').html();
        if(count == 1){
            $('li[data="lk_message"]').find('span').remove();
        }
        else{
            $('li[data="lk_message"]').find('span').html(count - 1);
        }
    }



