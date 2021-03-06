  
    var SetObj = {
        backgroundColor: '',
        backgroundImages: '',
        backgroundStatus: 0,
        countNumber: [],
        shownumber: document.getElementById('info_count_item').innerHTML,
        nabor:document.querySelectorAll('.cma'),
        history: getHistoruArray(),
        size: 'cross_main',
        numlight: document.cookie.split('numligth=')[1].charAt(0),
        showframe: document.cookie.split('frame=')[1].charAt(0),
        lastnum: 0,
        showxy: 0,
        timer: 0,
        countTimer: $('#sec_history').html(),
        scrolltop: document.cookie.split('scrolltop=')[1].charAt(0),
        scrolltop_flag: 1
    }
    
    var idTimer = '';
    document.getElementById('rew').innerHTML = (SetObj.history.length == 1)?'':' (' + (SetObj.history.length-1) + ')';
//--------------------------------------------------------------------------------------------------------- 
    function fixWhich(e) {
        if (!e.which && e.button) { // если which нет, но есть button... (IE8-)
            if (e.button & 1) e.which = 1; // левая кнопка
            else if (e.button & 4) e.which = 2; // средняя кнопка
            else if (e.button & 2) e.which = 3; // правая кнопка
         }
    }
//---------------------------------------------------------------------------------------------------------     
    function getEventType(e) {
       if (!e) e = window.event;
    }


/*********************** Функция отрисовки превью решения слева от основного меню ************************/

    $('.cma').mouseup(function(event) {
        showPreview();
    });

    function showPreview(){
        var Prev = {}
        var name_id = '';
        $('.cma').each(function(index, el) {
            if($(this).css('background-color') == 'rgb(0, 0, 0)'){
                name_id = $(this).attr('id');
                Prev[name_id] = 1;
            }
        });

        $('#small_cross_view table td').css('background-color', 'rgb(224, 224, 224)');

        $.each(Prev, function(index, el) {
            $('#prev_' + index).css('background-color', 'black');
        });
    }

//---------------------------------------------------------------------------------------------------------  
    function getHistoruArray(){
        var array = [];
        var item = [];
        var string_elem = '';
        var string = document.getElementById('array_history').innerHTML;
        if(string != ''){
            var mainArray = string.split(':'); 
            for(var i = 0; i < mainArray.length; i++){
                item = mainArray[i].split('+');
                for(var j = 0; j < item.length; j++){
                    item2 = item[j].split('-');
                    for(var h = 0; h < item2[0]; h++){
                        string_elem+= ''+item2[1];
                    }
                }
                array.push(string_elem);
                string_elem = '';
            }
            
        }else{
            array = [nabor()];
        }
        return array;
    } 
//---------------------------------------------------------------------------------------------------------    
    function crossPic(a, tr, td){
        fixWhich(a);
        a.preventDefault();
        var id = 'cma'+tr+'_'+td;
        var ed = document.querySelector('#'+id);
        if(a.which == 1){
            if(ed.style.backgroundColor == 'black'){
                ed.style.backgroundColor = 'white';
                SetObj.backgroundColor = 'white';
                ed.style.backgroundImage = '';
                SetObj.backgroundStatus = 0;  
            }
            else{
               ed.style.backgroundColor = 'black';
               SetObj.backgroundColor = 'black';
               ed.style.backgroundImage = '';
               SetObj.backgroundStatus = 1;
            }    
        }
        if(a.which == 3){
            if(ed.style.backgroundImage == '' || ed.style.backgroundColor == 'black'){
                ed.style.backgroundColor = 'white';
                ed.style.backgroundImage = 'url("images/slim_cross.gif")';
                SetObj.backgroundImages = 'url("images/slim_cross.gif")'; 
                SetObj.backgroundStatus = 2;
            }
            else{
                ed.style.backgroundImage = '';
                SetObj.backgroundImages = '';
                SetObj.backgroundStatus = 0;
            } 
        }
        if(SetObj.shownumber == 1){
            if(SetObj.backgroundStatus == 1){
                SetObj.countNumber.push(id);
            }
        }
    }
