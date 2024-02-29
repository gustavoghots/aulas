<?php
$T = (int) fgets(STDIN);
$resp = explode(" ", fgets(STDIN));
$respCorreta = 0;
$N = 5;
while ($N--) { 
    $competidorAtual = (int) $resp[$N];
    if($competidorAtual == $T) {
        $respCorreta++;
    }
}
echo $respCorreta . PHP_EOL;