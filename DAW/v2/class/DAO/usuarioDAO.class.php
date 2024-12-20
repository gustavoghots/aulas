<?php
    @include_once '../usuario.class.php';
    class Usuario_DAO {
        private $conexao;
        public function __construct(){
            $this->conexao = new PDO("mysql:host=localhost;dbname=padel","root","");
        }
        
        public function login(Usuario $usuario) {
            // Prepara a query para selecionar o usuário com base no email ou nome de usuário
            $sql = $this->conexao->prepare("SELECT * FROM Usuario WHERE email = :login OR usuario = :login");
            $sql->bindValue(":login", $usuario->getUsuario());
            $sql->execute();
        
            // Verifica se o usuário existe
            if ($sql->rowCount() > 0) {
                $retorno = $sql->fetch(); // Obtém os dados do usuário
        
                // Extrai o hash armazenado (que já inclui o salt e as informações do algoritmo)
                $storedHash = $retorno['senha'];
        
                // Verifica a senha usando o hash armazenado
                if (password_verify($usuario->getSenha(), $storedHash)) {
                    return $retorno; // Login bem-sucedido
                } else {
                    return 1; // Senha incorreta
                }
            } else {
                return 0; // Usuário não existe
            }
        }
        
        
        
        public function dados(Usuario $usuario){
            $sql = $this->conexao->prepare("select * from usuario where email = :login or usuario = :login");
            $sql->bindValue(":login", $usuario->getUsuario());
            $sql->execute();
            return $sql->fetch();
        }

        public function inserir(Usuario $usuario){
            // Gera o hash da senha usando o algoritmo Blowfish (bcrypt)
            $hashedPassword = password_hash($usuario->getSenha(), PASSWORD_BCRYPT);
        
            $sql = $this->conexao->prepare(
                "INSERT INTO usuario (usuario, senha, CPF, email, numero, adm) 
                VALUES (:usuario, :senha, :CPF, :email, :numero, :adm)"
            );
            $sql->bindValue(":usuario", $usuario->getUsuario());
            $sql->bindValue(":senha", $hashedPassword); // Armazena o hash gerado
            $sql->bindValue(":CPF", $usuario->getCPF());
            $sql->bindValue(":email", $usuario->getEmail());
            $sql->bindValue(":numero", $usuario->getNumero());
            $sql->bindValue(":adm", $usuario->getAdm());
            $sql->execute();
            return $this->conexao->lastInsertId();
        }
        
        

        public function listar($complemento = '1=1'){
            $sql= $this->conexao->prepare("select * from usuario where $complemento");
            $sql->execute();
            return $sql->fetchAll();
        }
        public function excluir($id){
            $sql= $this->conexao->prepare("delete from usuario where idusuario=:id");
            $sql->bindValue(":id",$id);
            return $sql->execute();
        }
        public function retornarADM($idUsuario){
            $sql= $this->conexao->prepare("select * from usuario where  idusuario = :idUsuario");
            $sql->bindValue(":idUsuario",$idUsuario);
            $sql->execute();
            return $sql->fetch();
        }
        public function editar(Usuario $objUsuario) {
            // Verifica se o usuário enviou uma nova senha
            if ($objUsuario->getSenha() != null && $objUsuario->getSenha() != "") {
                // Gera o hash da nova senha usando bcrypt (que já inclui o salt)
                $hashSenha = password_hash($objUsuario->getSenha(), PASSWORD_BCRYPT);
                
                // Prepara a query com a senha atualizada
                $sql = $this->conexao->prepare("UPDATE usuario 
                    SET usuario = :usuario, senha = :senha, CPF = :CPF, email = :email, numero = :numero, adm = :adm 
                    WHERE idUsuario = :idUsuario");
        
                $sql->bindValue(":senha", $hashSenha); // Atualiza a senha hashada
            } else {
                // Se a senha não foi enviada, mantemos a senha existente
                $sql = $this->conexao->prepare("UPDATE usuario 
                    SET usuario = :usuario, CPF = :CPF, email = :email, numero = :numero, adm = :adm 
                    WHERE idUsuario = :idUsuario");
            }
        
            // Faz o bind dos outros valores
            $sql->bindValue(":usuario", $objUsuario->getUsuario());
            $sql->bindValue(":CPF", $objUsuario->getCPF());
            $sql->bindValue(":email", $objUsuario->getEmail());
            $sql->bindValue(":numero", $objUsuario->getNumero());
            $sql->bindValue(":adm", $objUsuario->getAdm());
            $sql->bindValue(":idUsuario", $objUsuario->getIdUsuario());
        
            // Executa a query
            return $sql->execute();
        }
        
    }

?>