//---------------------------------------------------------------------------------------------------------     
    function hoverCrossPic(a, tr, td){
        fixWhich(a);
        var id = 'cma'+tr+'_'+td;
        var ed = document.querySelector('#'+id);
        var bCol = ed.style.backgroundColor;
        if(SetObj.numlight == '1'){
            for(var i = 0; i < cnt.length; i++){
                if(cnt[i][td][0] != 'n'){
                    var sId = 'cnt'+td+'_'+i;
                    var s = document.querySelector('#'+sId);
                    s.classList.add('kletka_light');
                }
            }

            for(var k = 0; k < cnl[tr].length; k++){
                if(cnl[tr][k][0] != 'n'){
                    var lId = 'cnl'+tr+'_'+k; 
                    var l = document.querySelector('#'+lId);
                    l.classList.add('kletka_light');
                }
            }
            ed.onmouseout = function(e){
                for(var j = 0; j < cnt.length; j++){
                    if(cnt[j][td][0] != 'n'){
                        var sId = 'cnt'+td+'_'+j;
                        var s = document.querySelector('#'+sId);
                        s.classList.remove('kletka_light');
                        s.classList.add('kletka');
                    }
                }
                for(var m = 0; m < cnl[tr].length; m++){
                    if(cnl[tr][m][0] != 'n'){
                        var uId = 'cnl'+tr+'_'+m;
                        var u = document.querySelector('#'+uId);
                        u.classList.remove('kletka_light');
                        u.classList.add('kletka');
                    }
                }
            }
        }

        document.getElementById('work_file').onclick = function(){
           if(SetObj.timer){return;}else{
           idTimer = setInterval(function(){
                SetObj.countTimer++; 
                seeTimer(SetObj.countTimer);
            }, 1000); 
            SetObj.timer = 1;
           }
        }

        if(navigator.userAgent.search(/Firefox/i) >= 0){
            if(a.buttons == 1){
                ed.style.backgroundColor = SetObj.backgroundColor;
                ed.style.backgroundImage = '';
            }
            else if(a.buttons == 2){
                ed.style.backgroundColor = 'white';
                ed.style.backgroundImage = SetObj.backgroundImages;
            }
        }else{
            if(a.which == 1){
                ed.style.backgroundColor = SetObj.backgroundColor;
                ed.style.backgroundImage = '';   
            }
            else if(a.which == 3){
                ed.style.backgroundColor = 'white';
                ed.style.backgroundImage = SetObj.backgroundImages;
            }
        }
        if(SetObj.shownumber == 1){
            if(SetObj.countNumber.length >= 1){
            document.getElementById('info_count_item').style.display = 'block';
                if(SetObj.countNumber.indexOf(id) < 0){
                    SetObj.countNumber.push(id);
                    document.getElementById('info_count_item').innerHTML = SetObj.countNumber.length;
                }
            }
        }
    }
//---------------------------------------------------------------------------------------------------------     
    function crossNumderTop(e, td, tr){
        var id = 'cnt'+td+'_'+tr;
        var ed = document.querySelector('#'+id);
        if(e != 0){
            if(e.which == 1){
                if(ed.style.backgroundImage == ''){
                    cnt[tr][td][1]=1;
                    crossLineVertical(td, tr);               
                    ed.style.backgroundImage = 'url("images/strong_cross.gif")';
                    ed.style.backgroundPosition = '50%, 50%'    
                }
                else{
                   ed.style.backgroundImage = '';
                   cnt[tr][td][1]=0;
                   crossLineVertical(td, tr);
                }    
            }
        }
        else{
        if(ed.style.backgroundImage == ''){
                    cnt[tr][td][1]=1;
                    crossLineVertical(td, tr);               
                    ed.style.backgroundImage = 'url("images/strong_cross.gif")';
                    ed.style.backgroundPosition = '50%, 50%'    
                }
                else{
                   ed.style.backgroundImage = '';
                   cnt[tr][td][1]=0;
                   crossLineVertical(td, tr);
                }    
        }   
    }
//---------------------------------------------------------------------------------------------------------     
    function crossLineVertical(td, tr){
        if(SetObj.lastnum == 1 || getCookie('lastnum') == 1){
            var sum = 0;
            for(var i = 0; i < cnt.length; i++){
                sum += cnt[i][td][1];        
            }
            if(i == sum){
                var nabor = document.querySelectorAll('.cma');
                for(var j = 0; j < nabor.length; j++){
                    var numberTD = nabor[j].id.slice(3).split('_');
                    if(numberTD[1] == td){
                        if(nabor[j].style.backgroundColor != 'black' && nabor[j].style.backgroundImage != 'url("images/slim_cross.gif")')
                            nabor[j].style.backgroundImage = 'url("images/slim_cross.gif")';
                        }
                    }
                }
            }
        }
    


