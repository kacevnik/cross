    var cnt = [[['n', 1], ['n', 1], ['n', 1], ['n', 1], [1, 0], [1, 0], ['n', 1], ['n', 1], ['n', 1], ['n', 1]], [['n', 1], [3, 0], [2, 0], [1, 0], [1, 0], [2, 0], [1, 0], ['n', 1], ['n', 1], ['n', 1]], [[10, 0], [2, 0], [1, 0], [4, 0], [5, 0], [2, 0], [6, 0], [8, 0], [6, 0], [4, 0]]]; 
    
    var cnl = [[['n', 1], ['n', 1], [7, 0]], [['n', 1], [3, 0], [1, 0]], [[2, 0], [1, 0], [2, 0]], [['n', 1], [1, 0], [3, 0]], [['n', 1], [1, 0], [4, 0]], [['n', 1], [1, 0], [6, 0]], [['n', 1], [1, 0], [7, 0]], [[1, 0], [2, 0], [3, 0]], [['n', 1], [2, 0], [5, 0]], [['n', 1], ['n', 1], [7, 0]]];
    
    var SetObj = {
        backgroundColor: '',   
        backgroundImages: '',   
        backgroundStatus: 0,
        nabor:document.querySelectorAll('.cma'),        
        historyFirst:[document.querySelector('#work_file').innerHTML],  
        history:[document.querySelector('#work_file').innerHTML]   
    } 

    function crossPic(a, tr, td){
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
        var id = 'cma'+tr+'_'+td;
        var ed = document.querySelector('#'+id);
        var bCol = ed.style.backgroundColor;
        
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
    
    function crossLineVertical(td, tr){
        var sum = 0;
        for(var i = 0; i < cnt.length; i++){
            sum += cnt[i][td][1];        
        }
        if(i == sum){            
            for(var j = 0; j < SetObj.nabor.length; j++){
                var numberTD = SetObj.nabor[j].id.slice(3).split('_');
                if(numberTD[1] == td){
                    if(SetObj.nabor[j].style.backgroundColor != 'black' && SetObj.nabor[j].style.backgroundImage != 'url("images/slim_cross.gif")')
                        SetObj.nabor[j].style.backgroundImage = 'url("images/slim_cross.gif")';
                }                    
            }
        }    
    }               

    
    function crossLineGorizontal(tr, td){
        var sum = 0;
        for(var i = 0; i < cnl[tr].length; i++){
            sum += cnl[tr][i][1];        
        }
        if(i == sum){
            for(var j = 0; j < SetObj.nabor.length; j++){
                var numberTR = SetObj.nabor[j].id.slice(3).split('_');
                if(numberTR[0] == tr){                                
                    if(SetObj.nabor[j].style.backgroundColor != 'black' && SetObj.nabor[j].style.backgroundImage != 'url("images/slim_cross.gif")'){
                        SetObj.nabor[j].style.backgroundImage = 'url("images/slim_cross.gif")';
                    }                        
                }
            }    
        }              
    }
    
    function crossNumderLeft(e, tr, td){
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
    
    document.querySelector('body').onmouseup = function(e){
        if(SetObj.history[SetObj.history.length - 1] != document.querySelector('#work_file').innerHTML){; 
            SetObj.history.push(document.querySelector('#work_file').innerHTML.replace(/ kletka_light/g, ''));
            if(SetObj.history.length > 1){
                document.querySelector('#rew').innerText = ' (' + (SetObj.history.length - 1) + ')';
                console.log(SetObj.history[SetObj.history.length - 1]);
            }       
        }   
    }
    
    function rewerse(e){
        if(SetObj.history.length > 1){
            SetObj.history.pop();
            document.querySelector('#work_file').innerHTML = SetObj.history[SetObj.history.length -1];
            SetObj.nabor = document.querySelectorAll('.cma') 
            console.log(SetObj.history.length);  
        }
        if(SetObj.history.length == 1){
            document.querySelector('#rew').innerText = '';   
        }
        else{
            document.querySelector('#rew').innerText = ' (' + (SetObj.history.length - 1) + ')';     
        }          
    }