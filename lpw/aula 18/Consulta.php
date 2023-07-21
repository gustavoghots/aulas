<?php
        class Consulta {
        private $nome;
        private $hora;
        private $esp;
        private $problema;

        function __construct($nome, $hora, $esp, $problema) {
            $this->nome = $nome;
            $this->hora = $hora;
            $this->esp = $esp;
            $this->problema = $problema;
        }

        function __destruct() {
            echo "Objeto destruido";
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function getHora() {
            return $this->hora;
        }

        public function setHora($hora) {
            $this->hora = $hora;
        }

        public function getEspecialidade() {
            return $this->esp;
        }

        public function setEspecialidade($esp) {
            $this->esp = $esp;
        }

        public function getProblema() {
            return $this->problema;
        }

        public function setProblema($problema) {
            $this->problema = $problema;
        }
    }
?>