//---------------------------------------------------------------------------------------------------------     
    function crossLineGorizontal(tr, td){
        if(SetObj.lastnum == 1 || getCookie('lastnum') == 1){
            var sum = 0;
            for(var i = 0; i < cnl[tr].length; i++){
                sum += cnl[tr][i][1];        
            }
            if(i == sum){
                var nabor = document.querySelectorAll('.cma');
                for(var j = 0; j < nabor.length; j++){
                    var numberTR = nabor[j].id.slice(3).split('_');
                    if(numberTR[0] == tr){                                   
                        if(nabor[j].style.backgroundColor != 'black' && nabor[j].style.backgroundImage != 'url("images/slim_cross.gif")'){
                            nabor[j].style.backgroundImage = 'url("images/slim_cross.gif")';
                        }                        
                    }
                }    
            } 
        }             
    }
//---------------------------------------------------------------------------------------------------------     
    function crossNumderLeft(e, tr, td){
        fixWhich(e);
        var id = 'cnl'+tr+'_'+td;
        var ed = document.querySelector('#'+id);
        if(e.which == 1){
            if(ed.style.backgroundImage == ''){
                cnl[tr][td][1]=1;
                crossLineGorizontal(tr, td);                
                ed.style.backgroundImage = 'url("images/strong_cross.gif")';
                ed.style.backgroundPosition = '50%, 50%'    
            }
            else{
               ed.style.backgroundImage = '';
               cnl[tr][td][1]=0;
               crossLineGorizontal(tr, td);
            }    
        }   
    }
    
    function nabor(){
        var nabor = document.querySelectorAll('.cma');
        var cma = '';
        for(var i = 0; i < nabor.length; i++){
            if(nabor[i].style.backgroundColor == 'black'){
                cma += '1'; 
            }else if(nabor[i].style.backgroundImage.search(/url/i) >= 0){
                cma += '2';
            }else{
                cma += '0';
            } 
        }
        return cma;
    }
//---------------------------------------------------------------------------------------------------------    
    function nabor_rewers(cma){
        var arr = cma.split('');
        var nabor = document.querySelectorAll('.cma');
        var id = '';
        for(var i = 0; i < nabor.length; i++){
            id = nabor[i].id;
            if(arr[i] == 1){
                document.getElementById(id).style.backgroundColor = 'black';
                document.getElementById(id).style.backgroundImage = ''; 
            }else if(arr[i] == 2){
                document.getElementById(id).style.backgroundColor = 'white';
                document.getElementById(id).style.backgroundImage = 'url("images/slim_cross.gif")';
            }else{
                document.getElementById(id).style.backgroundColor = 'white';
                document.getElementById(id).style.backgroundImage = '';
            } 
        }
    }
//---------------------------------------------------------------------------------------------------------     
    document.querySelector('body').onmouseup = function(e){
        cma = nabor();
        if(SetObj.history[SetObj.history.length - 1] != cma){; 
            SetObj.history.push(cma);
            if(SetObj.history.length > 1){
                document.querySelector('#rew').innerText = ' (' + (SetObj.history.length - 1) + ')';
            }                   
        }
        document.getElementById('info_count_item').style.display = 'none';
        SetObj.countNumber.length = 0;
    }
//---------------------------------------------------------------------------------------------------------     
    function rewerse(e){
        if(SetObj.history.length > 1){
            SetObj.history.pop();
            nabor_rewers(SetObj.history[SetObj.history.length - 1]); 
        }
        if(SetObj.history.length == 1){
            document.querySelector('#rew').innerText = '';
        }
        else{
            document.querySelector('#rew').innerText = ' (' + (SetObj.history.length - 1) + ')';
        }          
    }
//---------------------------------------------------------------------------------------------------------        
    function numLight(){
        var a = document.getElementById('num_ligth');
        if(a.checked){
            SetObj.numlight = 1;
            setCookie('numligth', '1', {expires: 31536000});
        }else{
            SetObj.numlight = 0;
            setCookie('numligth', '0', {expires: 31536000});
        }
    }
