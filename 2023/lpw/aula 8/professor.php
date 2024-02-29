<?php
    include_once 'fisica.php';
    class Professor extends Fisica {

        private $salario;

        public function __construct($nome,$idade,$cpf,$salario){
            parent::SetNome($nome);
            parent::SetIdade($idade);
            parent::SetCpf($cpf);
            $this->salario=$salario;
        }

        public function GetSalario(){
            return $this->salario;
        }

        public function SetSalario($salario){
            $this->salario=$salario;
        }
    }
?>