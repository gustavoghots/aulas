<?php
    include_once"usuario.class.php";
    class Usuario_DAO {
        private $conexao;
        public function __construct(){
            $this->conexao = new PDO("mysql:host=localhost;dbname=padel","root","");
        }
        public function login(usuario $usuario){
            $sql = $this->conexao->prepare("select * from login where email = :login or usuario = :login");
            $sql->bindValue(":login", $usuario->getUsuario());
            $sql->execute();
            return $sql->fetch();
        }
        public function senha(usuario $usuario){
            $sql = $this->conexao->prepare("select * from login where senha = :senha");
            $sql->bindValue(":senha", $usuario->getSenha());
            $sql->execute();
            return $sql->fetch();
        }
        public function dados(usuario $usuario){
            $sql = $this->conexao->prepare("select * from usuario where email = :login or usuario = :login");
            $sql->bindValue(":login", $usuario->getUsuario());
            $sql->execute();
            return $sql->fetch();
        }
    }
?>