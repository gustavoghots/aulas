<?php
    $emailEnvio = $_POST['email'];
    $titulo = "NEFFEX Acount";
    $texto = "Welcome to NEFFEX club, we are happy to see you here. Acount Registered";
    $header = "FROM: NEFFEX_Club@gmail.com";

    if(mail($emailEnvio,$titulo,$texto/*,$header*/)){
        echo "Email enviado";
    }else{
        echo "Email não enviado";
    }
?>