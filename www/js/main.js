    /************************* функция отработки кнопки и поиска соответсвующего модуля в header ****************/

    $('#but_search_header').click(function(event) {
        if($(this).children('i').hasClass('fa-search')){
            $(this).children('i').removeClass('fa-search');
            $(this).children('i').addClass('fa-times');
            $('.search_form_header').fadeIn('300')
        }else{
            $(this).children('i').removeClass('fa-times');
            $(this).children('i').addClass('fa-search');
            $('.search_form_header').fadeOut('300');
            $('#search_input').val('');
            $('#search_result ul li').remove();
            $('#search_result').hide();
        }
        return false;
    });

    $('#search_input').keyup(function(event) {
        if($(this).val().length > 2){
            var text = $(this).val();
            $('#search_result').show();
            $('#search_result li').remove();
            $.each(SearchObj, function(index, el){
                var patern = new RegExp(text,'i');
                if(patern.test(el)){
                    $('#search_result ul').append('<li><a href="http://samurai-ka.ru/cross.php?cross=' + index + '">' + el + '</a></li>');
                }
            });
        }else{
            $('#search_result').hide();
        }
    });