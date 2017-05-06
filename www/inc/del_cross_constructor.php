<?php
    include("core.php");
    
    if (isset($_POST['cross']))       {$cross = $_POST['cross'];         $cross = (int)abs($cross);}
    if (isset($_POST['pass']))        {$pass = $_POST['pass'];           $pass = (int)abs($pass);}
    
    if($pass != date("G").'9564'){unset($pass); echo "<div class='error'>Неверный пароль</div>";}
        
    if($cross && $pass){                      
        if(mysqli_query($db, "DELETE FROM dk_cross WHERE id='$cross'")){
            echo "<div class='error_plus'>Кроссворд удален</div>";
        }
    }
?>