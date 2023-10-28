<?php
    $con = new mysqli("localhost","root","","estados_cidades");
    if (mysqli_connect_errno()){
        echo "<script>console.log('falha ao conectar ao banco')</script>";
        exit();
    }
?>