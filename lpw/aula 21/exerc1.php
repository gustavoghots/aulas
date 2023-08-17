<?php
    include_once 'conexão.php';
    $cidade = mysqli_query($con,"select nome from cidade");
    foreach ($cidade as $cidade){
        foreach ($cidade as $cidade){
            echo $cidade."<br>";
        }
    }
?>