<html>
    <form action="" method="GET">
        <?php
            $indice= array('cachorro1', 'cachorro2', 'gato');
            for($i=0; $i<3; $i++){
                echo"<h1>$indice[$i]</h1>
                <label>Nome:</label><br>
                <input type='text' name='nome$i' required><br><br>
                <label>Vocal:</label><br>
                <input type='text' name='vocal$i' required><br><br>";
                if($i != 2){
                    echo "<label>Cor do pelo:</label><br>
                    <input type='text' name='corDoPelo$i' required><br><br>";
                }
                else{
                    echo "<label>Tamanho da unha:</label><br>
                    <input type='text' name='tamUnha$i' required><br><br>";
                }
            }
        ?>
        <input type="submit" value="Enviar"><br>
    </form>
</html>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        include_once 'gato.php';
        include_once 'cachorro.php';
        include_once 'animal.php';
        for($i=0;$i<2;$i++){
            @$cachorro[$i] = new cachorro($_GET["nome$i"],$_GET["vocal$i"]);
            @$cachorro[$i]->SetCorDoPelo($_GET["corDoPelo$i"]);
        }
        @$gato = new Gato($_GET["nome2"],$_GET["vocal2"]);
        @$gato->SetTamUnha($_GET["tamUnha2"]);
        for($i=0;$i<2;$i++){
            $a=$i+1;
            echo "<h2>Dados do Animal Cachorro $a:</h2>";
            echo "<ul>";
            echo "<li>Nome: " . $cachorro[$i]->GetNome() . "</li>";    
            echo "<li>Vocal: " . $cachorro[$i]->GetVocal() . "</li>";
            echo "<li>Nota: " . $cachorro[$i]->GetCorDoPelo() . "</li>";
            echo "</ul>";
        }
        echo "<h2>Dados do Animal Gato:</h2>";
        echo "<ul>";
        echo "<li>Nome: " . $gato->GetNome() . "</li>";    
        echo "<li>Vocal: " . $gato->GetVocal() . "</li>";
        echo "<li>Salario: " . $gato->GetTamUnha() . "</li>";
        echo "</ul>";
    }
?>