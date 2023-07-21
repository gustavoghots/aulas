<?php
    include_once 'pessoa.php';
    class fisica extends Pessoa {

        private $cpf;

        function __construct($nome,$idade,$altura,$cpf){
            parent::setNome($nome);
            parent::setIdade($idade);
            parent::setAltura($altura);
            $this->cpf=$cpf;
        }
        public function GetCpf(){
            return $this->cpf;
        }

        public function SetCpf($cpf){
            $this->cpf=$cpf;
        }
    }
?>