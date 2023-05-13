<?php
    echo "<body>
            <form method='POST' action=''>
                <label>Salario minimo:</label><br>
                <input type='number' name='salario' required><br><br>
                <input type='submit' value='Enviar'><br><br><br>
            </form>
        </body>";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include_once 'Funcionario.php';
        $Funcionario['Gerente']= new Funcionario('Gustavo',17,$_POST['salario'],'Gerente');
        $Funcionario['Contador']= new Funcionario('Fernanda',18,$_POST['salario'],'Contador');
        $Funcionario['Segurança1']= new Funcionario('Manuela',17,$_POST['salario'],'Segurança');
        $Funcionario['Segurança2']= new Funcionario('Ana',17,$_POST['salario'],'Segurança');
        $Funcionario['Faxieniro1']= new Funcionario('Samuel',17,$_POST['salario'],'Faxineiro');
        $Funcionario['Faxieniro2']= new Funcionario('Isis',17,$_POST['salario'],'Faxineiro');
        $Funcionario['Vendedor1']= new Funcionario('Oliver',17,$_POST['salario'],'Vendedor');
        $Funcionario['Vendedor2']= new Funcionario('João',17,$_POST['salario'],'Vendedor');
        $Funcionario['Vendedor3']= new Funcionario('Vinicius',17,$_POST['salario'],'Vendedor');
        $Funcionario['Vendedor4']= new Funcionario('Gabriel',18,$_POST['salario'],'Vendedor');
        foreach ($Funcionario as $Funcionario){
            echo "<h2>Dados do ". $Funcionario->getTipo().":</h2>";
            echo "<ul>";
            echo "<li>Nome: " . $Funcionario->getNome() . "</li>";
            echo "<li>Idade: " . $Funcionario->getIdade() . "</li>";
            echo "<li>Salario: " . $Funcionario->getSalario() . "</li>";
            echo "</ul><br><br>";
        }
    }
?>