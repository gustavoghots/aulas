<?php
    $con = mysqli_connect("localhost","root","","lpw");
    if (mysqli_connect_errno()){
        echo "<script>console.log('falha ao conectar ao banco')</script>";
        exit();
    }
?>