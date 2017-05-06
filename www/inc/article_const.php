<?php
    if(isset($_GET['id'])){$id = $_GET['id']; $id = (int)abs($id);}
    
    if(getArticleData($id)){$articleData = getArticleData($id);}else{header("Location: index.php"); exit();}
    $views = $articleData['views'] + 1;
    $up = mysqli_query($db, "UPDATE dk_articles SET views='$views' WHERE id='".$articleData["id"]."'");
?>