//---------------------------------------------------------------------------------------------------------     
    function showTimer(){
        var a = document.getElementById('show_timer');
        var b = document.getElementById('timer');
        if(a.checked){
            b.style.display = 'none';
        }else{
            b.style.display = 'list-item';
        }
    }
    
    if(SetObj.showframe == '1'){
        document.getElementById('frame').classList.add('frame');
    }
//---------------------------------------------------------------------------------------------------------     
    function showFrame(){
        var a = document.getElementById('show_frame');
        var b = document.getElementById('frame');
        if(a.checked){
            SetObj.showframe = '1';
            b.classList.add('frame');
            setCookie('frame', '1', {expires: 31536000});
        }else{
            SetObj.showframe = '0';
            b.classList.remove(b.className);
            setCookie('frame', '0', {expires: 31536000})
        }
    }
//---------------------------------------------------------------------------------------------------------     
    function showNumber(){
        var a = document.getElementById('scroll_show_number');
        if(a.checked){
            SetObj.shownumber = '1';
            setCookie('number', '1', {expires: 31536000});
        }else{
            SetObj.shownumber = '0';
            setCookie('number', '0', {expires: 31536000})
        }
    }
//---------------------------------------------------------------------------------------------------------     
    function lastNum(){
        var a = document.getElementById('last_num');
        if(a.checked){
            SetObj.lastnum = 1;
            setCookie('lastnum', '1', {expires: 31536000});
        }else{
            SetObj.lastnum = 0;
            setCookie('lastnum', '0', {expires: 31536000});
        }
    }
//---------------------------------------------------------------------------------------------------------     
    function showXY(){
        var a = document.getElementById('show_xy');
        var b = document.querySelectorAll('.cma');
        var id = '';
        if(a.checked){
            for(var i = 0; i < b.length; i++){
                if(b[i].hasAttribute('title'))break; 
                c = b[i].id.slice(3).split('_');
                var x = parseInt(c[0]) + 1; var y = parseInt(c[1]) + 1;
                b[i].setAttribute('title', '(' + x + ' - ' + y + ')');
            }
            SetObj.showxy = 1;
            setCookie('showxy', '1', {expires: 31536000});
        }else{
            for(var i = 0; i < b.length; i++){
                if(b[i].hasAttribute('title')){
                    b[i].removeAttribute('title');
                }
            }
            SetObj.showxy = 0;
            setCookie('showxy', '0', {expires: 31536000}); 
        }
    }
//---------------------------------------------------------------------------------------------------------     
    function scrollTopPanell(){
        var a = document.getElementById('scroll_top');
        if(a.checked){
            SetObj.scrolltop = 1;
            setCookie('scrolltop', '1', {expires: 31536000});
        }else{
            SetObj.scrolltop = 0;
            setCookie('scrolltop', '0', {expires: 31536000});
            var f = document.getElementById('scroll_tr'); //шапка
            var w = document.getElementById('scroll_td1');
            //стили по умолчанию
            f.style.position = 'relative';
            f.style.top = '';
            f.style.left = '';

            $('#small_cross_view').css({'position': 'relative' , 'top': '', 'margin-top': '25px'});
        }
    }
      
    var margin_f_top = document.getElementById('scroll_tr').getBoundingClientRect().top + window.pageYOffset || document.documentElement.scrollTop//отступ от верхнего края до шапки кроссвода
    var margin_f_ecv = document.getElementById('scroll_ecv').getBoundingClientRect().top + window.pageYOffset || document.documentElement.scrollTop//отступ от верхнего края нижней строчки
    window.onscroll = function() {
        var margin_f_left = document.getElementById('scroll_tr').getBoundingClientRect().left//отступ от левого края до фиксированного блока
        var f = document.getElementById('scroll_tr'); //шапка 
        var k = document.getElementById('scroll_td');
        if(SetObj.scrolltop == 1){
            if(SetObj.scrolltop_flag == 1){
                var scrollHeightf = Math.max(f.scrollHeight, f.offsetHeight, f.clientHeight);//высота шапки         
                //стили при начале прокрутки
                f.style.position = 'fixed';
                f.style.top = margin_f_top + 'px';
                var scrollTop = window.pageYOffset || document.documentElement.scrollTop;//размер прокрутки страницы
                if(scrollTop < margin_f_top){
                    f.style.top = (margin_f_top - scrollTop) + 'px';
                    f.style.left = margin_f_left + 'px';
                    k.style.height = (scrollHeightf - 2) + 'px';
                }else if(scrollTop < margin_f_ecv - scrollHeightf - 60){
                    f.style.top = 0 + 'px';
                    f.style.left = margin_f_left + 'px';
                    k.style.height = (scrollHeightf - 2) + 'px'
                }
                else{
                    f.style.top = (margin_f_ecv - scrollHeightf - 60 - scrollTop) + 'px';
                    f.style.left = margin_f_left + 'px';
                    k.style.height = (scrollHeightf - 2) + 'px'
                }

                $('#small_cross_view').css({'position': 'fixed' , 'top': $('#scroll_tr').css('top'), 'margin-top': '0'});
            }
        }else{
            f.style.position = 'relative';
        }
    } 
