    function show_date(){
        var a = document.getElementById('show_date');
        var b = document.getElementById('show_set_date');
        if(a.checked){
            b.style.display = 'block';
        }else{
            b.style.display = 'none';
        }
    }