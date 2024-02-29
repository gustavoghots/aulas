<html>
    <form action="" method="GET">
        <?php
            $indice= array('Aluno1', 'Aluno2', 'Professor');
            for($i=0; $i<3; $i++){
                echo"<h1>$indice[$i]</h1>
                <label>Nome:</label><br>
                <input type='text' name='nome$i' required><br><br>
                <label>Idade:</label><br>
                <input type='text' name='idade$i' required><br><br>";
                if($i != 2){
                    echo "<label>Nota:</label><br>
                    <input type='text' name='nota$i' required><br><br>";
                }
                else{
                    echo "<label>Salario:</label><br>
                    <input type='text' name='salario$i' required><br><br>";
                }
            }
        ?>
        <input type="submit" value="Enviar"><br>
    </form>
</html>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        include_once 'professor.php';
        include_once 'aluno.php';
        include_once 'pessoa.php';
        for($i=0;$i<2;$i++){
            $aluno[$i] = new Aluno($_GET["nome$i"],$_GET["idade$i"]);
            $aluno[$i]->SetNota($_GET["nota$i"]);
        }
        $professor = new Professor($_GET["nome2"],$_GET["idade2"]);
        $professor->SetSalario($_GET["salario2"]);
        for($i=0;$i<2;$i++){
            $a=$i+1;
            echo "<h2>Dados da Pessoa Aluno $a:</h2>";
            echo "<ul>";
            echo "<li>Nome: " . $aluno[$i]->GetNome() . "</li>";    
            echo "<li>Idade: " . $aluno[$i]->GetIdade() . "</li>";
            echo "<li>Nota: " . $aluno[$i]->GetNota() . "</li>";
            echo "</ul>";
        }
        echo "<h2>Dados da Pessoa Professor:</h2>";
        echo "<ul>";
        echo "<li>Nome: " . $professor->GetNome() . "</li>";    
        echo "<li>Idade: " . $professor->GetIdade() . "</li>";
        echo "<li>Salario: " . $professor->GetSalario() . "</li>";
        echo "</ul>";
    }
?>