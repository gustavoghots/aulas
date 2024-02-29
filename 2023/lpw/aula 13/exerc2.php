<?php
    include_once 'pessoa.php';
    include_once 'fisica.php';
    include_once 'juridica.php';
    for($i=0;$i<1000;$i++){
        $type=rand(0,1);
        if($type==0){
            $lista[]= new Fisica();
        }else{
            $lista[]= new Juridica();
        }
        $lista[$i]->setIdade(rand(18,99));
        $lista[$i]->setNome(randString(3));
    }

    foreach ($lista as $lista){
        echo  $lista->getNome().' - '.$lista->getIdade()."<br>";
    }

    function randString($tamPalavra){
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $tamVar = strlen($chars);
        $retorno="";
        for( $x = 0; $x < $tamPalavra; $x++ )
        $retorno = $retorno.(String) $chars[ rand( 0, $tamVar - 1 ) ];
        return $retorno;
    }
?>