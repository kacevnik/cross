
    var SetObj = {
        backgroundColor: '',   
        backgroundImages: '',   
        backgroundStatus: 0,
        nabor:document.querySelectorAll('.cma'),        
        historyFirst:[document.querySelector('#work_file').innerHTML],  
        history:[document.querySelector('#work_file').innerHTML.replace(/ title="\(\d+ - \d+\)"/g, '').replace(/ title="\(\d+ - \d+\)"/g, '').replace(/ display: table-cell;/g, '').replace(/ display: none;/g, '').replace(/id="scroll_tr" style="[position: absolute; top: \d+px; left: \d+px;]*"/g, 'id="scroll_tr"')],
        size: 'cross_main',
        numlight: 0,
        showframe: 0,
        lastnum: 0,
        showxy: 0,
        timer: 0,
        scrolltop: document.cookie.split('scrolltop=')[1].charAt(0)
    }
    
    function fixWhich(e) {
        if (!e.which && e.button) { // если which нет, но есть button... (IE8-)
            if (e.button & 1) e.which = 1; // левая кнопка
            else if (e.button & 4) e.which = 2; // средняя кнопка
            else if (e.button & 2) e.which = 3; // правая кнопка
         }
    }
    
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
    }
    
    function hoverCrossPic(a,tr, td){
        fixWhich(a);
        var id = 'cma'+tr+'_'+td;
        var ed = document.querySelector('#'+id);
        var bCol = ed.style.backgroundColor;
        if(SetObj.numlight){
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
             
        if(a.which == 1){
            ed.style.backgroundColor = SetObj.backgroundColor;
            ed.style.backgroundImage = '';   
        }
        else if(a.which == 3){
            ed.style.backgroundColor = 'white';
            ed.style.backgroundImage = SetObj.backgroundImages;   
        }
    }
    
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
    
    function rewerse(e){
        if(SetObj.history.length > 1){
            SetObj.history.pop();
            document.querySelector('#work_file').innerHTML = SetObj.history[SetObj.history.length -1]; 
        }
        if(SetObj.history.length == 1){
            document.querySelector('#rew').innerText = '';   
        }
        else{
            document.querySelector('#rew').innerText = ' (' + (SetObj.history.length - 1) + ')';     
        }          
    }
    
    function biger(){
        var a = document.getElementById('work_file');
        var b = a.getElementsByTagName('DIV');
            if(parseInt(getComputedStyle(b[0]).width) >= 18 && parseInt(getComputedStyle(b[0]).width) <= 24){
                w = parseInt(getComputedStyle(b[0]).width) + 2;
                a.classList.remove(a.className);
                a.classList.add('cross_main_' + w);
                SetObj.size = 'cross_main_' + w;
                setCookie('size', 'cross_main_' + w, {expires: 31536000});
            }       
    }  
    
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
    } 
    
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
    
    function showTimer(){
        var a = document.getElementById('show_timer');
        var b = document.getElementById('timer');
        if(a.checked){
            b.style.display = 'none';
        }else{
            b.style.display = 'list-item';
        }
    }
    
    function showFrame(){
        var a = document.getElementById('show_frame');
        var b = document.getElementById('frame');
        if(a.checked){
            SetObj.showframe = 1;
            b.classList.add('frame');
            setCookie('frame', '1', {expires: 31536000});   
        }else{
            SetObj.showframe = 0;
            b.classList.remove(b.className);
            setCookie('frame', '0', {expires: 31536000})
        }
    }
    
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
    
    function clickBut(num){
        if(num == 1 || num == 2){
            var h = document.getElementById('height_cross'); 
            var a = parseInt(h.value.trim());
            if(!a){a = 1;} 
            if(num == 1 && a >= 2){
                a = a - 1; 
                h.value = a;
            }
            if(num == 2){
                a = a + 1; 
                h.value = a;    
            }   
        }
        if(num == 3 || num == 4){
            var w = document.getElementById('width_cross'); 
            var b = parseInt(w.value.trim());
            if(!b){b = 1;} 
            if(num == 3 && b >= 2){
                b = b - 1; 
                w.value = b;
            }
            if(num == 4){
                b = b + 1; 
                w.value = b;    
            }   
        }
        reSize();
    } 
    
    function showLink(){
        document.getElementById('show_link').style.display = 'table';
    } 
    
    function reSize(){
        var h = document.getElementById('height_cross'); 
        var a = parseInt(h.value.trim());
        var w = document.getElementById('width_cross'); 
        var b = parseInt(w.value.trim());
        var class_td = '';
        var class_tr = '';
        if(!a){a = 1;} 
        if(!b){b = 1;}
        var text = '<tbody><tr><td style="cursor: default; background: rgb(241, 241, 241); display: table-cell;" id="scroll_td1">&nbsp;</td><td id="scroll_td"><table><tbody><tr>';
        for(var i = 0; i < b; i++){
            if((i+1)%5 == 0 && (i+1)!= b){class_td = ' td_str5';}else{class_td = '';}
            text = text + '<td class="td_null'+class_td+'"></td>';
        }
        text = text + '</tr></tbody></table></td></tr><tr><td><table><tbody>';
        for(var j = 0; j < a; j++){
            if((j+1)%5 == 0 && (j+1)!=a){class_tr = ' class="tr_str5"';}else{class_tr = '';}
            text = text + '<tr'+class_tr+'><td class="td_null"></td></tr>';
        }
        text = text + '</tbody></table></td><td><table><tbody>';
        for(var k = 0; k < a; k++){
            if((k+1)%5 == 0 && (k+1)!=a){class_tr = ' class="tr_str5"';}else{class_tr = '';}
            text = text+ '<tr'+class_tr+'>';
            for(var u = 0; u < b; u++){
                if((u+1)%5 == 0 && (u+1)!= b){class_td = ' td_str5';}else{class_td = '';} 
                text = text + '<td class="cma'+class_td+'" id="cma'+k+'_'+u+'" onmousedown="crossPic(event, '+k+', '+u+')" onmouseover="hoverCrossPic(event, '+k+', '+u+')"><div>&nbsp;</div></td>';   
            }
            text = text + '<tr>';  
        }
        text = text + '</tr></tbody></table></td></tbody>';
        document.getElementById('work_file').innerHTML = text;
    } 
    
    function postSolution(id){
        var h = parseInt(document.getElementById('height_cross').value.trim())||1;
        var w = parseInt(document.getElementById('width_cross').value.trim())||1;
        var nabor = document.querySelectorAll('.cma');
        var cma = '';
        var top = [];
        for(var i = 0; i < nabor.length; i++){
            if(nabor[i].style.backgroundColor == 'black'){
                cma += '1'; 
            }else{
                cma += '0';
            }   
        }
        
        for(var t = 0; t < w; t++){
            top[t] = [];               
            var sum = 0;
            for(var k = 0; k < h; k++){
                var el = document.getElementById('cma'+k+'_'+t);
                if(el.style.backgroundColor == 'black'){
                    sum += 1; 
                }else{
                    if(sum > 0){top[t].push(sum);}
                    sum = 0;
                }
            }
            if(sum > 0){top[t].push(sum);}
            sum = 0;
            top[t].reverse();
        }
        
        var msize = maxSize(top);
        var left = returnLeft();
        var msizeL = maxSize(left);
        var topNew = replaceTop(top, msize);
        var topLeft = replaceLeft(left, msizeL);
        
        function maxSize(arr){
            var count = 0;
            for(var i = 0; i < arr.length; i++){
                if(count < arr[i].length){count = arr[i].length;}
            }
            return count;   
        }
        //
        function replaceTop(arr, size){
            var topString = '+';
            for(var i = 0; i < size; i++){
                topString = topString + '+';
                for(var j = 0; j < arr.length; j++){
                    if(arr[j][size-i-1]){topString = topString + '+' + arr[j][size-i-1] + ', 0-, ';}
                    else{topString = topString + '+n, 1-, ';}
                }
                topString = topString.replace(/, $/g, '');
                topString = topString + '-, ';
            }
            topString = topString.replace(/, $/g, '');
            topString = topString + '-';
            return topString;
        }
        
        function replaceLeft(arr, size){
            var topString = '+';
            for(var i = 0; i < arr.length; i++){
                topString = topString + '+';
                for(var j = size; j > 0; j--){
                    if(arr[i][j-1]){topString = topString + '+' + arr[i][j-1] + ', 0-, ';}
                    else{topString = topString + '+n, 1-, ';}
                }
                topString = topString.replace(/, $/g, '');
                topString = topString + '-, ';
            }
            topString = topString.replace(/, $/g, '');
            topString = topString + '-';
            return topString;
        }
        
        function returnLeft(){
            var left = [];
            for(var i = 0; i < h; i++){
                left[i] = [];               
                var s = 0;
                for(var j = 0; j < w; j++){
                    var e = document.getElementById('cma'+i+'_'+j);
                    if(e.style.backgroundColor == 'black'){
                        s += 1; 
                    }else{
                        if(s > 0){left[i].push(s);}
                        s = 0;
                    }
                }
                if(s > 0){left[i].push(s);}
                s = 0;
                left[i].reverse();
            }
            return left;    
        }
        
        var name = $('#add_name').val();
        var pass = $('#report_pass').val();
        
        $.post( "../inc/add_report_constructor.php", {solution: cma, top: topNew, left: topLeft, name: name, h: h, w: w, cross:id, pass:pass},function(data){
           document.getElementById('message').innerHTML = data;   
        });
    }
    
    function delCross(cross){
        var pass = $('#report_pass').val();
        
        $.post( "../inc/del_cross_constructor.php", {pass:pass, cross:cross},function(data){
           document.getElementById('message').innerHTML = data;   
        });
    }