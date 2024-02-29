<html>
    <body>
        <form action="" method="post">
            <?php
                for($i=1; $i<4; $i++){
                    echo"<h1>Pessoa $i</h1>
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
        for($i=1; $i<4; $i++){
            $pessoa[$i]=new Pessoa($_POST["nome$i"],$_POST["idade$i"]);
        }
        $flag=True;
        for($i=1; $i<4; $i++){
            if(intval($pessoa[$i]->getIdade())>30){
                echo "<h2>Dados da Pessoa $i:</h2>";
                echo "<ul>";
                echo "<li>Nome: " . $pessoa[$i]->getNome() . "</li>";
                echo "<li>Idade: " . $pessoa[$i]->getIdade() . "</li>";
                echo "</ul>";
                $flag=False;
            }
        }
        if($flag==True){
            echo "<h2>Não existem pessoas com mais de 30 anos</h2>";
        }
    }
?>