//---------------------------------------------------------------------------------------------------------     
    function smally(){
        var a = document.getElementById('work_file');
        var b = a.getElementsByTagName('DIV');
        if(parseInt(getComputedStyle(b[0]).width) >= 20 && parseInt(getComputedStyle(b[0]).width) <= 26){
            w = parseInt(getComputedStyle(b[0]).width) - 2;
            a.classList.remove(a.className);
            if(w <= 20){
                a.classList.add('cross_main');
                SetObj.size = 'cross_main';
                setCookie('size', 'cross_main', {expires: 31536000});
            }else{
                a.classList.add('cross_main_' + w);
                SetObj.size = 'cross_main_' + w;
                setCookie('size', 'cross_main_' + w, {expires: 31536000});
            }
        }
        $('#scroll_tr').attr('style', '');
        $('#scroll_td').attr('style', '');                 
    } 
//---------------------------------------------------------------------------------------------------------     
    function biger(){
        var a = document.getElementById('work_file');
        var b = a.getElementsByTagName('DIV');
        var c = document.getElementById('scroll_tr');
        if(parseInt(getComputedStyle(b[0]).width) >= 18 && parseInt(getComputedStyle(b[0]).width) <= 24){
            w = parseInt(getComputedStyle(b[0]).width) + 2;
            a.classList.remove(a.className);
            a.classList.add('cross_main_' + w);
            SetObj.size = 'cross_main_' + w;
            setCookie('size', 'cross_main_' + w, {expires: 31536000});
        }
        $('#scroll_tr').attr('style', '');
        $('#scroll_td').attr('style', '');       
    }       
//---------------------------------------------------------------------------------------------------------     
    function seeTimer(count){
        var a = document.getElementById('timer');
        s = count%60;
        s = (s<10)?'0' + s:s;
        m = Math.floor(count/60)%60;
        m = (m<10)?'0' + m:m;
        h = Math.floor(count/60/60);
        if(h == 24){count = 0;}
        h = (h<10)?'0' + h:h;
        a.innerHTML = h + ':' + m + ':' + s;
    } 
//---------------------------------------------------------------------------------------------------------     
    function solution(){
        $('#error_bg').css({'display': 'block'});
        $('#scroll_tr').attr('style', '');
        $('body').css('overflow-y', 'hidden');
        
        SetObj.scrolltop_flag = 0;
        
        var nabor = document.querySelectorAll('.cma');
        var last = '';
        var cma = ''; 
        
        for(var i = 0; i < nabor.length; i++){
            if(nabor[i].style.backgroundColor == 'black'){
                last += '1'; 
            }else{
                last += '0';
            }   
        }
        
        for(var i = 0; i < SetObj.history.length; i++){
            var arr = SetObj.history[i].split('');
            var a = 0;
            var b = 0;
            var c = 0;
            for(var j = 0; j < arr.length; j++){
                if(arr[j] == 0){a++;}
                if(arr[j] == 1){b++;}
                if(arr[j] == 2){c++;}
                if(arr[j] != arr[j + 1]){
                    if(a > 0){cma+= a + '-0+'; a = 0;}
                    if(b > 0){cma+= b + '-1+'; b = 0;}
                    if(c > 0){cma+= c + '-2+'; c = 0;}   
                }
            }
            cma = cma.slice(0, -1);
            cma+=':';
        }
        cma = cma.slice(0, -1);

        var cross = parseInt(location.href.split('?cross=')[1]);

        $.post( "../inc/solution_constructor.php", {solution:last, cross:cross, sec:SetObj.countTimer, history:cma}, function(data){
            var result = JSON.parse(data);
            if(result.type == 2){
                clearInterval(idTimer);
            }else if(result.type == 1){
                SetObj.scrolltop_flag = 0;
            }else{
                $('#error_bg').css({'display': 'none'}); 
                SetObj.scrolltop_flag = 0;
            }
            $('#error_bg span').css('display', 'none');
            $('#error_message').removeAttr('style').css({'display': 'block', 'min-width': '500px'});
            var e_h = $('#error_message').innerHeight();
            var e_w = $('#error_message').width();
            $('#error_message').css({'margin-left': -1*e_w/2 + 'px', 'margin-top': -1*e_h/2 + 'px'});
            $('#error_message_text').html(result.error_message);            
        });
    }
