<html>
    <body>
        <form action="" method="post">
            <?php
                for($i=1; $i<3; $i++){
                    echo"<h1>Pessoa $i</h1>
                    <label>Nome:</label><br>
                    <input type='text' name='nome$i' required><br><br>
                    <label>Idade:</label><br>
                    <input type='number' name='idade$i' required><br><br>";
                }
            ?>
            <input type="submit" value="Enviar"><br>
        </form>
    </body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        require_once 'Pessoa.php';
        for($i=1; $i<3; $i++){
            $pessoa[$i]=new Pessoa($_POST["nome$i"],$_POST["idade$i"]);
        }
        $soma=0;
        for($i=1; $i<3; $i++){
            $soma=$soma+intval($pessoa[$i]->getIdade());
        }
        echo "<h2>Soma idade Pessoas: $soma</h2>";
    }
?>