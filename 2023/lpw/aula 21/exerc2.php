<?php
    include_once 'conexão.php';
    $cidade = mysqli_query($con,"select nome from cidade where estado=23");
    $i=0;
    foreach ($cidade as $cidade){
        foreach ($cidade as $cidade){
            echo $i."-".$cidade."<br>";
            $i++;
        }
    }
?>