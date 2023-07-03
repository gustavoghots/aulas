<?php
        class Login {
        private $login;
        private $senha;

        function __construct($login, $senha) {
            $this->login = $login;
            $this->senha = $senha;
        }

        function __destruct() {
            echo "<script>console.log('Debug Objects: Objeto destruido' );</script>";
        }

        public function getLogin() {
            return $this->login;
        }

        public function setLogin($login) {
            $this->Login = $login;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function setSenha($senha) {
            $this->Senha = $senha;
        }
    }
?>
