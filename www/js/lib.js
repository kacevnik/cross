/**
 * Функции COOCIE ---------------------------------------------------
 */
     
    function setCookie(name, value, options){
        options = options || {};

        var expires = options.expires;

        if(typeof expires == "number" && expires){
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if(expires && expires.toUTCString){
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        for(var propName in options){
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if(propValue !== true){
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;
    }
    
    function getCookie(name){
        var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
/**
 * ---------------------------------------------------------------------------------
 */ 
    function reload_capcha(){
        document.getElementById('capcha').src = 'capcha.php';
    }
/**
 * ---------------------------------------------------------------------------------
 */ 
 
    function sub(){
        var login_id = document.getElementById('form_login');
        var login = login_id.value.trim();
        var email_id = document.getElementById('form_email');
        var email = email_id.value.trim();
        var pass_id = document.getElementById('form_pass');
        var pass = pass_id.value.trim();
        var pass2_id = document.getElementById('form_pass2');
        var pass2 = pass2_id.value.trim();
        var capcha_id = document.getElementById('form_capcha');
        var capcha = capcha_id.value.trim();
        var error_text = '';
        var error_div = document.getElementById('reg_error');
        error_div.style.opacity = 1;
        if(/^[a-zA-Z0-9]+[a-zA-Z0-9-_]{2,30}[a-zA-Z0-9]+$/.test(login)){
            if(/^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/.test(email)){
                if(/^[a-zA-Z0-9]{4,100}$/.test(pass)){
                    if(/^[a-zA-Z0-9]{4,100}$/.test(pass2)){
                        if(pass == pass2){
                            if(/^[a-zA-Z0-9]{4}$/i.test(capcha)){
                                return true;
                                                                
                            }else{                               
                                error_text = 'Проверочное поле заполненно не верно';
                                capcha_id.style.borderColor = '#C73030';
                                error_div.innerText = error_text;
                                return false;
                            }
                        }else{
                            error_text = 'Пароли разные, попробуйте еще раз!';
                            pass2_id.style.borderColor = '#C73030';
                            error_div.innerText = error_text;
                            return false;    
                        } 
                    }else{
                        error_text = 'Второе поле пароля не заполнено! Или заполнено неправильно, разререшены латинские символы и числа.';
                        pass2_id.style.borderColor = '#C73030';
                        error_div.innerText = error_text;
                        return false; 
                    }
                }else{
                    error_text = 'Первое поле пароля не заполнено! Или заполнено неправильно, разререшены латинские символы и числа.';
                    pass_id.style.borderColor = '#C73030';
                    error_div.innerText = error_text;
                    return false;
                }
            }else{
                error_text = 'Поле E-mail не заполнено! Или заполнено неправильно.';
                email_id.style.borderColor = '#C73030';
                error_div.innerText = error_text;
                return false;
            } 
        }else{
            error_text = 'Поле Логин не заполнено! Или заполнено неправильно, разререшены латинские символы и числа.';
            login_id.style.borderColor = '#C73030';
            error_div.innerText = error_text;
            return false;
        }
    }
    
    function clear_in(e){
        var error = document.getElementById('reg_error');
        e.value = '';
        e.style.borderColor = '#BDBDBD';
        var start = Date.now();
        if(error.style.opacity == 1){
            var timer = setInterval(function(){
                var def = Date.now() - start;
                if(def >= 2000){
                   clearInterval(timer);        
                   error.innerText = '';
                   return; 
                }
                error.style.opacity = 1 - (def/2000);
            }, 20);
        }

    }
    
    function closeErrorMessage(){
        $('#error_bg').css({'display': 'none'});
        $('error_bg span').css('display', 'block');
        $('#error_message').css({'display': 'none'});
        SetObj.scrolltop_flag = 1;
    }
    
    $('#error_bg').click(function(){
        closeErrorMessage();
    });
    
    $('#error_close').click(function(){
        closeErrorMessage();
    });