<?php
    include_once 'pessoa.php';
    class Fisica extends Pessoa {

        private $cpf;

        public function GetCpf(){
            return $this->cpf;
        }

        public function SetCpf($cpf){
            $this->cpf=$cpf;
        }
    }
?>