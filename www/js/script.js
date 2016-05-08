    var cnt = [[['n', 1], ['n', 1], ['n', 1], ['n', 1], [1, 0], [1, 0], ['n', 1], ['n', 1], ['n', 1], ['n', 1]], [['n', 1], [3, 0], [2, 0], [1, 0], [1, 0], [2, 0], [1, 0], ['n', 1], ['n', 1], ['n', 1]], [[10, 0], [2, 0], [1, 0], [4, 0], [5, 0], [2, 0], [6, 0], [8, 0], [6, 0], [4, 0]]]; 
    
    var cnl = [[[0, 1], [0, 1], [7, 0]], [[0, 1], [3, 0], [1, 0]], [[2, 0], [1, 0], [2, 0]], [[0, 1], [1, 0], [3, 0]], [[0, 1], [1, 0], [4, 0]], [[0, 1], [1, 0], [6, 0]], [[0, 1], [1, 0], [7, 0]], [[1, 0], [2, 0], [3, 0]], [[0, 1], [2, 0], [5, 0]], [[0, 1], [0, 1], [7, 0]]];
    
    var cma = [[0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]];
    var bgColor = '';   
    var bgImg = '';   
    var bgStatus = 0; 
      
    function crossPic(a, tr, td){
        a.preventDefault();
        var id = 'cma'+tr+'_'+td;
        var ed = document.querySelector('#'+id);
        if(a.which == 1){
            if(ed.style.backgroundColor == 'black'){
                ed.style.backgroundColor = 'white';
                bgColor = 'white';
                ed.style.backgroundImage = '';
                cma[tr][td] = 0; 
                bgStatus = 0;  
            }
            else{
               ed.style.backgroundColor = 'black';
               bgColor = 'black';
               ed.style.backgroundImage = '';
               bgStatus = 1;
               cma[td][tr] = 1;
            }    
        }
        if(a.which == 3){
            if(ed.style.backgroundImage == '' || ed.style.backgroundColor == 'black'){
                ed.style.backgroundColor = 'white';
                ed.style.backgroundImage = 'url("images/slim_cross.gif")';
                bgImg = 'url("images/slim_cross.gif")'; 
                bgStatus = 2;
                cma[tr][td] = 2;     
            }
            else{
                ed.style.backgroundImage = '';
                bgimg = '';
                bgStatus = 0;
                cma[tr][td] = 0;
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
                s.classList.add('num_light_on');
            }
        }
        
        for(var k = 0; k < cnl[tr].length; k++){
            if(cnl[tr][k][0]){
                var lId = 'cnl'+tr+'_'+k; 
                var l = document.querySelector('#'+lId);
                l.classList.add('num_light_on');   
            }
        }
        ed.onmouseout = function(e){
            for(var j = 0; j < cnt.length; j++){
                if(cnt[j][td][0] != 'n'){
                    var sId = 'cnt'+td+'_'+j;
                    var s = document.querySelector('#'+sId);
                    s.classList.remove('num_light_on');
                    s.classList.add('num');
                }
            }
            for(var m = 0; m < cnl[tr].length; m++){
                if(cnl[tr][m][0]){
                    var uId = 'cnl'+tr+'_'+m;
                    var u = document.querySelector('#'+uId);
                    u.classList.remove('num_light_on');
                    u.classList.add('num');
                }
            }    
        }
             
        if(a.which == 1){
            ed.style.backgroundColor = bgColor;
            ed.style.backgroundImage = '';
            cma[tr][td] = bgStatus;    
        }
        else if(a.which == 3){
            ed.style.backgroundColor = 'white';
            ed.style.backgroundImage = bgImg;
            cma[tr][td] = bgStatus;   
        }
        console.log(bgColor);
        console.log(bgImg);
        console.log(bgStatus);
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
            for(var j = 0; j < cma.length; j++){
                if(cma[j][td] != 1 && cma[j][td] != 2){
                   cma[j][td] = 0;
                   var id = 'cma'+j+'_'+td;
                   var ed = document.querySelector('#'+id);
                   ed.style.backgroundImage = 'url("images/slim_cross.gif")'; 
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
            for(var j = 0; j < cma[tr].length; j++){
                if(cma[tr][j] != 1 && cma[tr][j] != 2){
                   cma[tr][j] = 0;
                   var id = 'cma'+tr+'_'+j;
                   var ed = document.querySelector('#'+id);
                   ed.style.backgroundImage = 'url("images/slim_cross.gif")'; 
                }
            }    
        }              
    }
    
    function crossNumderRight(e, tr, td){
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