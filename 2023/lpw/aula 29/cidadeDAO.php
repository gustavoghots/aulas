<?php
    include_once 'interf.php';
    class CidadeDAO implements CidadeInterf{
        function listarCidades(){
            require_once 'conexão.php';
            include_once 'cidade.php';
            $linhas = mysqli_query($banana, "select * from cidade where id=23");
            $linhas = mysqli_fetch_assoc($linhas);
            foreach ($linhas as $i => $linhas){
                $obj_cidade[] = new Cidade($linha['id'],$linha['nome'],$linha['estado']);
                echo $obj_cidade[$i]->getid()."-".$obj_cidade[$i]->getnome()."-".$obj_cidade[$i]->getestado()."<br>";
            }
        }
    }
?>