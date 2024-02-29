<?php
//Jeito burro
    include_once 'aluno.php';
    include_once 'fisica.php';
    include_once 'juridica.php';
    include_once 'pessoa.php';
    include_once 'professor.php';

    $if = new Juridica('IFsul','10','???');
    $professor = new Professor('Alexandre','40??','???','Suficiente :)');

    $turma[] = new Aluno('Gustavo','17','???','10 confia');
    $turma[] = new Aluno('Fernanda','18','???','2');
    $turma[] = new Aluno('Ana','17','???','-10');
    $turma[] = new Aluno('Manuela','17','???','1');
    $turma[] = new Aluno('Isis','17','???','6');

    echo "<h2>Dados do IFsul:</h2>";
        echo "<ul>";
        echo "<li>Nome: " . $if->GetNome() . "</li>";
        echo "<li>Idade: " . $if->GetIdade() . "</li>";
        echo "<li>Cpf: " . $if->GetCnpj() . "</li>";
        echo "</ul><br><br>";
    echo "<h2>Dados do professor:</h2>";
        echo "<ul>";
        echo "<li>Nome: " . $professor->GetNome() . "</li>";
        echo "<li>Idade: " . $professor->GetIdade() . "</li>";
        echo "<li>Cpf: " . $professor->GetCpf() . "</li>";
        echo "<li>Nota: " . $professor->GetSalario() . "</li>";
        echo "</ul><br><br>";
    foreach ($turma as $turma){
        echo "<h2>Dados dos alunos:</h2>";
        echo "<ul>";
        echo "<li>Nome: " . $turma->GetNome() . "</li>";
        echo "<li>Idade: " . $turma->GetIdade() . "</li>";
        echo "<li>Cpf: " . $turma->GetCpf() . "</li>";
        echo "<li>Nota: " . $turma->GetNota() . "</li>";
        echo "</ul>";
    }
?>
