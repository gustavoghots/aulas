<?php
    require_once 'conexão.php';
    include_once 'cidade.php';
    include_once 'interf.php';
    class CidadeDAO implements CidadeInterf{
        function listarCidades(){
            $linhas = mysqli_fetch_assoc(mysqli_query($con, "select * from cidade where id=23"));
            foreach ($linhas as $i => $linhas){
                $obj_cidade[] = new Cidade($linha['id'],$linha['nome'],$linha['estado']);
                echo $obj_cidade[$i]->getid()."-".$obj_cidade[$i]->getnome()."-".$obj_cidade[$i]->getestado()."<br>";
            }
        }
    }
?>