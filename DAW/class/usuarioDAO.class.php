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
        public function dados(Usuario $usuario){
            $sql = $this->conexao->prepare("select * from usuario where email = :login or usuario = :login");
            $sql->bindValue(":login", $usuario->getUsuario());
            $sql->execute();
            return $sql->fetch();
        }

        public function inserir(Usuario $usuario){
            $sql= $this->conexao->prepare(
                "insert into usuario (usuario,senha,CPF,email,numero, adm) values (:usuario,:senha,:CPF,:email,:numero,:adm)");
            $sql->bindValue(":usuario",$usuario->getUsuario());
            $sql->bindValue(":senha",$usuario->getSenha());
            $sql->bindValue(":CPF",$usuario->getCPF());
            $sql->bindValue(":email",$usuario->getEmail());
            $sql->bindValue(":numero",$usuario->getNumero());
            $sql->bindValue(":adm",$usuario->getAdm());
            return $sql->execute();
        }

        public function listar(){
            $sql= $this->conexao->prepare("select * from usuario where adm=true");
            $sql->execute();
            return $sql->fetchAll();
        }
    }
?>