//---------------------------------------------------------------------------------------------------------     
    function answer(){
        $('body').css('overflow-y', 'hidden');
        $('#error_bg').css({'display': 'block'});
        $('#scroll_tr').attr('style', '');
        SetObj.scrolltop_flag = 0;
        
        var nabor = document.querySelectorAll('.cma');
        var cma = '';
        for(var i = 0; i < nabor.length; i++){
            if(nabor[i].style.backgroundColor == 'black'){
                cma += '1'; 
            }else{
                cma += '0';
            }
        }
        
        var cross = parseInt(location.href.split('?cross=')[1]);
        
        $.post( "../inc/answer_constructor.php", {answer: cma, cross:cross}, function(data){
            var result = JSON.parse(data);
            if(result.type == 2){
                $('#error_message').removeAttr('style').css({'display': 'block', 'padding': '5px', 'width': 'auto'});
                var e_h = result.height_img + 12;
                var e_w = result.width_img + 12;
                SetObj.scrolltop_flag = 0;
            }else if(result.type == 1){
                $('#error_message').removeAttr('style').css({'display': 'block', 'min-width': '500px'});
                var e_h = $('#error_message').outerHeight();
                var e_w = $('#error_message').outerWidth();
                SetObj.scrolltop_flag = 0;
            }else{
                $('#error_bg').css({'display': 'none'}); 
                SetObj.scrolltop_flag = 0;
            }
            
            $('#error_bg span').css('display', 'none');

            $('#error_message').css({'margin-left': -1*e_w/2 + 'px', 'margin-top': -1*e_h/2 + 'px'});
            $('#error_message').css({'display': 'none'});
            
            
            if(result.type == 2){
                $('#error_message').css({'display': 'block','margin-left': -1*e_w/2 + 'px', 'margin-top': -1*e_h/2 + 'px'});
            }else if(result.type == 1){
                $('#error_message').css({'display': 'block'});
            }else{
                $('#error_bg').css({'display': 'none'}); 
            }

            $('#error_message_text').html(result.error_message);
        });
    }
//---------------------------------------------------------------------------------------------------------     
    function save(){
        $('#error_bg').css({'display': 'block'});
        $('body').css('overflow-y', 'hidden');
        $('#scroll_tr').attr('style', '');
        SetObj.scrolltop_flag = 0;
        var cma = '';        
        var nabor = document.querySelectorAll('.cma');
        var last = '';
        for(var i = 0; i < nabor.length; i++){
            if(nabor[i].style.backgroundColor == 'black'){
                last += '1'; 
            }else{
                last += '0';
            }
        }
        
        for(var i = 0; i < SetObj.history.length; i++){
            var arr = SetObj.history[i].split('');
            var a = 0;
            var b = 0;
            var c = 0;
            for(var j = 0; j < arr.length; j++){
                if(arr[j] == 0){a++;}
                if(arr[j] == 1){b++;}
                if(arr[j] == 2){c++;}
                if(arr[j] != arr[j + 1]){
                    if(a > 0){cma+= a + '-0+'; a = 0;}
                    if(b > 0){cma+= b + '-1+'; b = 0;}
                    if(c > 0){cma+= c + '-2+'; c = 0;}
                }
            }
            cma = cma.slice(0, -1);
            cma+=':';
        }
        cma = cma.slice(0, -1);
        var cross = parseInt(location.href.split('?cross=')[1]);
        
        $.post( "../inc/save_constructor.php", {history:cma, answer:last, cross:cross, sec:SetObj.countTimer}, function(data){
            var result = JSON.parse(data);

            if(result.type == 1 || result.type == 2){
                $('#error_message').removeAttr('style').css({'display': 'block', 'min-width': '500px'});
                SetObj.scrolltop_flag = 0;
                if(result.type == 2){
                    clearInterval(idTimer);
                    SetObj.timer = 0;
                }
            }else{
                $('#error_bg').css({'display': 'none'}); 
                SetObj.scrolltop_flag = 0;
            }
            var e_h = $('#error_message').innerHeight();
            var e_w = $('#error_message').width();
            
            $('#error_bg span').css('display', 'none');

            $('#error_message').css({'margin-left': -1*e_w/2 + 'px', 'margin-top': -1*e_h/2 + 'px'});

            $('#error_message_text').html(result.error_message);
        });
    }
