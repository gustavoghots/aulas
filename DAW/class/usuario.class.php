<?php
    class usuario {
        private $idUsuario;
        private $usuario;
        private $senha;
        private $CPF;
        private $email;
        private $numero;
        private $adm;

        // Métodos Get
        public function getIdUsuario() {
            return $this->idUsuario;
        }

        public function getUsuario() {
            return $this->usuario;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function getCPF() {
            return $this->CPF;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getNumero() {
            return $this->numero;
        }

        public function getAdm() {
            return $this->adm;
        }

        // Métodos Set
        public function setIdUsuario($idUsuario) {
            $this->idUsuario = $idUsuario;
        }

        public function setUsuario($usuario) {
            $this->usuario = $usuario;
        }

        public function setSenha($senha) {
            $this->senha = $senha;
        }

        public function setCPF($CPF) {
            $this->CPF = $CPF;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setNumero($numero) {
            $this->numero = $numero;
        }

        public function setAdm($adm) {
            $this->adm = $adm;
        }
    }
?>