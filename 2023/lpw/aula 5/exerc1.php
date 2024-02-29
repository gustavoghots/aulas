<html>
    <body>
        <form action="" method="post">
            <?php
                $indice= array('Aluno 1', 'Aluno 2', 'Professor');
                for($i=0; $i<3; $i++){
                    echo"<h1>$indice[$i]</h1>
                    <label>Nome:</label><br>
                    <input type='text' name='nome$i' required><br><br>
                    <label>Idade:</label><br>
                    <input type='text' name='idade$i' required><br><br>";
                }
            ?>
            <input type="submit" value="Enviar"><br>
        </form>
    </body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        require_once 'Pessoa.php';
        for($i=0; $i<3; $i++){
            $pessoa[$indice[$i]]=new Pessoa($_POST["nome$i"],$_POST["idade$i"]);
        }
        foreach($pessoa as $i=>$pessoa){
            echo "<h2>Dados da Pessoa $i:</h2>";
            echo "<ul>";
            echo "<li>Nome: " . $pessoa->getNome() . "</li>";
            echo "<li>Idade: " . $pessoa->getIdade() . "</li>";
            echo "</ul>";
        }
    }
?>