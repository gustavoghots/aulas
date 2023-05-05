<?php
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

    echo $if->GetNome()."<br".$if->GetIdade()."<br".$if->GetCnpj();
    echo $professor->GetNome()."<br>".$professor->GetIdade()."<br>".$professor->GetCpf()."<br>".$professor->GetSalario();
    foreach ($turma as $turma){
        $turma->GetNome()."<br>".$turma->GetIdade()."<br>".$turma->GetCpf()."<br>".$turma->GetNota();
    }
?>