<?php
    include_once 'pessoa.php';
    class Professor extends Pessoa {

        private $salario;

        public function GetSalario(){
            return $this->salario;
        }

        public function SetSalario($salario){
            $this->salario=$salario;
        }
    }
?>