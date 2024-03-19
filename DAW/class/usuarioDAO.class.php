<?php
    include_once"usuario.class.php";
    class Usuario_DAO {
        private $conexao;
        public function __construct(){
            $this->conexao = new PDO("mysql:host=localhost;dbname=padel","root","");
        }
        public function login(usuario $usuario){
            $sql = $this->conexao->prepare("select * from Usuario where email = :login or usuario = :login");
            //por favor trocar de volta para a view!!!!!!!!
            $sql->bindValue(":login", $usuario->getUsuario());
            $sql->execute();
            if($sql->rowCount()>0){
                while($retorno = $sql->fetch()){
                    if($usuario->getSenha()==$retorno['senha']){
                        return $retorno;
                    }
                }
                return 1; // senha incorreta
            }else{
                return 0; //login não existe
            }
        }
        public function dados(usuario $usuario){
            $sql = $this->conexao->prepare("select * from usuario where email = :login or usuario = :login");
            $sql->bindValue(":login", $usuario->getUsuario());
            $sql->execute();
            return $sql->fetch();
        }
    }
?>