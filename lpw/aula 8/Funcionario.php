<?php
    class Funcionario {
        private $nome;
        private $idade;
        private $salario;
        private $tipo;
        
        public function __construct($nome,$idade,$salario,$tipo){
            $this->nome=$nome;
            $this->idade=$idade;
            $this->salario=$salario;
            $this->tipo=$tipo;
        }
        
        public function getNome() {
            return $this->nome;
        }
        
        public function setNome($nome) {
            $this->nome = $nome;
        }
        
        public function getIdade() {
            return $this->idade;
        }
        
        public function setIdade($idade) {
            $this->idade = $idade;
        }

        public function getSalario() {
            switch ($this->tipo){
                case 'Gerente';
                    return (6*$this->salario)*0.90;
                break;
                case 'Contador';
                    return (4*$this->salario)*0.90;
                break;
                case 'Segurança';
                    return (2*$this->salario)*0.85;
                break;
                case 'Faxineiro';
                    return (2*$this->salario)*0.85;
                break;
                case 'Vendedor';
                    return $this->salario*0.87;
                break;
            }
        }
        
        public function setSalario($idade) {
            $this->salario = $salario;
        }

        public function getTipo(){
            return $this->tipo;
        }

    }
?>