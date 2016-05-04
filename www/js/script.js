    var nmv = [[[0, 1], [0, 1], [10, 0]], [[0, 1], [3, 0], [2, 0]], [[0, 1], [2, 0], [1, 0]], [[0, 1], [1, 0], [4, 0]], [[1, 0], [1, 0], [5, 0]], [[1, 0], [2, 0], [2, 0]], [[0, 1], [1, 0], [6, 0]], [[0, 1], [0, 1], [8, 0]], [[0, 1], [0, 1], [6, 0]], [[0, 1], [0, 1], [4, 0]]]; 
    
    var nml = [[[0, 1], [0, 1], [7, 0]], [[0, 1], [3, 0], [1, 0]], [[2, 0], [1, 0], [2, 0]], [[0, 1], [1, 0], [3, 0]], [[0, 1], [1, 0], [4, 0]], [[0, 1], [1, 0], [6, 0]], [[0, 1], [1, 0], [7, 0]], [[1, 0], [2, 0], [3, 0]], [[0, 1], [2, 0], [5, 0]], [[0, 1], [0, 1], [7, 0]]];
    
    var nmf = [[0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]];
    var bgColor = '';   
    var bgImg = '';   
    var bgStatus = 0; 
      
    function fc2(a,b,c){
        a.preventDefault();
        var id = 'nmf'+b+'_'+c;
        var ed = document.querySelector('#'+id);
        if(a.which == 1){
            if(ed.style.backgroundColor == 'black'){
                ed.style.backgroundColor = 'white';
                bgColor = 'white';
                ed.style.backgroundImage = '';
                nmf[b][c] = 0; 
                bgStatus = 0;  
            }
            else{
               ed.style.backgroundColor = 'black';
               bgColor = 'black';
               ed.style.backgroundImage = '';
               bgStatus = 1;
               nmf[b][c] = 1;
            }    
        }
        if(a.which == 3){
            if(ed.style.backgroundImage == '' || ed.style.backgroundColor == 'black'){
                ed.style.backgroundColor = 'white';
                ed.style.backgroundImage = 'url("http://www.nonograms.ru/i/cutout1b.gif")';
                bgImg = 'url("http://www.nonograms.ru/i/cutout1b.gif")'; 
                bgStatus = 2;
                nmf[b][c] = 2;     
            }
            else{
                ed.style.backgroundImage = '';
                bgimg = '';
                bgStatus = 0;
                nmf[b][c] = 0;
            } 
        }
        console.log(a.which);
        console.log(nmf[b]);
        console.log(bgStatus);
    }
    function fc4(a,b,c){
        var id = 'nmf'+b+'_'+c;
        var ed = document.querySelector('#'+id);
        var bCol = ed.style.backgroundColor;
        for(var i = 0; i < nmv[b].length; i++){
            if(nmv[b][i][0]){
                var sId = 'nmv'+b+'_'+i;
                var s = document.querySelector('#'+sId);
                s.classList.add('num_light_on');
            }
        }
        ed.onmouseout = function(e){
            for(var i = 0; i < nmv[b].length; i++){
                if(nmv[b][i][0]){
                    var sId = 'nmv'+b+'_'+i;
                    var s = document.querySelector('#'+sId);
                    s.classList.remove('num_light_on');
                    s.classList.add('num');
                }
            }   
        }
               
        
        if(a.which == 1){
            ed.style.backgroundColor = bgColor;
            nmf[b][c] = bgStatus;    
        }
        else if(a.which == 3){
            ed.style.backgroundColor = 'white';
            ed.style.backgroundImage = bgImg;
            nmf[b][c] = bgStatus;   
        }
        console.log(nmf[b]);
    }
    
    function fc7(e, a, b){
        var id = 'nmv'+a+'_'+b;
        var ed = document.querySelector('#'+id);
        if(e.which == 1){
            if(ed.style.backgroundImage == ''){
                nmv[a][b][1]=1;
                fc1(a, b);                
                ed.style.backgroundImage = 'url("http://www.nonograms.ru/i/cutout2b.gif")';
                ed.style.backgroundPosition = '50%, 50%'    
            }
            else{
               ed.style.backgroundImage = '';
               nmv[a][b][1]=0;
               fc1(a, b);
            }    
        }   
    }
    
    function fc1(a, b){
        var sum = 0;
        for(var i = 0; i < nmv[a].length; i++){
            sum += nmv[a][i][1];        
        }
        if(i == sum){
            for(var j = 0; j < nmf[a].length; j++){
                if(nmf[a][j] != 1 && nmf[a][j] != 2){
                   nmf[a][j] = 0;
                   var id = 'nmf'+a+'_'+j;
                   var ed = document.querySelector('#'+id);
                   ed.style.backgroundImage = 'url("http://www.nonograms.ru/i/cutout1b.gif")'; 
                }
            }    
        }               
    }
    
    function fc5(a, b){
        var sum = 0;
        for(var i = 0; i < nml[a].length; i++){
            sum += nml[a][i][1];        
        }
        if(i == sum){
            for(var j = 0; j < nmf.length; j++){
                if(nmf[j][a] != 1 && nmf[j][a] != 2){
                   nmf[j][a] = 0;
                   var id = 'nmf'+j+'_'+a;
                   var ed = document.querySelector('#'+id);
                   ed.style.backgroundImage = 'url("http://www.nonograms.ru/i/cutout1b.gif")'; 
                }
            }    
        }              
    }
    
    function fc3(e, a, b){
        var id = 'nml'+a+'_'+b;
        var ed = document.querySelector('#'+id);
        if(e.which == 1){
            if(ed.style.backgroundImage == ''){
                nml[a][b][1]=1;
                fc5(a, b);                
                ed.style.backgroundImage = 'url("http://www.nonograms.ru/i/cutout2b.gif")';
                ed.style.backgroundPosition = '50%, 50%'    
            }
            else{
               ed.style.backgroundImage = '';
               nml[a][b][1]=0;
               fc5(a, b);
            }    
        }   
    }