//---------------------------------------------------------------------------------------------------------     
    function clearCross(){
        var cross = parseInt(location.href.split('?cross=')[1]);
        $('body').css('overflow-y', 'hidden');
        $('#error_bg').css({'display': 'block'});
        $('#scroll_tr').attr('style', '');
        SetObj.scrolltop_flag = 0;
        $('#error_message').removeAttr('style').css({'display': 'block', 'min-width': '500px'});
        var e_h = $('#error_message').innerHeight();
        var e_w = $('#error_message').width();
        $('#error_message').css({'margin-left': -1*e_w/2 + 'px', 'margin-top': -1*e_h/2 + 'px'});
        $('#error_message_text').html('<div class="error_plus" style="margin-bottom: 10px;">Вы уверены, что хотите очистить все поля?<br><i style="font-size: 12px;">Вся история так же будет очищена</i></div><div class="seting_but3"><ul><li><a href="" onclick="clear_yes(' + cross + '); return false;">Да</a></li><li><a href="" onclick="closeErrorMessage(); return false;">Нет</a></li></ul></div>');       
    } 
//---------------------------------------------------------------------------------------------------------     
    function clear_yes(cross){
        $('#small_cross_view table td').css('background-color', 'white');
        var nabor = document.querySelectorAll('.cma');
        var cma = '';
        for(var i = 0; i < nabor.length; i++){
            if(nabor[i].style.backgroundColor == 'black'){
                cma += '1'; 
            }else if(nabor[i].style.backgroundImage.search(/url/i) >= 0){
                cma += '2';
            }else{
                cma += '0';
            } 
            if(nabor[i].hasAttribute('style')){
                nabor[i].removeAttribute('style');
            }
        }
        
        $.post( "../inc/clear_constructor.php", {cross: cross, answer: cma}, function(data){
            var result = JSON.parse(data);
            if(result.type == 1){
                $('#error_bg').css({'display': 'block'});
                $('#scroll_tr').attr('style', '');
                SetObj.scrolltop_flag = 0;
                $('#error_message').removeAttr('style').css({'display': 'block', 'min-width': '500px'});
                $('body').css('overflow-y', 'hidden');
                var e_h = $('#error_message').innerHeight();
                var e_w = $('#error_message').width();
                $('#error_message').css({'margin-left': -1*e_w/2 + 'px', 'margin-top': -1*e_h/2 + 'px'});
                $('#error_bg span').css('display', 'none');
                $('#error_message_text').html(result.error_message);
            }    
        });
        SetObj.timer = 0;
        clearInterval(idTimer);
        $('#timer').html('00:00:00');
        SetObj.countTimer = 0;
        SetObj.history.length = 0;
        var nabor1 = document.querySelectorAll('.cma');
        var cma1 = '';
        for(var i = 0; i < nabor1.length; i++){
            if(nabor1[i].style.backgroundColor == 'black'){
                cma1 += '1'; 
            }else if(nabor1[i].style.backgroundImage.search(/url/i) >= 0){
                cma1 += '2';
            }else{
                cma1 += '0';
            } 
        }
        SetObj.history = [cma1];
        document.querySelector('#rew').innerText = '';
        closeErrorMessage();
    }
//---------------------------------------------------------------------------------------------------------     
    function hoverFrame(e){
        var a = document.getElementById('info_count_item');
        a.style.top = e.clientY - 34 + "px"; 
        a.style.left = e.clientX - 24 + 'px';
    }
//---------------------------------------------------------------------------------------------------------     
    document.body.onmouseover = function(e){14
        if(e.target.id.search(/cma/) < 0 && e.target.parentNode.id.search(/cma/)){
            document.getElementById('info_count_item').style.display = 'none';
        }
    }   