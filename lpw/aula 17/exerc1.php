<?php
    include_once 'normal.php';
    include_once 'especial.php';
    include_once 'premium.php';

    for($i=0;$i<2;$i++){
        $lista[]= new Normal();
        $lista[]= new Especial();
        $lista[]= new Premium();
    }

    $count=0;
    foreach($lista as $i=>$lista){
        echo "<h2>Dados Conta $i</h2><h4>Nível: ".get_class($lista)."</h4>";
            echo "<ul>";
            echo "<li>Saldo: ".$lista->getSaldo()."</li>";
            $lista->remuneracao();
            echo "<li>Remunerado: ".$lista->getSaldo()."</li>";
            echo "</ul>";

        $count+=$lista->getSaldo();
    }
    echo "<br><h1 style='color:#dc143c'>valor somado: ".$count."</h1>";
?>