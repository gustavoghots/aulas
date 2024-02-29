<?php
    include_once 'Consulta.php';
    $obj_consuta = new Consulta($_POST['nome'],$_POST['hora'],$_POST['especialidade'],$_POST['problema']);

    echo "<h2>Dados Consulta</h2>";
    echo "<ul>";
    echo "<li>Nome: ".$obj_consuta->getNome()."</li>";
    echo "<li>Hora: ".$obj_consuta->getHora()."</li>";
    echo "<li>Especialidade: ".$obj_consuta->getEspecialidade()."</li>";
    echo "<li>Problema: ".$obj_consuta->getProblema()."</li>";
    echo "</ul>";
?>